@extends('Usuarios.layout')
@section('title', 'Preguntas')
@section('content')
<div class="question-box">
    @if($pregunta)
    <h4 class="mb-4">{{ $pregunta->pregunta }}</h4>
    <form method="POST" action="{{ route('pregunta.mostrar') }}">
        @csrf
        <input type="hidden" name="respuesta" id="respuesta">
        @foreach($pregunta->respuestas as $index => $respuesta)
        <button type="button"
            class="btn btn-outline-primary option-btn"
            value="{{ $respuesta->id }}"
            onclick="selectOption(this)">
            {{ chr(65 + $index) }}. {{ $respuesta->texto }}
        </button>
        <input type="hidden" name="pregunta_id" value="{{ $pregunta->id }}">
        @endforeach
        <div class="mt-4">
            <button type="submit" class="btn btn-success w-100">Enviar</button>
        </div>
    </form>
    <a href="{{ route('views.UCamino') }}" class="btn btn-warning mb-3 w-100">Ir al Camino</a>

    @if($resultado)
    <div class="alert mt-3 {{ $resultado == 'correcto' ? 'alert-success' : 'alert-danger' }}">
        {{ $mensaje }}
    </div>
    @endif
    @else
    <p>No hay preguntas disponibles.</p>
    @endif
</div>

@endsection
@section('head')
<style>
    .question-box {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 0 20px #ffc10733;
        padding: 2rem;
        max-width: 500px;
        margin: 3rem auto;
    }

    .option-btn {
        width: 100%;
        margin-bottom: 1rem;
    }

    .option-btn.selected {
        background: #ffc107;
        color: #222;
    }
</style>
@endsection
@section('scripts')
<script>
    function selectOption(btn) {
        document.querySelectorAll('.option-btn').forEach(b => b.classList.remove('selected'));
        btn.classList.add('selected');
        document.getElementById('respuesta').value = btn.value;
    }
</script>
@endsection