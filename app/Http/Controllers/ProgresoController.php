<?php

namespace App\Http\Controllers;

use App\Models\Pregunta;
use App\Models\ProgresoPregunta;
use App\Models\Respuesta;
use App\Models\Prueba;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProgresoController extends Controller
{
    /**
     * Mostrar una pregunta de la prueba.
     */
    public function mostrarPregunta($prueba_id)
    {
        $usuario = auth()->user();

        $prueba = Prueba::with('leccion.curso')->findOrFail($prueba_id);
        $curso = $prueba->leccion->curso;
        $curso_id = $curso->id;

        // Verificar vidas
        if ($usuario->vidas <= 0) {
            return redirect()->route('usuarios.caminoCurso', compact('curso_id'))
                ->with('error', '❌ No tienes vidas para iniciar esta prueba. Recarga vidas o espera.');
        }

        // Validar progreso en curso
        $cursoUsuario = $usuario->cursos()->where('curso_id', $curso_id)->first()->pivot;
        if ($prueba->id !== $cursoUsuario->prueba_actual_id) {
            return redirect()->route('usuarios.caminoCurso', compact('curso_id'))
                ->with('error', '❌ Esa prueba no está disponible.');
        }

        // Crear progreso inicial si no existe
        if (!$usuario->progresoPreguntas()->where('prueba_id', $prueba->id)->exists()) {
            $preguntas = $prueba->leccion->preguntas()->pluck('id')->shuffle()->take(10);
            foreach ($preguntas as $pid) {
                ProgresoPregunta::create([
                    'usuario_id' => $usuario->id,
                    'prueba_id' => $prueba->id,
                    'pregunta_id' => $pid,
                ]);
            }
            session()->forget(['preguntas_incorrectas', 'ronda_repeticion']);
        }

        $rondaRepeticion = session('ronda_repeticion', false);

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

                session()->forget('preguntas_incorrectas');

                if (!$rondaRepeticion) {
                    session(['ronda_repeticion' => true]);
                    return redirect()->route('pregunta.mostrar', ['prueba_id' => $prueba_id, 'repaso' => 1]);
                }

                return redirect()->route('pregunta.mostrar', compact('prueba_id'));
            }

            // Finalizar prueba si no quedan incorrectas
            if ($rondaRepeticion) {
                $this->avanzarProgreso($cursoUsuario, $prueba);
            }

            $usuario->progresoPreguntas()->where('prueba_id', $prueba->id)->delete();
            session()->forget('ronda_repeticion');

            return redirect()->route('usuarios.caminoCurso', compact('curso_id'))
                ->with('finalizado', '✅ Prueba completada.');
        }

        $pregunta = $pendiente->pregunta()->with('respuestas')->first();

        // ====== NUEVO: Contador de pregunta ======
        $preguntasIds = $usuario->progresoPreguntas()
            ->where('prueba_id', $prueba->id)
            ->pluck('pregunta_id')
            ->toArray();

        $preguntaActualIndex = array_search($pendiente->pregunta_id, $preguntasIds);
        $numeroPregunta = $preguntaActualIndex !== false ? $preguntaActualIndex + 1 : 1;
        $totalPreguntas = count($preguntasIds);
        // =======================================

        return view('VistasEstudiante.preguntas', [
            'pregunta' => $pregunta,
            'curso_id' => $curso_id,
            'prueba_id' => $prueba->id,
            'resultado' => null,
            'mensaje' => null,
            'mostrarContinuar' => false,
            'numeroPregunta' => $numeroPregunta,
            'totalPreguntas' => $totalPreguntas,
        ]);
    }


    /**
     * Procesar la respuesta del usuario a una pregunta.
     */
    public function responderPregunta(Request $request)
    {
        $usuario = auth()->user();
        $pregunta = Pregunta::findOrFail($request->pregunta_id);
        $respuesta = Respuesta::findOrFail($request->respuesta);

        $correcta = $pregunta->respuestas()->where('es_correcta', true)->first();
        $resultado = $respuesta->id === $correcta->id ? 'correcto' : 'incorrecto';

        // Marcar como respondida
        $usuario->progresoPreguntas()
            ->where('pregunta_id', $pregunta->id)
            ->update(['respondida' => true]);

        // Manejo de respuestas incorrectas
        if ($resultado === 'incorrecto') {
            $usuario->decrement('vidas');

            $incorrectas = session()->get('preguntas_incorrectas', []);
            if (!in_array($pregunta->id, $incorrectas)) {
                $incorrectas[] = $pregunta->id;
                session(['preguntas_incorrectas' => $incorrectas]);
            }
        }

        // Validar vidas
        if ($usuario->vidas <= 0) {
            $usuario->progresoPreguntas()->delete();
            session()->forget(['preguntas_incorrectas', 'ronda_repeticion']);

            return view('VistasEstudiante.sinVidas', [
                'curso_id' => $request->curso_id ?? $usuario->cursos()->first()->id ?? null,
                'mensaje' => 'Te has quedado sin vidas. Debes recargar vidas para continuar.',
            ]);
        }

        // Actualizar racha si es correcto
        if ($resultado === 'correcto') {
            $hoy = Carbon::today();
            $ultimoDia = $usuario->ultimo_dia_activo ? Carbon::parse($usuario->ultimo_dia_activo) : null;

            if ($ultimoDia) {
                $diff = $hoy->diffInDays($ultimoDia);
                $usuario->dias_racha = $diff == 1 ? $usuario->dias_racha + 1 : ($diff > 1 ? 1 : $usuario->dias_racha);
            } else {
                $usuario->dias_racha = 1;
            }

            $usuario->ultimo_dia_activo = $hoy;
            $usuario->save();
        }

        // Contador de preguntas
        $preguntasIds = $usuario->progresoPreguntas()
            ->where('prueba_id', $request->prueba_id)
            ->pluck('pregunta_id')
            ->toArray();
        $preguntaActualIndex = array_search($pregunta->id, $preguntasIds);
        $numeroPregunta = $preguntaActualIndex !== false ? $preguntaActualIndex + 1 : 1;
        $totalPreguntas = count($preguntasIds);

        // Verificar si quedan preguntas pendientes
        $pendientes = $usuario->progresoPreguntas()
            ->where('prueba_id', $request->prueba_id)
            ->where('respondida', false)
            ->count();

        $cursoUsuario = $usuario->cursos()->where('curso_id', $request->curso_id)->first()->pivot;

        if ($pendientes === 0) {
            // Si no quedan pendientes, avanzar progreso
            $prueba = Prueba::findOrFail($request->prueba_id);
            $this->avanzarProgreso($cursoUsuario, $prueba);

            // Limpiar progreso y sesión
            $usuario->progresoPreguntas()->where('prueba_id', $request->prueba_id)->delete();
            session()->forget(['preguntas_incorrectas', 'ronda_repeticion']);

            return redirect()->route('usuarios.caminoCurso', ['curso_id' => $request->curso_id])
                ->with('finalizado', '✅ Prueba completada.');
        }

        // Cargar pregunta con respuestas
        $pregunta->load('respuestas');

        return view('VistasEstudiante.preguntas', [
            'pregunta' => $pregunta,
            'curso_id' => $request->curso_id ?? $usuario->cursos()->first()->id,
            'prueba_id' => $request->prueba_id ?? $pregunta->progresoPreguntas()->first()->prueba_id ?? null,
            'resultado' => $resultado,
            'mensaje' => $resultado === 'correcto' ? '✅ Correcto!' : '❌ Incorrecto.',
            'mostrarContinuar' => true,
            'respuesta_seleccionada' => $respuesta->id,
            'numeroPregunta' => $numeroPregunta,
            'totalPreguntas' => $totalPreguntas,
        ]);
    }


    /**
     * Avanzar el progreso del usuario en el curso.
     */
    private function avanzarProgreso($cursoUsuario, $prueba)
    {
        $usuario = auth()->user();
        $usuario->increment('experiencia', $prueba->xp);

        $pruebas = $prueba->leccion->pruebas()->orderBy('orden')->get();
        $posPrueba = $pruebas->search(fn($p) => $p->id === $prueba->id);

        if ($posPrueba !== false && isset($pruebas[$posPrueba + 1])) {
            $cursoUsuario->update(['prueba_actual_id' => $pruebas[$posPrueba + 1]->id]);
            return;
        }

        $lecciones = $prueba->leccion->curso->lecciones()->orderBy('id')->get();
        $posLeccion = $lecciones->search(fn($l) => $l->id === $prueba->leccion_id);

        if ($posLeccion !== false && isset($lecciones[$posLeccion + 1])) {
            $siguiente = $lecciones[$posLeccion + 1];
            $cursoUsuario->update([
                'leccion_actual_id' => $siguiente->id,
                'prueba_actual_id' => $siguiente->pruebas()->orderBy('orden')->first()->id ?? null,
            ]);
            return;
        }

        $cursoUsuario->update(['prueba_actual_id' => null]);
    }

    /**
     * Cancelar el intento actual y volver al camino del curso.
     */
    public function cancelarIntento($curso_id)
    {
        $usuario = auth()->user();

        // Eliminar progreso de la prueba actual en este curso
        $cursoUsuario = $usuario->cursos()->where('curso_id', $curso_id)->first()->pivot;
        if ($cursoUsuario?->prueba_actual_id) {
            $usuario->progresoPreguntas()
                ->where('prueba_id', $cursoUsuario->prueba_actual_id)
                ->delete();
        }

        // Limpiar sesión
        session()->forget(['preguntas_incorrectas', 'ronda_repeticion']);

        return redirect()->route('usuarios.caminoCurso', compact('curso_id'))
            ->with('info', '❌ Has cancelado el intento actual de la prueba.');
    }
}
