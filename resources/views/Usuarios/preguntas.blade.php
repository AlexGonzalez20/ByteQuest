@extends('Usuarios.layout')
@section('title', 'Preguntas')
@section('content')
<div class="question-box">
    <h4 class="mb-4">Pregunta de ejemplo</h4>
    <form method="POST" action="">
        @csrf
        <input type="hidden" name="respuesta" id="respuesta">
        <button type="button" class="btn btn-outline-primary option-btn" value="A" onclick="selectOption(this)">Opción A</button>
        <button type="button" class="btn btn-outline-primary option-btn" value="B" onclick="selectOption(this)">Opción B</button>
        <button type="button" class="btn btn-outline-primary option-btn" value="C" onclick="selectOption(this)">Opción C</button>
        <button type="button" class="btn btn-outline-primary option-btn" value="D" onclick="selectOption(this)">Opción D</button>
        <div class="mt-4">
            <button type="submit" class="btn btn-success w-100">Enviar</button>
        </div>
    </form>
    @if(session('resultado'))
        <div class="alert mt-3 {{ session('resultado') == 'correcto' ? 'alert-success' : 'alert-danger' }}">
            {{ session('mensaje') }}
        </div>
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