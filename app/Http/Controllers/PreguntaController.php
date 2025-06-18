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
        return view('AdQuest', compact('preguntas'));
    }

    public function create()
    {
        $cursos = Curso::all();
        return view('preguntas.create', compact('cursos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'curso_id' => 'required|exists:cursos,id',
            'pregunta' => 'required|string',
            'nivel' => 'required|integer',
        ]);
        Pregunta::create($request->all());
        return redirect()->route('preguntas.index')->with('success', 'Pregunta añadida correctamente');
    }
}
