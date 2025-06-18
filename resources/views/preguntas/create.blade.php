@extends('layouts.app')

@section('content')
<div class="container mt-5 p-4 rounded bg-white bg-opacity-75 shadow">
    <h2 class="mb-4">Añadir Cuestionario</h2>
    <form method="POST" action="{{ route('preguntas.store') }}">
        @csrf
        <div class="mb-3">
            <label for="curso_id" class="form-label">Curso</label>
            <select class="form-select" id="curso_id" name="curso_id" required>
                <option value="">Selecciona un curso</option>
                @foreach($cursos as $curso)
                    <option value="{{ $curso->id }}">{{ $curso->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="pregunta" class="form-label">Pregunta</label>
            <input type="text" class="form-control" id="pregunta" name="pregunta" required>
        </div>
        <div class="mb-3">
            <label for="nivel" class="form-label">Nivel</label>
            <input type="number" class="form-control" id="nivel" name="nivel" required min="1">
        </div>
        <button type="submit" class="btn btn-byte">Guardar</button>
        <a href="{{ route('preguntas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
