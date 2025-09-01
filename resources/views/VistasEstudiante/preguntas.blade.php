<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Preguntas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite('resources/css/preguntas.css')
</head>

<body>
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="d-flex align-items-center gap-2">
                <a href="{{ route('usuarios.caminoCurso', ['curso_id' => $curso_id ?? 0]) }}" class="btn btn-secondary">
                    ← Volver al camino
                </a>
                <span class="btn btn-danger">
                    <i class="fa-solid fa-heart"></i>
                    Vidas: {{ auth()->user()->vidas }}
                </span>
            </div>
        </div>

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

                    {{-- Mostrar imagen si existe --}}
                    @if (!empty($pregunta->imagen))
                        <div class="mb-3 text-center">
                            <img src="{{ asset('imagenes_preguntas/' . $pregunta->imagen) }}" 
                                 alt="Imagen de la pregunta" 
                                 style="max-height:180px;width:auto;">
                        </div>
                    @endif

                    {{-- Formulario para responder --}}
                    <form method="POST" action="{{ route('pregunta.responder') }}">
                        @csrf
                        <input type="hidden" name="pregunta_id" value="{{ $pregunta->id }}">
                        <input type="hidden" name="respuesta" id="respuesta">

                        @foreach ($pregunta->respuestas->shuffle() as $respuesta)
                            <button type="button" 
                                    class="btn btn-outline-primary w-100 mb-2 option-btn"
                                    value="{{ $respuesta->id }}" 
                                    onclick="selectOption(this)">
                                {{ $respuesta->texto }}
                            </button>
                        @endforeach

                        <button type="submit" class="btn btn-success w-100 mt-3">Enviar respuesta</button>
                    </form>

                    {{-- ✅ Mostrar mensaje después de enviar --}}
                    @if(isset($mensaje))
                        <div class="alert {{ $resultado === 'correcto' ? 'alert-success' : 'alert-danger' }} mt-3">
                            {{ $mensaje }}
                        </div>

                        {{-- ✅ Botón continuar solo si corresponde --}}
                        @if(!empty($mostrarContinuar) && $mostrarContinuar === true)
                            <form action="{{ route('siguiente.pregunta', ['curso_id' => $curso_id]) }}" method="GET">
                                <button type="submit" class="btn btn-primary mt-2">Continuar</button>
                            </form>
                        @endif
                    @endif
                @endif
            </div>
        </div>
    </div>

    <script>
        function selectOption(btn) {
            document.querySelectorAll('.option-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            document.getElementById('respuesta').value = btn.value;
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>