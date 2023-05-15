<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected $commands = [
        Commands\SendDailyPushNotification::class,
        \App\Console\Commands\Push_notification::class,
    ];
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('notification:push-daily')->dailyAt('9:00')->timezone('America/New_York');
        $schedule->command('notification:push_notification')
         ->dailyAt('9:00')
         ->timezone('Asia/Kolkata');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
