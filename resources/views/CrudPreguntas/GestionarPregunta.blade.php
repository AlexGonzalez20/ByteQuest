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
<form method="GET" class="mb-3 d-flex align-items-center" action="{{ route('preguntas.index') }}">
    <input type="number" name="leccion_id" class="form-control w-auto me-2" placeholder="ID Lección" value="{{ request('leccion_id') }}">
    <button type="submit" class="btn btn-primary">Filtrar</button>
    @if(request('leccion_id'))
        <a href="{{ route('preguntas.index') }}" class="btn btn-link">Limpiar</a>
    @endif
</form>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Curso</th>
                <th>Lección</th>
                <th>Pregunta</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
            <tr>
                
            </tr>
        </thead>
        <tbody>
            @forelse($preguntas as $pregunta)
                <tr>
                    <th scope="row">{{ $pregunta->id }}</th>
                    <td>{{ $pregunta->leccion->curso->nombre ?? 'Sin curso' }}</td>
                    <td>{{ $pregunta->leccion->nombre ?? 'Sin lección' }}</td>
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
            @empty
                <tr>
                    <td colspan="6" class="text-center">No hay preguntas registradas.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
    crossorigin="anonymous"></script>
@endsection
