<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the Usuarios.
     */
    public function index()
    {
        $usuarios = Usuario::all();
        return view('CrudUsuarios.GestionarUsuario', compact('usuarios'));
    }

    /**
     * Show the form for creating a new Usuario.
     */
    public function create()
    {
        return view('CrudUsuarios.CrearUsuario');
    }

    /**
     * Store a newly created Usuario in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre'   => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email'    => 'required|email|unique:usuarios,email',
            'password' => 'required|string|min:6',
            'rol_id'   => 'required|exists:roles,id',
        ]);

        Usuario::create([
            'nombre'   => $request->nombre,
            'apellido' => $request->apellido,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'rol_id'   => $request->rol_id,
        ]);

        return redirect()->route('usuarios.index')->with('success', 'Usuario añadido correctamente');
    }

    /**
     * Show the form for editing the specified Usuario.
     */
    public function edit(Usuario $usuario)
    {
        return view('CrudUsuarios.EditarUsuario', compact('usuario'));
    }

    /**
     * Update the specified Usuario in storage.
     */
    public function update(Request $request, Usuario $usuario)
    {
        $request->validate([
            'nombre'   => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email'    => 'required|email|unique:usuarios,email,' . $usuario->id,
            'rol_id'   => 'required|exists:roles,id',
            'password' => 'nullable|string|min:6',
        ]);

        $usuario->nombre   = $request->nombre;
        $usuario->apellido = $request->apellido;
        $usuario->email    = $request->email;
        $usuario->rol_id   = $request->rol_id;

        if ($request->filled('password')) {
            $usuario->password = Hash::make($request->password);
        }

        $usuario->save();

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado correctamente');
    }

    /**
     * Remove the specified Usuario from storage.
     */
    public function destroy(Usuario $usuario)
    {
        $usuario->delete();
        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado correctamente');
    }

    /**
     * Permite al usuario autenticado seguir un curso.
     */
    public function seguirCurso($curso_id)
    {
        $user = auth()->user();
        if ($user && ! $user->cursos()->where('curso_id', $curso_id)->exists()) {
            $user->cursos()->attach($curso_id);
        }
        return back()->with('success', '¡Curso agregado a Mis Cursos!');
    }

    /**
     * Permite al usuario dejar de seguir un curso.
     */
    public function dejarCurso($curso_id)
    {
        $user = auth()->user();
        if ($user && $user->cursos()->where('curso_id', $curso_id)->exists()) {
            $user->cursos()->detach($curso_id);
        }
        return back()->with('success', 'Has dejado de seguir el curso.');
    }

    /**
     * Muestra los cursos seguidos por el usuario autenticado.
     */
    public function misCursos()
    {
        $user = auth()->user();
        $cursos = $user ? $user->cursos : collect();
        return view('Usuarios.miscursos', compact('cursos'));
    }

    /**
     * Muestra el catálogo de cursos y cuáles sigue el usuario.
     */
    public function catalogoCursos()
    {
        $user = auth()->user();
        $cursos = \App\Models\Curso::all();
        $cursosSeguidos = $user ? $user->cursos->pluck('id')->toArray() : [];
        return view('Usuarios.cursos', compact('cursos', 'cursosSeguidos'));
    }

    /**
     * Muestra el camino de aprendizaje para un curso específico.
     */
    public function caminoCurso($curso_id)
    {
        $curso = \App\Models\Curso::findOrFail($curso_id);
        return view('Usuarios.camino', compact('curso'));
    }
}
