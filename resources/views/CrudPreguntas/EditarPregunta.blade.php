@extends('layouts.admin')

@section('title', 'Editar Pregunta')

@section('head')
    @vite('resources/css/editarPregunta.css')
@endsection

@section('content')
    <div class="container mt-5 p-4 rounded bg-white bg-opacity-75 shadow">
        <h2 class="mb-4">Editar Pregunta</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('preguntas.update', $pregunta->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="pregunta" class="form-label">Enunciado</label>
                <textarea class="form-control" id="pregunta" name="pregunta" rows="3" required>{{ old('pregunta', $pregunta->pregunta) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="leccion_id" class="form-label">Lección</label>
                <select class="form-control" name="leccion_id" id="leccion_id" required>
                    @foreach ($lecciones as $leccion)
                        <option value="{{ $leccion->id }}"
                            {{ $pregunta->leccion_id == $leccion->id ? 'selected' : '' }}>
                            {{ $leccion->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Imagen actual</label><br>
                @if ($pregunta->imagen)
                    <img src="{{ asset($pregunta->imagen) }}" alt="Imagen actual" style="max-height: 100px;">
                @else
                    <span class="text-muted">No tiene imagen</span>
                @endif
            </div>

            <div class="mb-3">
                <label for="imagen" class="form-label">Nueva Imagen (opcional)</label>
                <input type="file" class="form-control" name="imagen" id="imagen">
            </div>

            <h5>Opciones</h5>
            @foreach ($pregunta->respuestas as $index => $respuesta)
                <div class="mb-2">
                    <label class="form-label">Opción {{ $index + 1 }}</label>
                    <input type="text" name="opciones[]" value="{{ old('opciones.' . $index, $respuesta->texto) }}"
                        class="form-control" required>
                    <div class="form-check mt-1">
                        <input class="form-check-input" type="radio" name="correcta" value="{{ $index + 1 }}"
                            {{ $respuesta->es_correcta ? 'checked' : '' }}>
                        <label class="form-check-label">
                            Marcar como correcta
                        </label>
                    </div>
                </div>
            @endforeach

            <div class="mt-4">
                <button type="submit" class="btn btn-warning">Actualizar</button>
                <a href="{{ route('preguntas.index') }}" class="btn btn-danger">Cancelar</a>
            </div>
        </form>
    </div>
@endsection
