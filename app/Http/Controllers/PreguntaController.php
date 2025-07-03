<?php

namespace App\Http\Controllers;

use App\Models\Pregunta;
use App\Models\Prueba;
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


    public function mostrarPregunta($prueba_id)
    {
        $prueba = Prueba::with('preguntas.respuestas')->findOrFail($prueba_id);

        // Aquí decides qué pregunta mostrar (la siguiente sin responder)
        $pregunta = $prueba->preguntas()->first(); // simplificado
        return view('VistasEstudiante.preguntas', compact('pregunta'));
    }
}
