@extends('layouts.admin')

@section('title', 'Gestión de Preguntas')

@section('head')
@endsection

@section('content')
<div class="container mt-5 p-4 rounded bg-white bg-opacity-75 shadow">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Gestión de Preguntas</h1>
        <a href="{{ route('preguntas.create') }}" class="btn btn-success">Añadir Pregunta</a>
    </div>

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    {{-- Filtro único --}}
    <form method="GET" class="mb-3 d-flex align-items-center" action="{{ route('preguntas.index') }}">
        <input type="text" name="search" class="form-control w-auto me-2"
            placeholder="Buscar pregunta"
            value="{{ request('search') }}">
        <button type="submit" class="btn btn-primary">Buscar</button>
        @if(request('search'))
        <a href="{{ route('preguntas.index') }}" class="btn btn-link">Limpiar</a>
        @endif
    </form>

    @php
    $preguntasPorCurso = $preguntas->groupBy(function($pregunta) {
    return $pregunta->leccion && $pregunta->leccion->curso
    ? $pregunta->leccion->curso->nombre
    : 'Sin Curso';
    });
    @endphp

    <div class="accordion" id="accordionCursos">
        @forelse($preguntasPorCurso as $cursoNombre => $preguntasDelCurso)
        @php
        $cursoSlug = Str::slug($cursoNombre . '-' . uniqid());
        $preguntasPorLeccion = $preguntasDelCurso->groupBy(function($pregunta) {
        return $pregunta->leccion ? $pregunta->leccion->nombre : 'Sin Lección';
        });
        @endphp

        <div class="accordion-item mb-2">
            <h2 class="accordion-header" id="heading-{{ $cursoSlug }}">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapse-{{ $cursoSlug }}"
                    aria-expanded="false"
                    aria-controls="collapse-{{ $cursoSlug }}">
                    {{ $cursoNombre }}
                </button>
            </h2>
            <div id="collapse-{{ $cursoSlug }}" class="accordion-collapse collapse"
                aria-labelledby="heading-{{ $cursoSlug }}"
                data-bs-parent="#accordionCursos">
                <div class="accordion-body">

                    <div class="accordion" id="accordionLecciones-{{ $cursoSlug }}">
                        @foreach($preguntasPorLeccion as $leccionNombre => $preguntasDeLeccion)
                        @php
                        $leccionSlug = Str::slug($cursoNombre.'-'.$leccionNombre.'-'.uniqid());
                        @endphp

                        <div class="accordion-item mb-2">
                            <h2 class="accordion-header" id="heading-{{ $leccionSlug }}">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse-{{ $leccionSlug }}"
                                    aria-expanded="false"
                                    aria-controls="collapse-{{ $leccionSlug }}">
                                    {{ $leccionNombre }}
                                </button>
                            </h2>
                            <div id="collapse-{{ $leccionSlug }}" class="accordion-collapse collapse"
                                aria-labelledby="heading-{{ $leccionSlug }}"
                                data-bs-parent="#accordionLecciones-{{ $cursoSlug }}">
                                <div class="accordion-body">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Pregunta</th>
                                                <th>Imagen</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($preguntasDeLeccion as $pregunta)
                                            <tr>
                                                <th scope="row">{{ $pregunta->id }}</th>
                                                <td>{{ Str::limit($pregunta->pregunta, 50) }}</td>
                                                <td>
                                                    @if ($pregunta->imagen)
                                                    <span class="badge bg-success">Sí</span>
                                                    <a href="{{ asset($pregunta->imagen) }}" target="_blank" class="btn btn-sm btn-primary mt-2">
                                                        Ver Imagen
                                                    </a>
                                                    @else
                                                    <span class="badge bg-secondary">No</span>
                                                    @endif
                                                </td>
                                                <td class="d-flex gap-2">
                                                    <a href="{{ route('preguntas.edit', $pregunta->id) }}" class="btn btn-sm btn-warning">
                                                        <i class="fa-solid fa-pen-nib"></i> Editar
                                                    </a>
                                                    <form action="{{ route('preguntas.destroy', $pregunta->id) }}" method="POST"
                                                        onsubmit="return confirm('¿Deseas eliminar esta pregunta?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">
                                                            <i class="fa-solid fa-trash"></i> Eliminar
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
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
        @empty
        <p>No hay preguntas registradas.</p>
        @endforelse
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
    crossorigin="anonymous"></script>
@endsection