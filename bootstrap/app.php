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
        // Envoi de fichiers depassant post_max_size : PHP rejette la requete
        // avant meme la validation Laravel. On renvoie l'utilisateur sur le
        // formulaire avec un message clair au lieu de la page d'erreur.
        $exceptions->render(function (\Illuminate\Http\Exceptions\PostTooLargeException $e, \Illuminate\Http\Request $request) {
            $max = ini_get('post_max_size');

            return redirect()->back()->withErrors([
                'upload' => "L'envoi est trop volumineux : le serveur accepte au maximum {$max} par envoi. "
                    . "Réduisez le nombre de photos ou envoyez-les en plusieurs fois.",
            ]);
        });
    })->create();
