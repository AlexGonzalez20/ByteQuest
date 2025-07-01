@extends('Usuarios.layout')
@section('title', 'Camino')
@section('content')
<h2 class="mb-4">Camino de Aprendizaje</h2>
<div class="path-container">
    <div class="circle" style="top:10%;left:10%;" onclick="window.location.href='{{ route('views.UPreguntas')}}'">1</div>
    <div class="circle" style="top:25%;left:25%;" onclick="window.location.href='{{ route('views.UPreguntas', ['id'=>2]) }}'">2</div>
    <div class="circle" style="top:40%;left:40%;" onclick="window.location.href='{{ route('views.UPreguntas', ['id'=>3]) }}'">3</div>
    <div class="circle" style="top:55%;left:60%;" onclick="window.location.href='{{ route('views.UPreguntas', ['id'=>4]) }}'">4</div>
    <div class="circle" style="top:70%;left:80%;" onclick="window.location.href='{{ route('views.UPreguntas', ['id'=>5]) }}'">5</div>
</div>
@endsection
@section('head')
<style>
    .path-container {
        position: relative;
        height: 70vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .circle {
        position: absolute;
        width: 70px;
        height: 70px;
        border-radius: 50%;
        background: #fff;
        border: 3px solid #ffc107;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        color: #222;
        box-shadow: 0 0 10px #ffc10744;
        transition: box-shadow 0.2s, transform 0.2s;
        cursor: pointer;
        pointer-events: auto;
    }
    .circle:hover {
        box-shadow: 0 0 20px #ffc107;
        transform: scale(1.1);
    }
</style>
@endsection