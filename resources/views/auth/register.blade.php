<!DOCTYPE html>
<html lang="es">

<head>
  <title>Registro - ByteQuest</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Boxicons para el icono -->
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <!-- Fondo animado y fuente Montserrat -->
  <link rel="stylesheet" href="{{ asset('css/register.css') }}">
  @vite('resources/css/register.css')
</head>

<body>
  <div class="hero">
    <div class="cube"></div>
    <div class="cube"></div>
    <div class="cube"></div>
    <div class="cube"></div>
    <div class="cube"></div>
    <div class="cube"></div>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
      <div class="card shadow-lg p-5"
        style="max-width: 600px; width: 100%; border-radius: 18px; background-color: #252746; color: whitesmoke;">
        <div class="d-flex justify-content-end align-items-center mb-4">
          <a href="{{ route('landing') }}"
            class="sbutton text-light btn btn-outline-info d-flex align-items-center gap-2">
            <i class='bx bx-left-arrow-circle fs-3'></i>
            <span>Regresar</span>
          </a>
        </div>
        @if ($errors->any())
          <div class="alert alert-danger">
            <ul class="mb-0">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif
        <h2 class="mb-4 text-center" style="font-size: 1.5rem;">Registrarse</h2>
        <form method="POST" action="/register">
          @csrf
          <div class="mb-3">
            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" name="nombre" id="nombre" class="form-control" required placeholder="Nombre">
          </div>
          <div class="mb-3">
            <label for="apellido" class="form-label">Apellido:</label>
            <input type="text" name="apellido" id="apellido" class="form-control" required placeholder="Apellido">
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Correo:</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="Correo" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Contraseña:</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Contraseña" required>
          </div>
          <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirmar Contraseña:</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required
              placeholder="Confirmar Contraseña">
          </div>
          <button type="submit" class="sbutton btn btn-primary w-100">Registrarse</button>
        </form>
        <a href="/login" class=" d-flex justify-content-center mt-3">¿Ya tienes cuenta? Inicia sesión</a>
      </div>
    </div>
  </div>
  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>