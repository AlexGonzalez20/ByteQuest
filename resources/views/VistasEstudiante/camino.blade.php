@php
    echo '<div style="color:yellow;background:#333;padding:8px;">vidas: ' . auth()->user()->vidas . ' | tiempo_recuperacion: ' . ($tiempo_recuperacion ?? 'null') . ' | ultima_vida_perdida: ' . (session('ultima_vida_perdida') ?? 'null') . '</div>';
@endphp
@extends('layouts.estudiante')

@section('title', 'Camino')
@section('content')

    <div class="path-list">
        @foreach ($lecciones as $leccion)
            <div class="leccion-item">
                <h5 class="leccion-title">
                    {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }} — {{ $leccion->nombre }}
                </h5>

                <div class="pruebas-list camino-nodos">
                    @foreach ($leccion->pruebas as $prueba)
                        <div
                            class="prueba-nodo {{ $prueba->completada ? 'completed' : ($prueba->disponible ? 'available' : 'locked') }}">
                            <div class="nodo-content">
                                <span class="prueba-orden">{{ $prueba->orden }}</span>
                                @if ($prueba->completada)
                                    <span class="checkmark">&#10003;</span>
                                @elseif($prueba->disponible)
                                    <a href="{{ route('pregunta.mostrar', ['prueba_id' => $prueba->id]) }}"
                                        class="btn btn-learn">LEARN</a>
                                @else
                                    <span class="locked-text">🔒</span>
                                @endif
                            </div>
                            @if (!$loop->last)
                                <div class="nodo-linea"></div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
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
        .path-list {
            width: 100%;
            max-width: 1000px;
            margin: auto;
        }


        .leccion-item {
            background: #333661;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .leccion-title {
            color: #ccc;
            margin-bottom: 15px;
        }

        .camino-nodos {
            display: flex;
            flex-direction: row;
            gap: 0;
            align-items: center;
            justify-content: flex-start;
            margin-top: 20px;
        }

        .prueba-nodo {
            position: relative;
            width: 60px;
            height: 60px;
            background: #282851;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            margin: 0 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.12);
        }

        .prueba-nodo.completed {
            background: #223322;
            color: #4CAF50;
        }

        .prueba-nodo.available {
            background: #2c2c5f;
            border: 2px solid #ffc107;
        }

        .prueba-nodo.locked {
            background: #333344;
            color: #888;
        }

        .nodo-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .prueba-orden {
            font-size: 1rem;
            font-weight: bold;
            margin-bottom: 2px;
        }

        .btn-learn {
            background: #28a745;
            color: #fff;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 0.7rem;
            text-decoration: none;
            margin-top: 2px;
        }

        .checkmark {
            font-size: 1.2rem;
            color: #4CAF50;
        }

        .locked-text {
            font-size: 1.2rem;
            opacity: 0.5;
        }

        .nodo-linea {
            position: absolute;
            top: 50%;
            left: 100%;
            width: 40px;
            height: 4px;
            background: #ffc107;
            transform: translateY(-50%);
            z-index: 0;
        }

        .btn-learn {
            background: #28a745;
            color: #fff;
            padding: 4px 10px;
            border-radius: 4px;
            font-size: 0.8rem;
            text-decoration: none;
        }

        .checkmark {
            font-size: 1.2rem;
            color: #4CAF50;
        }

        .locked-text {
            font-size: 1.2rem;
            opacity: 0.5;
        }
    </style>
@endsection