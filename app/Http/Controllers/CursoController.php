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
        return view('courses.Courses', compact('cursos'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('courses.create');
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
        return redirect()->route('courses.index')->with('success', 'Curso añadido correctamente');
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
    public function edit($id)
    {
        $curso = Curso::find($id);
        if (!$curso) {
            return redirect()->route('courses.index')->with('error', 'El curso no existe.');
        }
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
        return redirect()->route('courses.index')->with('success', 'Curso actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Curso $course)
    {
        $course->delete();
        return redirect()->route('courses.index')->with('success', 'Curso eliminado correctamente');
    }
}
