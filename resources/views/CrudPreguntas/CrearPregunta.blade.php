@extends('layouts.admin')

@section('title', 'Crear Pregunta')

@section('head')
    @vite('resources/css/crearPregunta.css')
@endsection

@section('content')
    <div class="container mt-5 p-4 rounded bg-white bg-opacity-75 shadow">
        <h2 class="mb-4">Crear Nueva Pregunta</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('preguntas.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="prueba_id" class="form-label">Prueba</label>
                <select class="form-control" name="prueba_id" id="prueba_id" required>
                    <option value="">Seleccione una prueba</option>
                    @foreach ($pruebas as $prueba)
                        <option value="{{ $prueba->id }}" {{ old('prueba_id') == $prueba->id ? 'selected' : '' }}>
                            Prueba #{{ $prueba->id }} - Lección: {{ $prueba->leccion->nombre ?? 'N/A' }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="pregunta" class="form-label">Enunciado</label>
                <textarea class="form-control" id="pregunta" name="pregunta" rows="3" required>{{ old('pregunta') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="imagen" class="form-label">Imagen (opcional)</label>
                <input type="file" class="form-control" name="imagen" id="imagen">
            </div>

            <div class="mt-4">
                <h5>Opciones</h5>
                @for ($i = 1; $i <= 4; $i++)
                    <div class="mb-3">
                        <label class="form-label">Opción {{ $i }}</label>
                        <div class="input-group">
                            <div class="input-group-text">
                                <input type="radio" name="correcta" value="{{ $i }}" required>
                            </div>
                            <input type="text" name="opciones[]" class="form-control"
                                value="{{ old('opciones.' . ($i - 1)) }}" required
                                placeholder="Texto de la opción {{ $i }}">
                        </div>
                    </div>
                @endfor
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-success">Guardar</button>
                <a href="{{ route('preguntas.index') }}" class="btn btn-danger">Cancelar</a>
            </div>
        </form>
    </div>
@endsection
