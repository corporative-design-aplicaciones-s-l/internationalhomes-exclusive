@extends('layouts.admin')

@section('title', 'Gestión de Zonas')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Zonas</h1>
        <a href="{{ route('admin.zonas.create') }}" class="btn btn-main">
            + Nueva Zona
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body p-0">
            <table class="table table-striped m-0" id="zona-table">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($zonas as $zona)
                        <tr>
                            <td>{{ $zona->id }}</td>
                            <td>{{ $zona->nombre }}</td>
                            <td class="text-end">
                                <a href="{{ route('admin.zonas.edit', $zona->id) }}" class="btn btn-sm btn-outline-primary">
                                    Editar
                                </a>
                                <form action="{{ route('admin.zonas.destroy', $zona->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('¿Estás seguro de eliminar esta zona?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
