<!DOCTYPE html>
<html lang="en">
<!--divinectorweb.com-->

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ByteQuest</title>

    <!-- All CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    @vite('resources/css/landing.css')
    @vite('resources/css/bootstrap.min.css')
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{route('views.prueba')}}"><span class="text-warning">Byte</span>Quest</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Inicio</a>
                    </li>   
                    <li class="nav-item">
                        <a class="nav-link" href="#about">Sobre Nosotros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#services">Servicios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#portfolio">Proyectos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contáctanos</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="btn btn-byte me-2 ">Login</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('register') }}" class="btn btn-byte ">Registro</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>



    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{asset('img/home4.jpg')}}" class="d-block w-100" alt="...">
                <div class="carousel-caption">
                    <h5>Aprende a Programar desde Cero</h5>
                    <p>Descubre el mundo del desarrollo web, y de software con nuestros cursos prácticos, dinámicos y
                        pensados para todos.</p>
                    <p><a href="#" class="btn  mt-3">Explora nuestros cursos</a></p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{asset('img/home-1.jpg')}}" class="d-block w-100" alt="...">
                <div class="carousel-caption">
                    <h5>Comprometidos con tu Futuro</h5>
                    <p>Nuestra misión es brindarte las herramientas necesarias para crecer profesionalmente en el sector
                        tecnológico.</p>
                    <p><a href="#" class="btn mt-3">Ver más</a></p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{asset('img/home-3.jpg')}}" class="d-block w-100" alt="...">
                <div class="carousel-caption">
                    <h5>Construimos Soluciones Reales</h5>
                    <p>A través de proyectos colaborativos, nuestros estudiantes aplican sus conocimientos en escenarios
                        reales.</p>
                    <p><a href="#" class="btn  mt-3">Mira nuestros proyectos</a></p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- about section starts -->
    <section id="about" class="about section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-12 col-12">
                    <div class="about-img">
                        <img src="{{asset('img/bytey.png')}}" alt="" class="img-fluid">
                    </div>
                </div>
                <div class="col-lg-8 col-md-12 col-12 ps-lg-5 mt-md-5">
                    <div class="about-text">
                        <h2>Formación Tecnológica <br /> con Propósito</h2>
                        <p>En ByteQuest, ofrecemos un enfoque educativo práctico y actualizado. Nuestro objetivo es
                            formar desarrolladores capaces de enfrentar los desafíos del mundo digital actual, con
                            habilidades técnicas, pensamiento crítico y trabajo en equipo.</p>
                        <a href="#" class="btn ">Conoce nuestra filosofía</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- about section Ends -->
    <!-- services section Starts -->
    <section class="services section-padding" id="services">
        <div class="container">
            <div class="row">
                <div class="col-md-12 ">
                    <div class="section-header text-center pb-5">
                        <h2>Nuestros servicios</h2>
                        <p>Formamos desarrolladores con visión de futuro,<br> combinando teoría, práctica y tecnología
                            de punta. </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-12 col-lg-4">
                    <div class="card text-white text-center bg-dark pb-2">
                        <div class="card-body mt-2">
                            <i class="bi bi-laptop"></i>
                            <h3 class="card-title">Formación de Alta Calidad</h3>
                            <p class="lead">Cursos diseñados por profesionales del sector. Contenido actualizado,
                                ejercicios reales y acompañamiento personalizado en cada etapa de tu aprendizaje.</p>
                            <button class="btn ">Ver detalles</button>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-4">
                    <div class="card text-white text-center bg-dark pb-2">
                        <div class="card-body mt-2">
                            <i class="bi bi-journal"></i>
                            <h3 class="card-title">Comunidad y Mentores</h3>
                            <p class="lead">Únete a una comunidad activa de estudiantes, desarrolladores y mentores que
                                te ayudarán a crecer en cada paso de tu formación.</p>
                            <button class="btn">Ver detalles</button>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-4">
                    <div class="card text-white text-center bg-dark pb-2">
                        <div class="card-body mt-2">
                            <i class="bi bi-intersect"></i>
                            <h3 class="card-title">Desarrollo Ético y Profesional</h3>
                            <p class="lead">Fomentamos una formación basada en valores como la integridad, el respeto y
                                la responsabilidad
                                tecnológica.</p>
                            <button class="btn">Ver detalles</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- services section Ends -->

    <!-- portfolio strats -->
    <section id="portafolio" class="portafolio section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-header text-center pb-5">
                        <h2>Proyectos que Transforman</h2>
                        <p>Descubre cómo nuestros estudiantes aplican sus conocimientos para resolver desafíos
                            reales,<br>desarrollar soluciones digitales y crear tecnología con propósito.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-12 col-lg-4">
                    <div class="card text-light text-center  pb-2">
                        <div class="card2">
                            <div class="img-area mb-4">
                                <img src="{{asset('img/card1.jpg')}}" class="img-fluid rounded-4" alt="">
                            </div>
                            <h3 class="card-title">Plataforma de Cursos Interactivos</h3>
                            <p class="lead">Desarrollo de una aplicación web para cursos, con evaluaciones automáticas,
                                foros y retroalimentación. Proyecto liderado por estudiantes.</p>
                            <button class="btn ">Ver más</button>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-4">
                    <div class="card text-light text-center pb-2">
                        <div class="card2 ">
                            <div class="img-area mb-4">
                                <img src="{{asset('img/face.jpg')}}" class="img-fluid" alt="">
                            </div>
                            <h3 class="card-title">Sistema de Gamificación para el Aprendizaje</h3>
                            <p class="lead">ByteQuest sera una plataforma interactiva con mecánicas de juego diseñadas
                                para motivar el aprendizaje de programación. Los usuarios ganarán puntos de experiencia,
                                mantendrán rachas diarias, usarán vidas para intentos limitados, y desbloquearán logros
                                al completar retos.</p>
                            <button class="btn ">Ver más</button>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-4">
                    <div class="card text-light text-center  pb-2">
                        <div class="card2 ">
                            <div class="img-area mb-4">
                                <img src="{{asset('img/chatbot.jpg')}}" class="img-fluid" alt="">
                            </div>
                            <h3 class="card-title">Chatbot de Soporte Estudiantil</h3>
                            <p class="lead">Asistente virtual basado en IA que responde dudas frecuentes y guía a nuevos
                                estudiantes.</p>
                            <button class="btn  ">Ver más</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- portfolio ends -->

    <!-- Contact starts -->
    <section id="contact" class="contact section-padding">
        <div class="container mt-5 mb-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-header text-center pb-5">
                        <h2>Contactanos</h2>
                        <p>¿Tienes dudas o ideas? ¡Estamos listos para escucharte y subir de nivel juntos!</p>
                    </div>
                </div>
            </div>
            <div class="row m-0">
                <div class="col-md-12 p-0 pt-4 pb-4">
                    <form action="#" class="bg-light p-4 m-auto">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <input class="form-control" placeholder="Ingresa tu nombre completo" required=""
                                        type="text">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <input class="form-control" placeholder="Ingresa tu correo de contacto" required=""
                                        type="email">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <textarea class="form-control" placeholder="Cuentanos como podemos ayudarte"
                                        required="" rows="3"></textarea>
                                </div>
                            </div><button class="btn btn-lg btn-block mt-3" type="button">Contacta con
                                nuestro equipo</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- contact ends -->
    <!-- footer starts -->
    <footer class="bg-dark p-2 text-center">
        <div class="container">
            <p class="text-white">ByteQuest 2025</p>
        </div>
    </footer>
    <!-- footer ends -->



    <!-- All Js -->
    @vite('resources/js/bootstrap.bundle.min.js')
</body>

</html>




<!--for getting the form download the code from download button-->