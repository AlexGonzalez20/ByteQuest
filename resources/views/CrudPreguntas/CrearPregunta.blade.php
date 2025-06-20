<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Crear Pregunta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite('resources/css/crearPregunta.css')
</head>

<body class="section-padding">
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('views.dashboard') }}">
                <span class="text-info">Byte</span>Quest
            </a>
            <div>
                <a class="btn btn-info mx-2" href="{{ route('preguntas.index') }}">Volver</a>
            </div>
        </div>
    </nav>

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

        <form method="POST" action="{{ route('preguntas.store') }}">
            @csrf

            <div class="mb-3">
                <label for="curso_id" class="form-label">Curso</label>
                <select class="form-control" name="curso_id" id="curso_id" required>
                    <option value="">Seleccione un curso</option>
                    @foreach ($cursos as $curso)
                    <option value="{{ $curso->id }}" {{ old('curso_id') == $curso->id ? 'selected' : '' }}>
                        {{ $curso->nombre_curso }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="pregunta" class="form-label">Enunciado</label>
                <textarea class="form-control" id="pregunta" name="pregunta" rows="3" required>{{ old('pregunta') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="nivel" class="form-label">Nivel</label>
                <input type="number" class="form-control" id="nivel" name="nivel" min="1" max="10" value="{{ old('nivel') }}" required>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-success">Guardar</button>
                <a href="{{ route('preguntas.index') }}" class="btn btn-danger">Cancelar</a>
            </div>
        </form>
    </div>
</body>

</html>