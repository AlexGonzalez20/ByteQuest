@extends('layouts.admin')

@section('title', 'Gestión de Usuarios')

@section('head')
@endsection

@section('content')
    <div class="container mt-5 p-4 rounded bg-white bg-opacity-75 shadow">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0">Gestión de Usuarios</h1>
            <a href="{{ route('views.CrearUsuario') }}" class="btn btn-info">Añadir Usuario</a>
        </div>


        {{-- Formulario de búsqueda --}}
        <form method="GET" class="mb-4" action="{{ route('usuarios.index') }}">
            <div class="row g-2 align-items-end">
                <div class="col-12 col-md-6">
                    <input type="text" name="search" class="form-control" placeholder="Buscar Usuario"
                        value="{{ request('search') }}">
                </div>
                <div class="col-12 col-md-auto">
                    <button type="submit" class="btn btn-primary w-100">Buscar</button>
                </div>
                @if(request('search'))
                    <div class="col-12 col-md-auto">
                        <a href="{{ route('usuarios.index') }}" class="btn btn-link w-100">Limpiar</a>
                    </div>
                @endif
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Rol</th>
                        <th scope="col">Editar</th>
                        <th scope="col">Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($usuarios as $usuario)
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
                                <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('¿Estás seguro de eliminar este usuario?')">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No se encontraron usuarios.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection