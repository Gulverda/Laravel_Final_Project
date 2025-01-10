<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * დადგენილი კონსოლური ბრძანებები.
     *
     * @var array
     */
    protected $commands = [
        // Add your custom commands here
    ];

    /**
     * სერვერის ციკლის დავალებები.
     *
     * @var array
     */
    protected function schedule(Schedule $schedule)
    {
        // Example of scheduling tasks
        $schedule->command('inspire')
                 ->hourly();
    }

    /**
     * კონსოლური ბრძანებების გეგმის მარშრუტი.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
