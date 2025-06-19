<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seleccionar Curso</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400..900&display=swap" rel="stylesheet">
    @vite('resources/css/selectCourse.css')

</head>
<body>
    <div class="container-select">
        <form action="">
            <h1>Selecciona el curso</h1>
            <button class="btn-byte"><a href="{{route('views.AdQuest')}}" style="color:inherit;text-decoration:none;">Buscar</a></button>
        </form>
    </div>
</body>
</html>