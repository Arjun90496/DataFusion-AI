<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\ApiProvider;
use App\Models\ApiKey;
use App\Models\FusedData;
use App\Models\AiInsight;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class DemoSeeder extends Seeder
{
    /**
     * Run the database seeds for the current developer user.
     */
    public function run(): void
    {
        $email = 'arjun22cse@gmail.com';
        $user = User::where('email', $email)->first();

        if (!$user) {
            $this->command->info("User with email {$email} not found. Creating...");
            $user = User::create([
                'name' => 'Arjun',
                'email' => $email,
                'password' => \Illuminate\Support\Facades\Hash::make('password123'),
            ]);
        }

        $providers = ApiProvider::all();
        if ($providers->isEmpty()) {
            $this->command->error("No API providers found. Run ApiProviderSeeder first.");
            return;
        }

        // 1. Create API Keys for the user
        foreach ($providers as $provider) {
            $exists = ApiKey::where('user_id', $user->id)
                ->where('api_provider_id', $provider->id)
                ->exists();

            if (!$exists) {
                ApiKey::create([
                    'user_id' => $user->id,
                    'api_provider_id' => $provider->id,
                    'name' => "My {$provider->name} Key",
                    'api_key' => 'sk-' . bin2hex(random_bytes(16)),
                    'is_enabled' => true,
                    'status' => 'active',
                    'last_used_at' => now()->subMinutes(rand(10, 60)),
                    'last_tested_at' => now()->subDay(),
                ]);
            }
        }

        $this->command->info("API Keys created for {$user->name}.");

        // 2. Create some initial activity logs
        $user->logActivity('api_added', 'Connected OpenWeatherMap API', 'plus-circle', 'green');
        $user->logActivity('api_added', 'Connected CoinGecko API', 'plus-circle', 'green');
        $user->logActivity('api_added', 'Connected NewsAPI', 'plus-circle', 'green');

        // 3. Create a few historic fusion snapshots
        for ($i = 0; $i < 3; $i++) {
            $fusedAt = Carbon::now()->subDays(3 - $i)->subHours(rand(1, 5));
            
            $fusedData = FusedData::create([
                'user_id' => $user->id,
                'payload' => $this->generatePayload($user->name),
                'sources_count' => 3,
                'size_bytes' => rand(3000, 7000),
                'primary_location' => 'Dhaka, BD',
                'fused_at' => $fusedAt,
                'created_at' => $fusedAt,
            ]);

            // Add an insight for the latest one
            if ($i === 2) {
                AiInsight::create([
                    'user_id' => $user->id,
                    'fused_data_id' => $fusedData->id,
                    'summary' => "The ecosystem analysis for Dhaka reveals stable environmental conditions but high volatility in the crypto markets. Diverse news topics suggest a shift in technology sentiment.",
                    'trends' => ["Bitcoin price fluctuation > 5%", "Clear weather trend for next 48h", "AI ethics news rising"],
                    'recommendations' => ["Hold crypto assets during volatility", "Plan outdoor server maintenance during clear weather", "Monitor AI compliance updates"],
                    'sentiment' => 'neutral',
                    'tokens_used' => 850,
                    'model_used' => 'gpt-4o',
                    'created_at' => $fusedAt,
                ]);
            }
        }

        $this->command->info("Demo data seeded for {$user->name}!");
    }

    private function generatePayload($name)
    {
        return [
            'environment' => [
                'source' => 'OpenWeatherMap',
                'data' => [
                    'location' => ['name' => 'Dhaka', 'country' => 'BD'],
                    'current' => ['temperature' => 28, 'humidity' => 65],
                    'weather' => ['description' => 'clear sky'],
                ]
            ],
            'briefing' => [
                'source' => 'NewsAPI',
                'data' => [
                    'articles' => [
                        [
                            'title' => 'Top Tech Trends to Watch in 2026',
                            'description' => 'A deep dive into how AI and fused data are reshaping the global market landscape this year.',
                            'author' => 'Elena Vance',
                            'source' => ['name' => 'Wired']
                        ],
                        [
                            'title' => 'Global Economy Update: Shifts in Sentiment',
                            'description' => 'Market analysts report a significant change in investor behavior following recent tech breakthroughs.',
                            'author' => 'Marcus Thorne',
                            'source' => ['name' => 'BBC News']
                        ]
                    ]
                ]
            ],
            'markets' => [
                'source' => 'CoinGecko',
                'data' => [
                    'data' => [
                        ['id' => 'bitcoin', 'current_price' => 64500, 'change_24h' => 2.5],
                        ['id' => 'ethereum', 'current_price' => 3450, 'change_24h' => -1.2]
                    ]
                ]
            ],
            'user' => $name
        ];
    }
}
