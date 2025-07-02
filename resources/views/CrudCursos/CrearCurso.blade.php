@extends('layouts.admin')

@section('title', 'Crear Curso')

@section('head')
    @vite('resources/css/crearCurso.css')
@endsection

@section('content')
    <div class="container mt-5 p-4 rounded bg-white bg-opacity-75 shadow">
        <h2 class="mb-4">Añadir Curso</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('cursos.store') }}">
            @csrf

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre del Curso</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="4">{{ old('descripcion') }}</textarea>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-success">Guardar</button>
                <a href="{{ route('cursos.index') }}" class="btn btn-danger">Cancelar</a>
            </div>
        </form>
    </div>
@endsection
