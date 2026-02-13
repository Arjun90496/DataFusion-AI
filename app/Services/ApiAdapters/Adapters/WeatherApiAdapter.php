<?php

namespace App\Services\ApiAdapters\Adapters;

use App\Services\ApiAdapters\Base\BaseApiAdapter;

/**
 * OpenWeatherMap Adapter
 * 
 * Fetches weather data from OpenWeatherMap API
 * Documentation: https://openweathermap.org/current
 */
class WeatherApiAdapter extends BaseApiAdapter
{
    /**
     * Build the API endpoint URL
     */
    protected function buildUrl(array $params): string
    {
        // Default to current weather endpoint
        $endpoint = $params['endpoint'] ?? 'weather';
        
        // Handle different endpoints if needed (e.g., forecast)
        if ($endpoint === 'forecast') {
            return $this->baseUrl . '/data/2.5/forecast';
        }
        
        return $this->baseUrl . '/data/2.5/weather';
    }
    
    /**
     * Build query parameters including API key
     */
    protected function buildQuery(array $params): array
    {
        return [
            'q' => $params['city'] ?? 'London',
            'appid' => $this->apiKey->api_key, // Automatically decrypted
            'units' => $params['units'] ?? 'metric',
            'lang' => $params['lang'] ?? 'en',
        ];
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
        // OpenWeatherMap response → Normalized format
        return [
            'location' => [
                'name' => $data['name'] ?? 'Unknown',
                'country' => $data['sys']['country'] ?? null,
                'coordinates' => [
                    'lat' => $data['coord']['lat'] ?? null,
                    'lon' => $data['coord']['lon'] ?? null,
                ],
            ],
            'current' => [
                'temperature' => $data['main']['temp'] ?? null,
                'feels_like' => $data['main']['feels_like'] ?? null,
                'temp_min' => $data['main']['temp_min'] ?? null,
                'temp_max' => $data['main']['temp_max'] ?? null,
                'pressure' => $data['main']['pressure'] ?? null,
                'humidity' => $data['main']['humidity'] ?? null,
            ],
            'weather' => [
                'main' => $data['weather'][0]['main'] ?? 'Unknown',
                'description' => $data['weather'][0]['description'] ?? '',
                'icon' => $data['weather'][0]['icon'] ?? null,
                'icon_url' => isset($data['weather'][0]['icon']) 
                    ? "https://openweathermap.org/img/wn/{$data['weather'][0]['icon']}@2x.png" 
                    : null,
            ],
            'wind' => [
                'speed' => $data['wind']['speed'] ?? null,
                'deg' => $data['wind']['deg'] ?? null,
            ],
            'sys' => [
                'sunrise' => isset($data['sys']['sunrise']) ? date('c', $data['sys']['sunrise']) : null,
                'sunset' => isset($data['sys']['sunset']) ? date('c', $data['sys']['sunset']) : null,
            ],
            'provider_timestamp' => $data['dt'] ?? time(),
        ];
    }
    
    /**
     * Validate connection
     */
    public function validate(): bool
    {
        try {
            // Lightest possible request to check key
            $response = $this->makeRequest(['city' => 'London']);
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
        // OpenWeatherMap free tier
        return [
            'limit' => 60,
            'window' => '1 minute',
            'remaining' => null, // Headers don't provide this on free tier
        ];
    }
    
    /**
     * Get metadata
     */
    public function getMetadata(): array
    {
        return [
            'name' => 'OpenWeatherMap',
            'version' => '2.5',
            'documentation_url' => 'https://openweathermap.org/api',
            'endpoint' => $this->baseUrl,
        ];
    }
}
