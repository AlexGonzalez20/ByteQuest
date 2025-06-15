<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    @vite('resources/css/dashboard.css')

    <title>DashBoard</title>
</head>

<body>
    <header>
        <div class="header">
            <h1>¡Bienvenido a ByteQuest!</h1>
            <img src="" alt="">
            <a href="">home</a>
            <a href="{{route('views.AdCourses')}}">administrar cursos</a>
            <a href="{{route('views.')}}">administrar usuarios</a>
            <a href="{{route('views.profile')}}">perfil</a>
        </div>
    </header>
    
    <footer>
        <h5>Derechos reservados ByteQuest &copy; 2025</h5>
    </footer>
</body>

</html>