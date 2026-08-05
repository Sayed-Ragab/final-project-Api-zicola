<?php

use App\Http\Middleware\AdminClinicMiddleware;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
         then: function () {
            Route::middleware('api')
                ->prefix('api/adminclinic')
                ->group(base_path('routes/adminclinic.php'));
        }
    )
    
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
        'admin' => AdminMiddleware::class,
        'adminclinic'=>AdminClinicMiddleware::class
    ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
