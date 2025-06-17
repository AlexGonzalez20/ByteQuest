<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ByteQuest Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @vite('resources/css/dashboard.css')
    @vite('resources/js/dashboard.js')


</head>

<body>

    <br>
    <button class="btn btn-success mx-3 mt-3" data-bs-toggle="offcanvas" data-bs-target="#intro">☰</button>

    <div class="offcanvas offcanvas-start" id="intro">
        <div class="offcanvas-header">
            <div class="offcanvas-title">
                <button class="btn btn-danger" data-bs-dismiss="offcanvas">☰</button>
            </div>
        </div>
        <div>
            <ul class="nav flex-column">
                <li class="nav-item"><a class="nav-link text-white" href="#">Usuarios</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="#">Cursos</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="#">Lecciones</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="#">Preguntas</a></li>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit">
                        Cerrar sesión
                    </button>
                </form>
            </ul>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">

            <!-- Main content -->
            <main class="col-md-10 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">


                    <a class="navbar-brand" href="{{route('landing')}}"><span class="text-warning">Byte</span><span class="quest">Quest</span></a>

                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="card text-white bg-primary mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Usuarios</h5>
                                <p class="card-text">150 registrados</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white bg-success mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Cursos</h5>
                                <p class="card-text">12 disponibles</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white bg-info mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Progreso Promedio</h5>
                                <p class="card-text">68%</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white bg-warning mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Preguntas</h5>
                                <p class="card-text">520 creadas</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-8">
                        <div class="card mb-4">
                            <div class="card-header">Resumen de Actividad</div>
                            <div class="card-body">
                                <div class="chart-placeholder">[Gráfico de barras aquí]</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <div class="card-header">Fuente de Usuarios</div>
                            <div class="card-body">
                                <div class="chart-placeholder">[Gráfico circular aquí]</div>
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
                            <div class="card-body">
                                <img src="https://undraw.co/api/illustrations/5c661510-44c4-4bcb-8019-776d86fae5ae" alt="Illustration" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>



</body>

</html>