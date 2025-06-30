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


    public function destroy(Pregunta $pregunta)
    {
        $pregunta->delete();
        return redirect()->route('preguntas.index')->with('success', 'Pregunta eliminada correctamente.');
    }
}
