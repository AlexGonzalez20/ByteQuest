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
        <h1 class="mb-4">Cuestionarios</h1>
         <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">pregunta</th>
                    <th scope="col">nivel</th>
                    <th scope="col">edit</th>
                    <th scope="col">delete</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td><a href="{{route('views.AdQuest')}} ">Mark</a></td>
                    <td>Otto</td>

                    <td><a href="{{route('views.EditQuest')}}"><i class="fa-solid fa-pen-nib"></i></a>
                    </td>
                    <td><a href=""><i class="fa-solid fa-trash"></i></a>
                    </td>
                </tr>
                <tr>
                    <th scope="row">1</th>
                    <td><a href="{{route('views.AdQuest')}} ">Mark</a></td>
                    <td>Otto</td>

                    <td><a href="{{route('views.EditQuest')}}"><i class="fa-solid fa-pen-nib"></i></a>
                    </td>
                    <td><a href=""><i class="fa-solid fa-trash"></i></a>
                    </td>
                </tr>
                <tr>
                    <th scope="row">1</th>
                    <td><a href="{{route('views.AdQuest')}} ">Mark</a></td>
                    <td>Otto</td>

                    <td><a href="{{route('views.EditQuest')}}"><i class="fa-solid fa-pen-nib"></i></a>
                    </td>
                    <td><a href=""><i class="fa-solid fa-trash"></i></a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>