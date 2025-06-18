<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cursos = Curso::all();
        return view('AdCourses', compact('cursos'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cursos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre_curso' => 'required|string',
            'descripcion' => 'required|string',
        ]);
        Curso::create($request->all());
        return redirect()->route('views.AdCourses')->with('success', 'Curso añadido correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Curso $curso)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Curso $curso)
    {
        return view('courses.EditCourses', compact('curso'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Curso $curso)
    {
        $request->validate([
            'nombre_curso' => 'required|string',
            'descripcion' => 'required|string',
        ]);
        $curso->update($request->all());
        return redirect()->route('views.AdCourses')->with('success', 'Curso actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Curso $curso)
    {
        $curso->delete();
        return redirect()->route('views.AdCourses')->with('success', 'Curso eliminado correctamente');
    }
}
