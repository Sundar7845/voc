<?php

namespace App\Console;

use App\Console\Commands\Customer;
use App\Console\Commands\Employee;
use App\Console\Commands\SalesReport;
use App\Console\Commands\SendWalkinEmail;
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
        Employee::class,
        Customer::class,
        SalesReport::class,
        SendWalkinEmail::class,
    ];
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('email:send-walkin')->dailyAt('23:00');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
