@extends('layouts.estudiante')

@section('title', 'Camino')
@section('content')
    <h2 class="mb-4 text-light">
        Camino de Aprendizaje
        @if (isset($curso))
            <span class="text-secondary" style="font-size:1.1rem; font-weight:normal;">— {{ $curso->nombre }}</span>
        @endif
    </h2>

    <div class="path-list">
        @foreach ($lecciones as $leccion)
            <div class="leccion-item">
                <h5 class="leccion-title">
                    {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }} — {{ $leccion->nombre }}
                </h5>

                <div class="pruebas-list">
                    @foreach ($leccion->pruebas as $prueba)
                        <div
                            class="prueba-item 
                    {{ $prueba->completada ? 'completed' : ($prueba->disponible ? 'available' : 'locked') }}">

                            <span class="prueba-orden">Prueba {{ $prueba->orden }}</span>

                            <div class="prueba-action">
                                @if ($prueba->completada)
                                    <span class="checkmark">&#10003;</span>
                                @elseif($prueba->disponible)
                                    <a href="{{ route('pregunta.mostrar', ['prueba_id' => $prueba->id]) }}"
                                        class="btn btn-learn">LEARN</a>
                                @else
                                    <span class="locked-text">🔒</span>
                                @endif
                            </div>
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

        .pruebas-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .prueba-item {
            flex: none;
            width: 100%;
            background: #282851;
            border-radius: 6px;
            padding: 20px;
            color: #fff;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .prueba-item.completed {
            background: #223322;
            color: #4CAF50;
        }

        .prueba-item.available {
            background: #2c2c5f;
            border: 1px solid #ffc107;
        }

        .prueba-item.locked {
            background: #333344;
            color: #888;
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
