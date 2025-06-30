<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Lección</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite('resources/css/editarCurso.css')
</head>

<body class="section-padding">
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('views.dashboard') }}">
                <span class="text-primary">Byte</span>Quest
            </a>
            <div>
                <a class="btn btn-info mx-2" href="{{ route('lecciones.index') }}">Volver</a>
            </div>
        </div>
    </nav>

    <div class="container mt-5 p-4 rounded bg-white bg-opacity-75 shadow">
        <h2 class="mb-4">Editar Lección</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('lecciones.update', $leccion->id) }}">
            @csrf
            @method('PUT')


            <div class="mb-3">
                <label for="curso_id" class="form-label">Curso</label>
                <select class="form-control" id="curso_id" name="curso_id" required>
                    <option value="">Seleccione un curso</option>
                    @foreach ($cursos as $curso)
                        <option value="{{ $curso->id }}"
                            {{ old('curso_id', $leccion->curso_id) == $curso->id ? 'selected' : '' }}>
                            {{ $curso->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre de la Lección</label>
                <input type="text" class="form-control" id="nombre" name="nombre"
                    value="{{ old('nombre', $leccion->nombre) }}" required>
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="4" required>{{ old('descripcion', $leccion->descripcion) }}</textarea>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-warning">Actualizar</button>
                <a href="{{ route('lecciones.index') }}" class="btn btn-danger">Cancelar</a>
            </div>
        </form>
    </div>
</body>

</html>
