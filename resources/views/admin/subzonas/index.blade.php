@extends('layouts.admin')

@section('title', 'Gestión de Subzonas')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Subzonas</h1>
        <a href="{{ route('admin.subzonas.create') }}" class="btn btn-main">+ Nueva Subzona</a>
    </div>

    <div class="card">
        <div class="card-body p-0">
            <table class="table table-striped m-0">
                <thead class="table-dark">
                    <tr>
                        <th>Nombre</th>
                        <th>Slug</th>
                        <th>Promoción</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($subzonas as $subzona)
                        <tr>
                            <td>{{ $subzona->nombre }}</td>
                            <td>{{ $subzona->slug }}</td>
                            <td>{{ $subzona->zona->nombre ?? 'Sin promoción' }}</td>
                            <td class="text-end">
                                <a href="{{ route('admin.subzonas.edit', $subzona) }}" class="btn btn-sm btn-outline-primary">Editar</a>
                                <form action="{{ route('admin.subzonas.destroy', $subzona) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Eliminar esta subzona?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
