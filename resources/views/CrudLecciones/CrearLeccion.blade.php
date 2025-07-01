@extends('layouts.admin')

@section('title', 'Crear Lección')

@section('head')
    @vite('resources/css/crearleccion.css')
@endsection

@section('content')
    <div class="container mt-5 p-4 rounded bg-white bg-opacity-75 shadow">
        <h2 class="mb-4">Añadir Lección</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('lecciones.store') }}">
            @csrf

            <div class="mb-3">
                <label for="curso_id" class="form-label">Curso</label>
                <select class="form-control" id="curso_id" name="curso_id" required>
                    <option value="">Seleccione un curso</option>
                    @foreach ($cursos as $curso)
                        <option value="{{ $curso->id }}" {{ old('curso_id') == $curso->id ? 'selected' : '' }}>
                            {{ $curso->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre de la lección</label>
                <input type="text" class="form-control" id="nombre" name="nombre"
                    value="{{ old('nombre') }}" required>
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="4"
                    required>{{ old('descripcion') }}</textarea>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-success">Guardar</button>
                <a href="{{ route('lecciones.index') }}" class="btn btn-danger">Cancelar</a>
            </div>
        </form>
    </div>
@endsection
