<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Panel Usuario')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href='https://cdn.boxicons.com/fonts/basic/boxicons.min.css' rel='stylesheet'>
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
                    <a class="navbar-brand fw-bold" href="#">
                        <span class="text-info">Byte</span><span class="text-light">Quest</span>
                    </a>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-2">
                            <a class="nav-link @if (Route::currentRouteName() == 'views.UsuarioHome') active @endif"
                                href="{{ route('views.UMisCursos') }}"><i class='bx bx-education'></i>Aprender</a>
                        </li>
                        <li class="nav-item mb-2">
                            <a class="nav-link @if (Route::currentRouteName() == 'views.UMisCursos') active @endif"
                                href="{{ route('views.UMisCursos') }}"><i class='bx bx-bookmark-heart'></i>Mis Cursos</a>
                        </li>
                        <li class="nav-item mb-2">
                            <a class="nav-link @if (Route::currentRouteName() == 'views.UCursos') active @endif"
                                href="{{ route('views.UCursos') }}"><i class='bx bx-bookmark-plus'></i>Cursos</a>
                        </li>
                        <li class="nav-item mb-2">
                            <a class="nav-link @if (Route::currentRouteName() == 'views.UPerfil') active @endif"
                                href="{{ route('views.UPerfil') }}"><i class='bx bx-store-alt-2'></i>Tienda</a>
                        </li>
                        <li class="nav-item mb-2">
                            <a class="nav-link @if (Route::currentRouteName() == 'views.UPerfil') active @endif"
                                href="{{ route('views.UPerfil') }}"><i class='bx bx-user'></i>Perfil</a>
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
                <nav class="navbar navbar-expand-lg" style="background-color: rgb(51, 54, 97)">
                    <div class="container-fluid m-2">


                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav mb-2 mb-lg-0">
                            </ul>

                            <div class="d-flex ms-auto align-items-center">
                                <div class="dropdown me-3">
                                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownCursos"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        Mis Cursos
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownCursos">
                                        @forelse ($cursos as $curso)
                                        <li>
                                            <a class="dropdown-item"
                                                href="{{ route('usuarios.caminoCurso', $curso->id) }}">
                                                {{ $curso->nombre }}
                                            </a>
                                        </li>
                                        @empty
                                        <li>
                                            <span class="dropdown-item text-muted">No tienes cursos</span>
                                        </li>
                                        @endforelse
                                    </ul>
                                </div>

                                <a href="#" class="btn btn-info me-3">
                                    <i class="fa-solid fa-bolt"></i>
                                    Racha: {{ auth()->user()->dias_racha }} días
                                </a>

                                <a href="#" class="btn btn-danger me-3">
                                    <i class="fa-solid fa-heart"></i>
                                    Vidas: {{ auth()->user()->vidas }}
                                </a>

                                <button class="btn btn-warning">
                                    <i class='bx bx-user-circle'></i>
                                    {{ auth()->user()->nombre }}
                                </button>
                            </div>
                        </div>
                    </div>
                </nav>


                <!-- Contenido principal -->
                <main class="px-4 py-5" style="background-color: rgb(37, 39, 70);">
                    @yield('content')
                </main>
            </div>
        </div>
    </div>

    @yield('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>