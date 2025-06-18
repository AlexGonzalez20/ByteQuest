@extends('layouts.app')

@section('content')
<div class="container mt-5 p-4 rounded bg-white bg-opacity-75 shadow">
    <h2 class="mb-4">Añadir Curso</h2>
    <form method="POST" action="{{ route('cursos.store') }}">
        @csrf
        <div class="mb-3">
            <label for="nombre_curso" class="form-label">Nombre del Curso</label>
            <input type="text" class="form-control" id="nombre_curso" name="nombre_curso" required>
        </div>
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" required></textarea>
        </div>
        <button type="submit" class="btn btn-byte">Guardar</button>
        <a href="{{ route('views.AdCourses') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
