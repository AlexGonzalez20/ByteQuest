@extends('layouts.estudiante')
@section('title', 'Camino')
@section('content')
    <h2 class="mb-4">
        Camino de Aprendizaje
        @if (isset($curso))
            <span class="text-secondary" style="font-size:1.1rem; font-weight:normal;">— {{ $curso->nombre }}</span>
        @endif
    </h2>
    <div class="path-container">
        <div class="circle" style="top:10%;left:10%;" onclick="window.location.href='{{ route('pregunta.mostrar') }}'">1</div>
        <div class="circle" style="top:25%;left:25%;">2</div>
        <div class="circle" style="top:40%;left:40%;">3</div>
        <div class="circle" style="top:55%;left:60%;">4</div>
        <div class="circle" style="top:70%;left:80%;">5</div>
    </div>
    @if (session('finalizado'))
        <div id="finalizado-alert" class="alert alert-success text-center">
            {{ session('finalizado') }}
        </div>
        <script>
            setTimeout(() => {
                document.getElementById('finalizado-alert').style.display = 'none';
            }, 4000);
        </script>
    @endif
@endsection
@section('head')
    <style>
        .path-container {
            position: relative;
            height: 70vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .circle {
            position: absolute;
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background: #fff;
            border: 3px solid #ffc107;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: #222;
            box-shadow: 0 0 10px #ffc10744;
            transition: box-shadow 0.2s, transform 0.2s;
            cursor: pointer;
            pointer-events: auto;
        }

        .circle:hover {
            box-shadow: 0 0 20px #ffc107;
            transform: scale(1.1);
        }
    </style>
@endsection
