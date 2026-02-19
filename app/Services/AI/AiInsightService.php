<?php

namespace App\Services\AI;

use App\Models\FusedData;
use App\Models\AiInsight;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * AiInsightService
 * 
 * Generates AI-powered insights from fused data using OpenAI API.
 * 
 * USAGE:
 * $service = new AiInsightService();
 * $insight = $service->generateInsights($fusedData);
 */
class AiInsightService
{
    protected string $apiKey;
    protected string $model = 'gpt-3.5-turbo';
    protected int $maxTokens = 500;
    
    public function __construct()
    {
        $this->apiKey = config('services.openai.api_key') ?? '';
    }
    
    /**
     * Generate insights from fused data
     * 
     * @param FusedData $fusedData
     * @return AiInsight
     */
    public function generateInsights(FusedData $fusedData): AiInsight
    {
        Log::info("Generating AI insights for fused_data: {$fusedData->id}");
        
        // Build prompt from fused data
        $prompt = $this->buildPrompt($fusedData->payload);
        
        // Call OpenAI API or use fallback if no key
        if (!empty($this->apiKey)) {
            try {
                $response = $this->callOpenAI($prompt);
                $insights = $this->parseResponse($response);
                $tokensUsed = $response['usage']['total_tokens'] ?? 0;
            } catch (\Exception $e) {
                Log::warning("AI service failed, using fallback: " . $e->getMessage());
                $insights = $this->generateFallbackInsights($fusedData->payload);
                $tokensUsed = 0;
            }
        } else {
            $insights = $this->generateFallbackInsights($fusedData->payload);
            $tokensUsed = 0;
        }
        
        // Save to database
        $aiInsight = AiInsight::create([
            'user_id' => $fusedData->user_id,
            'fused_data_id' => $fusedData->id,
            'summary' => $insights['summary'] ?? 'No summary available',
            'trends' => $insights['trends'] ?? [],
            'recommendations' => $insights['recommendations'] ?? [],
            'sentiment' => $insights['sentiment'] ?? 'neutral',
            'tokens_used' => $tokensUsed,
            'model_used' => empty($this->apiKey) ? 'rule-based-engine' : $this->model,
        ]);
        
        Log::info("AI insights generated successfully", [
            'insight_id' => $aiInsight->id,
            'tokens_used' => $aiInsight->tokens_used,
        ]);
        
        return $aiInsight;
    }
    
    /**
     * Build AI prompt from fused data payload
     * 
     * @param array $payload
     * @return string
     */
    protected function buildPrompt(array $payload): string
    {
        $prompt = "You are an AI data analyst for DataFusion AI. Analyze the following data snapshot and provide insights.\n\n";
        
        // Add environment data (weather)
        if (isset($payload['environment']['data'])) {
            $weather = $payload['environment']['data'];
            $location = $weather['location']['name'] ?? 'Unknown';
            $temp = $weather['current']['temperature'] ?? 'N/A';
            $condition = $weather['weather']['description'] ?? 'N/A';
            $humidity = $weather['current']['humidity'] ?? 'N/A';
            
            $prompt .= "WEATHER ({$location}):\n";
            $prompt .= "- Temperature: {$temp}°C\n";
            $prompt .= "- Condition: {$condition}\n";
            $prompt .= "- Humidity: {$humidity}%\n\n";
        }
        
        // Add briefing data (news)
        if (isset($payload['briefing']['data']['articles'])) {
            $articles = array_slice($payload['briefing']['data']['articles'], 0, 3);
            $prompt .= "TOP NEWS:\n";
            foreach ($articles as $i => $article) {
                $title = $article['title'] ?? 'No title';
                $prompt .= ($i + 1) . ". {$title}\n";
            }
            $prompt .= "\n";
        }
        
        // Add markets data (crypto)
        if (isset($payload['markets']['data']['data'])) {
            $cryptos = $payload['markets']['data']['data'];
            $prompt .= "CRYPTOCURRENCY MARKETS:\n";
            foreach ($cryptos as $crypto) {
                $id = strtoupper($crypto['id'] ?? 'Unknown');
                $price = $crypto['current_price'] ?? 'N/A';
                $change = $crypto['change_24h'] ?? 0;
                $changeSymbol = $change >= 0 ? '+' : '';
                $prompt .= "- {$id}: \${$price} ({$changeSymbol}{$change}%)\n";
            }
            $prompt .= "\n";
        }
        
        // Add task instructions
        $prompt .= "TASK: Analyze this data and provide insights in the following JSON format:\n";
        $prompt .= "{\n";
        $prompt .= '  "summary": "A brief 2-3 sentence overview of the key information",'."\n";
        $prompt .= '  "trends": ["Trend 1", "Trend 2", "Trend 3"],'."\n";
        $prompt .= '  "recommendations": ["Actionable recommendation 1", "Actionable recommendation 2"],'."\n";
        $prompt .= '  "sentiment": "positive|neutral|negative"'."\n";
        $prompt .= "}\n\n";
        $prompt .= "Respond ONLY with valid JSON, no additional text.";
        
        return $prompt;
    }
    
    /**
     * Call OpenAI API
     * 
     * @param string $prompt
     * @return array
     */
    protected function callOpenAI(string $prompt): array
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => "Bearer {$this->apiKey}",
                'Content-Type' => 'application/json',
            ])->timeout(30)->post('https://api.openai.com/v1/chat/completions', [
                'model' => $this->model,
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => 'You are a helpful data analyst. Always respond with valid JSON.'
                    ],
                    [
                        'role' => 'user',
                        'content' => $prompt
                    ]
                ],
                'max_tokens' => $this->maxTokens,
                'temperature' => 0.7,
            ]);
            
            if (!$response->successful()) {
                throw new \Exception("OpenAI API error: " . $response->body());
            }
            
            return $response->json();
            
        } catch (\Exception $e) {
            Log::error('OpenAI API call failed', [
                'error' => $e->getMessage(),
            ]);
            throw $e;
        }
    }
    
    /**
     * Parse OpenAI response
     * 
     * @param array $response
     * @return array
     */
    protected function parseResponse(array $response): array
    {
        try {
            $content = $response['choices'][0]['message']['content'] ?? '';
            
            // Try to extract JSON from response
            // Sometimes AI adds markdown code blocks
            $content = preg_replace('/```json\s*/', '', $content);
            $content = preg_replace('/```\s*/', '', $content);
            $content = trim($content);
            
            $insights = json_decode($content, true);
            
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new \Exception('Failed to parse AI response as JSON: ' . json_last_error_msg());
            }
            
            return $insights;
            
        } catch (\Exception $e) {
            Log::error('Failed to parse AI response', [
                'error' => $e->getMessage(),
                'response' => $response,
            ]);
            
            // Return fallback insights
            return [
                'summary' => 'Unable to generate insights at this time.',
                'trends' => [],
                'recommendations' => [],
                'sentiment' => 'neutral',
            ];
        }
    }

    /**
     * Generate rule-based insights when AI is unavailable
     * 
     * @param array $payload
     * @return array
     */
    protected function generateFallbackInsights(array $payload): array
    {
        $insights = [
            'summary' => 'Data analysis completed successfully across ' . ($payload['fusion_metadata']['successful_sources'] ?? 0) . ' sources.',
            'trends' => [],
            'recommendations' => [],
            'sentiment' => 'neutral',
        ];

        $hasWeather = isset($payload['environment']['data']);
        $hasNews = isset($payload['briefing']['data']['articles']);
        $hasCrypto = isset($payload['markets']['data']['data']);

        // 1. Basic Weather Analysis
        if ($hasWeather) {
            $weather = $payload['environment']['data'];
            $temp = $weather['current']['temperature'] ?? 20;
            $location = $weather['location']['name'] ?? 'Global';
            
            if ($temp > 30) {
                $insights['trends'][] = "Elevated temperature warning in {$location} ({$temp}°C).";
                $insights['recommendations'][] = "Monitor hardware temperature in designated zones.";
                $insights['sentiment'] = 'neutral';
            } elseif ($temp < 5) {
                $insights['trends'][] = "Cold weather front approaching {$location}.";
            }
        }

        // 2. Market Sentiment Analysis
        if ($hasCrypto) {
            $cryptos = $payload['markets']['data']['data'];
            $positiveMoves = 0;
            $negativeMoves = 0;

            foreach ($cryptos as $crypto) {
                $change = $crypto['change_24h'] ?? 0;
                $symbol = strtoupper($crypto['id']);
                
                if ($change > 3) {
                    $insights['trends'][] = "{$symbol} showing bullish momentum (+{$change}%).";
                    $positiveMoves++;
                } elseif ($change < -3) {
                    $insights['trends'][] = "{$symbol} correction detected ({$change}%).";
                    $negativeMoves++;
                }
            }

            if ($positiveMoves > $negativeMoves) {
                $insights['sentiment'] = 'positive';
                $insights['recommendations'][] = "Consider profit-taking on high-performing assets.";
            } elseif ($negativeMoves > $positiveMoves) {
                $insights['sentiment'] = 'negative';
                $insights['recommendations'][] = "Maintain long-term strategy during market volatility.";
            }
        }

        // 3. News Context
        if ($hasNews) {
            $articles = $payload['briefing']['data']['articles'];
            $count = count($articles);
            $insights['trends'][] = "Active information flow with {$count} recent briefing items.";
            
            // Heuristic news checking for specific keywords
            $keywords = ['surge', 'crash', 'breakthrough', 'conflict', 'recovery'];
            foreach ($articles as $article) {
                $title = strtolower($article['title'] ?? '');
                foreach ($keywords as $word) {
                    if (str_contains($title, $word)) {
                        $insights['trends'][] = "Critical keyword '{$word}' identified in recent briefing.";
                    }
                }
            }
        }

        // 4. CROSS-SOURCE CORRELATION (Phases 6 & 7 Logic)
        if ($hasWeather && $hasCrypto) {
            $weather = $payload['environment']['data'];
            $isExtreme = ($weather['current']['temperature'] ?? 20) > 35 || ($weather['current']['temperature'] ?? 20) < 0;
            
            if ($isExtreme && isset($insights['sentiment']) && $insights['sentiment'] === 'negative') {
                $insights['summary'] = "Combined warning: Environmental stress in {$location} correlates with bearish market indicators.";
                $insights['recommendations'][] = "Hedge risks as multiple sectors show defensive patterns.";
            }
        }

        if (empty($insights['trends'])) {
            $insights['trends'][] = "Stable baseline conditions observed across all data points.";
        }

        if (empty($insights['recommendations'])) {
            $insights['recommendations'][] = "Continue monitoring real-time feeds for variance.";
        }

        return $insights;
    }
}
