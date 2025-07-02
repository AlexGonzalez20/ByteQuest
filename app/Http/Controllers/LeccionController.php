<?php

namespace App\Http\Controllers;

use App\Models\Leccion;
use App\Models\Curso;

use App\Http\Controllers\Controller;
use App\Http\Controllers\CursoController;
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
        $cursos = Curso::all();
        return view('CrudLecciones.CrearLeccion', compact('cursos'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'curso_id' => 'required|exists:cursos,id',
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        Leccion::create([
            'curso_id' => $request->curso_id,
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()->route('lecciones.index')->with('success', 'Lección creada correctamente.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Leccion $leccion)
    {
        $cursos = Curso::all();
        return view('CrudLecciones.EditarLeccion', compact('leccion', 'cursos'));
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Leccion $leccion)
    {
        $request->validate([
            'curso_id' => 'required|exists:cursos,id',
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        $leccion->update($request->only('curso_id', 'nombre', 'descripcion'));

        return redirect()->route('lecciones.index')->with('success', 'Lección actualizada correctamente.');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Leccion $leccion)
    {
        $leccion->delete();
        return redirect()->route('lecciones.index')->with('success', 'leccion eliminado correctamente.');
    }

    /**
     * Reclama experiencia por completar una lección.
     * Solo permite reclamar una vez por usuario y lección.
     */
    public function reclamarXP($leccion_id)
    {
        $user = auth()->user();
        $leccion = \App\Models\Leccion::findOrFail($leccion_id);
        // Verificar si ya reclamó la XP
        $yaReclamada = $user->lecciones()->where('leccion_id', $leccion_id)->wherePivot('xp_reclamada', true)->exists();
        if ($yaReclamada) {
            return back()->with('info', 'Ya reclamaste la experiencia de esta lección.');
        }
        // Marcar como reclamada y sumar XP
        $user->lecciones()->syncWithoutDetaching([$leccion_id => ['xp_reclamada' => true]]);
        $user->experiencia += 100; // Puedes ajustar el valor de XP
        $user->save();
        return back()->with('success', '¡Has reclamado 100 XP por completar la lección!');
    }
}
