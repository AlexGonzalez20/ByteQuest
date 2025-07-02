@extends('Usuarios.layout')
@section('title', 'Mis Cursos')
@section('content')
<h2 class="mb-4">catalogo Cursos</h2>
<div class="row g-4">
    @foreach($cursos as $curso)
    <div class="col-12 col-md-4">
        <div class="card course-card">
            <img src="https://images.unsplash.com/photo-1513258496099-48168024aec0?auto=format&fit=crop&w=400&q=80" class="course-img" alt="{{ $curso->nombre }}">
            <div class="card-body">
                <h5 class="card-title">{{ $curso->nombre }}</h5>
                <p class="card-text">{{ $curso->descripcion }}</p>
                <a href="{{ route('usuarios.caminoCurso', ['curso_id' => $curso->id]) }}" class="btn btn-primary w-100">Ir al curso</a>
                @if(in_array($curso->id, $cursosSeguidos))
                    <form method="POST" action="{{ route('usuarios.dejarCurso', ['curso_id' => $curso->id]) }}" class="mt-2">
                        @csrf
                        <button type="submit" class="btn btn-danger w-100">Dejar de seguir</button>
                    </form>
                @else
                <form method="POST" action="{{ route('usuarios.seguirCurso', ['curso_id' => $curso->id]) }}" class="mt-2">
                    @csrf
                    <button type="submit" class="btn btn-warning w-100">Seguir</button>
                </form>
                @endif
            </div>
        </div>
    </div>
    @endforeach
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