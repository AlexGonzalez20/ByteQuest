<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Preguntas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite('resources/css/preguntas.css')
    <style>
        .option-btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .correct {
            background-color: #d4edda !important;
            border-color: #28a745 !important;
        }

        .incorrect {
            background-color: #f8d7da !important;
            border-color: #dc3545 !important;
        }
    </style>
</head>

<body>
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="d-flex align-items-center gap-2">
                <!-- Botón volver al camino -->
                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#cancelarModal">
                    ← Volver al camino
                </button>

                <span class="btn btn-danger">
                    <i class="fa-solid fa-heart"></i>
                    Vidas: {{ auth()->user()->vidas }}
                </span>
            </div>
        </div>

        <div class="card shadow mx-auto" style="max-width: 1000px;">
            <div class="card-body">
                @if (session('finalizado'))
                    <div class="alert alert-success text-center mb-3">
                        {{ session('finalizado') }}
                    </div>
                    <form method="GET" action="{{ route('usuarios.caminoCurso', ['curso_id' => $curso_id]) }}">
                        <button type="submit" class="btn btn-warning w-100">Volver al camino</button>
                    </form>
                @elseif(isset($pregunta) && $pregunta)
                    <h4 class="mb-4">{{ $pregunta->pregunta }}</h4>

                    @if (!empty($pregunta->imagen))
                        <div class="mb-3 text-center">
                            <img src="{{ asset($pregunta->imagen) }}" alt="Imagen de la pregunta"
                                style="max-height:180px;width:auto;">
                        </div>
                    @endif

                    <form method="POST" action="{{ route('pregunta.responder') }}">
                        @csrf
                        @if (request('repaso'))
                            <div class="alert alert-info text-center">
                                <strong>Repasemos</strong>
                            </div>
                        @endif
                        <input type="hidden" name="pregunta_id" value="{{ $pregunta->id }}">
                        <input type="hidden" name="respuesta" id="respuesta">
                        <input type="hidden" name="curso_id" value="{{ $curso_id }}">
                        <input type="hidden" name="prueba_id" value="{{ $prueba_id }}">

                        @foreach ($pregunta->respuestas->shuffle() as $resp)
                            @php
                                $classes = 'btn btn-outline-primary w-100 mb-2 option-btn';
                                if (isset($respuesta_seleccionada)) {
                                    if ($resp->id == $respuesta_seleccionada) {
                                        $classes .= $resultado === 'correcto' ? ' correct' : ' incorrect';
                                    }
                                    $disabled = 'disabled';
                                } else {
                                    $disabled = '';
                                }
                            @endphp
                            <button type="button" class="{{ $classes }}" value="{{ $resp->id }}"
                                onclick="selectOption(this)" {{ $disabled }}>
                                {{ $resp->texto }}
                            </button>
                        @endforeach

                        @if (empty($mostrarContinuar))
                            <button type="submit" id="enviarBtn" class="btn btn-success w-100 mt-3" disabled>
                                Enviar respuesta
                            </button>
                        @endif
                    </form>

                    @if (isset($mensaje))
                        <div class="alert {{ $resultado === 'correcto' ? 'alert-success' : 'alert-danger' }} mt-3">
                            {{ $mensaje }}
                        </div>

                        @if (!empty($mostrarContinuar))
                            <form action="{{ route('pregunta.mostrar', ['prueba_id' => $prueba_id]) }}" method="GET">
                                <button type="submit" class="btn btn-primary mt-2">Continuar</button>
                            </form>
                        @endif
                    @endif
                @endif
            </div>
        </div>
    </div>

    <!-- Modal advertencia para cancelar intento -->
    <div class="modal fade" id="cancelarModal" tabindex="-1" aria-labelledby="cancelarModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cancelarModalLabel">Cancelar intento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    ⚠️ Si vuelves al camino, se cancelará el progreso actual de la prueba.
                    ¿Deseas continuar?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <a href="{{ route('pregunta.cancelarIntento', ['curso_id' => $curso_id ?? 0]) }}"
                        class="btn btn-danger">Sí, cancelar intento</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function selectOption(btn) {
            // Quitar clase active de todos
            document.querySelectorAll('.option-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            // Guardar valor seleccionado
            document.getElementById('respuesta').value = btn.value;

            // Habilitar botón de enviar
            const enviarBtn = document.getElementById('enviarBtn');
            if (enviarBtn) enviarBtn.disabled = false;
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
