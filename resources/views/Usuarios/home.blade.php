@extends('layouts.estudiante')
@section('title', 'Home Usuario')
@section('content')
    <div class="row g-4 justify-content-center">
        <div class="col-6 col-md-3">
            <a href="{{ route('views.UCamino') }}" class="text-decoration-none">
                <div class="card icon-card text-center p-4">
                    <i class='bx bx-git-branch text-primary'></i>
                    <div class="mt-2">Camino</div>
                </div>
            </a>
        </div>
        <div class="col-6 col-md-3">
            <a href="{{ route('views.UMisCursos') }}" class="text-decoration-none">
                <div class="card icon-card text-center p-4">
                    <i class='bx bx-book text-success'></i>
                    <div class="mt-2">Mis Cursos</div>
                </div>
            </a>
        </div>
        <div class="col-6 col-md-3">
            <div class="card icon-card text-center p-4">
                <i class='bx bx-question-mark text-info'></i>
                <div class="mt-2">Preguntas</div>
            </div>
            </a>
        </div>
        <div class="col-6 col-md-3">
            <a href="{{ route('views.UPerfil') }}" class="text-decoration-none">
                <div class="card icon-card text-center p-4">
                    <i class='bx bx-user text-warning'></i>
                    <div class="mt-2">Perfil</div>
                </div>
            </a>
        </div>
    </div>
    </div>
@endsection
@section('head')
    <style>
        .icon-card {
            transition: transform 0.2s;
            cursor: pointer;
        }

        .icon-card:hover {
            transform: scale(1.05);
            box-shadow: 0 0 10px #ffc107;
        }

        .icon-card i {
            font-size: 3rem;
        }
    </style>
@endsection
