<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
            'adminOnly' => \App\Http\Middleware\AdminOnlyMiddleware::class,
        ]);

        $middleware->validateCsrfTokens(except: [
            'api/donasi/*',
        ]);

        $middleware->redirectUsersTo(function () {
            if (auth()->check() && auth()->user()->hasAdminAccess()) {
                return route('dashboard', absolute: false);
            }
            return '/';
        });
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
