<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    @extends('layouts.app')
    @section('content')
        <div class="container">
            <h1>Panel de Administración</h1>
            {{-- Botón de Cerrar sesión --}}
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit">
                    Cerrar sesión
                </button>
            </form>
</body>
</html>