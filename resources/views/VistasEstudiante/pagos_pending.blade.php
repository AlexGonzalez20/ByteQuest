@extends('layouts.estudiante')

@section('title', 'Pago pendiente')

@section('content')
<div class="container my-5">
  <div class="card p-4">
    <h2 class="fw-bold">Pago pendiente ⏳</h2>
    <p>Tu pago está en proceso.</p>

    <h5 class="mt-3">Datos recibidos:</h5>
    <pre>{{ print_r($data, true) }}</pre>

    <a href="{{ route('tienda') }}" class="btn btn-secondary mt-3">Volver a la tienda</a>
  </div>
</div>
@endsection
