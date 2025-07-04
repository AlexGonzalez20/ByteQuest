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

    @vite('resources/css/dashboard.css')

</head>

<body>



    <div class="container-fluid">
        <div class="row gy-4">

            <!-- Main content -->
            <main class="col-12 col-md-10 offset-md-1 px-3 py-4 gy-4">

                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">

                    <a class="navbar-brand" href="{{ route('landing') }}"><span class="text-warning">Byte</span><span
                            class="quest">Quest</span></a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">Cerrar Sesión</button>
                    </form>
                </div>

                <div class="row g-3">
                    <div class="col-md-3 d-flex">
                        <a href="{{ route('usuarios.index') }}" class="w-100 text-decoration-none">
                            <div class="card text-white bg-primary hover-card h-100">
                                <div class="card-body d-flex align-items-center justify-content-center">
                                    <h5 class="card-title mb-0">Gestionar Usuarios</h5>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-3 d-flex">
                        <a href="{{ route('cursos.index') }}" class="w-100 text-decoration-none">
                            <div class="card text-white bg-success hover-card h-100">
                                <div class="card-body d-flex align-items-center justify-content-center">
                                    <h5 class="card-title mb-0">Gestionar Cursos</h5>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-3 d-flex">
                        <a href="{{ route('lecciones.index') }}" class="w-100 text-decoration-none">
                            <div class="card text-white bg-primary hover-card h-100">
                                <div class="card-body d-flex align-items-center justify-content-center">
                                    <h5 class="card-title mb-0">Gestionar Lecciones</h5>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-3 d-flex">
                        <a href="{{ route('preguntas.index') }}" class="w-100 text-decoration-none">
                            <div class="card text-white bg-info hover-card h-100">
                                <div class="card-body d-flex align-items-center justify-content-center">
                                    <h5 class="card-title mb-0">Gestionar Preguntas</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="row g-3 justify-content-center mt-2">
                    <div class="col-md-3 d-flex">
                        <a href="{{ route('pruebas.index') }}" class="w-100 text-decoration-none">
                            <div class="card text-white bg-info hover-card h-100">
                                <div class="card-body d-flex align-items-center justify-content-center">
                                    <h5 class="card-title mb-0">Gestionar Pruebas</h5>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-3 d-flex">
                        <a href="{{ route('reportes.usuarios.pdf') }}" class="w-100 text-decoration-none">
                            <div class="card text-white bg-warning hover-card h-100">
                                <div class="card-body d-flex align-items-center justify-content-center">
                                    <h5 class="card-title mb-0">Generar Reporte Usuarios</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-8">
                        <div class="card mb-4">
                            <div class="card-header">Resumen de Actividad</div>
                            <div class="card-body">
                                <div class="chart-placeholder">
                                    <a href="{{ route('CDashboard.grafica') }}"><img src="" alt="grafica"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <div class="card-header">Fuente de Usuarios</div>
                            <div class="card-body">
                                <div class="chart-placeholder"><img
                                        src="https://www.jaspersoft.com/content/dam/jaspersoft/images/graphics/infographics/pie-chart-example.svg"
                                        class="circular"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card mb-4">
                            <div class="card-header">Proyectos</div>
                            <div class="card-body">
                                <p>Integración API <span class="float-end">60%</span></p>
                                <div class="progress mb-3">
                                    <div class="progress-bar bg-success" style="width: 60%"></div>
                                </div>
                                <p>Diseño UI <span class="float-end">85%</span></p>
                                <div class="progress mb-3">
                                    <div class="progress-bar bg-primary" style="width: 85%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card mb-4">
                            <div class="card-header">Ilustraciones</div>
                            <div class="chart-placeholder">
                                <img src="https://png.pngtree.com/png-vector/20230531/ourmid/pngtree-robot-in-the-style-of-an-old-drawing-vector-png-image_6790636.png"
                                    alt="" class="img-fluid">
                            </div>

                        </div>
                    </div>
                </div>
            </main>
        </div>
</body>

</html>