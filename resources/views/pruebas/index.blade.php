@extends('layouts.admin')

@section('title', 'Gestión de Pruebas')

@section('head')
@endsection

@section('content')
    <div class="container mt-5 p-4 rounded bg-white bg-opacity-75 shadow">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0">Gestión de Pruebas</h1>
            <a href="{{ route('pruebas.create') }}" class="btn btn-info">Añadir Prueba</a>
        </div>

        <div class="accordion" id="accordionCursos">
            @php
                $pruebasPorCurso = $pruebas->groupBy(function($prueba) {
                    return $prueba->leccion && $prueba->leccion->curso
                        ? $prueba->leccion->curso->nombre
                        : 'Sin Curso';
                });
            @endphp

            @foreach ($pruebasPorCurso as $cursoNombre => $pruebasDelCurso)
                <div class="accordion-item mb-2">
                    <h2 class="accordion-header" id="heading-{{ Str::slug($cursoNombre) }}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse-{{ Str::slug($cursoNombre) }}" aria-expanded="false"
                            aria-controls="collapse-{{ Str::slug($cursoNombre) }}">
                            {{ $cursoNombre }}
                        </button>
                    </h2>
                    <div id="collapse-{{ Str::slug($cursoNombre) }}" class="accordion-collapse collapse"
                        aria-labelledby="heading-{{ Str::slug($cursoNombre) }}"
                        data-bs-parent="#accordionCursos">
                        <div class="accordion-body">

                            @php
                                $pruebasPorLeccion = $pruebasDelCurso->groupBy(function($prueba) {
                                    return $prueba->leccion ? $prueba->leccion->nombre : 'Sin Lección';
                                });
                            @endphp

                            <div class="accordion" id="accordion-{{ Str::slug($cursoNombre) }}">
                                @foreach ($pruebasPorLeccion as $leccionNombre => $pruebasDeLaLeccion)
                                    <div class="accordion-item mb-2">
                                        <h2 class="accordion-header" id="heading-{{ Str::slug($cursoNombre . '-' . $leccionNombre) }}">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapse-{{ Str::slug($cursoNombre . '-' . $leccionNombre) }}"
                                                aria-expanded="false"
                                                aria-controls="collapse-{{ Str::slug($cursoNombre . '-' . $leccionNombre) }}">
                                                {{ $leccionNombre }}
                                            </button>
                                        </h2>
                                        <div id="collapse-{{ Str::slug($cursoNombre . '-' . $leccionNombre) }}"
                                            class="accordion-collapse collapse"
                                            aria-labelledby="heading-{{ Str::slug($cursoNombre . '-' . $leccionNombre) }}"
                                            data-bs-parent="#accordion-{{ Str::slug($cursoNombre) }}">
                                            <div class="accordion-body">

                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Orden</th>
                                                            <th>XP</th>
                                                            <th>Editar</th>
                                                            <th>Eliminar</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($pruebasDeLaLeccion as $prueba)
                                                            <tr>
                                                                <td>{{ $prueba->id }}</td>
                                                                <td>{{ $prueba->orden }}</td>
                                                                <td>{{ $prueba->xp }}</td>
                                                                <td>
                                                                    <a href="{{ route('pruebas.edit', $prueba->id) }}"
                                                                        class="btn btn-sm btn-warning">
                                                                        <i class="fa-solid fa-pen-nib"></i>
                                                                    </a>
                                                                </td>
                                                                <td>
                                                                    <form action="{{ route('pruebas.destroy', $prueba->id) }}" method="POST"
                                                                        style="display:inline;">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="btn btn-sm btn-danger"
                                                                            onclick="return confirm('¿Estás seguro de eliminar esta prueba?')">
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
                                @endforeach
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
