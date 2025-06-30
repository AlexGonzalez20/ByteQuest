<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    /**
     * Muestra todos los cursos.
     */
    public function index()
    {
        $cursos = Curso::all();
        return view('CrudCursos.GestionarCurso', compact('cursos'));
    }

    /**
     * Muestra el formulario para crear un curso.
     */
    public function create()
    {
        return view('CrudCursos.CrearCurso');
    }

    /**
     * Almacena un nuevo curso.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion'  => 'nullable|string',
        ]);

        Curso::create($request->all());

        return redirect()->route('cursos.index')->with('success', 'Curso creado correctamente.');
    }

    /**
     * Muestra el formulario para editar un curso.
     */
    public function edit(Curso $curso)
    {
        return view('CrudCursos.EditarCurso', compact('curso'));
    }

    /**
     * Actualiza un curso.
     */
    public function update(Request $request, Curso $curso)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion'  => 'nullable|string',
        ]);

        $curso->update($request->all());

        return redirect()->route('cursos.index')->with('success', 'Curso actualizado correctamente.');
    }

    /**
     * Elimina un curso.
     */
    public function destroy(Curso $curso)
    {
        $curso->delete();
        return redirect()->route('cursos.index')->with('success', 'Curso eliminado correctamente.');
    }
}
