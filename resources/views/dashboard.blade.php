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
    <link rel="icon" type="image/x-icon" href="{{ asset('img/icon.png') }}">


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
                <nav class=" d-flex float-start flex-column">

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
                            <div class="card dashboard-graph-card">
                                <div class="card-header text-center">Usuarios nuevos por mes</div>
                                <div class="card-body">
                                    <canvas id="usuariosMesChart" style="height: 250px;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card mb-4 rounded-4 border-0 text-center">
                        <div class="card dashboard-graph-card">
                            <div class="card-header text-center">Estudiantes por curso</div>
                            <div class="card-body">
                                <canvas id="estudiantesCursoChart"  style="height: 250px;"></canvas>
                            </div>
                        
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
                <div class="card dashboard-graph-card">
                    <div class="card-header text-center">Lecciones más vistas</div>
                    <div class="card-body">
                        <canvas id="leccionesVistasChart"  style="height: 340px;"></canvas>
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // 1. Usuarios nuevos por mes
        const ctxUsuariosMes = document.getElementById('usuariosMesChart').getContext('2d');
        new Chart(ctxUsuariosMes, {
            type: 'bar',
            data: {
                labels: @json($labelsUsuariosMes),
                datasets: [{
                    label: 'Usuarios nuevos',
                    data: @json($dataUsuariosMes),
                    backgroundColor: 'rgba(54, 162, 235, 0.7)'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        // 2. Estudiantes por curso
        const ctxEstudiantesCurso = document.getElementById('estudiantesCursoChart').getContext('2d');
        new Chart(ctxEstudiantesCurso, {
            type: 'bar',
            data: {
                labels: @json($labelsCursos),
                datasets: [{
                    label: 'Estudiantes',
                    data: @json($dataCursos),
                    backgroundColor: 'rgba(255, 193, 7, 0.7)'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        // 3. Lecciones más vistas
        const ctxLeccionesVistas = document.getElementById('leccionesVistasChart').getContext('2d');
        new Chart(ctxLeccionesVistas, {
            type: 'bar',
            data: {
                labels: @json($labelsLecciones),
                datasets: [{
                    label: 'Vistas',
                    data: @json($dataLecciones),
                    backgroundColor: 'rgba(40, 167, 69, 0.7)'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>

</html>