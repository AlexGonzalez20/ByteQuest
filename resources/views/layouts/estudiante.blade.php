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
    <div class="container-fluid p-0 m-0">
        <div class="row g-0 flex-nowrap">
            <!-- Sidebar Responsive -->
            <nav class="sidebar bg-dark position-fixed top-0 start-0 vh-100" id="sidebarMenu"
                style="width: 220px; z-index: 1050; transform: translateX(-100%); transition: transform 0.3s;">
                <div class="position-sticky p-1">
                    <a class="navbar-brand fw-bold d-block text-center fs-2 mb-4" href="#">
                        <span class="text-info">Byte</span><span class="text-light">Quest</span>
                    </a>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-2">
                            <a class="nav-link @if (Route::currentRouteName() == 'aprender') active @endif"
                                href="{{ route('aprender') }}"><i class='bx bx-education'></i>Aprender</a>
                        </li>
                        <li class="nav-item mb-2">
                            <a class="nav-link @if (Route::currentRouteName() == 'views.UMisCursos') active @endif"
                                href="{{ route('views.UMisCursos') }}"><i class='bx bx-bookmark-heart'></i>Mis
                                Cursos</a>
                        </li>
                        <li class="nav-item mb-2">
                            <a class="nav-link @if (Route::currentRouteName() == 'views.UCursos') active @endif"
                                href="{{ route('views.UCursos') }}"><i class='bx bx-bookmark-plus'></i>Cursos</a>
                        </li>
                        <li class="nav-item mb-2">
                            <a class="nav-link @if (Route::currentRouteName() == 'tienda') active @endif"
                                href="{{ route('tienda') }}"><i class='bx bx-store-alt-2'></i>Tienda</a>
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

            <!-- Botón hamburguesa para mostrar el menú (igual al de la navbar) -->
            <button class="navbar-toggler d-md-none position-fixed top-0 start-0 mt-2 rounded-1 pb-1"
                style="background-color: #3a3c5a; border: #252746 2px solid; width: 32px; height: 32px; color: #bfc2e2; transition: transform 0.3s; left: 0; display: block; z-index: 2001;"
                id="menuToggle" aria-label="Toggle navigation">
                <span
                    style="font-size: 1.5rem; display: flex; align-items: center; justify-content: center; height: 100%;">
                    <span id="menuIcon">&gt;</span>
                </span>
            </button>

            <!-- Contenedor derecho -->
            <div class="col-md-10 min-vh-100" id="mainContent"
                style="background-color: #252746; position: relative; margin-left: 220px; left: 0; width: calc(100% - 220px); transition: left 0.3s, width 0.3s, margin-left 0.3s;">
                <!-- Navbar alineada a la derecha del sidebar -->
                <nav style="background-color: #333661; border-radius: 0 0 16px 16px;">
                    <div class="container-fluid px-3 py-2">
                        <!-- Eliminar el botón hamburguesa y el collapse para que el navbar siempre esté visible -->
                        <div class="navbar-collapse" id="navbarSupportedContent" style="display: flex !important;">
                            <ul class="navbar-nav mb-2 mb-lg-0">
                            </ul>

                            <div class="dropdown ms-4 me-3">
                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownCursos"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Mis Cursos
                                </button>
                                <ul class="dropdown-menu text-center" aria-labelledby="dropdownCursos">
                                    @forelse ($cursos as $curso)
                                        <li>
                                            <a class="dropdown-item" href="{{ route('usuarios.caminoCurso', $curso->id) }}">
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
                            <div class="d-flex ms-auto align-items-center">

                                <a href="#" class="btn btn-info me-3">
                                    <i class="fa-solid fa-bolt"></i>
                                    Racha: {{ auth()->user()->dias_racha }} días
                                </a>

                                <a href="{{route('recuperarVidas')}}" class="btn btn-danger me-3">
                                    <i class="fa-solid fa-heart"></i>
                                    Vidas: {{ auth()->user()->vidas }}
                                </a>

                                <a href="{{ route('views.UPerfil') }}" class="btn btn-warning">
                                    <i class='bx bx-user-circle'></i>
                                    {{ auth()->user()->nombre }}
                                </a>
                            </div>
                        </div>
                    </div>
                </nav>


                <!-- Contenido principal -->
                <main class="px-2 py-4">
                    @yield('content')
                </main>
            </div>
        </div>
    </div>

    @yield('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Mostrar/Ocultar sidebar en móviles
        const menuToggle = document.getElementById('menuToggle');
        const sidebarMenu = document.getElementById('sidebarMenu');
        const mainContent = document.getElementById('mainContent');
        let menuOpen = false;
        menuToggle.addEventListener('click', function () {
            menuOpen = !menuOpen;
            if (menuOpen) {
                sidebarMenu.style.transform = 'translateX(0)';
                if (window.innerWidth < 768) {
                    mainContent.style.marginLeft = '0';
                    mainContent.style.left = '0';
                    mainContent.style.width = '100%';
                    menuToggle.style.transform = 'translateX(220px)';
                    menuIcon.innerHTML = '&lt;';
                    mainContent.style.filter = 'brightness(0.7)';
                } else {
                    mainContent.style.filter = 'none';
                }
            } else {
                sidebarMenu.style.transform = 'translateX(-100%)';
                if (window.innerWidth < 768) {
                    mainContent.style.marginLeft = '0';
                    mainContent.style.left = '0';
                    mainContent.style.width = '100%';
                    menuToggle.style.transform = 'translateX(0)';
                }
                menuIcon.innerHTML = '&gt;';
                mainContent.style.filter = 'none';
            }
        });
        // Ocultar menú al hacer click fuera
        mainContent.addEventListener('click', function () {
            if (menuOpen && window.innerWidth < 768) {
                sidebarMenu.style.transform = 'translateX(-100%)';
                mainContent.style.left = '0';
                mainContent.style.width = '100%';
                mainContent.style.filter = 'none';
                menuOpen = false;
            }
        });
        // Mostrar sidebar en desktop
        function handleResize() {
            if (window.innerWidth >= 768) {
                sidebarMenu.style.transform = 'translateX(0)';
                mainContent.style.marginLeft = '220px';
                mainContent.style.left = '0';
                mainContent.style.width = 'calc(100% - 220px)';
                menuToggle.style.display = 'none';
            } else {
                sidebarMenu.style.transform = 'translateX(-100%)';
                mainContent.style.marginLeft = '0';
                mainContent.style.left = '0';
                mainContent.style.width = '100%';
                menuToggle.style.display = 'block';
            }
        }
        window.addEventListener('resize', handleResize);
        handleResize();
    </script>

</body>

</html>