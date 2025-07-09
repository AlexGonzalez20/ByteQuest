@extends('layouts.admin')

@section('title', 'Gestión de Lecciones')

@section('head')
    @vite('resources/css/gestionarleccion.css')
@endsection

@section('content')
    <div class="container mt-5 p-4 rounded bg-white bg-opacity-75 shadow">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0">Gestión de lecciones</h1>
            <a href="{{ route('lecciones.create') }}" class="btn btn-success">Añadir lección</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
<form method="GET" class="mb-3 d-flex align-items-center" action="{{ route('lecciones.index') }}">
    <input type="number" name="curso_id" class="form-control w-auto me-2" placeholder="ID Curso" value="{{ request('curso_id') }}">
    <button type="submit" class="btn btn-primary">Filtrar</button>
    @if(request('curso_id'))
        <a href="{{ route('lecciones.index') }}" class="btn btn-link">Limpiar</a>
    @endif
</form>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Curso</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($lecciones as $leccion)
                    <tr>
                        <td>{{ $leccion->id }}</td>
                        <td>{{ $leccion->curso->nombre ?? 'Sin curso' }}</td>
                        <td>{{ $leccion->nombre }}</td>
                        <td>{{ $leccion->descripcion }}</td>
                        <td>
                            <a href="{{ route('lecciones.edit', $leccion->id) }}" class="btn btn-sm btn-warning">
                                <i class="fa-solid fa-pen-nib"></i>
                            </a>
                            <form action="{{ route('lecciones.destroy', $leccion->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('¿Estás seguro de eliminar esta lección?')">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">No hay lecciones registradas.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
