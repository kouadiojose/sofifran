<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\Localization;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
        $middleware->web(append: [
            Localization::class
        ]);

        // Les invités de la zone admin sont renvoyés vers le login admin,
        // les autres vers le login classique (Breeze).
        $middleware->redirectGuestsTo(function ($request) {
            return $request->is('admin-sofifran*')
                ? route('admin-login')
                : route('login');
        });

        // Un utilisateur deja connecte qui revient sur une page de login
        // est renvoye vers son tableau de bord.
        $middleware->redirectUsersTo(function ($request) {
            return $request->is('admin-sofifran*')
                ? route('admin-dashboard')
                : route('dashboard');
        });
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
