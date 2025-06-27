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

        <form method="POST" action="{{ route('preguntas.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="pregunta" class="form-label">Enunciado</label>
                <textarea class="form-control" id="pregunta" name="pregunta" rows="3" required>{{ old('pregunta') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="leccion_id" class="form-label">Lección</label>
                <select class="form-control" name="leccion_id" id="leccion_id" required>
                    <option value="">Seleccione una lección</option>
                    @foreach ($lecciones as $leccion)
                    <option value="{{ $leccion->id }}" {{ old('leccion_id') == $leccion->id ? 'selected' : '' }}>
                        {{ $leccion->nombre_leccion }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="imagen" class="form-label">Imagen</label>
                <input type="file" class="form-control" name="imagen" id="imagen" required>
            </div>

            <div class="mt-4 d-flex flex-column">

                @for ($i = 1; $i <= 4; $i++)
                    <label class="mb-4">
                    <input type="radio" name="correcta" value="{{ $i }}">
                    Opción {{ $i }}
                    <input type="text" name="opciones[]" required>
                    </label>
                    @endfor
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-success">Guardar</button>
                <a href="{{ route('preguntas.index') }}" class="btn btn-danger">Cancelar</a>
            </div>
        </form>
    </div>
</body>

</html>