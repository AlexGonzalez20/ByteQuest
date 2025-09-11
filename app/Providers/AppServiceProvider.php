<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\URL;

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
        // Forzar HTTPS en producción
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }

        // Tu lógica de cursos
        View::composer('layouts.estudiante', function ($view) {
            $user = auth()->user();
            $cursos = $user ? $user->cursos : collect();
            $view->with('cursos', $cursos);
        });
    }
}