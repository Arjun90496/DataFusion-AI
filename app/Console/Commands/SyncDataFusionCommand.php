<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Services\DataFusion\DataFusionService;
use Illuminate\Console\Command;

class SyncDataFusionCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'datafusion:sync {user_id? : Optional specific user ID}';

    /**
     * The description of the console command.
     *
     * @var string
     */
    protected $description = 'Sync and fuse data from connected APIs for all users';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if ($this->argument('user_id')) {
            $users = User::where('id', $this->argument('user_id'))->get();
        } else {
            // Get all users (check has API keys for activity)
            $users = User::has('apiKeys')->get();
        }

        if ($users->isEmpty()) {
            $this->info('No active users found.');
            return;
        }

        $this->info("Syncing data fusion for " . count($users) . " user(s)...");

        $fusionService = app(DataFusionService::class);

        foreach ($users as $user) {
            try {
                $this->line("Syncing user: {$user->name} ({$user->email})...");

                $fusedData = $fusionService->fuse($user);

                if ($fusedData) {
                    $this->info("✓ Successfully fused data for {$user->name}");
                } else {
                    $this->warn("No active API keys for {$user->name}");
                }
            } catch (\Exception $e) {
                $this->error("✗ Error syncing {$user->name}: " . $e->getMessage());
            }
        }

        $this->info("Data fusion sync completed!");
    }
}
