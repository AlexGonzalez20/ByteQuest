@extends('layouts.admin')

@section('title', 'Gestión de Lecciones')

@section('content')
@php
use Illuminate\Support\Str;
@endphp
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

    {{-- Filtro por búsqueda general --}}
    <form method="GET" class="mb-3 d-flex align-items-center" action="{{ route('lecciones.index') }}">
        <input type="text" name="search" class="form-control w-auto me-2"
            placeholder="Buscar lección o curso"
            value="{{ request('search') }}">
        <button type="submit" class="btn btn-primary">Buscar</button>
        @if (request('search'))
        <a href="{{ route('lecciones.index') }}" class="btn btn-link">Limpiar</a>
        @endif
    </form>


    @php
    $leccionesPorCurso = $lecciones->groupBy(function($leccion) {
    return $leccion->curso?->nombre ?? 'Sin curso';
    });
    @endphp

    <div class="accordion" id="accordionCursos">
        @forelse($leccionesPorCurso as $cursoNombre => $leccionesDelCurso)
        <div class="accordion-item mb-2">
            <h2 class="accordion-header" id="heading-{{ Str::slug($cursoNombre) }}">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapse-{{ Str::slug($cursoNombre) }}"
                    aria-expanded="false"
                    aria-controls="collapse-{{ Str::slug($cursoNombre) }}">
                    {{ $cursoNombre }}
                </button>
            </h2>
            <div id="collapse-{{ Str::slug($cursoNombre) }}" class="accordion-collapse collapse"
                aria-labelledby="heading-{{ Str::slug($cursoNombre) }}"
                data-bs-parent="#accordionCursos">
                <div class="accordion-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($leccionesDelCurso as $leccion)
                            <tr>
                                <td>{{ $leccion->id }}</td>
                                <td>{{ $leccion->nombre }}</td>
                                <td>{{ $leccion->descripcion }}</td>
                                <td>
                                    <a href="{{ route('lecciones.edit', $leccion->id) }}" class="btn btn-sm btn-warning">
                                        <i class="fa-solid fa-pen-nib"></i>
                                    </a>
                                    <form action="{{ route('lecciones.destroy', $leccion->id) }}"
                                        method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('¿Estás seguro de eliminar esta lección?')">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @empty
        <p>No hay lecciones registradas.</p>
        @endforelse
    </div>
</div>
@endsection