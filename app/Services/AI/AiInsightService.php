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
        $this->apiKey = config('services.openai.api_key');
        
        if (empty($this->apiKey)) {
            throw new \Exception('OpenAI API key not configured. Please set OPENAI_API_KEY in .env');
        }
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
        
        // Call OpenAI API
        $response = $this->callOpenAI($prompt);
        
        // Parse response
        $insights = $this->parseResponse($response);
        
        // Save to database
        $aiInsight = AiInsight::create([
            'user_id' => $fusedData->user_id,
            'fused_data_id' => $fusedData->id,
            'summary' => $insights['summary'] ?? 'No summary available',
            'trends' => $insights['trends'] ?? [],
            'recommendations' => $insights['recommendations'] ?? [],
            'sentiment' => $insights['sentiment'] ?? 'neutral',
            'tokens_used' => $response['usage']['total_tokens'] ?? 0,
            'model_used' => $this->model,
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
}
