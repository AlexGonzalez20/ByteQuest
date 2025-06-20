<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Curso</title>
    @vite('resources/css/bootstrap.min.css')
    @vite('resources/css/landing.css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400..900&display=swap" rel="stylesheet">
</head>

<body class="section-padding">
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('views.dashboard') }}"><span class="text-warning">Byte</span>Quest</a>
            <div>
                <a class="btn btn-byte mx-2" href="{{ route('courses.index') }}">Volver</a>
            </div>
        </div>
    </nav>
    <div class="container mt-5 p-4 rounded bg-white bg-opacity-75 shadow">
        <h2 class="mb-4">Añadir Curso</h2>
        <form method="POST" action="{{ route('courses.store') }}">
            @csrf
            <div class="mb-3">
                <label for="nombre_curso" class="form-label">Nombre del Curso</label>
                <input type="text" class="form-control" id="nombre_curso" name="nombre_curso" required>
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion" required></textarea>
            </div>
            <button type="submit" class="btn btn-byte">Guardar</button>
            <a href="{{ route('courses.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>

</html>