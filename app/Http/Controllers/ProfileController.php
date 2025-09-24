<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Usuario;

class ProfileController extends Controller
{
    public function index()
    {
        $usuario = Auth::user();
        $usuario->actualizarVidas();

        $segundosRestantes = 0;
        if ($usuario->vidas < 5 && $usuario->ultima_vida_perdida) {
            $segundosPasados = $usuario->ultima_vida_perdida->diffInSeconds(now());
            $segundosRestantes = max(0, 30 - ($segundosPasados % 30)); // 30 seg, cámbialo a 1800 si quieres 30 min
        }

        return view('VistasEstudiante.perfil', [
            'usuario' => $usuario,
            'segundosRestantes' => $segundosRestantes,
        ]);
    }

    public function reclamarVida()
    {
        $usuario = Auth::user();
        $usuario->actualizarVidas();

        if ($usuario->vidas < 5) {
            $usuario->vidas++;
            $usuario->ultima_vida_perdida = now();
            $usuario->save();
        }

        return response()->json([
            'vidas' => $usuario->vidas
        ]);
    }
}
