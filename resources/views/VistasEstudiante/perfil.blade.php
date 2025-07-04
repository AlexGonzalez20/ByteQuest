@extends('layouts.estudiante')

@section('title', 'Perfil de Usuario')

@section('content')
    <div class="profile-container text-center">
        <h2 class="mb-4">👤 Mi Perfil</h2>

        <div class="profile-picture mb-3">
            <img src="{{ asset('img/robots/' . (Auth::user()->imagen ?? 'amarillo.PNG')) }}"
                alt="Foto de perfil" class="profile-img">
        </div>

        <!-- Barra de progreso de experiencia -->
        <h5>Experiencia</h5>
        <div class="progress mb-4" style="height: 20px;">
            <div class="progress-bar bg-warning" role="progressbar"
                style="width: {{ min(Auth::user()->experiencia / 100 * 100, 100) }}%;">
                {{ Auth::user()->experiencia }} XP
            </div>
        </div>

        <form class="profile-form text-start" method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('POST')

            <div class="mb-3">
                <label class="form-label">Imagen de perfil</label>
                <div class="d-flex justify-content-between flex-wrap">
                    @php
                        $opciones = ['amarillo.PNG', 'azulito.PNG', 'verde.PNG', 'rojo.PNG'];
                    @endphp
                    @foreach ($opciones as $img)
                        <label class="me-2 mb-2 avatar-holder {{ Auth::user()->imagen === $img ? 'selected' : '' }}"
                            style="cursor:pointer;">
                            <input type="radio" name="imagen" value="{{ $img }}" class="d-none"
                                {{ Auth::user()->imagen === $img ? 'checked' : '' }}>
                            <img src="{{ asset('img/robots/' . $img) }}" alt="{{ $img }}" width="60" height="60">
                        </label>
                    @endforeach
                </div>
            </div>

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control"
                    value="{{ Auth::user()->nombre }}" required>
            </div>

            <div class="mb-3">
                <label for="apellido" class="form-label">Apellido</label>
                <input type="text" name="apellido" id="apellido" class="form-control"
                    value="{{ Auth::user()->apellido }}" required>
            </div>

            <button type="submit" class="btn btn-warning w-100">💾 Guardar cambios</button>
        </form>

        @if (session('success'))
            <div class="alert alert-success mt-3">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger mt-3">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <a href="{{ route('views.UsuarioHome') }}" class="btn btn-link mt-3">← Volver al inicio</a>
    </div>
@endsection

@section('head')
    <style>
        .profile-container {
            max-width: 420px;
            margin: 3rem auto;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 0 25px #ffc10733;
            padding: 2rem;
        }

        .profile-picture {
            display: flex;
            justify-content: center;
        }

        .profile-img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 50%;
            border: 4px solid #ffc107;
        }

        .progress {
            background-color: #e9ecef;
            border-radius: 30px;
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

        .avatar-holder.selected,
        .avatar-holder input:checked+img {
            border-color: #ffc107 !important;
            box-shadow: 0 0 12px #ffc107;
            background: #fffbe6;
        }

        .avatar-holder img {
            border-radius: 50%;
            display: block;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const holders = document.querySelectorAll('.avatar-holder');
            holders.forEach(holder => {
                holder.addEventListener('click', function () {
                    holders.forEach(h => h.classList.remove('selected'));
                    this.classList.add('selected');
                });
            });
        });
    </script>
@endsection
