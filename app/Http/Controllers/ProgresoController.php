<?php

namespace App\Http\Controllers;

use App\Models\Pregunta;
use App\Models\ProgresoPregunta;
use Illuminate\Http\Request;
use Carbon\Carbon;


class ProgresoController extends Controller
{
    public function mostrarPregunta($prueba_id)
    {
        $usuario = auth()->user();

        $prueba = \App\Models\Prueba::with('leccion.curso')->findOrFail($prueba_id);
        $curso = $prueba->leccion->curso;
        $curso_id = $curso->id;

        // 🚫 Validar vidas antes de todo
        if ($usuario->vidas <= 0) {
            return redirect()->route('usuarios.caminoCurso', ['curso_id' => $curso_id])
                ->with('error', '❌ No tienes vidas para iniciar esta prueba. Recarga vidas o espera.');
        }

        $cursoUsuario = $usuario->cursos()->where('curso_id', $curso_id)->first()->pivot;

        // Verifica que sea la prueba actual
        if ($prueba->id != $cursoUsuario->prueba_actual_id) {
            return redirect()->route('usuarios.caminoCurso', ['curso_id' => $curso_id])
                ->with('error', '❌ Esa prueba no está disponible.');
        }

        // Generar progreso si no existe
        if ($usuario->progresoPreguntas()->where('prueba_id', $prueba->id)->count() == 0) {
            $preguntas = $prueba->leccion->preguntas()->pluck('id')->shuffle()->take(10);

            foreach ($preguntas as $pid) {
                \App\Models\ProgresoPregunta::create([
                    'usuario_id' => $usuario->id,
                    'prueba_id' => $prueba->id,
                    'pregunta_id' => $pid,
                ]);
            }
        }

        // Trae la siguiente pregunta sin responder
        $pendiente = $usuario->progresoPreguntas()
            ->where('prueba_id', $prueba->id)
            ->where('respondida', false)
            ->first();

        if (!$pendiente) {
            $usuario->progresoPreguntas()->where('prueba_id', $prueba->id)->delete();
            $this->avanzarProgreso($cursoUsuario, $prueba);

            return redirect()->route('usuarios.caminoCurso', ['curso_id' => $curso_id])
                ->with('finalizado', '✅ Prueba completada.');
        }

        $pregunta = $pendiente->pregunta()->with('respuestas')->first();

        return view('VistasEstudiante.preguntas', compact('pregunta', 'curso_id'));
    }



    public function responderPregunta(Request $request)
    {
        $usuario = auth()->user();
        $pregunta = \App\Models\Pregunta::findOrFail($request->pregunta_id);
        $respuesta = \App\Models\Respuesta::findOrFail($request->respuesta);

        $correcta = $pregunta->respuestas()->where('es_correcta', true)->first();
        $resultado = ($respuesta->id == $correcta->id) ? 'correcto' : 'incorrecto';

        // ✅ Marcar como respondida
        $usuario->progresoPreguntas()
            ->where('pregunta_id', $pregunta->id)
            ->update(['respondida' => true]);

        // ✅ Si es incorrecta → resta vida
        if ($resultado === 'incorrecto') {
            $usuario->vidas -= 1;
            $usuario->save();
        }

        // 🚫 Si ya no tiene vidas, termina la prueba a la fuerza
        if ($usuario->vidas <= 0) {
            $usuario->progresoPreguntas()->delete();

            return view('VistasEstudiante.sinvidas', [
                'curso_id' => $usuario->cursos()->first()->id,
                'mensaje' => 'Te has quedado sin vidas. Debes recargar vidas para continuar.'
            ]);
        }

        // ✅ Racha: sólo si la respuesta es correcta
        if ($resultado === 'correcto') {
            $hoy = Carbon::today();
            $ultimoDia = $usuario->ultimo_dia_activo ? Carbon::parse($usuario->ultimo_dia_activo) : null;

            if ($ultimoDia) {
                $diff = $hoy->diffInDays($ultimoDia);

                if ($diff == 1) {
                    // Aumenta la racha
                    $usuario->dias_racha += 1;
                } elseif ($diff > 1) {
                    // Reinicia racha
                    $usuario->dias_racha = 1;
                }
                // diff == 0 => hoy mismo, no cambia
            } else {
                $usuario->dias_racha = 1;
            }

            $usuario->ultimo_dia_activo = $hoy;
            $usuario->save();
        }

        return redirect()->back()
            ->with('resultado', $resultado)
            ->with('mensaje', $resultado === 'correcto' ? '✅ Correcto!' : '❌ Incorrecto.');
    }


    private function avanzarProgreso($cursoUsuario, $prueba)
    {
        $usuario = auth()->user();

        // ✅ Sumar XP de la prueba al usuario
        $usuario->experiencia += $prueba->xp;
        $usuario->save();

        // 🔁 Continuar flujo para desbloquear la siguiente prueba o lección
        $pruebas = $prueba->leccion->pruebas()->orderBy('orden')->get();
        $posPrueba = $pruebas->search(fn($p) => $p->id == $prueba->id);

        if ($posPrueba !== false && isset($pruebas[$posPrueba + 1])) {
            $cursoUsuario->prueba_actual_id = $pruebas[$posPrueba + 1]->id;
            $cursoUsuario->save();
            return;
        }

        $lecciones = $prueba->leccion->curso->lecciones()->orderBy('id')->get();
        $posLeccion = $lecciones->search(fn($l) => $l->id == $prueba->leccion_id);

        if ($posLeccion !== false && isset($lecciones[$posLeccion + 1])) {
            $siguiente = $lecciones[$posLeccion + 1];
            $cursoUsuario->leccion_actual_id = $siguiente->id;
            $cursoUsuario->prueba_actual_id = $siguiente->pruebas()->orderBy('orden')->first()->id ?? null;
            $cursoUsuario->save();
            return;
        }

        $cursoUsuario->prueba_actual_id = null; // ✅ Curso finalizado
        $cursoUsuario->save();
    }
}
