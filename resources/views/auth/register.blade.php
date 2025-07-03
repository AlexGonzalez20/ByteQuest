<!DOCTYPE html>
<html lang="es">

<head>
  <title>Registro - ByteQuest</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Google Fonts -->
  <link rel="stylesheet" href="{{ asset('css/register.css') }}">
  @vite('resources/css/register.css')
</head>

<body>
  <div class="container">
    <header class="header">
      <h2><a href="{{ route('landing') }}" class="header-link">Registrarse</a></h2>
    </header>

    <div class="formulario">
      <div class="card-form">
        @if ($errors->any())
          <div class="errors">
            <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form method="POST" action="/register">
          @csrf

          <label for="nombre">Nombre:</label>
          <input type="text" name="nombre" id="nombre" required placeholder="Nombre">

          <label for="apellido">Apellido:</label>
          <input type="text" name="apellido" id="apellido" required placeholder="Apellido">

          <label for="email">Correo:</label>
          <input type="email" name="email" id="email" placeholder="Correo" required>

          <label for="password">Contraseña:</label>
          <input type="password" name="password" id="password" placeholder="Contraseña" required>

          <label for="password_confirmation">Confirmar Contraseña:</label>
          <input type="password" name="password_confirmation" id="password_confirmation" required placeholder="Confirmar Contraseña">

          <button type="submit">Registrarse</button>
        </form>
        <a href="/login">¿Ya tienes cuenta? Inicia sesión</a>
      </div>
    </div>
  </div>
</body>
</html>
