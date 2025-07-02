@extends('Usuarios.layout')
@section('title', 'Preguntas')
@section('content')
<div class="question-box">
    @if(isset($finalizado) && $finalizado)
        <div class="alert alert-success text-center mb-3">¡Has completado todas las preguntas y el repaso!</div>
        @if(isset($xp_mensaje) && $xp_mensaje)
            <div class="alert alert-warning text-center mb-3">{{ $xp_mensaje }}</div>
        @endif
        <form method="GET" action="{{ route('views.UCamino') }}">
            <button type="submit" class="btn btn-warning w-100">Volver al camino</button>
        </form>
    @else
        @if(isset($mensaje_repaso) && $mensaje_repaso)
            <div class="alert alert-info text-center small mb-3">{{ $mensaje_repaso }}</div>
        @endif
        <h4 class="mb-4">@if(isset($pregunta)) {{ $pregunta->pregunta }} @else Pregunta de ejemplo @endif</h4>
        <form method="POST" action="">
            @csrf
            @if(isset($pregunta))
                <input type="hidden" name="pregunta_id" value="{{ $pregunta->id }}">
                <input type="hidden" name="respuesta" id="respuesta">
                @foreach($pregunta->respuestas as $respuesta)
                    <button type="button" class="btn btn-outline-primary option-btn" value="{{ $respuesta->id }}" onclick="selectOption(this)">{{ $respuesta->texto }}</button>
                @endforeach
            @else
                <div class="alert alert-success">¡No hay más preguntas!</div>
            @endif
            <div class="mt-4">
                <button type="submit" class="btn btn-success w-100">Enviar</button>
            </div>
        </form>
        @if(session('resultado'))
            <div class="alert mt-3 {{ session('resultado') == 'correcto' ? 'alert-success' : 'alert-danger' }}">
                {{ session('mensaje') }}
            </div>
        @endif
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