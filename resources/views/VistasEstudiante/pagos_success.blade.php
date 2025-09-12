@extends('layouts.estudiante')

@section('title', 'Pago exitoso')

@section('content')
    <div class="container my-5">
        <div class="card p-4 text-center">
            <h2 class="fw-bold text-success">✅ Pago exitoso</h2>
            <p>Gracias por tu compra.</p>

            @if (isset($producto) && $producto != '')
                <h4 class="mt-3">Producto adquirido:</h4>
                <p class="fw-bold">{{ $producto }}</p>
            @endif

            <h4 class="mt-4">Detalles de la transacción:</h4>
            <ul class="list-group text-start mt-3">
                <li class="list-group-item"><strong>ID de pago:</strong> {{ $data['payment_id'] ?? 'N/A' }}</li>
                <li class="list-group-item"><strong>Estado:</strong> {{ $data['status'] ?? 'N/A' }}</li>
                <li class="list-group-item"><strong>Collection ID:</strong> {{ $data['collection_id'] ?? 'N/A' }}</li>
                <li class="list-group-item"><strong>Orden:</strong> {{ $data['merchant_order_id'] ?? 'N/A' }}</li>
            </ul>

            <a href="{{ route('tienda') }}" class="btn btn-primary mt-4">Volver a la tienda</a>
        </div>
    </div>
@endsection
