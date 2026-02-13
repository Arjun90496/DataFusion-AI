<?php

namespace App\Services\ApiAdapters;

use App\Models\ApiKey;
use App\Services\ApiAdapters\Contracts\ApiAdapterInterface;
use App\Services\ApiAdapters\Adapters\WeatherApiAdapter;
use App\Services\ApiAdapters\Adapters\NewsApiAdapter;
use App\Services\ApiAdapters\Adapters\CryptoApiAdapter;
use InvalidArgumentException;

/**
 * API Adapter Factory
 * 
 * Instantiates the correct adapter based on the provider slug.
 */
class ApiAdapterFactory
{
    /**
     * Create an adapter instance for the given API key
     *
     * @param ApiKey $apiKey
     * @return ApiAdapterInterface
     * @throws InvalidArgumentException
     */
    public static function make(ApiKey $apiKey): ApiAdapterInterface
    {
        // Ensure provider relationship is loaded
        if (!$apiKey->relationLoaded('provider')) {
            $apiKey->load('provider');
        }
        
        $slug = $apiKey->provider->slug;
        
        return match($slug) {
            'openweathermap', 'weather' => new WeatherApiAdapter($apiKey),
            'newsapi', 'news' => new NewsApiAdapter($apiKey),
            'coingecko', 'crypto', 'finance' => new CryptoApiAdapter($apiKey),
            default => throw new InvalidArgumentException("No adapter implementation found for provider: {$slug}")
        };
    }
}
