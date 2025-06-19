@extends('layouts.app')

@section('content')
<div class="container mt-5 p-4 rounded bg-white bg-opacity-75 shadow">
    <h1 class="mb-4">Editar Curso</h1>
    <form method="POST" action="{{ route('courses.update', $curso->id) }}">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{ $curso->id }}">
        <div class="form-group">
            <label for="nombre_curso">Nombre del Curso:</label>
            <input type="text" name="nombre_curso" class="form-control" value="{{ old('nombre_curso', $curso->nombre_curso) }}">
            <span class="text-danger">@error('nombre_curso') {{ $message }} @enderror</span>
        </div>
        <div class="form-group">
            <label for="descripcion">Descripción:</label>
            <textarea name="descripcion" class="form-control">{{ old('descripcion', $curso->descripcion) }}</textarea>
            <span class="text-danger">@error('descripcion') {{ $message }} @enderror</span>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('views.AdCourses') }}" class="btn btn-secondary">Cancelar</a>
    </form>
    <pre>
    {{ var_dump($curso) }}
</pre>
    {{-- Debug temporal para ver el id del curso --}}
   
</div>
@endsection
