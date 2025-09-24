<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Preguntas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite('resources/css/preguntas.css')
    <style>
        body {
            background-color: #252746;
        }

        .card {
            border-radius: 1rem;
            align-items: center;
        }

        .options-container {
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            gap: 0.75rem;
            margin-top: 1rem;
            flex-wrap: nowrap;
            overflow-x: auto;
        }

        .option-btn {
            transition: all 0.2s ease;
            font-weight: 500;
            text-align: center;
            padding: 0.6rem 0.5rem;
            min-width: 80px;
            max-width: 150px;
            border-radius: 0.5rem;
            font-size: 0.9rem;
        }

        .option-btn:hover:not(:disabled) {
            background-color: #00b2c3;
            color: whitesmoke;
            transition: all 0.3s ease;
        }

        .option-btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .correct {
            background-color: #d4edda !important;
            border-color: #28a745 !important;
            color: #155724;
        }

        .incorrect {
            background-color: #f8d7da !important;
            border-color: #dc3545 !important;
            color: #721c24;
        }

        .contador {
            font-size: 0.95rem;
            font-weight: 600;
            color: #000000ff;
            text-align: center;
            margin-bottom: 0.5rem;
        }

        .vidas {
            font-size: 1rem;
            font-weight: 600;
        }

        .mensaje {
            font-size: 1.1rem;
            font-weight: 500;
            text-align: center;
        }

        .pregunta-img {
            max-height: 220px;
            width: auto;
            border-radius: 0.5rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        }

        .btn-enviar {
            font-weight: 600;
        }

        .btn-secondary:hover {
            background-color: #ffc107;
            color: #252647;
            transition: all 0.3s ease;
        }

        /* Responsive adjustments */
        @media (max-width: 576px) {
            .option-btn {
                min-width: 100px;
                max-width: 100%;
                font-size: 0.85rem;
            }

            .options-container.d-flex {
                flex-direction: column !important;
                gap: 0.5rem;
            }
        }
    </style>
</head>

<body>
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#cancelarModal">
                ← Volver al camino
            </button>
            <span class="btn btn-danger vidas">
                <i class="fa-solid fa-heart"></i>
                Vidas: {{ auth()->user()->vidas }}
            </span>
        </div>

        <div class="card shadow mx-auto p-4" style="max-width: 900px;">
            <div class="card-body">
                @if (session('finalizado'))
                    <div class="alert alert-success text-center mb-3">
                        {{ session('finalizado') }}
                    </div>
                    <form method="GET" action="{{ route('usuarios.caminoCurso', ['curso_id' => $curso_id]) }}">
                        <button type="submit" class="btn btn-warning btn-enviar">Volver al camino</button>
                    </form>
                @elseif(isset($pregunta) && $pregunta)
                    <h4 class="mb-2">{{ $pregunta->pregunta }}</h4>
                    <p class="contador">Pregunta {{ $numeroPregunta ?? 1 }} de {{ $totalPreguntas ?? 10 }}</p>

                    @if (!empty($pregunta->imagen))
                        <div class="mb-3 text-center">
                            <img src="{{ asset($pregunta->imagen) }}" alt="Imagen de la pregunta" class="pregunta-img">
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

                        <div
                            class="{{ !empty($pregunta->imagen) ? 'd-flex justify-content-between mt-3' : 'options-container' }}">
                            @foreach ($pregunta->respuestas->shuffle() as $resp)
                                @php
                                    $classes = 'btn btn-outline-primary option-btn';
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
                                    onclick="selectOption(this)" {{ $disabled }} @if(!empty($pregunta->imagen))
                                    style="flex: 1 1 0; max-width: 18%; min-width: 80px;" @else style="width: 150px;" @endif>
                                    {{ $resp->texto }}
                                </button>
                            @endforeach
                        </div>

                        @if (empty($mostrarContinuar))
                            <button type="submit" id="enviarBtn" class="btn btn-success w-100 mt-3 btn-enviar" disabled>
                                Enviar respuesta
                            </button>
                        @endif
                    </form>

                    @if (isset($mensaje))
                        <div class="d-flex justify-content-between align-items-center mt-3 p-2 rounded"
                            style="background-color: {{ $resultado === 'correcto' ? '#d4edda' : '#f8d7da' }};">
                            <span style="color: {{ $resultado === 'correcto' ? '#155724' : '#721c24' }}; font-weight: 500;">
                                {{ $mensaje }}
                            </span>

                            @if (!empty($mostrarContinuar))
                                <form action="{{ route('pregunta.mostrar', ['prueba_id' => $prueba_id]) }}" method="GET"
                                    class="mb-0">
                                    <button type="submit" class="btn btn-primary btn-enviar">Continuar</button>
                                </form>
                            @endif
                        </div>
                    @endif

                @endif
            </div>
        </div>
    </div>

    <!-- Modal cancelar intento -->
    <div class="modal fade" id="cancelarModal" tabindex="-1" aria-labelledby="cancelarModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cancelarModalLabel">Cancelar intento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body text-center">
                    ⚠️ Si vuelves al camino, se cancelará el progreso actual de la prueba.<br>
                    ¿Deseas continuar?
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <a href="{{ route('pregunta.cancelarIntento', ['curso_id' => $curso_id ?? 0]) }}"
                        class="btn btn-danger">Sí, cancelar intento</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function selectOption(btn) {
            document.querySelectorAll('.option-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            document.getElementById('respuesta').value = btn.value;
            const enviarBtn = document.getElementById('enviarBtn');
            if (enviarBtn) enviarBtn.disabled = false;
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>