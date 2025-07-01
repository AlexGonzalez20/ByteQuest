@extends('Usuarios.layout')
@section('title', 'Mis Cursos')
@section('content')
<h2 class="mb-4">Mis Cursos</h2>
<div class="row g-4">
    <!-- Ejemplo de cursos, reemplaza por tu lógica de cursos -->
    <div class="col-12 col-md-4">
        <div class="card course-card">
            <img src="https://images.unsplash.com/photo-1513258496099-48168024aec0?auto=format&fit=crop&w=400&q=80" class="course-img" alt="Curso 1">
            <div class="card-body">
                <h5 class="card-title">Curso de Programación</h5>
                <p class="card-text">Aprende los fundamentos de la programación moderna.</p>
                <a href="#" class="btn btn-primary w-100">Ir al curso</a>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="card course-card">
            <img src="https://images.unsplash.com/photo-1461749280684-dccba630e2f6?auto=format&fit=crop&w=400&q=80" class="course-img" alt="Curso 2">
            <div class="card-body">
                <h5 class="card-title">Curso de Diseño</h5>
                <p class="card-text">Explora el mundo del diseño gráfico y digital.</p>
                <a href="#" class="btn btn-success w-100">Ir al curso</a>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="card course-card">
            <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=400&q=80" class="course-img" alt="Curso 3">
            <div class="card-body">
                <h5 class="card-title">Curso de Matemáticas</h5>
                <p class="card-text">Domina los conceptos clave de las matemáticas.</p>
                <a href="#" class="btn btn-info w-100">Ir al curso</a>
            </div>
        </div>
    </div>
    <!-- Fin ejemplo -->
</div>
@endsection
@section('head')
<style>
    .course-card {
        border-radius: 16px;
        box-shadow: 0 0 10px #ffc10733;
        transition: transform 0.2s;
        cursor: pointer;
    }
    .course-card:hover {
        transform: scale(1.03);
        box-shadow: 0 0 20px #ffc107;
    }
    .course-img {
        width: 100%;
        height: 120px;
        object-fit: cover;
        border-radius: 16px 16px 0 0;
    }
</style>
@endsection