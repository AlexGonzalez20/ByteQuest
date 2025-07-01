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
    $resultado = null;
    $mensaje = null;

    // Obtener preguntas respondidas de la sesión
    $respondidas = session('preguntas_respondidas', []);

    if ($request->isMethod('post')) {
        $pregunta = \App\Models\Pregunta::with('respuestas')->find($request->input('pregunta_id'));
        $respuestaId = $request->input('respuesta');
        $respuesta = $pregunta ? $pregunta->respuestas->where('id', $respuestaId)->first() : null;

        if ($respuesta && $respuesta->es_correcta) {
            $resultado = 'correcto';
            $mensaje = '¡Respuesta correcta!';
            // Agregar la pregunta a las respondidas
            $respondidas[] = $pregunta->id;
            $respondidas = array_unique($respondidas);
            session(['preguntas_respondidas' => $respondidas]);
        } else {
            $resultado = 'incorrecto';
            $mensaje = 'Respuesta incorrecta. Intenta de nuevo.';
        }
    }

    // Si ya respondió 5 preguntas, limpiar progreso y mostrar mensaje final
    if (count($respondidas) >= 5) {
        session()->forget('preguntas_respondidas');
        return redirect()->route('views.UCamino')->with('finalizado', '¡Completaste las 5 preguntas correctamente!');
    }

    // Buscar una pregunta no respondida
    $pregunta = \App\Models\Pregunta::with('respuestas')
        ->whereNotIn('id', $respondidas)
        ->inRandomOrder()
        ->first();

    // Barajar respuestas
    if ($pregunta && $pregunta->respuestas) {
        $pregunta->respuestas = $pregunta->respuestas->shuffle();
    }

    return view('Usuarios.preguntas', compact('pregunta'))
        ->with('resultado', $resultado)
        ->with('mensaje', $mensaje);
}
}
