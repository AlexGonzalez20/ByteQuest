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

        public function verificarRespuesta(Request $request)
{
    $vidas = Vida::where('user_id', Auth::id())->first();

    if ($vidas->cantidad <= 0) {
        return redirect()->back()->with('error', '¡No tienes vidas disponibles!');
    }

    $respuestaCorrecta = Pregunta::find($request->pregunta_id)->respuesta_correcta;

    if ($request->respuesta == $respuestaCorrecta) {
        return redirect()->back()->with('mensaje', '¡Correcto!');
    } else {
        $vidas->cantidad -= 1;
        $vidas->save();
        return redirect()->back()->with('error', 'Incorrecto. Te queda(n) ' . $vidas->cantidad . ' vida(s).');
    }
}

}