
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Cursos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
    <h2>Reporte de Cursos y Usuarios</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Curso</th>
                <th>Número de Usuarios</th>
                <th>Usuarios</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cursos as $curso)
                <tr>
                    <td>{{ $curso->descripcion }}</td>
                    <td>{{ $curso->usuarios->count() }}</td>
                    <td>{{ $curso->usuarios->pluck('nombre')->join(', ') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
