<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Administrar Cuestionarios</title>
        @vite('resources/css/bootstrap.min.css')
        @vite('resources/css/landing.css')
</head>
<body class="section-padding">
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{route('views.dashboard')}}"><span class="text-warning">Byte</span>Quest</a>
            <div>
                <a class="btn btn-byte mx-2" href="{{route('views.AdQuest')}}">Volver</a>
            </div>
        </div>
    </nav>
    <div class="container mt-5 p-4 rounded bg-white bg-opacity-75 shadow">
        <h1 class="mb-4">Cuestionarios</h1> 
             <form action="">
            <label for="nombre">ingrese la pregunta</label>
            <input type="text" class="form-control mb-3" id="nombre" name="nombre" placeholder="Nombre de la pregunta">
            <label for="nivel">ingrese el nivel</label>
            <select class="form-select mb-3" id="nivel" name="nivel">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">4</option>
            </select>
            <button type="submit" class="btn btn-byte">Guardar Cambios</button>
        </form>
    </div>
</body>
</html>