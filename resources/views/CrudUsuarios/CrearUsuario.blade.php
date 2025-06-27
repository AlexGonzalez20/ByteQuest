@extends('layouts.app')

@section('title', 'Añadir Usuario')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">

                {{-- Breadcrumb --}}
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('views.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('usuarios.index') }}">Usuarios</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Añadir Usuario</li>
                    </ol>
                </nav>

                <div class="card shadow">
                    <div class="card-header bg-info text-white">
                        <h4 class="mb-0">Nuevo Usuario</h4>
                    </div>
                    <div class="card-body">

                        {{-- Validación global --}}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $e)
                                        <li>{{ $e }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('usuarios.store') }}">
                            @csrf

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control @error('nombre') is-invalid @enderror"
                                            id="nombre" name="nombre" placeholder="Nombre" value="{{ old('nombre') }}">
                                        <label for="nombre">Nombre</label>
                                        @error('nombre')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control @error('apellido') is-invalid @enderror"
                                            id="apellido" name="apellido" placeholder="Apellido"
                                            value="{{ old('apellido') }}">
                                        <label for="apellido">Apellido</label>
                                        @error('apellido')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            id="email" name="email" placeholder="Correo Electrónico"
                                            value="{{ old('email') }}">
                                        <label for="email">Correo Electrónico</label>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                            id="password" name="password" placeholder="Contraseña">
                                        <label for="password">Contraseña</label>
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select class="form-select @error('rol_id') is-invalid @enderror" id="rol_id"
                                            name="rol_id">
                                            <option value="" disabled {{ old('rol_id') ? '' : 'selected' }}>
                                                Seleccione un rol</option>
                                            <option value="1" {{ old('rol_id') == 1 ? 'selected' : '' }}>Administrador
                                            </option>
                                            <option value="2" {{ old('rol_id') == 2 ? 'selected' : '' }}>Usuario
                                            </option>
                                        </select>
                                        <label for="rol_id">Rol</label>
                                        @error('rol_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4 d-flex justify-content-between">
                                <a href="{{ route('usuarios.index') }}" class="btn btn-outline-secondary">
                                    Cancelar
                                </a>
                                <button type="submit" class="btn btn-info">
                                    Guardar Usuario
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
