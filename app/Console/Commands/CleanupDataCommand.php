<?php

namespace App\Console\Commands;

use App\Models\FusedData;
use App\Models\ApiLog;
use Illuminate\Console\Command;

class CleanupDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'datafusion:cleanup {--days=30 : Days of data to keep}';

    /**
     * The description of the console command.
     *
     * @var string
     */
    protected $description = 'Clean up old fusion data and API logs';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $days = $this->option('days');
        $before = now()->subDays($days);

        $this->info("Cleaning up data older than {$days} days...");

        // Delete old fused data
        $deletedFusions = FusedData::where('created_at', '<', $before)->delete();
        $this->line("Deleted {$deletedFusions} old fusion records");

        // Delete old API logs
        $deletedLogs = ApiLog::where('created_at', '<', $before)->delete();
        $this->line("Deleted {$deletedLogs} old API log entries");

        $this->info("Cleanup completed!");
    }
}
