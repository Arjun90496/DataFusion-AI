<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\ApiProvider;
use App\Models\ApiKey;
use App\Models\FusedData;
use App\Models\AiInsight;
use App\Models\Activity;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $usersData = [
            ['name' => 'Alex Rivera', 'email' => 'alex@datafusion.ai'],
            ['name' => 'Sarah Chen', 'email' => 'sarah@datafusion.ai'],
            ['name' => 'Marcus Thorne', 'email' => 'marcus@datafusion.ai'],
            ['name' => 'Elena Vance', 'email' => 'elena@datafusion.ai'],
            ['name' => 'David Miller', 'email' => 'david@datafusion.ai'],
        ];

        $providers = ApiProvider::all();

        foreach ($usersData as $userData) {
            // 1. Create User
            $user = User::create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'password' => Hash::make('password123'),
            ]);

            // 2. Create 3 random API Keys
            $selectedProviders = $providers->random(3);
            foreach ($selectedProviders as $provider) {
                ApiKey::create([
                    'user_id' => $user->id,
                    'api_provider_id' => $provider->id,
                    'name' => "My {$provider->name} Key",
                    'api_key' => 'sk-' . bin2hex(random_bytes(16)),
                    'is_enabled' => true,
                    'status' => 'active',
                    'last_used_at' => now()->subHours(rand(1, 24)),
                    'last_tested_at' => now()->subDays(1),
                ]);
            }

            $user->logActivity('onboarding', 'Completed registration and connected first APIs', 'user', 'green');

            // 3. Create 5 Fused Data Snapshots
            for ($i = 0; $i < 5; $i++) {
                $fusedAt = Carbon::now()->subDays(5 - $i)->subHours(rand(1, 10));
                
                $fusedData = FusedData::create([
                    'user_id' => $user->id,
                    'payload' => $this->generateSamplePayload($userData['name']),
                    'sources_count' => 3,
                    'size_bytes' => rand(2048, 8192),
                    'primary_location' => 'San Francisco, CA',
                    'fused_at' => $fusedAt,
                ]);

                // 4. Create AI Insights for some snapshots
                if ($i >= 3) {
                    AiInsight::create([
                        'user_id' => $user->id,
                        'fused_data_id' => $fusedData->id,
                        'summary' => "Strategic overview of data snapshot from {$fusedAt->format('M d')}. Market volatility detected in crypto assets while local weather patterns remain stable for logistics.",
                        'trends' => [
                            "Increased correlated movement between Bitcoin and tech equities",
                            "Hyper-local temperature spikes affecting cooling costs",
                            "Sustainability-focused news dominating market sentiment"
                        ],
                        'recommendations' => [
                            "Hedge crypto exposure with stablecoin allocation",
                            "Optimize server load during peak temperature hours",
                            "Focus marketing on ESG-compliant project features"
                        ],
                        'sentiment' => (rand(0, 1) ? 'positive' : 'neutral'),
                        'tokens_used' => rand(400, 1200),
                        'model_used' => 'gpt-4o',
                    ]);

                    $user->logActivity('insight_generated', "AI generated insights for snapshot {$fusedData->id}", 'sparkles', 'purple');
                }

                $user->logActivity('data_fusion', "Completed data aggregation task #{$fusedData->id}", 'database', 'indigo');
            }
        }
    }

    private function generateSamplePayload($userName)
    {
        return [
            'environment' => [
                'source' => 'OpenWeatherMap',
                'data' => [
                    'current' => ['temperature' => rand(18, 28), 'humidity' => rand(40, 60)],
                    'weather' => ['description' => 'Partly Cloudy'],
                    'wind' => ['speed' => rand(2, 8)]
                ]
            ],
            'briefing' => [
                'source' => 'NewsAPI',
                'data' => [
                    'articles' => [
                        [
                            'title' => "AI Integration Trends in 2026",
                            'description' => "How companies are leveraging fused data for competitive advantage.",
                            'source' => ['name' => 'TechCrunch'],
                            'author' => 'Sarah Jenkins'
                        ],
                        [
                            'title' => "Market Update: Global Logistics",
                            'description' => "Supply chain optimization using real-time environment data.",
                            'source' => ['name' => 'Reuters'],
                            'author' => 'Michael Ross'
                        ]
                    ]
                ]
            ],
            'markets' => [
                'source' => 'CoinGecko',
                'data' => [
                    'data' => [
                        ['id' => 'bitcoin', 'current_price' => rand(45000, 65000), 'change_24h' => rand(-5, 5)],
                        ['id' => 'ethereum', 'current_price' => rand(2500, 4000), 'change_24h' => rand(-5, 5)]
                    ]
                ]
            ],
            'fusion_metadata' => [
                'generated_for' => $userName,
                'system_version' => '1.2.0',
                'processing_time_ms' => rand(150, 450)
            ]
        ];
    }
}
