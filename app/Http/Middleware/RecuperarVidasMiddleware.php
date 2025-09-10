<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RecuperarVidasMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            if (method_exists($user, 'actualizarVidas')) {
                $user->actualizarVidas();
            }
        }

        return $next($request);
    }
}