<?php

namespace App\Http\Controllers;

use App\Models\Leccion;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LeccionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lecciones = Leccion::all();
        return view('CrudLecciones.GestionarLeccion', compact('lecciones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    return view('CrudLecciones.CrearLeccion');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    $request->validate([
            'nombre_leccion' => 'required|string|max:255',
            'descripcion'  => 'nullable|string',
        ]);

        Leccion::create($request->all());

        return redirect()->route('lecciones.index')->with('success', 'leccion creado correctamente.');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Leccion $leccion)
    {
        return view('CrudLecciones.EditarLeccion', compact('leccion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Leccion $leccion)
    {
         $request->validate([
            'nombre_leccion' => 'required|string|max:255',
            'descripcion'  => 'nullable|string',
        ]);

        $leccion->update($request->all());

        return redirect()->route('lecciones.index')->with('success', 'leccion actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Leccion $leccion)
    {
        $leccion->delete();
        return redirect()->route('lecciones.index')->with('success', 'leccion eliminado correctamente.');
    }

}

