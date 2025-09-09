<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Curso;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the Usuarios.
     */
    public function index(Request $request)
    {
        $usuarios = Usuario::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $usuarios->where(function ($query) use ($search) {
                $query->where('nombre', 'like', '%' . $search . '%')
                    ->orWhere('apellido', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('rol_id', 'like', '%' . $search . '%');
            });
        }

        $usuarios = $usuarios->get();

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
        $usuario = auth()->user();

        $curso = Curso::with(['lecciones.pruebas'])->findOrFail($curso_id);

        $primeraLeccionConPrueba = $curso->lecciones->sortBy('id')->first(function ($leccion) {
            return $leccion->pruebas && $leccion->pruebas->count() > 0;
        });

        if (!$primeraLeccionConPrueba) {
            return redirect()->back()->with('error', 'El curso no tiene lecciones con pruebas disponibles.');
        }

        $primeraPrueba = $primeraLeccionConPrueba->pruebas->sortBy('orden')->first();

        // Conecta el curso con el usuario y guarda la lección/prueba actual:
        $usuario->cursos()->attach($curso_id, [
            'leccion_actual_id' => $primeraLeccionConPrueba->id,
            'prueba_actual_id' => $primeraPrueba->id,
        ]);

        // Redirige al camino del curso
        return redirect()->route('usuarios.caminoCurso', ['curso_id' => $curso_id]);
    }

    /**
     * Muestra los cursos seguidos por el usuario autenticado.
     */
    public function misCursos()
    {
        $user = auth()->user();
        $cursos = $user ? $user->cursos : collect();
        return view('VistasEstudiante.miscursos', compact('cursos'));
    }

    // UsuarioController.php



    /**
     * Muestra el catálogo de cursos y cuáles sigue el usuario.
     */
    public function catalogoCursos()
    {
        $user = auth()->user();
        $cursos = \App\Models\Curso::all();
        $cursosSeguidos = $user ? $user->cursos->pluck('id')->toArray() : [];
        return view('VistasEstudiante.cursos', compact('cursos', 'cursosSeguidos'));
    }

    /**
     * Muestra el camino de aprendizaje para un curso específico.
     */


    public function caminoCurso($curso_id)
    {
        // Redirige a la ruta de CaminoController@mostrar para centralizar la lógica
        return redirect()->route('usuarios.caminoCurso', ['curso_id' => $curso_id]);
    }
    public function home()
    {
        $usuario = auth()->user();

        // Si quieres mostrar el curso actual:
        $curso = $usuario->cursos()->first();
    }
    
}
