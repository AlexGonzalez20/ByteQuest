@extends('layouts.admin')

@section('title', 'Gestión de Cursos')

@section('head')

@endsection

@section('content')
<div class="container mt-5 p-4 rounded bg-white bg-opacity-75 shadow">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Gestión de Cursos</h1>
        <a href="{{ route('cursos.create') }}" class="btn btn-success">Añadir Curso</a>
    </div>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            @forelse($cursos as $curso)
            <tr>
                <td>{{ $curso->id }}</td>
                <td>{{ $curso->nombre }}</td>
                <td>{{ $curso->descripcion }}</td>
                <td>
                    <a href="{{ route('cursos.edit', $curso->id) }}" class="btn btn-sm btn-warning">
                        <i class="fa-solid fa-pen-nib"></i>
                    </a>

                </td>
                <td>
                    <form action="{{ route('cursos.destroy', $curso->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar este curso?')">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4">No hay cursos registrados.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection