<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Usuario;

class ProfileController extends Controller
{
    public function index()
    {
        $usuario = Auth::user();

        // Solo calculamos segundos restantes para el contador
        $segundosRestantes = 30; // default
        if ($usuario->ultima_vida_perdida) {
            $segundosPasados = $usuario->ultima_vida_perdida->diffInSeconds(now());
            $segundosRestantes = max(0, 30 - $segundosPasados);
        }

        return view('VistasEstudiante.perfil', [
            'usuario' => $usuario,
            'segundosRestantes' => $segundosRestantes,
        ]);
    }

    public function reclamarVida()
    {
        $usuario = Auth::user();
        $usuario->recuperarVida(); // solo se recupera 1 vida si ya corresponde

        return response()->json([
            'vidas' => $usuario->vidas
        ]);
    }
}
