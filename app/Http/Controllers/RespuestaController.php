<?php

namespace App\Http\Controllers;

use App\Models\Respuesta;
use App\Models\Pregunta;
use Illuminate\Http\Request;

class RespuestaController extends Controller
{
    public function store(Request $request, Pregunta $pregunta)
    {
        $request->validate([
            'opciones'   => 'required|array|min:2',
            'opciones.*' => 'required|string',
            'correcta'   => 'required|integer|min:1',
        ]);

        foreach ($request->opciones as $index => $texto) {
            Respuesta::create([
                'pregunta_id'  => $pregunta->id,
                'texto_opcion' => $texto,
                'es_correcta'  => ($index + 1) == $request->correcta,
            ]);
        }

        return redirect()->route('preguntas.index')->with('success', 'Respuestas guardadas correctamente.');
    }
}