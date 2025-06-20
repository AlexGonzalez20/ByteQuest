<?php

namespace App\Http\Controllers;

use App\Models\Pregunta;
use App\Models\Curso;
use Illuminate\Http\Request;

class PreguntaController extends Controller
{
    public function index()
    {
        $preguntas = Pregunta::with('curso')->get();
        return view('CrudPreguntas.GestionarPregunta', compact('preguntas'));
    }

    public function create()
    {
        $cursos = Curso::all();
        return view('CrudPreguntas.CrearPregunta', compact('cursos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'curso_id' => 'required|exists:cursos,id',
            'pregunta' => 'required|string',
            'nivel'    => 'required|integer|min:1|max:10',
        ]);

        Pregunta::create($request->all());

        return redirect()->route('preguntas.index')->with('success', 'Pregunta creada correctamente.');
    }

    public function edit(Pregunta $pregunta)
    {
        $cursos = Curso::all();
        return view('CrudPreguntas.EditarPregunta', compact('pregunta', 'cursos'));
    }

    public function update(Request $request, Pregunta $pregunta)
    {
        $request->validate([
            'curso_id' => 'required|exists:cursos,id',
            'pregunta' => 'required|string',
            'nivel'    => 'required|integer|min:1|max:10',
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
