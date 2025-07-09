<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Preguntas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- ✅ Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite('resources/css/preguntas.css')
</head>
<body>

    <div class="container py-5">
        <div class="card shadow mx-auto" style="max-width: 1000px;">
            <div class="card-body">
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
                            <button type="button" class="btn btn-outline-primary w-100 mb-2 option-btn"
                                value="{{ $respuesta->id }}"
                                onclick="selectOption(this)">
                                {{ $respuesta->texto }}
                            </button>
                        @endforeach

                        <button type="submit" class="btn btn-success w-100 mt-3">Enviar respuesta</button>
                    </form>

                    {{-- ✅ Mensaje de resultado --}}
                    @if (session('resultado'))
                        <div class="alert mt-3 {{ session('resultado') == 'correcto' ? 'alert-success' : 'alert-danger' }}">
                            {{ session('mensaje') }}
                        </div>
                    @endif

                {{-- ✅ Si no hay preguntas ni finalización --}}
                @else
                    <div class="alert alert-info text-center mb-3">
                        No hay preguntas pendientes.
                    </div>
                    <a href="{{ route('usuarios.caminoCurso', ['curso_id' => $curso_id]) }}" class="btn btn-primary w-100">
                        Volver al camino
                    </a>
                @endif
            </div>
        </div>
    </div>

    {{-- ✅ Script para seleccionar opción --}}
    <script>
        function selectOption(btn) {
            document.querySelectorAll('.option-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            document.getElementById('respuesta').value = btn.value;
        }
    </script>

    {{-- ✅ Bootstrap JS (opcional) --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
