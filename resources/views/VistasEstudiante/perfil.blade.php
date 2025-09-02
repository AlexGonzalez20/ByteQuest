@extends('layouts.estudiante')

@section('title', 'Perfil de Usuario')

@section('head')
<style>
    .profile-container {
        max-width: 60%;
        /* Más ancho */
        margin: 3rem auto;
        background: #fff;
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
</style>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const holders = document.querySelectorAll('.avatar-holder');
        holders.forEach(holder => {
            holder.addEventListener('click', function() {
                holders.forEach(h => h.classList.remove('selected'));
                this.classList.add('selected');
                this.querySelector('input').checked = true;
            });
        });
    });
</script>
@endsection

@section('content')
<div class="profile-container text-center">
    <h2 class="mb-4">👤 Mi Perfil</h2>

    <div class="profile-picture mb-4">
        <img src="{{ asset('img/robots/' . (Auth::user()->imagen ?? 'amarillo.PNG')) }}" alt="Foto de perfil"
            class="profile-img">
    </div>

    <!-- Barra de progreso de experiencia -->
    <h5>Experiencia</h5>
    <div class="progress mb-5" style="height: 22px;">
        <div class="progress-bar bg-warning" role="progressbar"
            style="width: {{ min((Auth::user()->experiencia / 100) * 100, 100) }}%;">
            {{ Auth::user()->experiencia }} XP
        </div>
    </div>

    <form class="profile-form text-start" method="POST" action="{{ route('profile.update') }}">
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
                    <img src="{{ asset('img/robots/' . $img) }}" alt="{{ $img }}" width="70"
                        height="70">
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
@endsection