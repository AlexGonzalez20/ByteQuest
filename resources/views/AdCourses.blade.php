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

            <a class="btn btn-byte mx-2" href="{{route('views.dashboard')}}">Volver</a>
        </div>
    </nav>
    <div class="container mt-5">
        <h1 class="mb-4">Cursos</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Descripcion</th>

                    <th scope="col">edit</th>
                    <th scope="col">delete</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td><a href="{{route('views.AdQuest')}} ">Mark</a></td>
                    <td>Otto</td>

                    <td><a href=""><i class="fa-solid fa-pen-nib"></i></a>
                    </td>
                    <td><a href=""><i class="fa-solid fa-trash"></i></a>
                    </td>
                </tr>
                <tr>
                    <th scope="row">1</th>
                    <td><a href="{{route('views.AdQuest')}} ">Mark</a></td>
                    <td>Otto</td>
                    <td><a href=""><i class="fa-solid fa-pen-nib"></i></a>
                    </td>
                    <td><a href=""><i class="fa-solid fa-trash"></i></a>
                    </td>
                </tr>
                <tr>
                    <th scope="row">1</th>
                    <td><a href="{{route('views.AdQuest')}} ">Mark</a></td>
                    <td>Otto</td>
                    <td><a href=""><i class="fa-solid fa-pen-nib"></i></a>
                    </td>
                    <td><a href=""><i class="fa-solid fa-trash"></i></a>
                    </td>
                </tr>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>