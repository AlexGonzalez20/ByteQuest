<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <title>Administrar Usuarios</title>
    <script src="https://kit.fontawesome.com/2ecd82a135.js" crossorigin="anonymous"></script>
    @vite('resources/css/login.css')

</head>

<body class="section-padding">
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{route('landing')}}"><span class="text-warning">Byte</span>Quest</a>
            <div>
                <a class="btn btn-info mx-2" href="{{route('views.dashboard')}}">Regresar a Dashboard</a>
            </div>
        </div>
    </nav>
    <div class="container mt-5 p-4 rounded bg-white bg-opacity-75 shadow">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0">Gestion de Usuarios</h1>
            <a href="{{route('views.CrearUsuario')}}" class="btn btn-info">Añadir Usuario</a>
        </div>
        <p class="lead">Bienvenido, aquí puedes administrar los usuarios.</p>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Rol</th>
                </tr>
            </thead>
            <tbody>
                @foreach($usuarios as $usuario)
                <tr>
                    <th scope="row">{{ $usuario->id }}</th>
                    <td>{{ $usuario->nombre }}</td>
                    <td>{{ $usuario->apellido }}</td>
                    <td>{{ $usuario->email }}</td>
                    <td>{{ $usuario->rol_id }}</td>
                    <td>
                        <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn btn-sm btn-warning">
                            <i class="fa-solid fa-pen-nib"></i>
                        </a>
                    </td>
                    <td>
                        <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar este usuario?')">
                                <i class="fa-solid fa-trash"></i>
                            </button>

                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>

</html>