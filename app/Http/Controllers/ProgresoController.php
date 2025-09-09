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

        if ($usuario->vidas <= 0) {
            return redirect()->route('usuarios.caminoCurso', ['curso_id' => $curso_id])
                ->with('error', '❌ No tienes vidas para iniciar esta prueba. Recarga vidas o espera.');
        }

        $cursoUsuario = $usuario->cursos()->where('curso_id', $curso_id)->first()->pivot;

        if ($prueba->id != $cursoUsuario->prueba_actual_id) {
            return redirect()->route('usuarios.caminoCurso', ['curso_id' => $curso_id])
                ->with('error', '❌ Esa prueba no está disponible.');
        }

        // Si no hay progreso, crea los 10 registros de progreso
        if ($usuario->progresoPreguntas()->where('prueba_id', $prueba->id)->count() == 0) {
            $preguntas = $prueba->leccion->preguntas()->pluck('id')->shuffle()->take(10);

            foreach ($preguntas as $pid) {
                ProgresoPregunta::create([
                    'usuario_id' => $usuario->id,
                    'prueba_id' => $prueba->id,
                    'pregunta_id' => $pid,
                ]);
            }
            // Limpiar posibles sesiones anteriores
            session()->forget('preguntas_incorrectas');
            session()->forget('ronda_repeticion');
        }

        // ¿Estamos en ronda de repetición?
        $rondaRepeticion = session('ronda_repeticion', false);

        if (!$rondaRepeticion) {
            // PRIMERA RONDA: solo las 10 originales
            $pendiente = $usuario->progresoPreguntas()
                ->where('prueba_id', $prueba->id)
                ->where('respondida', false)
                ->first();

            if (!$pendiente) {
                $incorrectas = session()->get('preguntas_incorrectas', []);
                if (!empty($incorrectas)) {
                    $usuario->progresoPreguntas()->where('prueba_id', $prueba->id)->delete();
                    foreach ($incorrectas as $pid) {
                        ProgresoPregunta::create([
                            'usuario_id' => $usuario->id,
                            'prueba_id' => $prueba->id,
                            'pregunta_id' => $pid,
                        ]);
                    }
                    session(['ronda_repeticion' => true]);
                    session()->forget('preguntas_incorrectas');
                    // Pasa el mensaje de repaso
                    return redirect()->route('pregunta.mostrar', ['prueba_id' => $prueba_id, 'repaso' => 1]);
                } else {
                    // No hay incorrectas, termina la prueba
                    $usuario->progresoPreguntas()->where('prueba_id', $prueba->id)->delete();
                    session()->forget('ronda_repeticion');
                    return redirect()->route('usuarios.caminoCurso', ['curso_id' => $curso_id])
                        ->with('finalizado', '✅ Prueba completada.');
                }
            }
        } else {
            // RONDA DE REPETICIÓN: solo incorrectas
            $pendiente = $usuario->progresoPreguntas()
                ->where('prueba_id', $prueba->id)
                ->where('respondida', false)
                ->first();

            if (!$pendiente) {
                $incorrectas = session()->get('preguntas_incorrectas', []);
                if (!empty($incorrectas)) {
                    // Borrar progreso anterior
                    $usuario->progresoPreguntas()->where('prueba_id', $prueba->id)->delete();
                    // Crear progreso solo para las incorrectas
                    foreach ($incorrectas as $pid) {
                        ProgresoPregunta::create([
                            'usuario_id' => $usuario->id,
                            'prueba_id' => $prueba->id,
                            'pregunta_id' => $pid,
                        ]);
                    }
                    session()->forget('preguntas_incorrectas');
                    return redirect()->route('pregunta.mostrar', ['prueba_id' => $prueba_id]);
                } else {
                    // Ya no hay incorrectas, termina la prueba
                    $usuario->progresoPreguntas()->where('prueba_id', $prueba->id)->delete();
                    session()->forget('ronda_repeticion');
                    return redirect()->route('usuarios.caminoCurso', ['curso_id' => $curso_id])
                        ->with('finalizado', '✅ Prueba completada.');
                }
            }
        }

        $pregunta = $pendiente->pregunta()->with('respuestas')->first();

        return view('VistasEstudiante.preguntas', [
            'pregunta' => $pregunta,
            'curso_id' => $curso_id,
            'prueba_id' => $prueba->id,
            'resultado' => null,
            'mensaje' => null,
            'mostrarContinuar' => false,
        ]);
    }

    public function responderPregunta(Request $request)
    {
        $usuario = auth()->user();
        $pregunta = Pregunta::findOrFail($request->pregunta_id);
        $respuesta = \App\Models\Respuesta::findOrFail($request->respuesta);

        $correcta = $pregunta->respuestas()->where('es_correcta', true)->first();
        $resultado = ($respuesta->id == $correcta->id) ? 'correcto' : 'incorrecto';

        $usuario->progresoPreguntas()
            ->where('pregunta_id', $pregunta->id)
            ->update(['respondida' => true]);

        // Guardar incorrectas en sesión (solo si fue incorrecta)
        if ($resultado === 'incorrecto') {

            $usuario->vidas -= 1;
            $usuario->ultima_vida_perdida = now();
            $usuario->save();

            $incorrectas = session()->get('preguntas_incorrectas', []);
            if (!in_array($pregunta->id, $incorrectas)) {
                $incorrectas[] = $pregunta->id;
                session(['preguntas_incorrectas' => $incorrectas]);
            }
        }

        if ($usuario->vidas <= 0) {
            $usuario->progresoPreguntas()->delete();
            session()->forget('preguntas_incorrectas');
            session()->forget('ronda_repeticion');
            return view('VistasEstudiante.sinvidas', [
                'curso_id' => $usuario->cursos()->first()->id ?? null,
                'mensaje' => 'Te has quedado sin vidas. Debes recargar vidas para continuar.'
            ]);
        }

        if ($resultado === 'correcto') {
            $hoy = Carbon::today();
            $ultimoDia = $usuario->ultimo_dia_activo ? Carbon::parse($usuario->ultimo_dia_activo) : null;

            if ($ultimoDia) {
                $diff = $hoy->diffInDays($ultimoDia);
                if ($diff == 1) $usuario->dias_racha += 1;
                elseif ($diff > 1) $usuario->dias_racha = 1;
            } else {
                $usuario->dias_racha = 1;
            }

            $usuario->ultimo_dia_activo = $hoy;
            $usuario->save();
        }

        $pregunta = $pregunta->load('respuestas');

        return view('VistasEstudiante.preguntas', [
            'pregunta' => $pregunta,
            'curso_id' => $request->curso_id ?? $usuario->cursos()->first()->id,
            'prueba_id' => $request->prueba_id ?? $pregunta->progresoPreguntas()->first()->prueba_id ?? null,
            'resultado' => $resultado,
            'mensaje' => $resultado === 'correcto' ? '✅ Correcto!' : '❌ Incorrecto.',
            'mostrarContinuar' => true,
            'respuesta_seleccionada' => $respuesta->id,
        ]);
    }

    private function avanzarProgreso($cursoUsuario, $prueba)
    {
        $usuario = auth()->user();

        $usuario->experiencia += $prueba->xp;
        $usuario->save();

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

        $cursoUsuario->prueba_actual_id = null;
        $cursoUsuario->save();
    }
}
