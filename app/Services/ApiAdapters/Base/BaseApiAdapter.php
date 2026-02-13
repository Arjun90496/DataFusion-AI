<?php

namespace App\Services\ApiAdapters\Base;

use App\Models\ApiKey;
use App\Services\ApiAdapters\Contracts\ApiAdapterInterface;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * BaseApiAdapter
 * 
 * Abstract base class that handles common API communication logic.
 */
abstract class BaseApiAdapter implements ApiAdapterInterface
{
    /**
     * @var string Base URL for the API
     */
    protected string $baseUrl;

    /**
     * @var ApiKey The user's API key model
     */
    protected ApiKey $apiKey;

    /**
     * Constructor
     */
    public function __construct(ApiKey $apiKey)
    {
        $this->apiKey = $apiKey;
        
        // Ensure provider relationship is loaded to get base_url
        if (!$apiKey->relationLoaded('provider')) {
            $apiKey->load('provider');
        }
        
        $this->baseUrl = $apiKey->provider->base_url ?? '';
    }

    /**
     * Fetch data from the external source
     */
    public function fetch(array $params = []): ApiResponse
    {
        try {
            $response = $this->makeRequest($params);
            
            if ($response->successful()) {
                $data = $this->transform($response->json());
                return new ApiResponse(
                    success: true,
                    data: $data,
                    statusCode: $response->status()
                );
            }

            // Handle failed response
            $errorMessage = $response->json()['message'] ?? $response->reason() ?? "Unknown API Error";
            
            Log::warning("API Request Failed", [
                'provider' => $this->apiKey->provider->name,
                'status' => $response->status(),
                'error' => $errorMessage
            ]);

            return new ApiResponse(
                success: false,
                message: "API Error ({$response->status()}): {$errorMessage}",
                statusCode: $response->status()
            );

        } catch (\Exception $e) {
            Log::error("Adapter Fetch Exception", [
                'provider' => $this->apiKey->provider->name,
                'error' => $e->getMessage()
            ]);

            return new ApiResponse(
                success: false,
                message: "Internal Adapter Error: " . $e->getMessage(),
                statusCode: 500
            );
        }
    }

    /**
     * Execute the HTTP request
     */
    protected function makeRequest(array $params)
    {
        return Http::withHeaders($this->getHeaders())
            ->get($this->buildUrl($params), $this->buildQuery($params));
    }

    /**
     * Build the full URL for the request
     */
    abstract protected function buildUrl(array $params): string;

    /**
     * Build query parameters
     */
    abstract protected function buildQuery(array $params): array;

    /**
     * Transform the raw API response to standardized format
     */
    abstract protected function transform(array $data): array;

    /**
     * Default headers for all requests
     */
    protected function getHeaders(): array
    {
        return [
            'Accept' => 'application/json',
            'User-Agent' => 'DataFusion-AI/1.0',
        ];
    }
}
