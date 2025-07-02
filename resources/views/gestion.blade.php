@extends('layouts.layout')
@section('title', 'Home')
@section('content')
<div class="container mt-5 p-4 rounded bg-white bg-opacity-75 shadow">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Gestion de Usuarios</h1>
        <a href="{{route('views.CrearUsuario')}}" class="btn btn-info">Añadir Usuario</a>
    </div>
    <p class="lead">Bienvenido, aquí puedes administrar los usuarios.</p>

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellido</th>
                <th scope="col">Correo</th>
                <th scope="col">Rol</th>
            </tr>
        </thead>
        <tbody>
            @foreach($usuarios as $usuario)
            <tr>
                <th scope="row">{{ $usuario->id }}</th>
                <td>{{ $usuario->nombre }}</td>
                <td>{{ $usuario->apellido }}</td>
                <td>{{ $usuario->email }}</td>
                <td>{{ $usuario->rol_id }}</td>
                <td>
                    <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn btn-sm btn-warning">
                        <i class="fa-solid fa-pen-nib"></i>
                    </a>
                </td>
                <td>
                    <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar este usuario?')">
                            <i class="fa-solid fa-trash"></i>
                        </button>

                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection