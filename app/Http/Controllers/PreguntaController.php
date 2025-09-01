<?php

namespace App\Http\Controllers;

use App\Models\Pregunta;
use App\Models\Leccion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PreguntaController extends Controller
{
    public function index(Request $request)
    {
        $preguntas = \App\Models\Pregunta::with(['leccion.curso']);

        if ($request->filled('search')) {
            $search = $request->search;
            $preguntas->where(function ($query) use ($search) {
                $query->where('pregunta', 'like', '%' . $search . '%')
                    ->orWhereHas('leccion', function ($q) use ($search) {
                        $q->where('nombre', 'like', '%' . $search . '%')
                            ->orWhereHas('curso', function ($qc) use ($search) {
                                $qc->where('nombre', 'like', '%' . $search . '%');
                            });
                    });
            });
        }

        $preguntas = $preguntas->get();

        return view('CrudPreguntas.GestionarPregunta', compact('preguntas'));
    }


    public function create()
    {
        // Muestra todas las lecciones disponibles para asignar preguntas
        $lecciones = Leccion::all();
        return view('CrudPreguntas.CrearPregunta', compact('lecciones'));
    }

    public function edit(Pregunta $pregunta)
    {
        $lecciones = Leccion::all();
        return view('CrudPreguntas.EditarPregunta', compact('pregunta', 'lecciones'));
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
            $pregunta = Pregunta::create([
                'pregunta' => $request->pregunta,
                'leccion_id' => $request->leccion_id,
                'imagen' => null,
            ]);

            if ($request->hasFile('imagen')) {
                $file = $request->file('imagen');
                $extension = $file->getClientOriginalExtension();
                $nombreArchivo = 'leccion_' . $request->leccion_id . '_pregunta_' . $pregunta->id . '.' . $extension;

                $file->move(public_path('imagenes_preguntas'), $nombreArchivo);

                $pregunta->update(['imagen' => $nombreArchivo]);
            }
            $pregunta->respuestas()->delete();

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

        $pregunta->pregunta = $request->pregunta;
        $pregunta->leccion_id = $request->leccion_id;

        if ($request->hasFile('imagen')) {
            if ($pregunta->imagen && file_exists(public_path($pregunta->imagen))) {
                unlink(public_path($pregunta->imagen));
            }

            $extension = $request->file('imagen')->getClientOriginalExtension();
            $nombreArchivo = 'leccion_' . $request->leccion_id . '_pregunta_' . $pregunta->id . '.' . $extension;

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

    public function mostrarPregunta($leccion_id)
    {
        $pregunta = Pregunta::where('leccion_id', $leccion_id)
            ->with('respuestas')
            ->inRandomOrder()
            ->first();

        return view('VistasEstudiante.preguntas', compact('pregunta'));
    }
    public function siguiente($curso_id)
    {
        // Buscar la siguiente pregunta del curso
        $pregunta = Pregunta::where('curso_id', $curso_id)->inRandomOrder()->first();

        if (!$pregunta) {
            return redirect()->route('usuarios.caminoCurso', ['curso_id' => $curso_id])
                ->with('finalizado', '¡Has completado todas las preguntas de este curso!');
        }

        return view('VistasEstudiante.pregunta', compact('pregunta', 'curso_id'));
    }
}
