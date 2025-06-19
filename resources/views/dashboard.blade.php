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

    <br>
    <button class="btn btn-primary mx-3 mt-3" data-bs-toggle="offcanvas" data-bs-target="#intro"><i class='bx bx-menu'
            style='color:#000000'></i></button>

    <div class="offcanvas offcanvas-start bg-dark text-white" id="intro">
        <div class="offcanvas-header">
            <div class="offcanvas-title">
                <button class="btn btn-primary mt-4" data-bs-dismiss="offcanvas"><i class='bx bx-menu-alt-left'
                        style='color:#000000'></i></button>
            </div>
        </div>
        <div>
            <ul class="nav flex-column">
                <li class="mt-3"></li>
                <li class="nav-item"><a class="nav-link text-white" href="{{ route('logout') }}">Usuarios</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="{{ route('views.AdCourses') }}">Cursos</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="{{ route('logout') }}">Lecciones</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="{{ route('views.selectCourse') }}">Preguntas</a></li>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="btn btn-outline-light w-100 mt-3" type="submit">Cerrar sesión</button>

                </form>
            </ul>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">

            <!-- Main content -->
            <main class="col-12 col-md-10 offset-md-1 px-3 py-4">

                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <a class="navbar-brand" href="{{route('landing')}}"><span class="text-warning">Byte</span><span
                            class="quest">Quest</span></a>
                </div>
            <a href="{{route('views.dash')}}">Dash</a>


                <div class="row">
                    <div class="col-md-3">
                        <a href="#" class="text-decoration-none">
                            <div class="card text-white bg-primary mb-3 hover-card">
                                <div class="card-body">
                                    <h5 class="card-title">Gestionar Usuarios</h5>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-3">
                        <a href="{{ route('views.AdCourses') }}" class="text-decoration-none">
                            <div class="card text-white bg-success mb-3 hover-card">
                                <div class="card-body">
                                    <h5 class="card-title">Gestionar Cursos</h5>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-3">
                        <a href="#" class="text-decoration-none">
                            <div class="card text-white bg-info mb-3 hover-card">
                                <div class="card-body">
                                    <h5 class="card-title">Progreso Promedio</h5>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-3">
                        <a href="{{ route('views.selectCourse') }}" class="text-decoration-none">
                            <div class="card text-white bg-warning mb-3 hover-card">
                                <div class="card-body">
                                    <h5 class="card-title">Preguntas</h5>
                                </div>
                            </div>
                        </a>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-8">
                        <div class="card mb-4">
                            <div class="card-header">Resumen de Actividad</div>
                            <div class="card-body">
                                <div class="chart-placeholder">
                                    <img src="https://uni.edu.gt/wp-content/uploads/sites/19/2024/10/grafica_barras-1024x569.png"
                                        alt="Illustration" class="img-fluid">
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
    </div>

</body>

</html>