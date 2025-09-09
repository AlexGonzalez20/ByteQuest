@extends('layouts.estudiante')

@section('title', 'Tienda')

@section('head')
    <link rel="stylesheet" as="style" onload="this.rel='stylesheet'"
        href="https://fonts.googleapis.com/css2?display=swap&amp;family=Lexend%3Awght%40400%3B500%3B700%3B900&amp;family=Noto+Sans%3Awght%40400%3B500%3B700%3B900" />

    <style>
        /* Animación de latido */
        @keyframes heartbeat {
            0% {
                transform: scale(2);
            }

            25% {
                transform: scale(1.5);
            }

            40% {
                transform: scale(1.35);
            }

            60% {
                transform: scale(1.45);
            }

            100% {
                transform: scale(2);
            }
        }

        .heart-beat {
            animation: heartbeat 1.5s infinite;
            transform-origin: center;
        }

        .vidas-number {
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.3);
        }

        .vidas-card {
            background: linear-gradient(135deg, #333661 0%, #1a1a2e 100%);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .card:hover {
            transform: translateY(-4px);
            transition: transform 0.5s ease;
        }

        .price-tag {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: white;
            font-weight: bold;
            box-shadow: 0 2px 10px rgba(40, 167, 69, 0.3);
        }

        .price-original {
            text-decoration: line-through;
            color: #6c757d;
            font-size: 0.9rem;
        }
    </style>
@endsection

@section('content')
    <div class="d-flex flex-column min-vh-100" style=' font-family: Lexend, "Noto Sans", sans-serif;'>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <!-- Título y descripción -->
                    <div class="mb-4 text-white">
                        <h1 class="fw-bold" style="font-size: 64px;">Tienda ByteQuest</h1>
                        <p class="text-secondary">Que nada detenga tu Viaje de Aprendizaje</p>
                    </div>

                    <!-- Vidas actuales -->
                    <h3 class="text-white mb-3">Actualmente tienes:</h3>
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <div class="card text-white mb-3 vidas-card">
                                <div class="card-body d-flex align-items-center justify-content-center">
                                    <!-- Bloque número + texto -->
                                    <div class="d-flex flex-column align-items-center me-4">
                                        <div class="d-flex align-items-center" style="gap:8px;">
                                            <h1 class="mb-0 display-2 vidas-number">{{ auth()->user()->vidas }}</h1>
                                            @if(isset($tiempo_recuperacion) && $tiempo_recuperacion > 0)
                                                <span id="contador-vidas" class="text-warning"
                                                    style="font-size:1.2rem; min-width:90px;">
                                                    <i class="fa-regular fa-clock"></i>
                                                    <span id="tiempo-vidas"></span>
                                                </span>
                                            @endif
                                        </div>
                                        <p class="card-text mb-0 fs-4 text-secondary">Vidas</p>
                                        @section('scripts')
                                            <script>
                                                @if(isset($tiempo_recuperacion) && $tiempo_recuperacion > 0)
                                                    let tiempo = {{ $tiempo_recuperacion }};
                                                    function updateCounter() {
                                                        if (tiempo <= 0) return;
                                                        let min = Math.floor(tiempo / 60);
                                                        let sec = tiempo % 60;
                                                        var el = document.getElementById('tiempo-vidas');
                                                        if (el) {
                                                            el.textContent = `${min}:${sec.toString().padStart(2, '0')}`;
                                                        }
                                                        tiempo--;
                                                        if (tiempo > 0 && el) setTimeout(updateCounter, 1000);
                                                    }
                                                    updateCounter();
                                                @endif
                                            </script>
                                        @endsection
                                    </div>
                                    <!-- Icono animado -->
                                    <i class='bx bx-heart heart-beat' style="font-size: 64px; color: #e63946;"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Packs -->
                    <h3 class="text-white mb-4">💖 Packs de Vidas</h3>

                    <!-- Pack Recupera Vidas -->
                    <div class="card mb-4" style="background-color: #333661;">
                        <div class="row g-0">
                            <!-- Columna Texto e Imagen envueltos juntos para reordenar -->
                            <div class="col-12 col-md-6 d-flex flex-column p-4">
                                <!-- Texto -->
                                <div class="mb-3">
                                    <h5 class="card-title text-white mb-1">
                                        💖 Recupera todas tus vidas
                                        <span class="badge bg-success ms-2">Más Popular</span>
                                    </h5>
                                    <p class="text-secondary mb-2">10 Vidas para continuar practicando sin límites</p>
                                    <small class="text-warning">
                                        <i class="fas fa-clock"></i> Oferta especial por tiempo limitado
                                    </small>
                                </div>

                                <!-- Imagen solo visible en mobile -->
                                <div class="ratio ratio-16x9 rounded mb-3 d-md-none">
                                    <img src="{{ asset('img/bateria.jpg') }}" class="rounded" alt="Pack de vidas">
                                </div>

                                <!-- Precio y Botón -->
                                <div class="d-flex align-items-center gap-3 mt-auto">
                                    <div>
                                        <span class="price-original">$8.000</span>
                                        <h4 class="text-success mb-0">$5.000 COP</h4>
                                        <small class="text-secondary">Ahorra $3.000</small>
                                    </div>
                                    <a href="{{ route('pago', ['producto' => 'Recupera todas tus vidas', 'precio' => 5000]) }}"
                                        class="btn price-tag px-4 py-2 rounded-pill ms-auto">
                                        <i class="fas fa-shopping-cart me-2"></i>Comprar
                                    </a>
                                </div>
                            </div>

                            <!-- Imagen para escritorio -->
                            <div class="col-12 col-md-6 d-none d-md-block p-4">
                                <div class="ratio ratio-16x9 rounded h-100 d-flex align-items-center justify-content-center">
                                    <img src="{{ asset('img/bateria.jpg') }}" class="rounded" alt="Pack de vidas">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pack Vidas Infinitas -->
                    <div class="card mb-4" style="background-color: #333661; border: 2px solid #ffd700;">
                        <div class="card-header text-center" style="background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%); color: #333;">
                            <h6 class="mb-0">
                                <i class="fas fa-crown"></i> PREMIUM - MEJOR VALOR <i class="fas fa-crown"></i>
                            </h6>
                        </div>
                        <div class="row g-0">
                            <!-- Columna Texto e Imagen envueltos -->
                            <div class="col-12 col-md-6 d-flex flex-column p-4">
                                <!-- Título y descripción -->
                                <div class="mb-3">
                                    <h5 class="card-title text-white mb-1">
                                        ♾️ Vidas Infinitas
                                        <span class="badge bg-warning text-dark ms-2">Premium</span>
                                    </h5>
                                    <p class="text-secondary mb-2">8 Días completos de vidas ilimitadas</p>
                                    <ul class="text-secondary" style="font-size: 0.9rem;">
                                        <li>✅ Vidas que nunca se agotan</li>
                                        <li>✅ Practica sin interrupciones</li>
                                        <li>✅ Progreso acelerado</li>
                                    </ul>
                                </div>

                                <!-- Imagen solo para mobile -->
                                <div class="ratio ratio-16x9 rounded mb-3 d-md-none">
                                    <img src="{{ asset('img/bateria.jpg') }}" class="rounded" alt="Vidas infinitas">
                                </div>

                                <!-- Precio y Botón -->
                                <div class="d-flex align-items-center gap-3 mt-auto">
                                    <div>
                                        <span class="price-original">$25.000</span>
                                        <h4 class="text-warning mb-0">$15.000 COP</h4>
                                        <small class="text-secondary">Ahorra $10.000</small>
                                    </div>
                                    <a href="{{ route('pago', ['producto' => 'Vidas Infinitas', 'precio' => 15000]) }}"
                                        class="btn btn-warning text-dark px-4 py-2 rounded-pill ms-auto fw-bold">
                                        <i class="fas fa-crown me-2"></i>Obtener Premium
                                    </a>
                                </div>
                            </div>

                            <!-- Imagen para escritorio -->
                            <div class="col-12 col-md-6 d-none d-md-block p-4">
                                <div class="ratio ratio-16x9 rounded h-100">
                                    <img src="{{ asset('img/bateria.jpg') }}" class="rounded" alt="Vidas infinitas">
                                </div>
                            </div>
                        </div>
                    </div>

                    <h3 class="text-white mb-4">🛡️ Protectores de Racha</h3>

                    <!-- Pack Protege tu Racha -->
                    <div class="card mb-4" style="background-color: #333661;">
                        <div class="row g-0">
                            <!-- Columna Texto e Imagen envueltos -->
                            <div class="col-12 col-md-6 d-flex flex-column p-4">
                                <!-- Título y descripción -->
                                <div class="mb-3">
                                    <h5 class="card-title text-white mb-1">
                                        🛡️ Protector de Racha
                                        <span class="badge bg-info ms-2">Esencial</span>
                                    </h5>
                                    <p class="text-secondary mb-2">Mantén tu racha segura automáticamente</p>
                                    <ul class="text-secondary" style="font-size: 0.9rem;">
                                        <li>✅ Protección automática por 1 día</li>
                                        <li>✅ Conserva tu progreso</li>
                                        <li>✅ Tranquilidad total</li>
                                    </ul>
                                </div>

                                <!-- Imagen solo para mobile -->
                                <div class="ratio ratio-16x9 rounded mb-3 d-md-none">
                                    <img src="{{ asset('img/bateria.jpg') }}" class="rounded" alt="Protector de racha">
                                </div>

                                <!-- Precio y Botón -->
                                <div class="d-flex align-items-center gap-3 mt-auto">
                                    <div>
                                        <h4 class="text-info mb-0">$3.000 COP</h4>
                                        <small class="text-secondary">Precio justo</small>
                                    </div>
                                    <a href="{{ route('pago', ['producto' => 'Protector de Racha', 'precio' => 3000]) }}"
                                        class="btn btn-info text-dark px-4 py-2 rounded-pill ms-auto fw-bold">
                                        <i class="fas fa-shield-alt me-2"></i>Proteger
                                    </a>
                                </div>
                            </div>

                            <!-- Imagen para escritorio -->
                            <div class="col-12 col-md-6 d-none d-md-block p-4">
                                <div class="ratio ratio-16x9 rounded h-100">
                                    <img src="{{ asset('img/bateria.jpg') }}" class="rounded" alt="Protector de racha">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pack Combo (Nuevo) -->
                    <div class="card mb-4" style="background-color: #333661; border: 2px solid #e83e8c;">
                        <div class="card-header text-center" style="background: linear-gradient(135deg, #e83e8c 0%, #fd7e14 100%);">
                            <h6 class="mb-0 text-white">
                                <i class="fas fa-fire"></i> COMBO ESPECIAL - MÁXIMO AHORRO <i class="fas fa-fire"></i>
                            </h6>
                        </div>
                        <div class="row g-0">
                            <div class="col-12 col-md-6 d-flex flex-column p-4">
                                <div class="mb-3">
                                    <h5 class="card-title text-white mb-1">
                                        🎯 Combo Completo
                                        <span class="badge bg-danger ms-2">Oferta</span>
                                    </h5>
                                    <p class="text-secondary mb-2">Vidas Infinitas + 3 Protectores de Racha</p>
                                    <ul class="text-secondary" style="font-size: 0.9rem;">
                                        <li>✅ 8 días de vidas infinitas</li>
                                        <li>✅ 3 protectores de racha incluidos</li>
                                        <li>✅ Experiencia completa sin límites</li>
                                        <li>✅ Ahorro de $9.000 COP</li>
                                    </ul>
                                </div>

                                <div class="ratio ratio-16x9 rounded mb-3 d-md-none">
                                    <img src="{{ asset('img/bateria.jpg') }}" class="rounded" alt="Combo completo">
                                </div>

                                <div class="d-flex align-items-center gap-3 mt-auto">
                                    <div>
                                        <span class="price-original">$33.000</span>
                                        <h4 class="text-danger mb-0">$24.000 COP</h4>
                                        <small class="text-secondary">¡Súper ahorro!</small>
                                    </div>
                                    <a href="{{ route('pago', ['producto' => 'Combo Completo', 'precio' => 24000]) }}"
                                        class="btn btn-danger px-4 py-2 rounded-pill ms-auto fw-bold">
                                        <i class="fas fa-rocket me-2"></i>Combo
                                    </a>
                                </div>
                            </div>

                            <div class="col-12 col-md-6 d-none d-md-block p-4">
                                <div class="ratio ratio-16x9 rounded h-100">
                                    <img src="{{ asset('img/bateria.jpg') }}" class="rounded" alt="Combo completo">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection