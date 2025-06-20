<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Administrar Cursos</title>
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
                <a class="btn btn-byte mx-2" href="{{ route('views.dashboard') }}">Volver</a>
            </div>
        </div>
    </nav>
    <div class="container mt-5 p-4 rounded bg-white bg-opacity-75 shadow">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0">Cursos</h1>
            <a href="{{ url('courses/create') }}" class="btn btn-byte">Añadir</a>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre del Curso</th>
                    <th>Descripción</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                @if(count($cursos) > 0)
                @foreach($cursos as $curso)
                <tr>
                    <td>{{ $curso->id }}</td>
                    <td>{{ $curso->nombre_curso }}</td>
                    <td>{{ $curso->descripcion }}</td>
                    <td>
                        <a href="{{ route('courses.edit', $curso->id) }}" class="btn btn-sm btn-warning">Editar</a> |
                        <form method="POST" action="{{ route('courses.destroy', $curso->id) }}" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background:none;border:none;color:red;">Eliminar</button>
                        </form>
                    </td>
                    </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="4" align="center">No hay cursos registrados.</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</body>

</html>