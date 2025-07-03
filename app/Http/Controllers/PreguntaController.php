<?php

namespace App\Http\Controllers;

use App\Models\Pregunta;
use App\Models\Leccion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PreguntaController extends Controller
{
    public function index()
    {
        // ✅ Trae cada pregunta con su prueba y lección asociada
        $preguntas = Pregunta::with('prueba.leccion')->get();
        return view('CrudPreguntas.GestionarPregunta', compact('preguntas'));
    }

    public function create()
    {
        $pruebas = \App\Models\Prueba::with('leccion')->get();
        return view('CrudPreguntas.CrearPregunta', compact('pruebas'));
    }

    public function edit(Pregunta $pregunta)
    {
        $pruebas = \App\Models\Prueba::with('leccion')->get();
        return view('CrudPreguntas.EditarPregunta', compact('pregunta', 'pruebas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pregunta' => 'required|string',
            // ✅ Corrige: prueba_id apunta a pruebas, no lecciones
            'prueba_id' => 'required|exists:pruebas,id',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'opciones' => 'required|array|size:4',
            'opciones.*' => 'required|string',
            'correcta' => 'required|integer|between:1,4',
        ]);

        DB::beginTransaction();

        try {
            $pregunta = Pregunta::create([
                'pregunta' => $request->pregunta,
                'prueba_id' => $request->prueba_id,
                'imagen' => null,
            ]);

            if ($request->hasFile('imagen')) {
                $file = $request->file('imagen');
                $extension = $file->getClientOriginalExtension();
                $nombreArchivo = 'prueba_' . $request->prueba_id . '_pregunta_' . $pregunta->id . '.' . $extension;

                $file->move(public_path('imagenes_preguntas'), $nombreArchivo);

                $pregunta->update(['imagen' => 'imagenes_preguntas/' . $nombreArchivo]);
            }

            foreach ($request->opciones as $index => $texto) {
                $pregunta->respuestas()->create([
                    'texto' => $texto,
                    'es_correcta' => ($index + 1) == $request->correcta,
                ]);
            }

            DB::commit();
            return redirect()->route('preguntas.index')->with('success', 'Pregunta creada correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Hubo un error: ' . $e->getMessage());
        }
    }

    public function update(Request $request, Pregunta $pregunta)
    {
        $request->validate([
            'pregunta' => 'required|string',
            'prueba_id' => 'required|exists:pruebas,id',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'opciones' => 'required|array|size:4',
            'opciones.*' => 'required|string',
            'correcta' => 'required|integer|between:1,4',
        ]);

        $pregunta->pregunta = $request->pregunta;
        $pregunta->prueba_id = $request->prueba_id;

        if ($request->hasFile('imagen')) {
            if ($pregunta->imagen && file_exists(public_path($pregunta->imagen))) {
                unlink(public_path($pregunta->imagen));
            }

            $extension = $request->file('imagen')->getClientOriginalExtension();
            $nombreArchivo = 'prueba_' . $request->prueba_id . '_pregunta_' . $pregunta->id . '.' . $extension;

            $request->file('imagen')->move(public_path('imagenes_preguntas'), $nombreArchivo);

            $pregunta->imagen = 'imagenes_preguntas/' . $nombreArchivo;
        }

        $pregunta->save();

        foreach ($pregunta->respuestas as $index => $respuesta) {
            $respuesta->texto = $request->opciones[$index];
            $respuesta->es_correcta = ($index + 1) == $request->correcta;
            $respuesta->save();
        }

        return redirect()->route('preguntas.index')->with('success', 'Pregunta actualizada correctamente.');
    }

    public function mostrarPregunta(Request $request)
    {
        $pruebaid = 1;
        $resultado = null;
        $mensaje = null;
        $repaso = false;

        $respondidas = session('preguntas_respondidas', []);
        $fallidas = session('preguntas_fallidas', []);
        $en_repaso = session('en_repaso', false);
        $bien_respondidas = session('bien_respondidas', []);

        if ($request->isMethod('post')) {
            if (!$request->has('pregunta_id')) {
                session()->forget(['preguntas_respondidas', 'preguntas_fallidas', 'en_repaso', 'bien_respondidas']);
                return redirect()->route('pregunta.mostrar');
            }
            $pregunta = Pregunta::with('respuestas')->find($request->input('pregunta_id'));
            $respuestaId = $request->input('respuesta');
            $respuesta = $pregunta ? $pregunta->respuestas->where('id', $respuestaId)->first() : null;

            if ($pregunta && $respuesta && $respuesta->es_correcta) {
                $resultado = 'correcto';
                $mensaje = '¡Respuesta correcta!';
                $respondidas[] = $pregunta->id;
                $bien_respondidas[] = $pregunta->id;
                session([
                    'preguntas_respondidas' => array_unique($respondidas),
                    'bien_respondidas' => array_unique($bien_respondidas),
                ]);
            } elseif ($pregunta) {
                $resultado = 'incorrecto';
                $mensaje = 'Respuesta incorrecta. Intenta de nuevo.';
                if (!in_array($pregunta->id, $fallidas)) {
                    $fallidas[] = $pregunta->id;
                    session(['preguntas_fallidas' => $fallidas]);
                }
                $respondidas[] = $pregunta->id;
                session(['preguntas_respondidas' => array_unique($respondidas)]);
            }
        }

        $totalPreguntas = Pregunta::where('prueba_id', $pruebaid)->count();

        if (count($respondidas) >= $totalPreguntas && !$en_repaso) {
            if (!empty($fallidas)) {
                session(['en_repaso' => true, 'preguntas_respondidas' => []]);
                $repaso = true;
            } else {
                $user = auth()->user();
                $bien = count($bien_respondidas);
                if ($bien >= 4) {
                    $yaReclamada = $user->lecciones()->where('prueba_id', $pruebaid)->wherePivot('xp_reclamada', true)->exists();
                    if (!$yaReclamada) {
                        $user->lecciones()->syncWithoutDetaching([$pruebaid => ['xp_reclamada' => true]]);
                        $user->experiencia += 50; // Aquí podrías ajustar según XP de la prueba
                        $user->save();
                        $mensaje = '¡Has ganado 50 XP por tu desempeño en la lección!';
                    }
                }
                session()->forget(['preguntas_respondidas', 'preguntas_fallidas', 'en_repaso', 'bien_respondidas']);
                return redirect()->route('views.UCamino')->with('finalizado', '¡Completaste todas las preguntas de la lección 1 correctamente! ' . ($mensaje ?? ''));
            }
        }

        if ($en_repaso && empty($fallidas)) {
            $user = auth()->user();
            $bien = count(session('bien_respondidas', []));
            if ($bien >= 4) {
                $yaReclamada = $user->lecciones()->where('prueba_id', $pruebaid)->wherePivot('xp_reclamada', true)->exists();
                if (!$yaReclamada) {
                    $user->lecciones()->syncWithoutDetaching([$pruebaid => ['xp_reclamada' => true]]);
                    $user->experiencia += 50;
                    $user->save();
                    $mensaje = '¡Has ganado 50 XP por tu desempeño en la lección!';
                }
            }
            session()->forget(['preguntas_respondidas', 'preguntas_fallidas', 'en_repaso', 'bien_respondidas']);
            return view('VistasEstudiante.preguntas', [
                'pregunta' => null,
                'resultado' => null,
                'mensaje' => null,
                'mensaje_repaso' => null,
                'finalizado' => true,
                'xp_mensaje' => $mensaje ?? null,
            ]);
        }

        if ($en_repaso || $repaso) {
            $pregunta = Pregunta::with('respuestas')
                ->where('prueba_id', $pruebaid)
                ->whereIn('id', $fallidas)
                ->whereNotIn('id', $respondidas)
                ->inRandomOrder()
                ->first();
            $mensaje_repaso = 'Repasemos las que fallaste:';
        } else {
            $pregunta = Pregunta::with('respuestas')
                ->where('prueba_id', $pruebaid)
                ->whereNotIn('id', $respondidas)
                ->inRandomOrder()
                ->first();
            $mensaje_repaso = null;
        }

        if ($pregunta && $pregunta->respuestas) {
            $pregunta->respuestas = $pregunta->respuestas->shuffle();
        }

        return view('VistasEstudiante.preguntas', compact('pregunta', 'totalPreguntas'))
            ->with('resultado', $resultado)
            ->with('mensaje', $mensaje)
            ->with('mensaje_repaso', ($en_repaso || $repaso) ? $mensaje_repaso : null);
    }
}
