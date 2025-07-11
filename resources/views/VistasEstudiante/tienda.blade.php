@extends('layouts.estudiante')

@section('title', 'Tienda')

@section('head')
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin />
    <link rel="stylesheet" as="style" onload="this.rel='stylesheet'"
        href="https://fonts.googleapis.com/css2?display=swap&amp;family=Lexend%3Awght%40400%3B500%3B700%3B900&amp;family=Noto+Sans%3Awght%40400%3B500%3B700%3B900" />

    <style>
        /* Animación de latido */
        @keyframes heartbeat {
            0% {
                transform: scale(1);
            }

            25% {
                transform: scale(1.1);
            }

            40% {
                transform: scale(0.95);
            }

            60% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
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
                                        <h1 class="mb-0 display-2 vidas-number">{{ auth()->user()->vidas }}</h1>
                                        <p class="card-text mb-0 fs-4 text-secondary">Vidas</p>
                                    </div>
                                    <!-- Icono animado -->
                                    <i class='bx bx-heart heart-beat' style="font-size: 64px; color: #e63946;"></i>
                                </div>
                            </div>
                        </div>
                    </div>




                    <!-- Packs -->
                    <h3 class="text-white mb-4">Vidas</h3>

                    <div class="card mb-4" style="background-color: #333661;">
                        <div class="row g-0">
                            <!-- Columna Texto e Imagen envueltos juntos para reordenar -->
                            <div class="col-12 col-md-6 d-flex flex-column p-4">
                                <!-- Texto -->
                                <div class="mb-3">
                                    <h5 class="card-title text-white mb-1">Recupera todas tus vidas</h5>
                                    <p class="text-secondary mb-3">10 Vidas para continuar practicando</p>
                                </div>

                                <!-- Imagen solo visible en mobile -->
                                <div class="ratio ratio-16x9 rounded mb-3 d-md-none">
                                    <img src="{{ asset('img/bateria.jpg') }}" class="rounded" alt="...">

                                </div>

                                <!-- Botón -->
                                <button class="btn btn-dark w-auto px-4 rounded-pill mt-auto">$
                                    5</button>
                            </div>

                            <!-- Imagen para escritorio -->
                            <div class="col-12 col-md-6 d-none d-md-block p-4">
                                <div
                                    class="ratio ratio-16x9 rounded h-100 d-flex align-items-center justify-content-center">
                                    <img src="{{ asset('img/bateria.jpg') }}" class="rounded" alt="...">

                                </div>
                            </div>


                        </div>
                    </div>

                    <!-- Pack Vidas Infinitas -->
                    <div class="card mb-4" style="background-color: #333661;">
                        <div class="row g-0">
                            <!-- Columna Texto e Imagen envueltos -->
                            <div class="col-12 col-md-6 d-flex flex-column p-4">
                                <!-- Título y descripción -->
                                <div class="mb-3">
                                    <h5 class="card-title text-white mb-1">Vidas Infinitas</h5>
                                    <p class="text-secondary mb-3">8 Días de Vidas que no se acaban</p>
                                </div>

                                <!-- Imagen solo para mobile -->
                                <div class="ratio ratio-16x9 rounded mb-3 d-md-none">
                                </div>

                                <!-- Botón -->
                                <button class="btn btn-dark w-auto px-4 rounded-pill mt-auto">$15</button>
                            </div>

                            <!-- Imagen para escritorio -->
                            <div class="col-12 col-md-6 d-none d-md-block p-4">
                                <div class="ratio ratio-16x9 rounded h-100">
                                    <img src="{{ asset('') }}" class="rounded" alt="...">
                                </div>
                            </div>
                        </div>
                    </div>

                    <h3 class="text-white mb-4">Protectores de racha</h3>

                    <!-- Pack Protege tu Racha -->
                    <div class="card mb-4" style="background-color: #333661;">
                        <div class="row g-0">
                            <!-- Columna Texto e Imagen envueltos -->
                            <div class="col-12 col-md-6 d-flex flex-column p-4">
                                <!-- Título y descripción -->
                                <div class="mb-3">
                                    <h5 class="card-title text-white mb-1">Protege tu Racha</h5>
                                    <p class="text-secondary mb-3">Protege tu racha si no usas la app por un día</p>
                                </div>

                                <!-- Imagen solo para mobile -->
                                <div class="ratio ratio-16x9 rounded mb-3 d-md-none">
                                </div>

                                <!-- Botón -->
                                <button class="btn btn-dark w-auto px-4 rounded-pill mt-auto">$5</button>
                            </div>

                            <!-- Imagen para escritorio -->
                            <div class="col-12 col-md-6 d-none d-md-block p-4">
                                <div class="ratio ratio-16x9 rounded h-100">
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection
