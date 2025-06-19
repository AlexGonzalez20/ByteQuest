@extends('layouts.app')

@section('content')  
@vite('resources/css/courses.css')

<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400..900&display=swap" rel="stylesheet">

<div class="container mt-5 p-4 rounded bg-white bg-opacity-75 shadow">
    <h2 class="mb-4">Añadir Curso</h2>
    <form method="POST" action="{{ route('courses.store') }}">
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
        <a href="{{ route('courses.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
