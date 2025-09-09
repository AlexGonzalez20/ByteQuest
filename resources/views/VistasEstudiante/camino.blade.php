@extends('layouts.estudiante')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/camino.css') }}">
    @vite('resources/css/camino.css')
@endsection

@section('title', 'Camino')
@section('content')

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