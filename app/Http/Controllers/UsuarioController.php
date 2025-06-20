<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
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
}
