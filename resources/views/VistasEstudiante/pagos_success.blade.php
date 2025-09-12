@extends('layouts.estudiante')

@section('title', 'Pago exitoso')

@section('content')
<div class="container my-5">
    <div class="card p-4 text-center">
        <h2 class="fw-bold text-success">✅ Pago exitoso</h2>
        <p>Gracias por tu compra.</p>

        @if(isset($producto) && $producto != '')
            <h4 class="mt-3">Producto adquirido:</h4>
            <p class="fw-bold">{{ $producto }}</p>
        @endif

        {{-- Opcional: mostrar datos de MercadoPago solo para debugging --}}
        @if(config('app.debug'))
            <h5 class="mt-3">Datos recibidos:</h5>
            <pre>{{ print_r($data, true) }}</pre>
        @endif

        <a href="{{ route('tienda') }}" class="btn btn-primary mt-3">Volver a la tienda</a>
    </div>
</div>
@endsection
