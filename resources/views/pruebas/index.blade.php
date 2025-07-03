@extends('layouts.admin')

@section('title', 'Gestión de Pruebas')

@section('head')
@endsection

@section('content')
    <div class="container mt-5 p-4 rounded bg-white bg-opacity-75 shadow">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0">Gestión de Pruebas</h1>
            <a href="{{ route('pruebas.create') }}" class="btn btn-info">Añadir Prueba</a>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Orden</th>
                    <th scope="col">XP</th>
                    <th scope="col">Lección</th>
                    <th scope="col">Editar</th>
                    <th scope="col">Eliminar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pruebas as $prueba)
                    <tr>
                        <th scope="row">{{ $prueba->id }}</th>
                        <td>{{ $prueba->orden }}</td>
                        <td>{{ $prueba->xp }}</td>
                        <td>{{ $prueba->leccion ? $prueba->leccion->nombre : 'Sin Lección' }}</td>
                        <td>
                            <a href="{{ route('pruebas.edit', $prueba->id) }}" class="btn btn-sm btn-warning">
                                <i class="fa-solid fa-pen-nib"></i>
                            </a>
                        </td>
                        <td>
                            <form action="{{ route('pruebas.destroy', $prueba->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('¿Estás seguro de eliminar esta prueba?')">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
