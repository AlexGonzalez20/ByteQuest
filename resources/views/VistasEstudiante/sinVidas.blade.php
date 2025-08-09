@extends('layouts.estudiante')

@section('title', 'Sin Vidas')

@section('content')
    <div class="question-box text-center">
        <h3 class="mb-4 text-danger">
            <i class="fa-solid fa-heart-crack"></i> {{ $mensaje }}
        </h3>

        <form action="{{ route('usuarios.caminoCurso', $curso_id) }}" method="GET">
            <button type="submit" class="btn btn-warning">Volver al Camino</button>
        </form>
    </div>
@endsection

@section('head')
    <style>
        .question-box {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 0 20px #dc3545aa;
            padding: 2rem;
            max-width: 500px;
            margin: 5rem auto;
        }
    </style>
@endsection
