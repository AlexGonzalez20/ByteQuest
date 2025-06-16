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
            <a class="navbar-brand" href="{{route('views.dashboard')}}"><span class="text-warning">Byte</span>Quest</a>
            <a class="btn btn-byte mx-2" href="{{route('views.AdCourses')}}">Volver</a>
        </div>
    </nav>
    <div class="container mt-5 p-4 rounded bg-white bg-opacity-75 shadow">
        <h1 class="mb-4">Cursos</h1>
        <form action="">
            <label for="nombre">ingrese el nuevo nombre</label>
            <input type="text" class="form-control mb-3" id="nombre" name="nombre" placeholder="Nombre del curso">
            <label for="descripcion">ingrese la nueva descripcion</label>
            <textarea class="form-control mb-3" id="descripcion" name="descripcion" rows="3" placeholder="Descripcion del curso"></textarea>
            <button type="submit" class="btn btn-byte">Guardar Cambios</button>
        </form>
    </div>
</body>

</html>