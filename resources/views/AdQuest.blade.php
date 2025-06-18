<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Administrar Cuestionarios</title>
        <script src="https://kit.fontawesome.com/2ecd82a135.js" crossorigin="anonymous"></script>

        @vite('resources/css/bootstrap.min.css')
        @vite('resources/css/landing.css')
</head>
<body class="section-padding">
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{route('views.dashboard')}}"><span class="text-warning">Byte</span>Quest</a>
            <div>
                <a class="btn btn-byte mx-2" href="{{route('views.AdCourses')}}">Volver</a>
            </div>
        </div>
    </nav>
    <div class="container mt-5 p-4 rounded bg-white bg-opacity-75 shadow">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0">Cuestionarios</h1>
            <a href="{{ route('preguntas.create') }}" class="btn btn-byte">Añadir</a>
        </div>
        <p class="lead">Bienvenido, aquí puedes administrar los cuestionarios.</p>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Pregunta</th>
                    <th scope="col">Nivel</th>
                    <th scope="col">Curso</th>
                    <th scope="col">Editar</th>
                    <th scope="col">Eliminar</th>
                </tr>
            </thead>
            <tbody>
                
                @foreach($preguntas as $pregunta)
                <tr>
                    <th scope="row">{{ $pregunta->id }}</th>
                    <td>{{ $pregunta->pregunta }}</td>
                    <td>{{ $pregunta->nivel }}</td>
                    <td>{{ $pregunta->curso->nombre ?? '-' }}</td>
                    <td><a href="#" class="btn btn-sm btn-warning"><i class="fa-solid fa-pen-nib"></i></a></td>
                    <td><a href="#" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></a></td>
                </tr>
                @endforeach
                
            </tbody>
        </table>
    </div>
</body>
</html>