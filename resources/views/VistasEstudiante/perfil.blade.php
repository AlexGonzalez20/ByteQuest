@extends('layouts.estudiante')

@section('title', 'Perfil de Usuario')

@section('head')
<style>
    .profile-container {
        max-width: 60%;
        margin: 3rem auto;
        background: #000000ff;
        border-radius: 20px;
        box-shadow: 0 0 30px rgba(255, 193, 7, 0.2);
        padding: 3rem;
    }

    .profile-picture {
        display: flex;
        justify-content: center;
    }

    .profile-img {
        width: 140px;
        height: 140px;
        object-fit: cover;
        border-radius: 50%;
        border: 4px solid #ffc107;
        box-shadow: 0 0 20px rgba(255, 193, 7, 0.4);
    }

    .progress {
        background-color: #e9ecef;
        border-radius: 30px;
        height: 22px;
    }

    .progress-bar {
        font-weight: bold;
    }

    .avatar-holder {
        display: inline-block;
        padding: 6px;
        border-radius: 50%;
        border: 3px solid #ccc;
        transition: border-color 0.2s, box-shadow 0.2s;
    }

    .avatar-holder.selected {
        border-color: #ffc107 !important;
        box-shadow: 0 0 15px rgba(255, 193, 7, 0.7);
        background: #fffbe6;
    }

    .avatar-holder img {
        border-radius: 50%;
        display: block;
    }

    .btn-save {
        font-size: 1.2rem;
        font-weight: 600;
        padding: 0.75rem 2rem;
    }

    /* ---- Contador vidas ---- */
    .vidas-section {
        margin-top: 2.5rem;
        padding: 1.5rem;
        border: 2px dashed #ffc107;
        border-radius: 15px;
        background: #252746;
    }

    .vidas-title {
        font-size: 1.3rem;
        font-weight: bold;
        color: #ffffffff;
    }

    .vidas-counter {
        font-size: 1.5rem;
        font-weight: bold;
        color: #dc3545;
        margin-top: 0.5rem;
    }
</style>


@endsection

@section('content')
<div class="profile-container text-center">
    <h2 class="mb-4">Mi Perfil</h2>

    <div class="profile-picture mb-4">
        <img src="{{ asset('img/robots/' . (Auth::user()->imagen ?? 'amarillo.PNG')) }}"
            alt="Foto de perfil"
            class="profile-img">
    </div>

    <!-- Barra de progreso de experiencia -->
    <h5>Experiencia</h5>
    <div class="progress mb-5">
        <div class="progress-bar bg-warning" role="progressbar"
            style="width: {{ min((Auth::user()->experiencia / 100) * 100, 100) }}%;">
            {{ Auth::user()->experiencia }} XP
        </div>
    </div>

    <!-- Contador vidas -->
    <div class="vidas-section">
        <div class="vidas-title">❤️ Recuperación de vidas</div>
        <div id="contador-vidas" class="vidas-counter"></div>
        <div class="mt-2">
            Vidas actuales: <strong id="vidas-count">{{ $usuario->vidas }}</strong> / 5
        </div>
    </div>


    <form class="profile-form text-start mt-5" method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('POST')

        <div class="mb-4">
            <label class="form-label fw-bold">Imagen de perfil</label>
            <div class="d-flex justify-content-start flex-wrap">
                @php
                $opciones = ['amarillo.PNG', 'azulito.PNG', 'verde.PNG', 'rojo.PNG'];
                @endphp
                @foreach ($opciones as $img)
                <label class="me-3 mb-3 avatar-holder {{ Auth::user()->imagen === $img ? 'selected' : '' }}"
                    style="cursor:pointer;">
                    <input type="radio" name="imagen" value="{{ $img }}" class="d-none"
                        {{ Auth::user()->imagen === $img ? 'checked' : '' }}>
                    <img src="{{ asset('img/robots/' . $img) }}" alt="{{ $img }}" width="70" height="70">
                </label>
                @endforeach
            </div>
        </div>

        <div class="row">
            <div class="mb-4 col-md-6">
                <label for="nombre" class="form-label fw-bold">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control"
                    value="{{ Auth::user()->nombre }}" required>
            </div>

            <div class="mb-4 col-md-6">
                <label for="apellido" class="form-label fw-bold">Apellido</label>
                <input type="text" name="apellido" id="apellido" class="form-control"
                    value="{{ Auth::user()->apellido }}" required>
            </div>
        </div>

        <button type="submit" class="btn btn-warning w-100 btn-save">💾 Guardar cambios</button>
    </form>

    @if (session('success'))
    <div class="alert alert-success mt-4">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
    <div class="alert alert-danger mt-4">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <a href="{{ route('aprender') }}" class="btn btn-link mt-4">← Volver a Aprender</a>
</div>

<!-- Contador vidas -->


<script>
    document.addEventListener('DOMContentLoaded', function() {
        let tiempoRestante = @json($segundosRestantes ?? 0);
        const display = document.getElementById('contador-vidas');
        const vidasCountEl = document.getElementById('vidas-count');

        function formatTime(s) {
            const m = Math.floor(s / 60);
            const sec = s % 60;
            return `${m}:${sec < 10 ? '0' : ''}${sec}`;
        }

        function reclamarVida() {
            fetch("{{ route('vidas.reclamar') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({})
                })
                .then(res => res.json())
                .then(data => {
                    if (vidasCountEl) {
                        vidasCountEl.textContent = data.vidas;
                    }
                });
        }

        function actualizarContador() {
            if (!display) return;

            if (tiempoRestante > 0) {
                display.textContent = `⏳ Próxima vida en ${formatTime(tiempoRestante)}`;
                tiempoRestante--;
            } else {
                display.textContent = "✅ Vida lista para reclamar";

                // Reclamar solo si aún no tiene 5 vidas Y si justo se acaba de cumplir
                if (parseInt(vidasCountEl.textContent) < 5 && tiempoRestante === 1) {
                    reclamarVida();

                    // Reinicia el contador
                    tiempoRestante = 30; // 🔹 cambia a 1800 si quieres 30 min
                }
            }
        }


        actualizarContador();
        setInterval(actualizarContador, 1000);
    });
</script>


@endsection