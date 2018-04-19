<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{

    protected $commands =
        [
            \App\Console\Commands\ActivateUsers::class,
            \App\Console\Commands\UnboughtCartItems::class
        ];

    protected function schedule(Schedule $schedule)

    {
        $schedule->command('command:activateUsers')
                 ->withoutOverlapping()
                 ->everyMinute();

        $schedule->command('command:UnboughCartItems')
                 ->withoutOverlapping()
                 ->everyMinute();
    }


    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
