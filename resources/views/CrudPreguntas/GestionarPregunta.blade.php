<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Gestión de Preguntas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    @vite('resources/css/gestionarPregunta.css')
</head>

<body class="section-padding">
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('views.dashboard') }}">
                <span class="text-info">Byte</span>Quest
            </a>
            <div>
                <a class="btn btn-info mx-2" href="{{ route('views.dashboard') }}">Regresar a dashboard</a>
            </div>
        </div>
    </nav>

    <div class="container mt-5 p-4 rounded bg-white bg-opacity-75 shadow">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0">Gestión de Preguntas</h1>
            <a href="{{ route('preguntas.create') }}" class="btn btn-success">Añadir Pregunta</a>

        </div>

        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Curso</th>
                    <th>Pregunta</th>
                    <th>Nivel</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($preguntas as $pregunta)
                <tr>
                    <th scope="row">{{ $pregunta->id }}</th>
                    <td>{{ $pregunta->curso->nombre_curso ?? 'Sin curso' }}</td>
                    <td>{{ $pregunta->pregunta }}</td>
                    <td>{{ $pregunta->nivel }}</td>
                    <td class="d-flex gap-2">
                        <a href="{{ route('preguntas.edit', $pregunta->id) }}" class="btn btn-sm btn-warning">
                            <i class="fa-solid fa-pen-nib"></i> Editar
                        </a>
                        <form action="{{ route('preguntas.destroy', $pregunta->id) }}" method="POST" onsubmit="return confirm('¿Deseas eliminar esta pregunta?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="fa-solid fa-trash"></i> Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach

                @if ($preguntas->isEmpty())
                <tr>
                    <td colspan="5" class="text-center">No hay preguntas registradas.</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</body>

</html>