<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

    <script src="https://js.cx/libs/animate.js"></script>
    @vite(['resources/css/landing.css', 'resources/js/landing.js'])
</head>

<body>

    <body>
        <div class="svg-container">
            <!-- I crated SVG with: https://codepen.io/anthonydugois/pen/mewdyZ -->
            <svg viewbox="0 0 800 600" class="svg">


                <path id="curve" fill="#252746" d="M 800 300 Q 400 350 0 300 L 0 0 L 800 0 L 800 300 Z">

                </path>
            </svg>
        </div>
        <!-- Fondo animado tipo login -->
        <div class="bg"></div>
        <div class="bg bg2"></div>
        <div class="bg bg3"></div>
        <!-- Barra de navegación -->
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top"
            style="background-color: #242546; text-shadow: 0px 2px 4px #000000;">
            <div class="container-fluid">
                <!-- Logo + Título -->
                <a class="navbar-brand d-flex align-items-center" href="{{ route('landing') }}">
                    <img class="img-nav me-2 mt-2" src="{{ asset('img/icon.png') }}" alt="byte">
                    <span class="h4 mb-0">
                        <span style="color:#00b2c3;">Byte</span>Quest
                    </span>
                </a>

                <!-- Botón de hamburguesa para pantallas pequeñas -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
                    aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Contenido del navbar -->
                <div class="collapse navbar-collapse justify-content-between" id="navbarContent">
                    <!-- Enlaces del menú -->
                    <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link text-light me-5 ms-5" href="#about">Acerca de nosotros</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light me-5 ms-5" href="#">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light me-5 ms-5" href="#portafolio">Proyectos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light me-5 ms-5" href="#services">Servicios</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light me-5 ms-5" href="#contact">Contáctanos</a>
                        </li>
                    </ul>

                    <!-- Login y Empezar -->
                    <div class="d-flex align-items-center">
                        <a class="nav-link text-light me-3" href="{{ route('login') }}">Login</a>
                        <a class="btn btn-light rounded-3 " style="background-color: ;"
                            href="{{ route('register') }}">Empezar</a>
                    </div>
                </div>
            </div>
        </nav>
        <!-- Header -->
        <header class="flex">
            <div class="d-flex justify-content-center align-items-center flex-row">
                <h2 class="fs-1 mb-0">Bienvenido a <span class="h1 fs-1" style="color:#00b2c3;">Byte</span>Quest</h2>
            </div>
        </header>

        <!-- Animación de círculos en el fondo blanco -->
        <div class="area" style="z-index:-2; position:fixed; top:0; left:0; width:100vw; height:100vh;">
            <ul class="circles">
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>
        </div>

        <!-- Contenido Central -->
        <main id="about" class="d-flex flex-column justify-content-center align-items-center h-100 ">
            <!-- Texto Magico -->
            <div class="animacion d-flex flex-column  pb-4 mb-5 w-75">
                <textarea id="textExample" rows="5" cols="60" class="textarea pb-5 text-start mb-4 ">
                    Hola!!!
                    Mi nombre es Byte y esta es nuestra plataforma de aprendizaje interactivo.
                    aqui podras aprender a programar de manera divertida y rapida nos alegra mucho tenerte aqui 
                    porfavor da click abajo para empezar
                </textarea>
                <img class="img-text mb-4" src="{{ asset('img/byte.png') }}" alt="byte">

                <a class="btn text-decoration-none lh-lg-1 mt-2 mb-4 " id="text" type="button">Conoce a Byte!</a>
            </div>

            <div class="contenido rounded-4 text-light mb-5 p-4 w-75">
                <div class="card mt-5 mb-5 p-4">
                    <h3 class="mb-4">Acerca de nosotros</h3>
                    <p class="mb-4">
                        Somos un equipo de jovenes apasionados por la tecnologia y sus beneficios, decidimos emprender
                        este viaje por la programacion para ir mas alla de tal vez solo encontrar un ingreso economico,
                        por eso decidimos crear ByteQuest, una plataforma que te ayudara a aprender a programar de
                        manera divertida y rapida, con un enfoque en la gamificacion y el aprendizaje interactivo.
                    </p>
                </div>
            </div>

            <!-- cards section -->
            <section id="portafolio" class=" portafolio section-padding">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="section-header text-center pb-3 pt-5">
                                <h2 class="">Nuestros productos</h2>
                                <p class="text-dark">Descubre cómo nuestros estudiantes aplican sus conocimientos para
                                    resolver desafíos
                                    reales,<br>desarrollar soluciones digitales y crear tecnología con propósito.</p>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center align-items-center mb-5">
                        <div class=" col-12 col-md-12 col-lg-4">
                            <div class="card text-light text-center pb-2 h-75 rounded-4 p-4 mb-4">
                                <div class="card2 ">
                                    <div class="img-area mb-4 mt-2">
                                        <img src="{{asset('img/face.jpg')}}" class="img-fluid rounded-4" alt="">
                                    </div>
                                    <h3 class="card-title text-dark mb-3">ByteQuest</h3>
                                    <p class="text-dark mb-3">ByteQuest es una plataforma interactiva con mecánicas de
                                        juego
                                        diseñadas
                                        para motivar el aprendizaje de programación. Los usuarios ganarán puntos de
                                        experiencia,
                                        mantendrán rachas diarias, usarán vidas para intentos limitados, y desbloquearán
                                        logros
                                        al completar retos.</p>
                                    <button class="btn border-bottom mb-2">Ver más</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- services -->
                    <section class="services section-padding " id="services">
                        <div class="container">
                            <div class="row ">
                                <div class="col-md-12">
                                    <div class="section-header text-center pb-2 pt-5">
                                        <h2>Nuestros servicios</h2>
                                        <p class="lead">Formamos desarrolladores con visión de futuro,<br> combinando
                                            teoría,
                                            práctica y
                                            tecnología
                                            de punta. </p>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center align-items-stretch flex-wrap mb-5"
                                style="gap: 32px;">
                                <div class="service-card text-light">
                                    <div class="card-body text-center  pb-2 mt-2 service-card">
                                        <i class="bi bi-laptop"></i>
                                        <h2 class="card-title service-title text-light">Interfaz amigable</h2>
                                        <button class="btn service-btn">Ver detalles</button>
                                    </div>
                                </div>
                                <div class="service-card text-light">
                                    <div class="card-body text-center  pb-2 mt-2 service-card">
                                        <i class="bi bi-journal"></i>
                                        <h2 class="card-title service-title
                                        text-light">Interfaz </h2>
                                        <button class="btn service-btn">Ver detalles</button>
                                    </div>
                                </div>
                                <div class="service-card text-light">
                                    <div class="card-body text-center  pb-2 mt-2 service-card">
                                        <i class="bi bi-intersect"></i>
                                        <h3 class="card-title service-title text-light">Desarrollo Ético y Profesional
                                        </h3>
                                        <button class="btn service-btn ">Ver detalles</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section id="contact" class="contact section-padding mt-5 mb-5 p-5">
                        <div class="container mt-5 mb-5">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="section-header text-center pb-5">
                                        <h2>Contactanos</h2>
                                        <p>¿Tienes dudas o ideas? ¡Estamos listos para escucharte y subir de nivel
                                            juntos!</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row m-0">
                                <div class="col-md-12 p-0">
                                    <form action="#" class=" m-auto">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <input class="form-control" placeholder="Ingresa tu nombre completo"
                                                        required="" type="text">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <input class="form-control"
                                                        placeholder="Ingresa tu correo de contacto" required=""
                                                        type="email">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <textarea class="form-control"
                                                        placeholder="Cuentanos como podemos ayudarte" required=""
                                                        rows="3"></textarea>
                                                </div>
                                            </div><button class="btn btn-lg btn-block mt-3 text-light"
                                                type="button">Contacta con
                                                nuestro equipo</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </section>
        </main>
        <footer>
            <p style="font-weight: bold;">ByteQuest&copy;2025 all rights reserved.</p>
            <small>prueba algo diferente, <a href="https://youtu.be/xTxA1skdZsY?si=byI3iOAL5Y1PEmNf"
                    target="_blank">??</a>.</small>
        </footer>
    </body>
</body>

</html>