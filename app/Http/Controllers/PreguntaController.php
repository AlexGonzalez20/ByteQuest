<?php

namespace App\Http\Controllers;

use App\Models\Pregunta;
use App\Models\leccion;
use Illuminate\Http\Request;

class PreguntaController extends Controller
{
    public function index()
    {
        $preguntas = Pregunta::with('leccion')->get();
        return view('CrudPreguntas.GestionarPregunta', compact('preguntas'));
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
            'leccion_id' => 'required|exists:lecciones,id',
            'pregunta'   => 'required|string',
            'imagen'     => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'opciones'   => 'required|array|min:2',
            'opciones.*' => 'required|string',
            'correcta'   => 'required|integer|min:1|max:4',
        ]);

        $data = $request->all();

        // Guardar imagen si existe
        if ($request->hasFile('imagen')) {
            $data['img'] = $request->file('imagen')->store('preguntas', 'public');
        } else {
            $data['img'] = null;
        }

        // Crear la pregunta
        $pregunta = \App\Models\Pregunta::create([
            'leccion_id' => $data['leccion_id'],
            'pregunta'   => $data['pregunta'],
            'img'        => $data['img'],
        ]);

        // Guardar las opciones de respuesta
        foreach ($data['opciones'] as $index => $texto) {
            \App\Models\Respuesta::create([
                'pregunta_id'  => $pregunta->id,
                'texto_opcion' => $texto,
                'es_correcta'  => ($index + 1) == $data['correcta'],
            ]);
        }

        return redirect()->route('preguntas.index')->with('success', 'Pregunta y respuestas creadas correctamente.');
    }

    public function update(Request $request, Pregunta $pregunta)
    {
        $request->validate([
            'pregunta' => 'required|string',
            'leccion_id' => 'required|exists:lecciones,id',
            'img'
        ]);

        $pregunta->update($request->all());

        return redirect()->route('preguntas.index')->with('success', 'Pregunta actualizada correctamente.');
    }

    public function destroy(Pregunta $pregunta)
    {
        $pregunta->delete();
        return redirect()->route('preguntas.index')->with('success', 'Pregunta eliminada correctamente.');
    }
}
