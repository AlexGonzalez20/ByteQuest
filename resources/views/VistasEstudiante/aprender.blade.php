@extends('layouts.estudiante')
@section('title', 'Catalogo de Cursos')
@section('content')
<h2 class="mb-4 text-light">Escoge tu curso</h2>


 <div class="accordion" id="accordionCursos">


 @php
$pruebasPorCurso = $pruebas->groupBy(function($prueba) {
return $prueba->leccion && $prueba->leccion->curso
? $prueba->leccion->curso->nombre
: 'Sin Curso';
});
@endphp

@foreach ($pruebasPorCurso as $cursoNombre => $pruebasDelCurso)
<div class="accordion-item mb-2">
    <h2 class="accordion-header" id="heading-{{ Str::slug($cursoNombre) }}">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapse-{{ Str::slug($cursoNombre) }}" aria-expanded="false"
            aria-controls="collapse-{{ Str::slug($cursoNombre) }}">
            {{ $cursoNombre }}
        </button>
    </h2>
    <div id="collapse-{{ Str::slug($cursoNombre) }}" class="accordion-collapse collapse"
        aria-labelledby="heading-{{ Str::slug($cursoNombre) }}"
        data-bs-parent="#accordionCursos">
        <div class="accordion-body">

            @php
            $pruebasPorLeccion = $pruebasDelCurso->groupBy(function($prueba) {
            return $prueba->leccion ? $prueba->leccion->nombre : 'Sin Lección';
            });
            @endphp

            <div class="accordion" id="accordion-{{ Str::slug($cursoNombre) }}">
                @foreach ($pruebasPorLeccion as $leccionNombre => $pruebasDeLaLeccion)
                <div class="accordion-item mb-2">
                    <h2 class="accordion-header" id="heading-{{ Str::slug($cursoNombre . '-' . $leccionNombre) }}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse-{{ Str::slug($cursoNombre . '-' . $leccionNombre) }}"
                            aria-expanded="false"
                            aria-controls="collapse-{{ Str::slug($cursoNombre . '-' . $leccionNombre) }}">
                            {{ $leccionNombre }}
                        </button>
                    </h2>
                    <div id="collapse-{{ Str::slug($cursoNombre . '-' . $leccionNombre) }}"
                        class="accordion-collapse collapse"
                        aria-labelledby="heading-{{ Str::slug($cursoNombre . '-' . $leccionNombre) }}"
                        data-bs-parent="#accordion-{{ Str::slug($cursoNombre) }}">
                        <div class="accordion-body">
                            <ul class="list-group">
                                @php
                                // Buscar contenido relacionado a esta lección por nombre
                                $contenidoRelacionado = collect($datos)->firstWhere('nombre', $leccionNombre);
                                @endphp

                                @if (!empty($contenidoRelacionado) && !empty($contenidoRelacionado['contenido']))
                                <div id="carouselLeccion{{ Str::slug($cursoNombre . '-' . $leccionNombre) }}" class="carousel slide mb-4" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        @foreach ($contenidoRelacionado['contenido'] as $indexContenido => $seccion)
                                        <div class="carousel-item {{ $indexContenido === 0 ? 'active' : '' }}">
                                            <div class="p-4 text-center bg-white rounded shadow">
                                                <h4 class="mb-2">{{ $seccion['titulo'] }}</h4>
                                                <h6 class="text-secondary">{{ $seccion['subtitulo'] }}</h6>
                                                <p class="mt-3">{{ $seccion['cuerpo'] }}</p>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>

                                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselLeccion{{ Str::slug($cursoNombre . '-' . $leccionNombre) }}" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Anterior</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carouselLeccion{{ Str::slug($cursoNombre . '-' . $leccionNombre) }}" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Siguiente</span>
                                    </button>
                                </div>
                                @else
                                <p class="text-muted">No hay contenido adicional en esta lección.</p>
                                @endif






                            </ul>
                        </div>
                    </div>
                </div>
                @endforeach
            </div> {{-- fin accordion-lecciones --}}
        </div> {{-- fin accordion-body del curso --}}
    </div> {{-- fin collapse del curso --}}
</div> {{-- fin accordion-item del curso --}}
@endforeach
</div> {{-- fin accordionCursos --}}
</div>
@endsection