<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\URL;
use Carbon\Carbon;


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

        // View Composer para estudiante



        View::composer('layouts.estudiante', function ($view) {
            $user = auth()->user();

            if ($user) {
                $hoy = Carbon::today();
                $ultimoDia = $user->ultimo_dia_activo ? Carbon::parse($user->ultimo_dia_activo) : null;

                if (!$ultimoDia) {
                    $diasRacha = 1;
                } elseif ($ultimoDia->isToday()) {
                    $diasRacha = $user->dias_racha;
                } elseif ($ultimoDia->diffInDays($hoy) === 1) {
                    $diasRacha = $user->dias_racha + 1;
                } else {
                    $diasRacha = 1;
                }

                // Pasar la racha calculada a la vista
                $view->with('diasRacha', $diasRacha);
            }
        });
    }
}
