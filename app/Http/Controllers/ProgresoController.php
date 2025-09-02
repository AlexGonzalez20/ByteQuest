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

        if ($usuario->progresoPreguntas()->where('prueba_id', $prueba->id)->count() == 0) {
            $preguntas = $prueba->leccion->preguntas()->pluck('id')->shuffle()->take(10);

            foreach ($preguntas as $pid) {
                ProgresoPregunta::create([
                    'usuario_id' => $usuario->id,
                    'prueba_id' => $prueba->id,
                    'pregunta_id' => $pid,
                ]);
            }
        }

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

        if ($resultado === 'incorrecto') {
            $usuario->vidas -= 1;
            $usuario->save();
        }

        if ($usuario->vidas <= 0) {
            $usuario->progresoPreguntas()->delete();
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
