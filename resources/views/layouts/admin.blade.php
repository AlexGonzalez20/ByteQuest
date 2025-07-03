<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/2ecd82a135.js" crossorigin="anonymous"></script>
    <title>@yield('title')</title>
    @vite('resources/css/admin.css')
    @yield('head')
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="{{ route('views.dashboard') }}"><span
                    class="text-info">Byte</span>Quest</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
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
                        <a href="{{ route('pruebas.index') }}" class="nav-link">Pruebas</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('preguntas.index') }}" class="nav-link">Preguntas</a>
                    </li>

                </ul>
                <a class="btn btn-info mx-2" href="{{ route('views.dashboard') }}">Regresar a Dashboard</a>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger">Cerrar Sesión</button>
                </form>

            </div>
        </div>
    </nav>

    <main>

        @yield('content')
    </main>
    @yield('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous">
    </script>

</body>

</html>
