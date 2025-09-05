<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;

class CaminoController extends Controller
{
    public function mostrar($curso_id)
    {
        $usuario = auth()->user();

        // Verifica si el usuario sigue el curso
        $sigueCurso = $usuario->cursos()->where('cursos.id', $curso_id)->exists();
        if (!$sigueCurso) {
            return redirect()->route('views.UCursos')->with('error', 'Debes seguir el curso para ver el contenido.');
        }

        // Cargar curso + lecciones + pruebas
        $curso = Curso::with([
            'lecciones.pruebas' => function ($q) {
                $q->orderBy('orden');
            }
        ])->findOrFail($curso_id);

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
        // Lógica de tiempo de recuperación de vidas
        $tiempo_recuperacion = 0;
        if ($usuario->vidas < 5) { // Suponiendo 5 es el máximo de vidas
            // Ejemplo: guardas en sesión el timestamp de la última vida perdida
            $ultimo_uso = session('ultima_vida_perdida');
            $intervalo = 60 * 1; // 30 minutos para recuperar una vida
            if ($ultimo_uso) {
                $tiempo_restante = ($ultimo_uso + $intervalo) - time();
                $tiempo_recuperacion = $tiempo_restante > 0 ? $tiempo_restante : 0;
            }
        }

        return view('VistasEstudiante.camino', [
            'curso' => $curso,
            'lecciones' => $curso->lecciones,
            'pivot' => $pivot,
            'key' => $key,
            'idsPreguntas' => $idsPreguntas,
            'index' => $index,
            'tiempo_recuperacion' => $tiempo_recuperacion
        ]);
    }
}
