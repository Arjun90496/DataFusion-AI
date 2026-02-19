<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ApiKey;
use App\Services\ApiAdapters\ApiAdapterFactory;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class AiSearchController extends Controller
{
    public function index()
    {
        return view('ai-search.index');
    }

    public function search(Request $request)
    {
        $request->validate(['query' => 'required|string|max:500']);
        
        $query = $request->input('query');
        $userId = auth()->id();
        
        // Rate limiting
        $key = "ai_search:{$userId}";
        if (Cache::get($key, 0) >= 10) {
            return response()->json(['success' => false, 'message' => 'Rate limit exceeded. Try again later.'], 429);
        }
        Cache::increment($key, 1);
        Cache::expire($key, 60);
        
        // Get user's API keys
        $apiKeys = ApiKey::forUser($userId)->enabled()->with('provider')->get();
        
        if ($apiKeys->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No API keys configured. Please add API keys first.'
            ], 400);
        }
        
        // Analyze query with AI to determine what data to fetch
        $intent = $this->analyzeIntent($query);
        
        // Fetch relevant data
        $results = $this->fetchRelevantData($apiKeys, $intent, $query);
        
        // Generate AI response
        $response = $this->generateAiResponse($query, $results);
        
        return response()->json([
            'success' => true,
            'query' => $query,
            'intent' => $intent,
            'data' => $results,
            'response' => $response
        ]);
    }

    protected function analyzeIntent($query)
    {
        $query = strtolower($query);
        $intent = ['weather' => false, 'news' => false, 'crypto' => false];
        
        // Weather keywords
        if (preg_match('/\b(weather|temperature|rain|sunny|climate|forecast|cold|hot|humidity)\b/', $query)) {
            $intent['weather'] = true;
        }
        
        // News keywords
        if (preg_match('/\b(news|article|headline|story|report|latest|breaking|update)\b/', $query)) {
            $intent['news'] = true;
        }
        
        // Crypto keywords
        if (preg_match('/\b(crypto|bitcoin|btc|ethereum|eth|coin|price|market|trading)\b/', $query)) {
            $intent['crypto'] = true;
        }
        
        // If no specific intent, fetch all
        if (!$intent['weather'] && !$intent['news'] && !$intent['crypto']) {
            $intent = ['weather' => true, 'news' => true, 'crypto' => true];
        }
        
        return $intent;
    }

    protected function fetchRelevantData($apiKeys, $intent, $query)
    {
        $results = [];
        
        foreach ($apiKeys as $apiKey) {
            $slug = $apiKey->provider->slug;
            
            try {
                if ($intent['weather'] && in_array($slug, ['openweathermap', 'weather'])) {
                    $adapter = ApiAdapterFactory::make($apiKey);
                    $response = $adapter->fetch($this->extractWeatherParams($query));
                    if ($response->success) {
                        $results['weather'] = ['success' => true, 'data' => $response->data];
                    }
                }
                
                if ($intent['news'] && in_array($slug, ['newsapi', 'news'])) {
                    $adapter = ApiAdapterFactory::make($apiKey);
                    $response = $adapter->fetch($this->extractNewsParams($query));
                    if ($response->success) {
                        $results['news'] = ['success' => true, 'data' => $response->data];
                    }
                }
                
                if ($intent['crypto'] && in_array($slug, ['coingecko', 'crypto', 'finance'])) {
                    $adapter = ApiAdapterFactory::make($apiKey);
                    $response = $adapter->fetch($this->extractCryptoParams($query));
                    if ($response->success) {
                        $results['crypto'] = ['success' => true, 'data' => $response->data];
                    }
                }
            } catch (\Exception $e) {
                Log::error("AI Search fetch error: " . $e->getMessage());
                $results['_errors'][] = "Failed to fetch data from {$slug}";
            }
        }
        
        return $results;
    }

    protected function extractWeatherParams($query)
    {
        // Extract city name if mentioned
        preg_match('/\b(in|at|for)\s+([a-z\s]+?)(?:\s|$|\?)/i', $query, $matches);
        return ['city' => $matches[2] ?? 'London'];
    }

    protected function extractNewsParams($query)
    {
        // Extract topic keywords
        $keywords = ['technology', 'business', 'sports', 'health', 'science'];
        foreach ($keywords as $keyword) {
            if (stripos($query, $keyword) !== false) {
                return ['q' => $keyword];
            }
        }
        return ['q' => 'latest'];
    }

    protected function extractCryptoParams($query)
    {
        // Extract specific coins if mentioned
        if (preg_match('/\b(bitcoin|btc)\b/i', $query)) {
            return ['ids' => 'bitcoin'];
        }
        if (preg_match('/\b(ethereum|eth)\b/i', $query)) {
            return ['ids' => 'ethereum'];
        }
        return ['ids' => 'bitcoin,ethereum'];
    }

    protected function generateAiResponse($query, $results)
    {
        $apiKey = config('services.openai.api_key');
        
        if (empty($apiKey)) {
            return $this->generateFallbackResponse($query, $results);
        }
        
        try {
            $prompt = $this->buildPrompt($query, $results);
            
            $response = Http::withHeaders([
                'Authorization' => "Bearer {$apiKey}",
                'Content-Type' => 'application/json',
            ])->timeout(10)->post('https://api.openai.com/v1/chat/completions', [
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    ['role' => 'system', 'content' => 'You are a helpful AI assistant that provides concise, accurate answers based on real-time data.'],
                    ['role' => 'user', 'content' => $prompt]
                ],
                'max_tokens' => 300,
                'temperature' => 0.7,
            ]);
            
            if ($response->successful()) {
                $data = $response->json();
                return $data['choices'][0]['message']['content'] ?? 'No response generated';
            }
        } catch (\Exception $e) {
            Log::error("OpenAI API error: " . $e->getMessage());
        }
        
        return $this->generateFallbackResponse($query, $results);
    }

    protected function buildPrompt($query, $results)
    {
        $prompt = "User asked: \"{$query}\"\n\nAvailable data:\n";
        
        if (isset($results['weather'])) {
            $w = $results['weather'];
            $location = $w['location']['name'] ?? 'Unknown';
            $temp = $w['current']['temperature'] ?? 'N/A';
            $desc = $w['weather']['description'] ?? 'N/A';
            $prompt .= "\nWeather: {$location}, {$temp}°C, {$desc}\n";
        }
        
        if (isset($results['news']['articles']) && is_array($results['news']['articles'])) {
            $prompt .= "\nTop News:\n";
            foreach (array_slice($results['news']['articles'], 0, 3) as $i => $article) {
                $title = $article['title'] ?? 'No title';
                $prompt .= ($i + 1) . ". {$title}\n";
            }
        }
        
        if (isset($results['crypto']['data']) && is_array($results['crypto']['data'])) {
            $prompt .= "\nCrypto Prices:\n";
            foreach ($results['crypto']['data'] as $coin) {
                $name = $coin['name'] ?? 'Unknown';
                $price = $coin['current_price'] ?? 'N/A';
                $change = $coin['change_24h'] ?? 'N/A';
                $prompt .= "- {$name}: \${$price} ({$change}%)\n";
            }
        }
        
        $prompt .= "\nProvide a concise, natural answer to the user's question based on this data.";
        
        return $prompt;
    }

    protected function generateFallbackResponse($query, $results)
    {
        $response = "Based on your query, here's what I found:\n\n";
        
        if (isset($results['weather'])) {
            $w = $results['weather'];
            $location = $w['location']['name'] ?? 'Unknown';
            $temp = $w['current']['temperature'] ?? 'N/A';
            $desc = $w['weather']['description'] ?? 'N/A';
            $response .= "🌤️ Weather in {$location}: {$temp}°C, {$desc}.\n\n";
        }
        
        if (isset($results['news']['articles']) && is_array($results['news']['articles'])) {
            $response .= "📰 Latest News:\n";
            foreach (array_slice($results['news']['articles'], 0, 3) as $article) {
                $title = $article['title'] ?? 'No title';
                $response .= "• {$title}\n";
            }
            $response .= "\n";
        }
        
        if (isset($results['crypto']['data']) && is_array($results['crypto']['data'])) {
            $response .= "💰 Cryptocurrency Prices:\n";
            foreach ($results['crypto']['data'] as $coin) {
                $name = $coin['name'] ?? 'Unknown';
                $price = $coin['current_price'] ?? 'N/A';
                $change = $coin['change_24h'] ?? 0;
                $changeStr = $change >= 0 ? '+' : '';
                $response .= "• {$name}: \${$price} ({$changeStr}{$change}%)\n";
            }
        }
        
        if (empty($results) || (count($results) === 1 && isset($results['_errors']))) {
            $response = "I couldn't find relevant data for your query.";
            if (isset($results['_errors'])) {
                $response .= " Errors: " . implode(', ', $results['_errors']);
            }
        } elseif (isset($results['_errors'])) {
            $response .= "\n⚠️ Note: Some data sources encountered errors.";
        }
        
        return $response;
    }
}
