<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $routeMiddleware = [
        'jwt.auth' => \Tymon\JWTAuth\Http\Middleware\Authenticate::class,  // Not needed anymore
        'auth:sanctum' => \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,  // Add Sanctum middleware
        // other middleware...
    ];

    /**
     * The application's command schedule.
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
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'api' => [
            \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,  // Ensure stateful requests
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];
}
