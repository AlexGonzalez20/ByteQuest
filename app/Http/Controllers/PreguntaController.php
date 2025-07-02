<?php

namespace App\Http\Controllers;

use App\Models\Pregunta;
use App\Models\leccion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class PreguntaController extends Controller
{
    public function index()
    {
        $preguntas = Pregunta::with('leccion')->get();
        return view('CrudPreguntas.GestionarPregunta', compact('preguntas'));
    }

    public function edit(Pregunta $pregunta)
    {
        $lecciones = Leccion::all();
        return view('CrudPreguntas.EditarPregunta', compact('pregunta', 'lecciones'));
    }


    public function create()
    {
        $lecciones = \App\Models\Leccion::all();
        $lecciones = leccion::all();
        return view('CrudPreguntas.CrearPregunta', compact('lecciones', 'lecciones'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'pregunta' => 'required|string',
            'leccion_id' => 'required|exists:lecciones,id',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'opciones' => 'required|array|size:4',
            'opciones.*' => 'required|string',
            'correcta' => 'required|integer|between:1,4',
        ]);

        DB::beginTransaction();

        try {
            // 1) Crear la pregunta SIN imagen
            $pregunta = Pregunta::create([
                'pregunta' => $request->pregunta,
                'leccion_id' => $request->leccion_id,
                'imagen' => null,
            ]);

            // 2) Subir imagen si existe
            if ($request->hasFile('imagen')) {
                $file = $request->file('imagen');
                $extension = $file->getClientOriginalExtension();

                $nombreArchivo = 'leccion_' . $request->leccion_id . '_pregunta_' . $pregunta->id . '.' . $extension;

                $file->move(public_path('imagenes_preguntas'), $nombreArchivo);

                $rutaImagen = 'imagenes_preguntas/' . $nombreArchivo;

                // Actualizar columna imagen
                $pregunta->update(['imagen' => $rutaImagen]);
            }

            // 3) Guardar respuestas
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
            'leccion_id' => 'required|exists:lecciones,id',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'opciones' => 'required|array|size:4',
            'opciones.*' => 'required|string',
            'correcta' => 'required|integer|between:1,4',
        ]);

        // Actualizar pregunta básica
        $pregunta->pregunta = $request->pregunta;
        $pregunta->leccion_id = $request->leccion_id;

        // Manejar nueva imagen
        if ($request->hasFile('imagen')) {
            // Borrar imagen antigua si existe
            if ($pregunta->imagen && file_exists(public_path($pregunta->imagen))) {
                unlink(public_path($pregunta->imagen));
            }

            // Generar nuevo nombre
            $extension = $request->file('imagen')->getClientOriginalExtension();
            $nombreArchivo = 'leccion_' . $request->leccion_id . '_pregunta_' . $pregunta->id . '.' . $extension;

            $request->file('imagen')->move(public_path('imagenes_preguntas'), $nombreArchivo);

            $pregunta->imagen = 'imagenes_preguntas/' . $nombreArchivo;
        }

        $pregunta->save();

        // Actualizar respuestas
        foreach ($pregunta->respuestas as $index => $respuesta) {
            $respuesta->texto = $request->opciones[$index];
            $respuesta->es_correcta = ($index + 1) == $request->correcta;
            $respuesta->save();
        }

        return redirect()->route('preguntas.index')->with('success', 'Pregunta actualizada correctamente.');
    }

    public function mostrarPregunta(Request $request)
    {
        $leccionId = 1;
        $resultado = null;
        $mensaje = null;
        $repaso = false;

        // Obtener preguntas respondidas y fallidas de la sesión
        $respondidas = session('preguntas_respondidas', []);
        $fallidas = session('preguntas_fallidas', []);
        $en_repaso = session('en_repaso', false);
        $bien_respondidas = session('bien_respondidas', []);

        if ($request->isMethod('post')) {
            if (!$request->has('pregunta_id')) {
                session()->forget(['preguntas_respondidas', 'preguntas_fallidas', 'en_repaso', 'bien_respondidas']);
                return redirect()->route('pregunta.mostrar');
            }
            $pregunta = \App\Models\Pregunta::with('respuestas')->find($request->input('pregunta_id'));
            $respuestaId = $request->input('respuesta');
            $respuesta = $pregunta ? $pregunta->respuestas->where('id', $respuestaId)->first() : null;

            if ($pregunta && $respuesta && $respuesta->es_correcta) {
                $resultado = 'correcto';
                $mensaje = '¡Respuesta correcta!';
                $respondidas[] = $pregunta->id;
                $respondidas = array_unique($respondidas);
                $bien_respondidas[] = $pregunta->id;
                $bien_respondidas = array_unique($bien_respondidas);
                session(['preguntas_respondidas' => $respondidas, 'bien_respondidas' => $bien_respondidas]);
            } elseif ($pregunta) {
                $resultado = 'incorrecto';
                $mensaje = 'Respuesta incorrecta. Intenta de nuevo.';
                // Guardar pregunta como fallida si no está ya
                if (!in_array($pregunta->id, $fallidas)) {
                    $fallidas[] = $pregunta->id;
                    session(['preguntas_fallidas' => $fallidas]);
                }
                $respondidas[] = $pregunta->id;
                $respondidas = array_unique($respondidas);
                session(['preguntas_respondidas' => $respondidas]);
            }
        }

        // Si ya respondió 5 preguntas y no está en repaso, pasar a repaso
        $totalPreguntas = \App\Models\Pregunta::where('leccion_id', $leccionId)->count();

        // Si ya respondió todas las preguntas y no está en repaso, pasar a repaso si hay fallidas
        if (count($respondidas) >= $totalPreguntas && !$en_repaso) {
            if (!empty($fallidas)) {
                session(['en_repaso' => true]);
                $repaso = true;
                $respondidas = [];
                session(['preguntas_respondidas' => $respondidas]);
            } else {
                // Calcular XP y reclamar si corresponde
                $user = auth()->user();
                $bien = count($bien_respondidas);
                if ($bien >= 4) {
                    // Reclamar XP solo si no se ha reclamado
                    $yaReclamada = $user->lecciones()->where('leccion_id', $leccionId)->wherePivot('xp_reclamada', true)->exists();
                    if (!$yaReclamada) {
                        $user->lecciones()->syncWithoutDetaching([$leccionId => ['xp_reclamada' => true]]);
                        $user->experiencia += 50;
                        $user->save();
                        $mensaje = '¡Has ganado 50 XP por tu desempeño en la lección!';
                    }
                }
                session()->forget(['preguntas_respondidas', 'preguntas_fallidas', 'en_repaso', 'bien_respondidas']);
                return redirect()->route('views.UCamino')->with('finalizado', '¡Completaste todas las preguntas de la lección 1 correctamente!' . (isset($mensaje) ? ' ' . $mensaje : ''));
            }
        }

        // Si está en repaso y ya no quedan fallidas, terminar y permitir reinicio
        if ($en_repaso && empty($fallidas)) {
            // Sumar XP si el usuario alcanzó 4 o más correctas (incluyendo repaso)
            $user = auth()->user();
            $bien = count(session('bien_respondidas', []));
            if ($bien >= 4) {
                $yaReclamada = $user->lecciones()->where('leccion_id', $leccionId)->wherePivot('xp_reclamada', true)->exists();
                if (!$yaReclamada) {
                    $user->lecciones()->syncWithoutDetaching([$leccionId => ['xp_reclamada' => true]]);
                    $user->experiencia += 50;
                    $user->save();
                    $mensaje = '¡Has ganado 50 XP por tu desempeño en la lección!';
                }
            }
            session()->forget(['preguntas_respondidas', 'preguntas_fallidas', 'en_repaso', 'bien_respondidas']);
            return view('Usuarios.preguntas', [
                'pregunta' => null,
                'resultado' => null,
                'mensaje' => null,
                'mensaje_repaso' => null,
                'finalizado' => true,
                'xp_mensaje' => isset($mensaje) ? $mensaje : null
            ]);
        }

        // Buscar pregunta
        if ($en_repaso || $repaso) {
            // Mostrar solo preguntas fallidas no respondidas en repaso
            $pregunta = \App\Models\Pregunta::with('respuestas')
                ->where('leccion_id', $leccionId)
                ->whereIn('id', $fallidas)
                ->whereNotIn('id', $respondidas)
                ->inRandomOrder()
                ->first();
            $mensaje_repaso = 'Repasemos las que fallaste:';
        } else {
            // Normal: mostrar pregunta no respondida
            $pregunta = \App\Models\Pregunta::with('respuestas')
                ->where('leccion_id', $leccionId)
                ->whereNotIn('id', $respondidas)
                ->inRandomOrder()
                ->first();
            $mensaje_repaso = null;
        }

        // Barajar respuestas
        if ($pregunta && $pregunta->respuestas) {
            $pregunta->respuestas = $pregunta->respuestas->shuffle();
        }

        return view('Usuarios.preguntas', compact('pregunta', 'totalPreguntas'))
            ->with('resultado', $resultado)
            ->with('mensaje', $mensaje)
            ->with('mensaje_repaso', ($en_repaso || $repaso) ? $mensaje_repaso : null);
    }
}
