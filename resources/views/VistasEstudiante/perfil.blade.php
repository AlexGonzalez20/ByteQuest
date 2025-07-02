@extends('layouts.estudiante')
@section('title', 'Perfil de Usuario')
@section('content')
    <div class="profile-container">
        <h2>Mi Perfil</h2>
        <form class="profile-form" method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <img src="{{ Auth::user()->imagen ? asset('storage/' . Auth::user()->imagen) : asset('img/robot.png') }}"
                alt="Foto de perfil" class="profile-img">
            <label for="imagen">Imagen de perfil</label>
            <input type="file" name="imagen" id="imagen" accept="image/*">

            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" value="{{ Auth::user()->nombre }}" required>

            <label for="apellido">Apellido</label>
            <input type="text" name="apellido" id="apellido" value="{{ Auth::user()->apellido }}" required>

            <button type="submit" class="btn btn-warning w-100 mt-3">Guardar cambios</button>
        </form>
        @if (session('success'))
            <p style="color: green;">{{ session('success') }}</p>
        @endif
        @if ($errors->any())
            <ul style="color: red;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <a href="{{ route('views.UsuarioHome') }}" class="btn btn-link mt-3">Volver al inicio</a>
    </div>
@endsection
@section('head')
    <style>
        .profile-container {
            max-width: 400px;
            margin: 3rem auto;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 0 20px #ffc10733;
            padding: 2rem;
        }

        .profile-img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 1rem;
        }

        .profile-form label {
            margin-top: 1rem;
        }
    </style>
@endsection
