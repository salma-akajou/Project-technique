<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        \Illuminate\Support\Facades\Gate::define('manage-films', function ($user) {
            return true; // Tous les utilisateurs connectés peuvent voir/ajouter
        });

        \Illuminate\Support\Facades\Gate::define('delete-film', function ($user) {
            return $user->is_admin === true; // Seul l'admin peut supprimer
        });
    }
}
