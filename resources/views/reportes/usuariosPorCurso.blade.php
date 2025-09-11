<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Reporte: Usuarios por Curso</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            color: #333;
            margin: 40px;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #ddd;
            padding-bottom: 10px;
        }

        header .brand {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        header .brand img {
            height: 50px;
        }

        header .brand h1 {
            margin: 0;
            font-size: 28px;
        }

        header .info h1 {
            font-size: 20px;
            margin: 0;
        }

        header .info h2 {
            font-size: 14px;
            margin: 4px 0;
            color: #555;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 14px;
        }

        th,
        td {
            padding: 12px;
            border: 1px solid #ccc;
            text-align: left;
            vertical-align: top;
        }

        th {
            background: #f5f5f5;
        }

        tbody tr:nth-child(even) {
            background: #f9f9f9;
        }

        tfoot td {
            font-weight: bold;
            background: #f5f5f5;
        }

        /* Subtabla de usuarios */
        .usuarios-table {
            width: 95%;
            margin: 10px auto;
            font-size: 13px;
            border-collapse: collapse;
        }

        .usuarios-table th,
        .usuarios-table td {
            border: 1px solid #bbb;
            padding: 6px 8px;
        }

        .usuarios-table th {
            background: #eee;
        }

        .usuarios-title {
            font-size: 13px;
            font-weight: bold;
            margin: 6px 0;
        }

        footer {
            position: fixed;
            bottom: 20px;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 12px;
            color: #888;
        }
    </style>
</head>

<body>
    <header>
        <div class="brand">
            <img src="{{ public_path('img/logo.jpg') }}" alt="Logo">
            <h1>ByteQuest</h1>
        </div>
        <div class="info">
            <h1>Usuarios por Curso</h1>
            <h2>Generado por: {{ $usuario }}</h2>
            <h2>Fecha: {{ $fechaGeneracion }}</h2>
        </div>
    </header>

    <main>
        <table>
            <thead>
                <tr>
                    <th>Curso</th>
                    <th>Total de Usuarios</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cursos as $curso)
                    <tr>
                        <td>
                            {{ $curso->nombre }}

                            @if ($curso->usuarios->count())
                                <div class="usuarios-title">Usuarios en este curso:</div>
                                <table class="usuarios-table">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Apellido</th>
                                            <th>Email</th>
                                            <th>Experiencia</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($curso->usuarios as $u)
                                            <tr>
                                                <td>{{ $u->nombre }}</td>
                                                <td>{{ $u->apellido }}</td>
                                                <td>{{ $u->email }}</td>
                                                <td>{{ $u->experiencia }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </td>
                        <td>{{ $curso->usuarios_count }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td>Total General (usuarios únicos)</td>
                    <td>
                        {{ $cursos->pluck('usuarios')->flatten()->unique('id')->count() }}
                    </td>
                </tr>
            </tfoot>
        </table>
    </main>

    <footer>
        <p>ByteQuest © {{ date('Y') }} - Todos los derechos reservados</p>
        <script type="text/php">
            if (isset($pdf)) {
                $pdf->page_script('
                    $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
                    $pdf->text(520, 820, "Página $PAGE_NUM de $PAGE_COUNT", $font, 10);
                ');
            }
        </script>
    </footer>
</body>

</html>
