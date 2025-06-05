<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <script src="{{ asset('js/dashboard.js') }}"></script>
    @vite('resources/css/dashboard.css')

    <title>DashBoard</title>
</head>

<body>
    <section>
        <!-- MENU -->
        <div class="nav">
            <ul>
                <li>
                    <a href="#">
                        <span class="icono">
                            <ion-icon name="aperture"></ion-icon>
                        </span>
                        <span class="titulo">Logo</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icono">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="titulo">DashBoard</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icono">
                            <ion-icon name="people-outline"></ion-icon>
                        </span>
                        <span class="titulo">Clientes</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icono">
                            <ion-icon name="cash-outline"></ion-icon>
                        </span>
                        <span class="titulo">Ventas</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icono">
                            <ion-icon name="help-circle"></ion-icon>
                        </span>
                        <span class="titulo">Ayuda</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icono">
                            <ion-icon name="cog-sharp"></ion-icon>
                        </span>
                        <span class="titulo">Configuración</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icono">
                            <ion-icon name="log-out"></ion-icon>
                        </span>
                        <span class="titulo">Cerrar Sesión</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- DashBoard -->
        <div class="container">
            <!-- Topbar -->
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-sharp"></ion-icon>
                </div>
                <div class="buscar">
                    <label for="">
                        <input type="text" placeholder="Buscar..." name="" id="">
                    </label>
                </div>
                <div class="perfil-usuario">
                    <img src="https://alfabetajuega.com/hero/2021/12/one-piece-chopper-fan-art.jpg?width=1200&aspect_ratio=16:9"
                        alt="hola">
                </div>
            </div>
            <!-- Fin Barra Superior -->

            <!-- Cards -->

            <!-- Fin Cards -->
            <div class="detalles">

            </div>
        </div>
    </section>
    <!-- scripts -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></>
            <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>