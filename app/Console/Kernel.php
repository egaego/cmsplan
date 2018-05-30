<?php

namespace App\Console;

use App\Message;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
        Log::useDailyFiles(storage_path() . '/logs/scheduler.log');
        $schedule->call(function() {
            Message::sendPushNotification();
            Log::info('Scheduler is running: daily at 10:00');
        })->dailyAt('10:00');
        
        $schedule->call(function() {
            Message::sendPushNotification();
            Log::info('Scheduler is running: daily at 18:30');
        })->dailyAt('18:30');
        
        $schedule->call(function() {
            Message::sendPushNotification();
            Log::info('Scheduler is running: daily at 23:50');
        })->dailyAt('23:50');
        
        $schedule->call(function() {
            \App\ProcedurePreparation::sendPushNotification();
            Log::info('Scheduler is running: every hour');
        })->hourly();
        
        $schedule->call(function() {
            \App\ProcedurePayment::sendPushNotification();
            Log::info('Scheduler is running: every hour');
        })->hourly();
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
