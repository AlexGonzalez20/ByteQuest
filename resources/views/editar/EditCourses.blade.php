<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Cursos</title>
    <script src="https://kit.fontawesome.com/2ecd82a135.js" crossorigin="anonymous"></script>

    @vite('resources/css/bootstrap.min.css')
    @vite('resources/css/landing.css')
</head>

<body class="section-padding">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#"><span class="text-warning">Byte</span>Quest</a>
            <a class="nav-link" href="{{route('views.AdQuest')}}">Administrar Cursos</a>
            <a class="btn btn-byte mx-2" href="{{route('views.dashboard')}}">Volver</a>
        </div>
    </nav>
    <div class="container mt-5">
        <h1 class="mb-4">Cursos</h1>
 
    </div>
</body>

</html>