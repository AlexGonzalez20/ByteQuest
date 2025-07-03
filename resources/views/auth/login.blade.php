<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    @vite('resources/css/login.css')
</head>

<body class="bg-dark">
    <div class="container-fluid min-vh-100 d-flex flex-column">
        <!-- Encabezado -->
        <div class="row">
            <div class="col-6 d-flex justify-content-center pt-5">
                <header class="">
                    <a href="{{ route('landing') }}" class="text-decoration-none h2 display-6 header-link">
                        ¡Bienvenido a ByteQuest!
                    </a>
                </header>
            </div>
            <div class="col-6 d-flex justify-content-center align-items-center pt-5">
                <a href="{{ route('landing') }}" class="d-flex align-items-center gap-2 text-decoration-none ">
                    <i class='bx bx-left-arrow-circle fs-1'></i>
                    <h1 class="mb-0">Home</h1>
                </a>
            </div>

        </div>

        <!-- Contenido principal -->
        <div class="row flex-grow-1 align-items-center">
            <!-- Imagen -->
            <div class="col-lg-6 d-flex justify-content-center align-items-center mb-4 mb-lg-0">
                <img src="{{ asset('img/robot.png') }}" alt="ROBOT" class="img-fluid" style="max-height: 400px;">
            </div>

            <!-- Formulario -->
            <div class="col-lg-6 d-flex justify-content-center align-items-center">
                <div class="card shadow p-4 w-100" style="max-width: 500px;">
                    <h2 class="mb-4 text-center">Inicio de Sesión</h2>
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
                            <button type="submit" class="btn btn-warning text-dark fw-bold">Ingresar</button>
                        </div>

                        <div class="text-center">
                            <a href="{{ route('password.request') }}" class="d-block text-decoration-none">¿Olvidaste tu contraseña?</a>
                            <a href="{{ route('register') }}" class="d-block mb-2 text-decoration-none">¿Nuevo usuario? Regístrate ahora</a>
                        </div>


                        @if($errors->any())
                        <div class="alert alert-danger text-center mt-3">
                            Correo o contraseña incorrectos.
                        </div>

                        @endif
                    </form>
                </div>
            </div>
        </div>


    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>