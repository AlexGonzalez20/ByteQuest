{{-- ======================== --}}
{{-- Encabezado HTML y recursos --}}
{{-- ======================== --}}
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ByteQuest Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    @vite(['resources/css/dashboard.css', 'resources/js/dashboard.js'])
    <link rel="icon" type="image/x-icon" href="{{ asset('img/icon.png') }}">

</head>

<body>
    <!-- ======================== -->
    <!-- Navbar principal fijo    -->
    <!-- ======================== -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top shadow">
        <div class="container-fluid">
            <button class="navbar-toggler d-block d-md-none" type="button" id="sidebarToggle"
                aria-label="Toggle sidebar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="{{ route('landing') }}">
                <span style="color: #00b2c3">Byte</span><span class="quest">Quest</span>
            </a>
            <form action="{{ route('logout') }}" method="POST" class="d-flex">
                @csrf
                <button type="submit" class="logout btn btn-danger ms-2">Cerrar Sesión</button>
            </form>
        </div>
    </nav>

    <div class="container-fluid" style="padding-top: 20px;">
        <div class="row">
            <!-- Menú hamburguesa SIEMPRE a la izquierda -->
            <nav id="sidebar"
                class="sidebar col-12 col-md-3 col-lg-2 mt-4 navbar navbar-expand-md navbar-light mb-4 rounded shadow-sm flex-md-column align-items-stretch min-vh-100">
                <div class="navbar-collapse flex-md-column" id="gestionMenu">
                    <div class="row g-2 flex-column align-items-start w-100">
                        <!-- Gestionar Usuarios -->
                        <div class="button-card col-12 mb-2">
                            <a href=" {{ route('usuarios.index') }}" class="w-100 text-decoration-none">
                                <div class="card shadow-sm">
                                    <div class="card-body d-flex align-items-center gap-3">
                                        <i class='bx bx-user fs-3'></i>
                                        <h5 class="card-title mb-0">Gestionar Usuarios</h5>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Gestionar Cursos -->
                        <div class="button-card col-12 mb-2">
                            <a href=" {{ route('cursos.index') }}" class="w-100 text-decoration-none">
                                <div class="card shadow-sm">
                                    <div class="card-body d-flex align-items-center gap-3">
                                        <i class='bx bx-book fs-3'></i>
                                        <h5 class="card-title mb-0">Gestionar Cursos</h5>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Gestionar Lecciones -->
                        <div class="button-card col-12 mb-2">
                            <a href=" {{ route('lecciones.index') }}" class="w-100 text-decoration-none">
                                <div class="card shadow-sm">
                                    <div class="card-body d-flex align-items-center gap-3">
                                        <i class='bx bx-bookmark fs-3'></i>
                                        <h5 class="card-title mb-0">Gestionar Lecciones</h5>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Gestionar Preguntas -->
                        <div class="button-card col-12 mb-2">
                            <a href=" {{ route('preguntas.index') }}" class="w-100 text-decoration-none">
                                <div class="card shadow-sm">
                                    <div class="card-body d-flex align-items-center gap-3">
                                        <i class='bx bx-help-circle fs-3'></i>
                                        <h5 class="card-title mb-0">Gestionar Preguntas</h5>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Gestionar Pruebas -->
                        <div class="button-card col-12 mb-2">
                            <a href=" {{ route('pruebas.index') }}" class="w-100 text-decoration-none">
                                <div class="card shadow-sm">
                                    <div class="card-body d-flex align-items-center gap-3">
                                        <i class='bx bx-task fs-3'></i>
                                        <h5 class="card-title mb-0">Gestionar Pruebas</h5>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Generar Reporte -->
                        <div class="button-card col-12 mb-2">
                            <a href=" {{ route('reportes.usuarios.pdf') }}" class="w-100 text-decoration-none">
                                <div class="card shadow-sm">
                                    <div class="card-body d-flex align-items-center gap-3">
                                        <i class='bx bx-file fs-3'></i>
                                        <h5 class="card-title mb-0">Generar Reporte</h5>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Robot GIF -->
                        <div class="col-12 text-center mt-4">
                            <img src=" {{ asset('/img/robot-idle.gif') }}" alt="robot" class="img-fluid">
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Contenido principal a la derecha -->
            <main id="main-content" class="col-12 col-md-9 col-lg-10 px-3 py-4 gy-4">
                {{-- ======================== --}}
                {{-- Resumen de Actividad y Fuente de Usuarios --}}
                {{-- ======================== --}}
                <div class="row mt-1">
                    <div class="col-md-6">
                        <div class="card mb-4 rounded-4 border-0 text-center">
                            <div class="card-header">Resumen de Actividad</div>
                            <div class="card-body">
                                <div class="chart-placeholder">
                                    <a href=" {{ route('CDashboard.grafica') }}"><img
                                            src="https://imgproxy.domestika.org/unsafe/w:1200/rs:fill/plain/src://blog-post-open-graph-covers/000/013/052/13052-original.jpg?1712830811"
                                            alt="grafica" class="img-fluid"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card mb-4 rounded-4 border-0 text-center">
                            <div class="card-header">Fuente de Usuarios</div>
                            <div class="card-body">
                                <div class="chart-placeholder"><img
                                        src="https://www.jaspersoft.com/content/dam/jaspersoft/images/graphics/infographics/pie-chart-example.svg"
                                        class="circular img-fluid"></div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ======================== --}}
                {{-- Proyectos y Ilustraciones --}}
                {{-- ======================== --}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="card mb-4 rounded-4 border-0 text-center">
                            <div class="card-header">Proyectos</div>
                            <div class="card-body bg-white">
                                <p class="d-flex flex-column mt-4">Integración API <span class="float-end">60%</span>
                                </p>
                                <div class="progress mb-3">
                                    <div class="progress-bar bg-success" style="width: 60%"></div>
                                </div>
                                <p class="d-flex flex-column mt-4">Diseño UI <span class="float-end">85%</span></p>
                                <div class="progress mb-3">
                                    <div class="progress-bar bg-primary" style="width: 85%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card mb-4 rounded-4 border-0 text-center">
                            <div class="card-header">Ilustraciones</div>
                            <div class="card-body bg-white">
                                <div class="chart-placeholder">
                                    <img class="img-fluid"
                                        src="https://png.pngtree.com/png-vector/20230531/ourmid/pngtree-robot-in-the-style-of-an-old-drawing-vector-png-image_6790636.png"
                                        alt="Ilustración">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>

</html>