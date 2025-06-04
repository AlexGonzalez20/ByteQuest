<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
        @vite('resources/css/dashboard.css')
</head>
<body>
<header>
<nav>
    <ul>
        <li><a href="">Inicio</a></li>
        <li><a href="">Usuarios</a></li>
        <li><a href="{}">Cerrar sesión</a></li>
    </ul>
</nav>
</header>
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Panel de Administración</h1>

    {{-- Botón de Cerrar sesión --}}
    <form action="{{ route('logout') }}" method="POST" style="margin-bottom: 20px;">
        @csrf
        <button type="submit" style="background-color: #dc3545; color: white; border: none; padding: 10px 15px; cursor: pointer;">
            Cerrar sesión
        </button>
    </form>

    <h2>Lista de Usuarios</h2>
    <table border="1" cellpadding="8">
        <thead>
            <tr>
                <th>ID</th>
                <th>Correo</th>
                <th>Fecha de creación</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->id }}</td>
                    <td>{{ $usuario->correo }}</td>
                    <td>{{ $usuario->created_at->format('d/m/Y H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">No hay usuarios registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection


<footer>
    <p>&copy; 2025 ByteQuest. Todos los derechos reservados.</p>
</footer>
</body>
</html>