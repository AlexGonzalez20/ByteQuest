@extends('layouts.estudiante')

@section('title', 'Preguntas')

@section('content')
    <div class="question-box">
        {{-- ✅ Si la prueba ya se completó --}}
        @if (session('finalizado'))
            <div class="alert alert-success text-center mb-3">
                {{ session('finalizado') }}
            </div>
            <form method="GET" action="{{ route('usuarios.caminoCurso', ['curso_id' => $curso_id]) }}">
                <button type="submit" class="btn btn-warning w-100">Volver al camino</button>
            </form>

        {{-- ✅ Si hay una pregunta disponible --}}
        @elseif(isset($pregunta) && $pregunta)
            <h4 class="mb-4">{{ $pregunta->pregunta }}</h4>

            <form method="POST" action="{{ route('pregunta.responder') }}">
                @csrf
                <input type="hidden" name="pregunta_id" value="{{ $pregunta->id }}">
                <input type="hidden" name="respuesta" id="respuesta">

                @foreach ($pregunta->respuestas as $respuesta)
                    <button type="button" class="btn btn-outline-primary option-btn"
                        value="{{ $respuesta->id }}"
                        onclick="selectOption(this)">
                        {{ $respuesta->texto }}
                    </button>
                @endforeach

                <div class="mt-4">
                    <button type="submit" class="btn btn-success w-100">Enviar respuesta</button>
                </div>
            </form>

            {{-- ✅ Mensaje de resultado --}}
            @if (session('resultado'))
                <div class="alert mt-3 {{ session('resultado') == 'correcto' ? 'alert-success' : 'alert-danger' }}">
                    {{ session('mensaje') }}
                </div>
            @endif

        {{-- ✅ Si no hay preguntas ni finalización (estado raro) --}}
        @else
            <div class="alert alert-info text-center mb-3">
                No hay preguntas pendientes.
            </div>
            <a href="{{ route('usuarios.caminoCurso', ['curso_id' => $curso_id]) }}" class="btn btn-primary w-100">
                Volver al camino
            </a>
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
