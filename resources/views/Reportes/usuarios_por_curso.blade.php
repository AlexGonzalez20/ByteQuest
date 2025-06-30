<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Usuarios por Curso</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
            border: 1px solid #ccc;
            text-align: left;
        }

        th {
            background: #f4f4f4;
        }
    </style>
</head>

<body>
    <h1>Usuarios por Curso</h1>
    <table>
        <thead>
            <tr>
                <th>Curso</th>
                <th>Total Usuarios</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cursos as $curso)
                <tr>
                    <td>{{ $curso->nombre }}</td>
                    <td>{{ $curso->usuarios_count }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
