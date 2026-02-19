<?php

namespace App\Services\DataFusion;

use App\Models\User;
use App\Models\ApiKey;
use App\Models\FusedData;
use App\Services\ApiAdapters\ApiAdapterFactory;
use Illuminate\Support\Facades\Log;

/**
 * DataFusionService
 * 
 * Orchestrates fetching data from multiple API sources and combining them
 * into a unified "fusion snapshot" for the user.
 * 
 * USAGE:
 * $service = new DataFusionService();
 * $result = $service->fuse($user);
 */
class DataFusionService
{
    /**
     * Main fusion method
     * 
     * Fetches data from all active API keys for the user,
     * combines them into a unified structure, and saves to database.
     * 
     * @param User $user
     * @return FusedData|null
     */
    public function fuse(User $user): ?FusedData
    {
        Log::info("Starting data fusion for user: {$user->id}");
        
        // Get all enabled API keys for this user
        $apiKeys = ApiKey::where('user_id', $user->id)
            ->where('is_enabled', true)
            ->with('provider')
            ->get();
        
        if ($apiKeys->isEmpty()) {
            Log::warning("No active API keys found for user: {$user->id}");
            return null;
        }
        
        // Fetch data from all sources
        $results = $this->fetchFromAllSources($apiKeys);
        
        // Aggregate into unified structure
        $fusedPayload = $this->aggregate($results);
        
        // Extract metadata
        $sourcesCount = count(array_filter([
            $fusedPayload['environment'] ?? null,
            $fusedPayload['briefing'] ?? null,
            $fusedPayload['markets'] ?? null,
        ]));
        
        $primaryLocation = $fusedPayload['fusion_metadata']['primary_location'] ?? null;
        
        // Calculate payload size for storage tracking
        $payloadJson = json_encode($fusedPayload);
        $sizeBytes = strlen($payloadJson);
        
        // Save to database
        $fusedData = FusedData::create([
            'user_id' => $user->id,
            'payload' => $fusedPayload,
            'sources_count' => $sourcesCount,
            'size_bytes' => $sizeBytes,
            'primary_location' => $primaryLocation,
            'fused_at' => now(),
        ]);
        
        Log::info("Data fusion completed for user: {$user->id}", [
            'sources_count' => $sourcesCount,
            'fused_data_id' => $fusedData->id,
        ]);
        
        return $fusedData;
    }
    
    /**
     * Fetch data from all API sources
     * 
     * Handles partial failures gracefully - if one API fails,
     * we still return data from the others.
     * 
     * @param \Illuminate\Support\Collection $apiKeys
     * @return array
     */
    protected function fetchFromAllSources($apiKeys): array
    {
        $results = [];
        
        foreach ($apiKeys as $apiKey) {
            try {
                $adapter = ApiAdapterFactory::make($apiKey);
                
                // Determine default parameters based on provider
                $params = $this->getDefaultParams($apiKey->provider->slug);
                
                $response = $adapter->fetch($params);
                
                if ($response->success) {
                    $results[$apiKey->provider->slug] = [
                        'success' => true,
                        'data' => $response->data,
                        'provider' => $apiKey->provider->name,
                        'cached' => $response->isCached(),
                    ];
                } else {
                    $results[$apiKey->provider->slug] = [
                        'success' => false,
                        'error' => $response->message,
                        'provider' => $apiKey->provider->name,
                    ];
                }
                
            } catch (\Exception $e) {
                Log::error("Failed to fetch from {$apiKey->provider->name}", [
                    'error' => $e->getMessage(),
                    'api_key_id' => $apiKey->id,
                ]);
                
                $results[$apiKey->provider->slug] = [
                    'success' => false,
                    'error' => $e->getMessage(),
                    'provider' => $apiKey->provider->name,
                ];
            }
        }
        
        return $results;
    }
    
    /**
     * Aggregate results into unified structure
     * 
     * Combines disparate data types (weather, news, crypto) into
     * a cohesive "fusion snapshot" with metadata.
     * 
     * @param array $results
     * @return array
     */
    protected function aggregate(array $results): array
    {
        $fused = [
            'context' => [
                'generated_at' => now()->toIso8601String(),
                'sources' => [],
            ],
            'environment' => null,  // Weather data
            'briefing' => null,     // News data
            'markets' => null,      // Crypto data
            'fusion_metadata' => [
                'total_sources' => 0,
                'successful_sources' => 0,
                'failed_sources' => [],
                'primary_location' => null,
            ],
        ];
        
        // Process each result
        foreach ($results as $slug => $result) {
            $fused['fusion_metadata']['total_sources']++;
            
            if ($result['success']) {
                $fused['context']['sources'][] = $result['provider'];
                $fused['fusion_metadata']['successful_sources']++;
                
                // Map to appropriate category
                if (in_array($slug, ['openweathermap', 'weather'])) {
                    $fused['environment'] = [
                        'source' => $result['provider'],
                        'data' => $result['data'],
                        'cached' => $result['cached'],
                        'fetched_at' => now()->toIso8601String(),
                    ];
                    
                    // Update primary location from weather if available
                    if (isset($result['data']['location']['name'])) {
                        $fused['fusion_metadata']['primary_location'] = $result['data']['location']['name'];
                    }
                } elseif (in_array($slug, ['newsapi', 'news'])) {
                    $fused['briefing'] = [
                        'source' => $result['provider'],
                        'data' => $result['data'],
                        'cached' => $result['cached'],
                        'fetched_at' => now()->toIso8601String(),
                    ];
                } elseif (in_array($slug, ['coingecko', 'crypto', 'finance'])) {
                    $fused['markets'] = [
                        'source' => $result['provider'],
                        'data' => $result['data'],
                        'cached' => $result['cached'],
                        'fetched_at' => now()->toIso8601String(),
                    ];
                }
            } else {
                $fused['fusion_metadata']['failed_sources'][] = [
                    'provider' => $result['provider'],
                    'error' => $result['error'],
                ];
            }
        }
        
        return $fused;
    }
    
    /**
     * Get default parameters for each provider
     * 
     * @param string $slug
     * @return array
     */
    protected function getDefaultParams(string $slug): array
    {
        return match($slug) {
            'openweathermap', 'weather' => [
                'city' => 'London',
                'units' => 'metric',
            ],
            'newsapi', 'news' => [
                'country' => 'us',
                'category' => 'general',
                'pageSize' => 5,
            ],
            'coingecko', 'crypto', 'finance' => [
                'ids' => 'bitcoin,ethereum',
                'vs_currencies' => 'usd',
            ],
            default => [],
        };
    }
}
