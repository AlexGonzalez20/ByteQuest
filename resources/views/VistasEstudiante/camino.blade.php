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
            <div class="prueba-nodo {{ $prueba->completada ? 'completed' : ($prueba->disponible ? 'available' : 'locked') }}"
                @if($prueba->disponible)
                title="Empezar prueba {{ $prueba->orden }}"
                @endif>
                <div class="nodo-content">
                    <span class="prueba-orden">{{ $prueba->orden }}</span>
                    @if ($prueba->completada)
                    <span class="checkmark">&#10003;</span>
                    @elseif($prueba->disponible)
                    <a href="{{ route('pregunta.mostrar', ['prueba_id' => $prueba->id]) }}" class="btn btn-learn">START</a>
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
<div id="finalizado-alert" class="alert alert-success text-center mt-3">
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
    /* Contenedor principal */
    .path-list {
        width: 100%;
        max-width: 1000px;
        margin: auto;
    }

    /* Tarjeta de lección */
    .leccion-item {
        background: #333661;
        border-radius: 12px;
        padding: 25px;
        margin-bottom: 25px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    /* Título de lección */
    .leccion-title {
        color: #f0f0f0;
        font-weight: 600;
        margin-bottom: 20px;
    }

    /* Contenedor de nodos: 10 nodos distribuidos equitativamente */
    .camino-nodos {
        display: flex;
        justify-content: space-between;
        /* distribuye los nodos a lo largo del ancho */
        align-items: center;
        margin-top: 15px;
        flex-wrap: nowrap;
    }

    /* Nodo individual */
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
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        transition: all 0.3s;
    }

    .prueba-nodo.available:hover {
        transform: scale(1.1);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
    }

    /* Estados de nodo */
    .prueba-nodo.completed {
        background: #223322;
        color: #4CAF50;
    }

    .prueba-nodo.available {
        background: #2c2c5f;
        border: 2px solid #ffc107;
        cursor: pointer;
    }

    .prueba-nodo.locked {
        background: #333344;
        color: #888;
    }

    /* Contenido dentro del nodo */
    .nodo-content {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    /* Número de prueba */
    .prueba-orden {
        font-size: 1rem;
        font-weight: bold;
        margin-bottom: 4px;
    }

    /* Botón Empezar */
    .btn-learn {
        background: #28a745;
        color: #fff;
        padding: 5px 10px;
        border-radius: 6px;
        font-size: 0.75rem;
        text-decoration: none;
        margin-top: 2px;
        transition: background 0.2s;
    }

    .btn-learn:hover {
        background: #218838;
    }

    /* Checkmark */
    .checkmark {
        font-size: 1.3rem;
        color: #4CAF50;
    }

    /* Bloqueado */
    .locked-text {
        font-size: 1.3rem;
        opacity: 0.5;
    }

    /* Línea entre nodos */
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
</style>
@endsection