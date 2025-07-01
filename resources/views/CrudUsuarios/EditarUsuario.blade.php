@extends('layouts.admin')

@section('title', 'Editar Usuario')

@section('head')

@endsection

@section('content')
<div class="container mt-5 p-4 rounded bg-white bg-opacity-75 shadow">
    <h2 class="mb-4">Editar Usuario</h2>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('usuarios.update', $usuario->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre', $usuario->nombre) }}" required>
        </div>

        <div class="mb-3">
            <label for="apellido" class="form-label">Apellido</label>
            <input type="text" class="form-control" id="apellido" name="apellido" value="{{ old('apellido', $usuario->apellido) }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Correo Electrónico</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $usuario->email) }}" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Contraseña (opcional)</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Dejar en blanco para no cambiarla">
        </div>

        <div class="mb-3">
            <label for="rol_id" class="form-label">Rol</label>
            <select class="form-control mb-4" id="rol_id" name="rol_id" required>
                <option value="1" {{ $usuario->rol_id == 1 ? 'selected' : '' }}>Estudiante</option>
                <option value="2" {{ $usuario->rol_id == 2 ? 'selected' : '' }}>Administrador</option>
            </select>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-warning">Actualizar</button>
            <a href="{{ route('usuarios.index') }}" class="btn btn-danger">Cancelar</a>
        </div>
    </form>
</div>
@endsection