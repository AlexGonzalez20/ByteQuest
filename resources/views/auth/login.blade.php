<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>


    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    @vite('resources/css/login.css')
</head>

<body>
    <div class="container-fluid ">
        <!-- Encabezado -->
        <div class="text-center mb-4">
            <header class="header pt-1">
                <a href="{{ route('landing') }}" class="text-decoration-none h2 d-flex justify-content-start ms-5 ">
                    ¡Bienvenido a ByteQuest!
                </a>
            </header>
        </div>

        <!-- Contenido principal -->
        <div class="row align-items-center pt-3">
            <!-- Imagen -->
            <div class="col-lg-6 d-flex justify-content-center align-items-center mb-0 mb-lg-0">
                <img src="{{ asset('img/robot.png') }}" alt="ROBOT" class="img-fluid" style="max-height: 400px;">
            </div>

            <!-- Formulario -->
            <div class="col-lg-6 d-flex justify-content-center align-items-center">
                <div class="card shadow-lg p-4 w-100" style="max-width: 400px;">
                    <h2 class="mb-4 text-center">Inicio de Sesión</h2>
                    <div class="text-center">
                        <a href="{{ route('register') }}" class="d-block mb-2 text-decoration-none">Nuevo user?
                            Registrate ahora</a>
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
                                <button type="submit" class="boton  btn">Ingresar</button>
                            </div>

                            <div class="text-center">

                                <a href="{{ route('password.request') }}"
                                    class="d-block text-decoration-none">¿Olvidaste tu
                                    contraseña?</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="footer text-center mt-4">
                <h6 class="pt-5 ">
                    <a class="text-decoration-none d-flex justify-content-end" href="{{ route('landing') }}"><i
                            class='bx bx-left-arrow-circle'></i> </a>
                </h6>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>