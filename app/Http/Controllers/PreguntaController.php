<?php

namespace App\Http\Controllers;

use App\Models\Pregunta;
use App\Models\Prueba;
use App\Models\ProgresoPregunta;
use Illuminate\Http\Request;

class ProgresoController extends Controller
{
    public function mostrarPregunta($prueba_id)
    {
        $usuario = auth()->user();

        $prueba = Prueba::with(['preguntas', 'leccion.curso'])->findOrFail($prueba_id);

        // 🔐 Valida que la prueba sea la actual
        $cursoUsuario = $usuario->cursos()->where('curso_id', $prueba->leccion->curso_id)->firstOrFail()->pivot;

        if ($cursoUsuario->prueba_actual_id != $prueba->id) {
            return redirect()->route('usuarios.caminoCurso', ['curso_id' => $prueba->leccion->curso_id])
                ->with('error', '❌ Esta prueba no está disponible.');
        }

        // 🗑️ Limpia progreso si no hay preguntas guardadas
        $progreso = $usuario->progresoPreguntas()->where('prueba_id', $prueba->id);

        if ($progreso->count() === 0) {
            // ⚡ Genera preguntas SOLO de esta prueba y lección
            $preguntas = Pregunta::where('prueba_id', $prueba->id)
                ->where('prueba_id', $prueba->leccion->id)
                ->inRandomOrder()
                ->take(10)
                ->get();

            if ($preguntas->count() === 0) {
                return redirect()->route('usuarios.caminoCurso', ['curso_id' => $prueba->leccion->curso_id])
                    ->with('error', '❌ Esta prueba no tiene preguntas válidas para esta lección.');
            }

            foreach ($preguntas as $pregunta) {
                ProgresoPregunta::create([
                    'usuario_id' => $usuario->id,
                    'prueba_id' => $prueba->id,
                    'pregunta_id' => $pregunta->id,
                ]);
            }
        }

        // ✅ Busca la siguiente pregunta pendiente
        $pendiente = $usuario->progresoPreguntas()
            ->where('prueba_id', $prueba->id)
            ->where('respondida', false)
            ->first();

        if (!$pendiente) {
            // ✅ Limpia progreso y avanza
            $this->avanzarProgreso($cursoUsuario, $prueba);

            // Borra progreso usado
            ProgresoPregunta::where('usuario_id', $usuario->id)
                ->where('prueba_id', $prueba->id)
                ->delete();

            return redirect()->route('usuarios.caminoCurso', ['curso_id' => $prueba->leccion->curso_id])
                ->with('finalizado', '✅ Prueba completada.');
        }

        // ⚠️ Verifica que la pregunta pertenece a la lección
        if ($pendiente->pregunta->prueba_id !== $prueba->leccion->id) {
            return redirect()->route('usuarios.caminoCurso', ['curso_id' => $prueba->leccion->curso_id])
                ->with('error', '❌ Error: pregunta inválida para esta lección.');
        }

        $pregunta = $pendiente->pregunta()->with('respuestas')->first();

        return view('VistasEstudiante.preguntas', compact('pregunta'));
    }

    public function responderPregunta(Request $request)
    {
        $usuario = auth()->user();
        $pregunta = Pregunta::with('respuestas')->findOrFail($request->pregunta_id);

        $respuesta = $pregunta->respuestas()->findOrFail($request->respuesta);
        $correcta = $pregunta->respuestas()->where('es_correcta', true)->first();

        $resultado = $respuesta->id === $correcta->id ? 'correcto' : 'incorrecto';

        ProgresoPregunta::where([
            'usuario_id' => $usuario->id,
            'pregunta_id' => $pregunta->id,
        ])->update(['respondida' => true]);

        return redirect()->back()
            ->with('resultado', $resultado)
            ->with('mensaje', $resultado === 'correcto' ? '✅ Correcto!' : '❌ Incorrecto.');
    }

    private function avanzarProgreso($cursoUsuario, $prueba)
    {
        $pruebas = $prueba->leccion->pruebas()->orderBy('orden')->get();
        $posPrueba = $pruebas->search(fn($p) => $p->id === $prueba->id);

        if ($posPrueba !== false && isset($pruebas[$posPrueba + 1])) {
            $cursoUsuario->prueba_actual_id = $pruebas[$posPrueba + 1]->id;
            $cursoUsuario->save();
            return;
        }

        $lecciones = $prueba->leccion->curso->lecciones()->orderBy('id')->get();
        $posLeccion = $lecciones->search(fn($l) => $l->id === $prueba->leccion_id);

        if ($posLeccion !== false && isset($lecciones[$posLeccion + 1])) {
            $siguiente = $lecciones[$posLeccion + 1];
            $cursoUsuario->leccion_actual_id = $siguiente->id;
            $cursoUsuario->prueba_actual_id = $siguiente->pruebas()->orderBy('orden')->first()?->id;
            $cursoUsuario->save();
            return;
        }

        $cursoUsuario->prueba_actual_id = null; // Fin del curso
        $cursoUsuario->save();
    }
}
