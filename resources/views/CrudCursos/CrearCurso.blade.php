<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Curso</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite('resources/css/crearCurso.css')
</head>

<body class="section-padding">
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('views.dashboard') }}">
                <span class="text-primary">Byte</span>Quest
            </a>
            <div>
                <a class="btn btn-info mx-2" href="{{ route('cursos.index') }}">Volver</a>
            </div>
        </div>
    </nav>

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
                <label for="nombre_curso" class="form-label">Nombre del Curso</label>
                <input type="text" class="form-control" id="nombre_curso" name="nombre_curso" value="{{ old('nombre_curso') }}" required>
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
</body>

</html>