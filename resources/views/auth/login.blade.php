<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    @vite('resources/css/login.css')
</head>

<body class="bg-light">

    <div class="container py-5">
        <!-- Encabezado -->
        <div class="text-center mb-4">
            <header class="header">
                <a href="{{ route('landing') }}" class="text-decoration-none ">
                    ¡Bienvenido a ByteQuest!
                </a>
            </header>
        </div>

        <!-- Contenido principal -->
        <div class="row align-items-center">
            <!-- Imagen -->
            <div class="caja1 col-lg-6 text-center mb-4 mb-lg-0">
                <img src="{{ asset('img/robot.png') }}" alt="ROBOT" class="img-fluid" style="max-height: 400px;">
            </div>

            <!-- Formulario -->
            <div class="col-lg-6">
                <div class="card-form shadow p-4">
                    <h2 class="mb-4 text-center">POR FAVOR INGRESA TUS DATOS</h2>

                    @if(session('error'))
                        <div class="alert alert-danger text-center">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <input type="email" name="email" class="form-control text-center"
                                placeholder="Ingresa tu correo" required>
                        </div>

                        <div class="mb-3">
                            <input type="password" name="password" class="form-control text-center"
                                placeholder="Contraseña" required>
                        </div>

                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary">Ingresar</button>
                        </div>

                        <div class="text-center">
                            <a href="{{ route('register') }}" class="d-block mb-2 text-decoration-none">¿No tienes
                                cuenta? <br> ¡Regístrate
                                Ahora!</a>
                            <a href="{{ route('password.request') }}" class="d-block text-decoration-none">¿Olvidaste tu
                                contraseña?</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center ">
            <h6 class="text-muted pt-5 d-flex justify-content-center align-items-center ">Para mas información consultar
                la web de <a class="d-block text-decoration-none text-white" href="{{ route('landing') }}">ByteQuest</a>
            </h6>
        </div>
    </div>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>