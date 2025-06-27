<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de lecciones</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/2ecd82a135.js" crossorigin="anonymous"></script>
    @vite('resources/css/gestionarleccion.css')
</head>

<body class="section-padding">
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('views.dashboard') }}"><span class="text-primary">Byte</span>Quest</a>
            <div>
                <a class="btn btn-info mx-2" href="{{ route('views.dashboard') }}">Regresar a dashboard</a>
            </div>
        </div>
    </nav>

    <div class="container mt-5 p-4 rounded bg-white bg-opacity-75 shadow">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0">Gestión de lecciones</h1>
            <a href="{{ route('lecciones.create') }}" class="btn btn-success">Añadir leccion</a>
        </div>

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($lecciones as $leccion)
                <tr>
                    <td>{{ $leccion->id }}</td>
                    <td>{{ $leccion->nombre_leccion }}</td>
                    <td>{{ $leccion->descripcion }}</td>
                    <td>
                        <a href="{{ route('lecciones.edit', $leccion->id) }}" class="btn btn-sm btn-warning">
                            <i class="fa-solid fa-pen-nib"></i>
                        </a>
                        <form action="{{ route('lecciones.destroy', $leccion->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar este leccion?')">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4">No hay lecciones registrados.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>

</html>