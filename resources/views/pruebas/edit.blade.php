@extends('layouts.admin')

@section('title', 'Editar Prueba')

@section('head')
@endsection

@section('content')
    <div class="container mt-5 p-4 rounded bg-white bg-opacity-75 shadow">
        <h1 class="mb-4">Editar Prueba #{{ $prueba->id }}</h1>

        {{-- 🔴 Bloque para mostrar errores --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <h5 class="mb-2">Se encontraron los siguientes errores:</h5>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('pruebas.update', $prueba->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="orden" class="form-label">Orden</label>
                <input type="number" name="orden" id="orden" class="form-control"
                    value="{{ old('orden', $prueba->orden) }}" min="1" required>
            </div>

            <div class="mb-3">
                <label for="xp" class="form-label">XP</label>
                <input type="number" name="xp" id="xp" class="form-control"
                    value="{{ old('xp', $prueba->xp) }}" min="0" required>
            </div>

            <div class="mb-3">
                <label for="leccion_id" class="form-label">Lección</label>
                <select name="leccion_id" id="leccion_id" class="form-select" required>
                    @foreach ($lecciones as $leccion)
                        <option value="{{ $leccion->id }}" {{ $prueba->leccion_id == $leccion->id ? 'selected' : '' }}>
                            {{ $leccion->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Actualizar Prueba</button>
            <a href="{{ route('pruebas.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
