<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Panel Usuario')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/2ecd82a135.js" crossorigin="anonymous"></script>
    @vite('resources/css/usuarios.css')
    @yield('head')
</head>

<body>
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <!-- Sidebar -->
            <nav class="col-md-2 d-none d-md-block sidebar py-4">
                <div class="position-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item mb-2">
                            <a class="nav-link @if (Route::currentRouteName() == 'views.UsuarioHome') active @endif"
                                href="{{ route('views.UsuarioHome') }}">
                                <i class='bx bx-home'></i> Home
                            </a>
                        </li>
                        <li class="nav-item mb-2">
                            <a class="nav-link @if (Route::currentRouteName() == 'views.UCamino') active @endif"
                                href="{{ route('views.UCamino') }}">
                                <i class='bx bx-git-branch'></i> Camino
                            </a>
                        </li>
                        <li class="nav-item mb-2">
                            <a class="nav-link @if (Route::currentRouteName() == 'views.UMisCursos') active @endif"
                                href="{{ route('views.UMisCursos') }}">
                                <i class='bx bx-book'></i> Mis Cursos
                            </a>
                        </li>
                        <li class="nav-item mb-2">
                            <a class="nav-link @if (Route::currentRouteName() == 'views.UPerfil') active @endif"
                                href="{{ route('views.UPerfil') }}">
                                <i class='bx bx-user'></i> Perfil
                            </a>
                        </li>
                        <li class="nav-item mt-4">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button class="btn btn-outline-warning w-100" type="submit">
                                    <i class='bx bx-log-out'></i> Salir
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Contenedor derecho -->
            <div class="col-md-10 px-0">
                <!-- Navbar alineada a la derecha del sidebar -->
                <nav class="navbar navbar-expand-lg bg-body-tertiary">
                    <div class="container-fluid">
                        <a class="navbar-brand fw-bold" href="{{ route('views.dashboard') }}"><span
                                class="text-info">Byte</span>Quest</a>

                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                    <a href="{{ route('usuarios.index') }}" class="nav-link">Usuarios</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('cursos.index') }}" class="nav-link">Cursos</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('lecciones.index') }}" class="nav-link">Lecciones</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('preguntas.index') }}" class="nav-link">Preguntas</a>
                                </li>

                            </ul>
                            <a href="" class="btn btn-info m-2">
                                <i class="fa-solid fa-bolt"></i>
                                Dias de Racha</a>
                            <a href="" class="btn btn-danger">
                                <i class="fa-solid fa-heart"></i>
                                Vidas</a>

                        </div>
                    </div>
                </nav>

                <!-- Contenido principal -->
                <main class="px-4 py-5">
                    @yield('content')
                </main>
            </div>
        </div>
    </div>

    @yield('scripts')
</body>

</html>
