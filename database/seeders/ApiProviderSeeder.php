<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder for API Providers
 * 
 * Populates the api_providers table with supported external APIs.
 * Run after migration to make providers available to users.
 */
class ApiProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $providers = [
            [
                'name' => 'OpenWeatherMap',
                'slug' => 'openweathermap',
                'base_url' => 'https://api.openweathermap.org',
                'icon' => 'cloud',
                'color' => 'blue',
                'description' => 'Global weather data and forecasts. Get current weather, forecasts, and historical data.',
                'required_fields' => json_encode(['api_key']),
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'NewsAPI',
                'slug' => 'newsapi',
                'base_url' => 'https://newsapi.org',
                'icon' => 'newspaper',
                'color' => 'red',
                'description' => 'Breaking news headlines and articles from global news sources and blogs.',
                'required_fields' => json_encode(['api_key']),
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'OpenAI',
                'slug' => 'openai',
                'base_url' => 'https://api.openai.com',
                'icon' => 'sparkles',
                'color' => 'purple',
                'description' => 'AI-powered text generation, completion, and analysis with GPT models.',
                'required_fields' => json_encode(['api_key']),
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'GitHub API',
                'slug' => 'github',
                'base_url' => 'https://api.github.com',
                'icon' => 'code',
                'color' => 'gray',
                'description' => 'Access repository data, user profiles, and development activity from GitHub.',
                'required_fields' => json_encode(['api_key']),
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('api_providers')->insert($providers);
    }
}
