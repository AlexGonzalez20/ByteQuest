<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;

class CaminoController extends Controller
{
    public function mostrar($curso_id)
    {
        $usuario = auth()->user();

        // Cargar curso + lecciones + pruebas
        $curso = Curso::with(['lecciones.pruebas' => function ($q) {
            $q->orderBy('orden');
        }])->findOrFail($curso_id);

        $pivot = $usuario->cursos()->where('curso_id', $curso_id)->first()->pivot;

        $prueba_actual_id = $pivot->prueba_actual_id;
        $leccion_actual_id = $pivot->leccion_actual_id;

        // Buscar prueba para ver si existe una sesión de preguntas
        $key = null;
        $idsPreguntas = null;
        $index = null;

        if ($prueba_actual_id) {
            $key = "prueba_{$prueba_actual_id}_preguntas";
            if (session()->has($key)) {
                $idsPreguntas = session($key);
                $index = session("{$key}_index", 0);
            }
        }

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
            'lecciones' => $curso->lecciones,
            'pivot' => $pivot,
            'key' => $key,
            'idsPreguntas' => $idsPreguntas,
            'index' => $index
        ]);
    }
}
