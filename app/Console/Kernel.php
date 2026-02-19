<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // Run data fusion sync every 30 minutes
        $schedule->command('datafusion:sync')
            ->everyThirtyMinutes()
            ->withoutOverlapping()
            ->onSuccess(function () {
                \Log::info('Data fusion sync completed successfully');
            })
            ->onFailure(function () {
                \Log::error('Data fusion sync failed');
            });

        // Run data cleanup daily at 2 AM
        $schedule->command('datafusion:cleanup')
            ->dailyAt('02:00')
            ->withoutOverlapping();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
