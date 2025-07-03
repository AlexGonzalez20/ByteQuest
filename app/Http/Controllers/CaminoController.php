<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;

class CaminoController extends Controller
{
    public function mostrar($curso_id)
    {
        $usuario = auth()->user();

        // Carga curso con lecciones y pruebas ordenadas
        $curso = Curso::with(['lecciones.pruebas' => function ($query) {
            $query->orderBy('orden');
        }])->findOrFail($curso_id);

        // Obtener pivote de progreso
        $pivot = $usuario->cursos()->where('curso_id', $curso_id)->first()->pivot;

        $prueba_actual_id = $pivot->prueba_actual_id;

        // Marcar estado de cada prueba
        foreach ($curso->lecciones as $leccion) {
            foreach ($leccion->pruebas as $prueba) {
                if ($prueba->id < $prueba_actual_id) {
                    $prueba->completada = true;
                    $prueba->disponible = false;
                } elseif ($prueba->id == $prueba_actual_id) {
                    $prueba->completada = false;
                    $prueba->disponible = true;
                } else {
                    $prueba->completada = false;
                    $prueba->disponible = false;
                }
            }
        }

        return view('VistasEstudiante.camino', [
            'curso' => $curso,
            'lecciones' => $curso->lecciones
        ]);
    }
}
