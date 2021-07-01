<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use App\Console\Commands\SyncAllSubscriptions;
use App\Console\Commands\Shopify\SyncAllOrders;
use App\Console\Commands\Store\PurchaseReminderCommand;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        SyncAllOrders::class,
        SyncAllSubscriptions::class,
        PurchaseReminderCommand::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('queue:work --tries=3 --timeout=2000 --once')->everyMinute()->withoutOverlapping();
        $schedule->command('purchase:reminder')->dailyAt('00:00');
        $schedule->command('shopify:sync-orders')->dailyAt('00:00');
        $schedule->command('shopify:sync-subscriptions')->dailyAt('03:00');
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
