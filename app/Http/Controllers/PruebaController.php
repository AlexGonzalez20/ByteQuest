<?php

namespace App\Http\Controllers;

use App\Models\Prueba;
use App\Models\Leccion;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PruebaController extends Controller
{
    /**
     * Mostrar todas las pruebas.
     */
    public function index()
    {
        $pruebas = Prueba::with('leccion')->orderBy('leccion_id')->orderBy('orden')->get();
        return view('pruebas.index', compact('pruebas'));
    }

    /**
     * Mostrar formulario para crear nueva prueba.
     */
    public function create()
    {
        $lecciones = Leccion::all();
        return view('pruebas.create', compact('lecciones'));
    }

    /**
     * Guardar nueva prueba.
     */
    public function store(Request $request)
    {
        $request->validate([
            'orden' => [
                'required',
                'integer',
                Rule::unique('pruebas')->where(function ($query) use ($request) {
                    return $query->where('leccion_id', $request->leccion_id);
                }),
            ],
            'xp' => 'required|integer|min:0',
            'leccion_id' => 'required|exists:lecciones,id',
        ], [
            'orden.unique' => 'Ya existe una prueba con ese orden para la lección seleccionada.',
        ]);

        Prueba::create($request->only(['orden', 'xp', 'leccion_id']));

        return redirect()->route('pruebas.index')->with('success', 'Prueba creada correctamente.');
    }

    /**
     * Mostrar formulario para editar una prueba.
     */
    public function edit(Prueba $prueba)
    {
        $lecciones = Leccion::all();
        return view('pruebas.edit', compact('prueba', 'lecciones'));
    }

    /**
     * Actualizar prueba existente.
     */
    public function update(Request $request, Prueba $prueba)
    {
        $request->validate([
            'orden' => [
                'required',
                'integer',
                Rule::unique('pruebas')->where(function ($query) use ($request) {
                    return $query->where('leccion_id', $request->leccion_id);
                })->ignore($prueba->id),
            ],
            'xp' => 'required|integer|min:0',
            'leccion_id' => 'required|exists:lecciones,id',
        ], [
            'orden.unique' => 'Ya existe otra prueba con ese orden en esta lección.',
        ]);

        $prueba->update($request->only(['orden', 'xp', 'leccion_id']));

        return redirect()->route('pruebas.index')->with('success', 'Prueba actualizada correctamente.');
    }

    /**
     * Eliminar prueba.
     */
    public function destroy(Prueba $prueba)
    {
        $prueba->delete();
        return redirect()->route('pruebas.index')->with('success', 'Prueba eliminada correctamente.');
    }
}
