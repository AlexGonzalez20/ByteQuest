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
    <link rel="stylesheet" href="resources/css/dashboard.css">

    @vite('resources/css/dashboard.css')

</head>

<body>

    <div class="container-fluid">
        <div class="row gy-4">

            <!-- ======================== -->
            <!-- Main content principal   -->
            <!-- ======================== -->
            <main class="col-12 col-md-10 offset-md-1 px-3 py-4 gy-4">

                {{-- ======================== --}}
                {{-- Barra superior: logo y logout --}}
                {{-- ======================== --}}
                <div
                    class="navbar d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-4">

                    <a class="navbar-brand" href="{{ route('landing') }}"><span class="text-warning">Byte</span><span
                            class="quest">Quest</span></a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="logout btn btn-danger">Cerrar Sesión</button>
                    </form>
                </div>

                {{-- ======================== --}}
                {{-- Tarjetas de gestión (usuarios, cursos, lecciones, preguntas) --}}
                {{-- ======================== --}}
                <nav class="d-flex float-start flex-column">

                    {{-- Tarjetas de gestión --}}

                    <div class="row g-2 flex-column align-items-start">
                        <div class="button-card  col-10 mb-2">
                            <a href="{{ route('usuarios.index') }}" class="w-100 text-decoration-none">
                                <div class="card  hover-card  ">
                                    <div class="card-body d-flex align-items-center justify-content-start ps-4">
                                        <h5 class="card-title mb-0">Gestionar Usuarios</h5>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="button-card col-10 mb-2">
                            <a href="{{ route('cursos.index') }}" class="w-100 text-decoration-none">
                                <div class="card  hover-card ">
                                    <div class="card-body d-flex align-items-center justify-content-start ps-4">
                                        <h5 class="card-title mb-0">Gestionar Cursos</h5>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="button-card col-10 mb-2">
                            <a href="{{ route('lecciones.index') }}" class="w-100 text-decoration-none">
                                <div class="card  hover-card ">
                                    <div class="card-body d-flex align-items-center justify-content-start ps-4">
                                        <h5 class="card-title mb-0">Gestionar Lecciones</h5>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="button-card col-10 mb-2">
                            <a href="{{ route('preguntas.index') }}" class="w-100 text-decoration-none">
                                <div class="card  hover-card ">
                                    <div class="card-body d-flex align-items-center justify-content-start ps-4">
                                        <h5 class="card-title mb-0">Gestionar Preguntas</h5>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="row g-2 flex-column align-items-start mt-1">
                        <div class="button-card col-10 mb-3">
                            <a href="{{ route('pruebas.index') }}" class="w-100 text-decoration-none">
                                <div class="card  hover-card">
                                    <div class="card-body d-flex align-items-center justify-content-start ps-4">
                                        <h5 class="card-title mb-0">Gestionar Pruebas</h5>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="button-card col-10 mb-2 ">
                            <a href="{{ route('reportes.usuarios.pdf') }}" class="w-100 text-decoration-none">
                                <div class="card  hover-card ">
                                    <div class="card-body d-flex align-items-center justify-content-start ps-4">
                                        <h5 class="card-title mb-0">Generar Reporte Usuarios</h5>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <img src="{{ asset('/img/robot-idle.gif') }}" alt="robot">
                    </div>
                </nav>

                {{-- ======================== --}}
                {{-- Resumen de Actividad y Fuente de Usuarios --}}
                {{-- ======================== --}}
                <div class="row  mt-1">
                    <div class="col-md-12 ">
                        <div class="card mb-4 rounded-4 border-0 text-center ">
                            <div class="card-header">Resumen de Actividad</div>
                            <div class="card-body">
                                <div class="chart-placeholder">
                                    <a href="{{ route('CDashboard.grafica') }}"><img
                                            src="https://imgproxy.domestika.org/unsafe/w:1200/rs:fill/plain/src://blog-post-open-graph-covers/000/013/052/13052-original.jpg?1712830811"
                                            alt="grafica" class="img-fluid"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card mb-4 rounded-4 border-0 text-center">
                            <div class="card-header">Fuente de Usuarios</div>
                            <div class="card-body">
                                <div class="chart-placeholder"><img
                                        src="https://www.jaspersoft.com/content/dam/jaspersoft/images/graphics/infographics/pie-chart-example.svg"
                                        class="circular"></div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ======================== --}}
                {{-- Proyectos y Ilustraciones --}}
                {{-- ======================== --}}
                <div class="row float-left">
                    <div class="col-md-6">
                        <div class="card mb-4 h-100 rounded-4 border-0 text-center">
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
                    <div class="col-md-6 ">
                        <div class="card mb-4 h-100 rounded-4 border-0 text-center">
                            <div class="card-header ">Ilustraciones</div>
                            <div class="chart-placeholder ">
                                <img class="img-fluid"
                                    src="https://png.pngtree.com/png-vector/20230531/ourmid/pngtree-robot-in-the-style-of-an-old-drawing-vector-png-image_6790636.png">
                            </div>

                        </div>
                    </div>
                </div>
            </main>
        </div>
</body>

</html>