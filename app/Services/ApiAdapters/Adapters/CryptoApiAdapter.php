<?php

namespace App\Services\ApiAdapters\Adapters;

use App\Services\ApiAdapters\Base\BaseApiAdapter;

/**
 * CryptoApiAdapter (CoinGecko)
 * 
 * Fetches cryptocurrency data from CoinGecko API
 * Documentation: https://www.coingecko.com/en/api/documentation
 */
class CryptoApiAdapter extends BaseApiAdapter
{
    /**
     * Build the API endpoint URL
     */
    protected function buildUrl(array $params): string
    {
        $endpoint = $params['endpoint'] ?? 'simple/price';
        
        switch ($endpoint) {
            case 'coins/list':
                return $this->baseUrl . '/api/v3/coins/list';
            case 'simple/price':
            default:
                return $this->baseUrl . '/api/v3/simple/price';
        }
    }
    
    /**
     * Build query parameters
     */
    protected function buildQuery(array $params): array
    {
        $endpoint = $params['endpoint'] ?? 'simple/price';
        $query = [];

        // API Key handling for CoinGecko (Demo/Pro)
        // Free API doesn't require key, but Pro does via query param 'x_cg_demo_api_key' or 'x_cg_pro_api_key'
        // We'll pass it if it looks like a key (length check or based on config)
        if (!empty($this->apiKey->api_key)) {
            // Heuristic: assume standard demo/pro key param if key exists
            $query['x_cg_demo_api_key'] = $this->apiKey->api_key;
        }

        if ($endpoint === 'simple/price') {
            $query['ids'] = $params['ids'] ?? 'bitcoin,ethereum';
            $query['vs_currencies'] = $params['vs_currencies'] ?? 'usd';
            $query['include_market_cap'] = $params['include_market_cap'] ?? 'true';
            $query['include_24hr_vol'] = $params['include_24hr_vol'] ?? 'false';
            $query['include_24hr_change'] = $params['include_24hr_change'] ?? 'true';
            $query['include_last_updated_at'] = $params['include_last_updated_at'] ?? 'true';
        }

        return $query;
    }
    
    /**
     * Get required headers
     */
    protected function getHeaders(): array
    {
        return [
            'Accept' => 'application/json',
        ];
    }
    
    /**
     * Transform response to normalized format
     */
    protected function transform(array $data): array
    {
        // If it's the coins/list endpoint, just return as is
        if (isset($data[0]) && isset($data[0]['id'])) {
            return ['coins' => $data];
        }

        // Transform simple/price structure
        $transformed = [];
        foreach ($data as $coinId => $details) {
            $transformed[] = [
                'id' => $coinId,
                'currency' => 'usd', // Assuming default or first one
                'current_price' => $details['usd'] ?? null,
                'market_cap' => $details['usd_market_cap'] ?? null,
                'change_24h' => $details['usd_24h_change'] ?? null,
                'last_updated_at' => isset($details['last_updated_at']) 
                    ? date('c', $details['last_updated_at']) 
                    : null,
            ];
        }
        
        return ['data' => $transformed];
    }
    
    /**
     * Validate connection
     */
    public function validate(): bool
    {
        try {
            $response = $this->makeRequest(['ids' => 'bitcoin', 'vs_currencies' => 'usd']);
            return $response->successful();
        } catch (\Exception $e) {
            return false;
        }
    }
    
    /**
     * Get rate limits
     */
    public function getRateLimits(): array
    {
        // Public API: approx 10-30 calls/min depending on commercial use
        return [
            'limit' => 30, 
            'window' => '1 minute',
            'remaining' => null,
        ];
    }
    
    /**
     * Get metadata
     */
    public function getMetadata(): array
    {
        return [
            'name' => 'CoinGecko',
            'version' => '3',
            'documentation_url' => 'https://www.coingecko.com/en/api/documentation',
            'endpoint' => $this->baseUrl,
        ];
    }
}
