@extends('layouts.estudiante')

@section('title', 'Mis Cursos')

@section('content')
    <div class="container"> {{-- ✅ centramos y damos margen a los lados --}}
        <h2 class="mb-4 text-light">Mis Cursos</h2>

        @if ($cursos->isEmpty())
            <div class="alert alert-info">Aún no has seguido ningún curso.</div>
            <a href="{{ route('views.UCursos') }}" class="btn btn-warning mt-3">Ver Cursos Disponibles</a>
        @else
            <div class="row g-4">
                @foreach ($cursos as $curso)
                    <div class="col-12 col-md-6"> {{-- 2 por fila desde md --}}
                        <div class="card course-card h-100">
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
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title text-light">{{ $curso->nombre }}</h5>
                                <a href="{{ route('usuarios.caminoCurso', ['curso_id' => $curso->id]) }}"
                                    class="btn btn-warning mt-auto w-100">Ir al curso</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection

@section('head')
    <style>
        .course-card {
            border-radius: 16px;
            box-shadow: 0 0 15px #ffc10744;
            transition: transform 0.2s, box-shadow 0.2s;
            cursor: pointer;
            background: linear-gradient(135deg, #1c1c1c, #2c2c2c);
            border: 1px solid #ffc10733;
            color: #fff;
        }

        .course-card:hover {
            transform: scale(1.03);
            box-shadow: 0 0 25px #ffc107aa;
        }

        .course-img {
            width: 100%;
            height: 140px;
            object-fit: contain;
            background: #ffffff;
            border-radius: 16px 16px 0 0;
            padding: 10px;
        }

        .card-title {
            font-weight: bold;
            font-size: 1.2rem;
        }
    </style>
@endsection
