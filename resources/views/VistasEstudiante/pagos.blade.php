@extends('layouts.estudiante')

@section('title', 'Pagos')

@section('head')
<style>
    .payment-container {
        max-width: 600px;
    }

    .payment-card {
        background: linear-gradient(135deg, #333661 0%, #1a1a2e 100%);
        border: 1px solid rgba(255, 255, 255, 0.05);
        border-radius: 1rem;
    }

    .payment-card:hover {
        transform: translateY(-4px);
        transition: transform 0.4s ease;
    }

    .payment-amount {
        font-size: 2rem;
        font-weight: 700;
    }

    .btn-pay {
        font-size: 1.2rem;
        padding: 0.75rem 2.5rem;
        border-radius: 50px;
        font-weight: 500;
    }
</style>
@endsection

@section('content')
<div class="container my-5 d-flex justify-content-center">
    <div class="payment-container w-100">
        <div class="card payment-card text-white p-5 shadow">
            <h2 class="fw-bold mb-4 text-center">Resumen de compra</h2>

            <div class="mb-4 text-center">
                <h3 class="fw-bold">{{ $producto }}</h3>
                <p class="text-secondary mb-2">Pago seguro y protegido</p>
                <div class="payment-amount text-success">${{ number_format($precio, 2) }}</div>
            </div>

            <form action="{{ route('pago.checkout') }}" method="POST" class="text-center">
                @csrf
                <input type="hidden" name="title" value="{{ $producto }}">
                <input type="hidden" name="price" value="{{ $precio }}">
                <button type="submit" class="btn btn-success btn-pay shadow w-100 mb-3">
                    Ir a Pagar
                </button>
            </form>


            <div class="text-center">
                <a href="{{ route('tienda') }}" class="btn btn-link text-secondary">← Volver a la tienda</a>
            </div>
        </div>
    </div>
</div>
@endsection