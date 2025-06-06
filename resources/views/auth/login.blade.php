<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>ByteQuest</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- clave para móviles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}"> @vite('resources/css/login.css')
    <!-- Asumiendo que usarás el CSS externo -->
</head>

<body>
    <div class="main-container">
        <!-- Header -->
        <header class="text-center">
            <h1>¡Bienvenido a ByteQuest!</h1>
        </header>

        <!-- Contenido principal -->
        <div class="container content flex-grow-1 d-flex align-items-center justify-content-center">
            <div class="row w-100 align-items-center">
                <!-- Imagen -->
                <div class="col-12 col-md-6 text-center mb-4 mb-md-0">
                    <img src="{{ asset('img/byte.png') }}" alt="Robot" class="img-fluid robot-img">
                </div>

                <!-- Formulario -->
                <div class="col-12 col-md-6 ">
                    <div class="card p-4 shadow ">
                        <h4 class="card-title mb-3 text-center">Por favor ingresa tus datos</h4>

                        @if(session('error'))
                            <p class="text-danger">{{ session('error') }}</p>
                        @endif

                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <input type="email" class="form-control" name="correo" placeholder="Ingresa tu correo"
                                required>
                            <input type="password" class="form-control mt-5" name="password" placeholder="Contraseña"
                                required>
                            <button type="submit" class="btn btn-primary w-100 mt-5">Ingresar</button>

                            <!-- Links -->
                            <div class="text-center mt-3">
                                <a href="#">¿Olvidaste tu contraseña?</a><br>
                                <a href="{{ route('register') }}">¿No tienes cuenta? ¡Regístrate ahora!</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer>
            <a href="#" class="mt-2">Contactanos para mas información</a>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
</body>

</html>