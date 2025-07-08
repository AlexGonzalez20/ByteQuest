@extends('layouts.estudiante')
@section('title', 'Mis Cursos')
@section('content')
<h2 class="mb-4">Mis Cursos</h2>
@if ($cursos->isEmpty())
<div class="alert alert-info">Aún no has seguido ningún curso.</div>
<a href="{{ route('views.UCursos') }}" class="btn btn-warning mt-3">Ver Cursos Disponibles</a>
@else

<div class="row g-4">
    @foreach ($cursos as $curso)
    <div class="col-12 col-md-4">
        <div class="card course-card">
            <img src="https://images.unsplash.com/photo-1513258496099-48168024aec0?auto=format&fit=crop&w=400&q=80"
                class="course-img" alt="{{ $curso->nombre }}">
            <div class="card-body">
                <h5 class="card-title">{{ $curso->nombre }}</h5>
                <p class="card-text">{{ $curso->descripcion }}</p>
                <a href="{{ route('usuarios.caminoCurso', ['curso_id' => $curso->id]) }}"
                    class="btn btn-primary w-100">Ir al curso</a>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endif
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