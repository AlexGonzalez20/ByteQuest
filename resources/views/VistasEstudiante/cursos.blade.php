@extends('layouts.estudiante')
@section('title', 'Catalogo de Cursos')
@section('content')
    <div class="container">
        <h2 class="mb-4 text-light text-center">Catalogo Cursos</h2>

        @if (session('error'))
            <div class="alert alert-danger small">{{ session('error') }}</div>
        @endif

        <div class="row g-4 justify-content-center">
            @foreach ($cursos as $curso)
                <div class="col-12 col-md-5 col-lg-4">
                    <div class="card course-card">

                        {{-- Imagen con fondo blanco --}}
                        <div class="course-img-container">
                            @php
                                $nombreCurso = strtolower($curso->nombre);
                                if (\Illuminate\Support\Str::contains($nombreCurso, 'php')) {
                                    $img = asset('img/php.png');
                                } elseif (\Illuminate\Support\Str::contains($nombreCurso, 'python')) {
                                    $img = asset('img/python.png');
                                } elseif (
                                    \Illuminate\Support\Str::contains($nombreCurso, 'javascript') ||
                                    \Illuminate\Support\Str::contains($nombreCurso, 'js')
                                ) {
                                    $img = asset('img/javascript.png');
                                } else {
                                    $img = asset('img/default.png');
                                }
                            @endphp
                            <img src="{{ $img }}" class="course-img" alt="{{ $curso->nombre }}">
                        </div>

                        {{-- Contenido --}}
                        <div class="card-body">
                            <h5 class="card-title">{{ $curso->nombre }}</h5>
                            <p class="card-text">{{ $curso->descripcion }}</p>

                            {{-- Un solo botón dinámico --}}
                            @if (in_array($curso->id, $cursosSeguidos))
                                <a href="{{ route('usuarios.caminoCurso', ['curso_id' => $curso->id]) }}"
                                    class="btn btn-success w-100">Siguiendo</a>
                            @else
                                <form method="POST" action="{{ route('usuarios.seguirCurso', ['curso_id' => $curso->id]) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-warning w-100">Seguir</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('head')
    <style>
        .course-card {
            border-radius: 16px;
            background-color: #222; /* Fondo oscuro */
            box-shadow: 0 0 10px #ffc10733;
            transition: transform 0.2s, box-shadow 0.2s, background-color 0.2s;
            cursor: pointer;
            overflow: hidden;
        }

        .course-card:hover {
            transform: scale(1.03);
            box-shadow: 0 0 20px #ffc107;
            background-color: #fff;
        }

        .course-img-container {
            background-color: #fff;
            text-align: center;
            padding: 20px;
        }

        .course-img {
            max-width: 80%;
            height: 100px;
            object-fit: contain;
        }

        .card-body {
            padding: 15px;
        }

        .card-title {
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: 10px;
            color: #fff;
            transition: color 0.3s;
        }

        .card-text {
            font-size: 0.9rem;
            color: #ffffff;
            margin-bottom: 15px;
            transition: color 0.3s;
        }

        /* Texto cambia a negro en hover */
        .course-card:hover .card-title,
        .course-card:hover .card-text {
            color: #000;
        }
    </style>
@endsection
