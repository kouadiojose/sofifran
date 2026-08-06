<?php

namespace App\Providers;

use App\Models\Admin;
use App\Models\Setting;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Schema::defaultStringLength(191);
        Paginator::useBootstrap();

        // Branche les @can des vues admin sur le systeme roles/permissions
        // existant (tables roles, permissions, permission_role). Sans ceci,
        // aucun Gate n'etait defini et les liens proteges par @can
        // (Parametres generaux, Utilisateurs...) restaient invisibles.
        Gate::before(function ($user, string $ability) {
            if (!$user instanceof Admin) {
                return null;
            }

            try {
                // Le role "Admin" (code admins) a acces a tout.
                if ($user->role && in_array($user->role->code, ['admins', 'super-admin'])) {
                    return true;
                }

                return $user->role && $user->hasPermission($ability) ? true : null;
            } catch (\Throwable $e) {
                return null;
            }
        });

        // Coordonnees et reseaux sociaux (page admin "General") partages avec
        // le header et le footer du site, en cache pour eviter une requete
        // par affichage de page.
        View::composer(
            ['layouts.frontend.header', 'layouts.frontend.footer', 'layouts.master.sidebar'],
            function ($view) {
                $setting = Cache::remember('site_settings', 3600, function () {
                    try {
                        return Setting::first();
                    } catch (\Throwable $e) {
                        return null;
                    }
                });

                $view->with('setting', $setting);
            }
        );
    }
}
