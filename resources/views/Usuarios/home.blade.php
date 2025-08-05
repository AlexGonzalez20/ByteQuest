@extends('Usuarios.layout')
@section('title', 'Home Usuario')
@section('content')
<div class="row g-4 justify-content-center">
    <div class="col-6 col-md-3">
        <a href="{{ route('views.UCamino') }}" class="text-decoration-none">
            <div class="card icon-card text-center p-4">
                <i class='bx bx-git-branch text-primary'></i>
                <div class="mt-2">Camino</div>
            </div>
        </a>
    </div>
    <div class="col-6 col-md-3">
        <a href="{{ route('views.UMisCursos') }}" class="text-decoration-none">
            <div class="card icon-card text-center p-4">
                <i class='bx bx-book text-success'></i>
                <div class="mt-2">Mis Cursos</div>
            </div>
        </a>
    </div>
    <div class="col-6 col-md-3">
        <a href="{{ route('views.UPreguntas') }}" class="text-decoration-none">
            <div class="card icon-card text-center p-4">
                <i class='bx bx-question-mark text-info'></i>
                <div class="mt-2">Preguntas</div>
            </div>
        </a>
    </div>
    <div class="col-6 col-md-3">
        <a href="{{ route('views.UPerfil') }}" class="text-decoration-none">
            <div class="card icon-card text-center p-4">
                <i class='bx bx-user text-warning'></i>
                <div class="mt-2">Perfil</div>
            </div>
        </a>
    </div>
</div>
<h2 class="mb-4 text-center">Mis Cursos</h2>

<div class="carrusel-container">
    <button class="flecha izquierda" onclick="moverCarrusel(-1)">←</button>

    <div class="carrusel" id="carrusel">
        <div class="curso" id="curso-0">
            <img src="{{ asset('images/js.png') }}" alt="JavaScript">
            <h4>JavaScript</h4>
        </div>
        <div class="curso" id="curso-1">
            <img src="{{ asset('images/python.png') }}" alt="Python">
            <h4>Python</h4>
        </div>
        <div class="curso" id="curso-2">
            <img src="{{ asset('images/php.png') }}" alt="PHP">
            <h4>PHP</h4>
        </div>
    </div>

    <button class="flecha derecha" onclick="moverCarrusel(1)">→</button>

    <div class="botones text-center mt-3">
        <a href="#" class="btn btn-primary">Ir al curso</a>
        <a href="#" class="btn btn-outline-secondary">Progreso</a>
    </div>
</div>
@endpush

@push('scripts')
<script>
    const cursos = document.querySelectorAll('.curso');
    let index = 0;

    function actualizarVista() {
        cursos.forEach((curso, i) => {
            curso.classList.remove('activo');
        });
        cursos[index].classList.add('activo');
    }

    function moverCarrusel(direccion) {
        index = (index + direccion + cursos.length) % cursos.length;
        actualizarVista();
    }

    // Iniciar carrusel automático
    setInterval(() => {
        moverCarrusel(1);
    }, 2000); // cada 5 segundos

    actualizarVista(); // mostrar uno al cargar
</script>
@endpush
@section('head')
<style>
    .carrusel-container {
        position: relative;
        width: 700px;
        margin: 0 auto;
        padding: 40px 0;
        text-align: center;
    }

    .carrusel {
        display: flex;
        justify-content: center;
        align-items: flex-end;
        gap: 40px;
        transform: translateY(0);
    }

    .curso {
        transition: transform 0.4s, opacity 0.4s;
        text-align: center;
        width: 120px;
        opacity: 0.5;
        transform: scale(0.8) rotateZ(10deg);
    }

    .curso img {
        width: 100px;
        height: 100px;
        object-fit: contain;
    }

    .curso.activo {
        transform: scale(1.2) rotateZ(0deg);
        opacity: 1;
        z-index: 2;
    }

    .flecha {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        font-size: 2rem;
        background: none;
        border: none;
        cursor: pointer;
    }

    .flecha.izquierda {
        left: -30px;
    }

    .flecha.derecha {
        right: -30px;
    }
</style>
<style>
    .icon-card {
        transition: transform 0.2s;
        cursor: pointer;
    }
    .icon-card:hover {
        transform: scale(1.05);
        box-shadow: 0 0 10px #ffc107;
    }
    .icon-card i {
        font-size: 3rem;
    }
</style>
@endsection