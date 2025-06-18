@extends('layouts.app')

@section('content')
<div class="container mt-5 p-4 rounded bg-white bg-opacity-75 shadow">
    <h1 class="mb-4">Editar Curso</h1>
    <form method="POST" action="{{ route('cursos.update', $curso->id) }}">
        @csrf
        @method('PUT')
        <label for="nombre_curso">Ingrese el nuevo nombre</label>
        <input type="text" class="form-control mb-3" id="nombre_curso" name="nombre_curso" value="{{ $curso->nombre_curso }}" placeholder="Nombre del curso">
        <label for="descripcion">Ingrese la nueva descripción</label>
        <textarea class="form-control mb-3" id="descripcion" name="descripcion" rows="3" placeholder="Descripción del curso">{{ $curso->descripcion }}</textarea>
        <button type="submit" class="btn btn-byte">Guardar Cambios</button>
        <a href="{{ route('views.AdCourses') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection