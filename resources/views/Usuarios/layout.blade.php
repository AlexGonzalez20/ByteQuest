<!-- resources/views/Usuarios/layout.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Panel Usuario')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    @vite('resources/css/usuarios.css')
    @yield('head')
</head>
<body>  
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav class="col-md-2 d-none d-md-block sidebar py-4">
            <div class="position-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item mb-2">
                        <a class="nav-link @if(Route::currentRouteName() == 'views.UsuarioHome') active @endif" href="{{ route('views.UsuarioHome') }}"><i class='bx bx-home'></i> Home</a>
                    </li>
                    <li class="nav-item mb-2">
                        <a class="nav-link @if(Route::currentRouteName() == 'views.UCamino') active @endif" href="{{ route('views.UCamino') }}"><i class='bx bx-git-branch'></i> Camino</a>
                    </li>
                    <li class="nav-item mb-2">
                        <a class="nav-link @if(Route::currentRouteName() == 'views.UMisCursos') active @endif" href="{{ route('views.UMisCursos') }}"><i class='bx bx-book'></i> Mis Cursos</a>
                    </li>
                    <li class="nav-item mb-2">
                        <a class="nav-link @if(Route::currentRouteName() == 'views.UPerfil') active @endif" href="{{ route('views.UPerfil') }}"><i class='bx bx-user'></i> Perfil</a>
                    </li>
                    <li class="nav-item mt-4">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="btn btn-outline-warning w-100" type="submit"><i class='bx bx-log-out'></i> Salir</button>
                        </form>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- Main -->
        <main class="col-md-10 ms-sm-auto px-4 py-5">
            @yield('content')
        </main>
    </div>
</div>
@yield('scripts')
</body>
</html>
