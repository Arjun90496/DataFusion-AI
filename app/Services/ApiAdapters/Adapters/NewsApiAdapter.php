<?php

namespace App\Services\ApiAdapters\Adapters;

use App\Services\ApiAdapters\Base\BaseApiAdapter;

/**
 * NewsAPI Adapter
 * 
 * Fetches news headlines from NewsAPI
 * Documentation: https://newsapi.org/docs
 */
class NewsApiAdapter extends BaseApiAdapter
{
    /**
     * Build the API endpoint URL
     */
    protected function buildUrl(array $params): string
    {
        $endpoint = $params['endpoint'] ?? 'top-headlines';
        
        if ($endpoint === 'everything') {
            return $this->baseUrl . '/v2/everything';
        }
        
        return $this->baseUrl . '/v2/top-headlines';
    }
    
    /**
     * Build query parameters
     */
    protected function buildQuery(array $params): array
    {
        $query = [
            'apiKey' => $this->apiKey->api_key,
            'pageSize' => $params['pageSize'] ?? 10,
            'page' => $params['page'] ?? 1,
        ];

        // Specific handling for top-headlines vs everything
        if (($params['endpoint'] ?? 'top-headlines') === 'everything') {
            $query['q'] = $params['q'] ?? 'technology';
            $query['sortBy'] = $params['sortBy'] ?? 'publishedAt';
        } else {
            $query['country'] = $params['country'] ?? 'us';
            $query['category'] = $params['category'] ?? null;
            $query['q'] = $params['q'] ?? null;
        }
        
        // Remove null values
        return array_filter($query, fn($value) => !is_null($value));
    }
    
    /**
     * Get required headers
     */
    protected function getHeaders(): array
    {
        return [
            'Accept' => 'application/json',
            // NewsAPI also accepts key in header: 'X-Api-Key' => $this->apiKey->api_key
        ];
    }
    
    /**
     * Transform response to normalized format
     */
    protected function transform(array $data): array
    {
        return [
            'totalResults' => $data['totalResults'] ?? 0,
            'articles' => array_map(function($article) {
                return [
                    'source' => [
                        'id' => $article['source']['id'] ?? null,
                        'name' => $article['source']['name'] ?? 'Unknown',
                    ],
                    'author' => $article['author'] ?? 'Unknown',
                    'title' => $article['title'] ?? '',
                    'description' => $article['description'] ?? '',
                    'content' => $article['content'] ?? null,
                    'url' => $article['url'] ?? '#',
                    'image_url' => $article['urlToImage'] ?? null,
                    'published_at' => isset($article['publishedAt']) 
                        ? date('c', strtotime($article['publishedAt'])) 
                        : null,
                ];
            }, $data['articles'] ?? []),
        ];
    }
    
    /**
     * Validate connection
     */
    public function validate(): bool
    {
        try {
            $response = $this->makeRequest(['country' => 'us', 'pageSize' => 1]);
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
        // Developer plan: 100 requests / day (checked manually)
        return [
            'limit' => 100,
            'window' => '24 hours',
            'remaining' => null, // Headers might contain this
        ];
    }
    
    /**
     * Get metadata
     */
    public function getMetadata(): array
    {
        return [
            'name' => 'NewsAPI',
            'version' => '2',
            'documentation_url' => 'https://newsapi.org/docs',
            'endpoint' => $this->baseUrl,
        ];
    }
}
