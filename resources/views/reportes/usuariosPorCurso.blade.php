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
            <img src="{{ public_path('img/face.jpg') }}" alt="Logo">
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
                @php $totalUsuarios = 0; @endphp
                @foreach ($cursos as $curso)
                    <tr>
                        <td>{{ $curso->nombre }}</td>
                        <td>{{ $curso->usuarios_count }}</td>
                    </tr>
                    @php $totalUsuarios += $curso->usuarios_count; @endphp
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td>Total General</td>
                    <td>{{ $totalUsuarios }}</td>
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
