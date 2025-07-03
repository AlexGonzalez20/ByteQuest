@extends('layouts.admin')

@section('title', 'Gráficas Dashboard')

@section('head')
    <style>
        .dashboard-graph-card {
            min-width: 340px;
            max-width: 400px;
            margin: 0 auto 2rem auto;
            height: 350px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .dashboard-graph-card .card-body {
            flex: 1 1 auto;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .dashboard-graph-card canvas {
            max-width: 100% !important;
            max-height: 250px !important;
        }

        @media (min-width: 992px) {
            .dashboard-graph-row {
                justify-content: center;
            }
        }
    </style>
@endsection

@section('content')
    <div class="container py-4">
        <div class="row dashboard-graph-row gy-4">
            <div class="col-12 col-md-4">
                <div class="card dashboard-graph-card">
                    <div class="card-header text-center">Usuarios nuevos por mes</div>
                    <div class="card-body">
                        <canvas id="usuariosMesChart" height="120"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card dashboard-graph-card">
                    <div class="card-header text-center">Estudiantes por curso</div>
                    <div class="card-body">
                        <canvas id="estudiantesCursoChart" height="120"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card dashboard-graph-card">
                    <div class="card-header text-center">Lecciones más vistas</div>
                    <div class="card-body">
                        <canvas id="leccionesVistasChart" height="120"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
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
@endsection