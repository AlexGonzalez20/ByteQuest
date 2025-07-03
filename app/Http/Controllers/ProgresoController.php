<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Prueba;
use App\Models\Pregunta;

class ProgresoController extends Controller
{
    /**
     * Muestra la prueba con sus preguntas.
     */
    public function mostrarPrueba($prueba_id)
    {
        $usuario = Auth::user();

        $prueba = Prueba::with('preguntas.respuestas', 'leccion.curso')->findOrFail($prueba_id);

        $curso = $prueba->leccion->curso;

        // Validar acceso: solo la prueba actual se puede ver
        $cursoPivot = $usuario->cursos()->where('curso_id', $curso->id)->first()->pivot;

        if ($cursoPivot->prueba_actual_id != $prueba->id) {
            return redirect()->route('usuarios.caminoCurso', $curso->id)
                ->with('error', 'No tienes acceso a esta prueba todavía.');
        }

        return view('VistasEstudiante.preguntas', [
            'prueba' => $prueba,
            'pregunta' => $prueba->preguntas->first(),
            'curso' => $curso,
        ]);
    }

    /**
     * Procesa la respuesta y avanza progreso.
     */
    public function responderPrueba(Request $request)
    {
        $usuario = Auth::user();
        $pregunta_id = $request->input('pregunta_id');
        $respuesta_id = $request->input('respuesta');

        $pregunta = Pregunta::with('prueba.leccion.curso')->findOrFail($pregunta_id);
        $prueba = $pregunta->prueba;
        $curso = $prueba->leccion->curso;

        $respuesta_correcta = $pregunta->respuestas()->where('es_correcta', true)->first();


        $resultado = ($respuesta_id == $respuesta_correcta->id) ? 'correcto' : 'incorrecto';

        // Aquí puedes registrar intento, sumar XP, etc.

        $preguntas_total = $prueba->preguntas()->count();
        $preguntas_resueltas = 1; // Simulado para demo

        if ($preguntas_resueltas >= $preguntas_total && $resultado === 'correcto') {
            // Buscar siguiente prueba
            $siguientePrueba = $prueba->leccion->pruebas()
                ->where('orden', '>', $prueba->orden)
                ->orderBy('orden')
                ->first();

            if (!$siguientePrueba) {
                $siguienteLeccion = $curso->lecciones()->where('id', '>', $prueba->leccion->id)->orderBy('id')->first();
                if ($siguienteLeccion) {
                    $siguientePrueba = $siguienteLeccion->pruebas()->orderBy('orden')->first();
                }
            }

            if ($siguientePrueba) {
                $usuario->cursos()->updateExistingPivot($curso->id, [
                    'leccion_actual_id' => $siguientePrueba->leccion_id,
                    'prueba_actual_id' => $siguientePrueba->id,
                ]);
            }

            return redirect()->route('usuarios.caminoCurso', $curso->id)
                ->with('finalizado', '¡Prueba completada! Avanzaste a la siguiente.');
        }

        return back()->with([
            'resultado' => $resultado,
            'mensaje' => $resultado === 'correcto' ? '¡Respuesta correcta!' : 'Respuesta incorrecta, inténtalo de nuevo.'
        ]);
    }
}
