<?php

namespace App\Console;

use App\Console\Commands\DemoCron;
use App\Console\Commands\PlateCron;
use App\Console\Commands\ReminderCron;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected $commands = [
        ReminderCron::class,
        DemoCron::class,
        PlateCron::class
    ];
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('demo:cron')
            ->everyMinute();
        $schedule->command('plate:cron')
            ->monthlyOn(1);
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
