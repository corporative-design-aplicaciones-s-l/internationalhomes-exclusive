@extends('layouts.admin')

@section('title', 'Gestión de Zonas')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Zonas</h1>
        <button class="btn btn-main" data-bs-toggle="modal" data-bs-target="#createZonaModal">
            + Nueva Zona
        </button>
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
                <tbody id="zona-tbody">
                    {{-- Aquí se cargan dinámicamente --}}
                    @foreach ($zonas as $zona)
                        @include('admin.zonas._row', ['zona' => $zona])
                    @endforeach
                </tbody>
            </table>
            @foreach ($zonas as $zona)
                @include('admin.zonas._edit-modal', ['zona' => $zona])
            @endforeach

        </div>
    </div>

    {{-- Modal de creación --}}
    <div class="modal fade" id="createZonaModal" tabindex="-1" aria-labelledby="createZonaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('admin.zonas.store') }}" method="POST" enctype="multipart/form-data"
                class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="createZonaModalLabel">Nueva Zona</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="nombre" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Imagen principal</label>
                        <input type="file" name="imagen_principal" class="form-control" accept="image/*">
                    </div>

                    <hr>
                    <h6 class="fw-semibold">Secciones</h6>
                    <div id="secciones-container">
                        <div class="zona-seccion border rounded p-3 mb-3 bg-light">
                            <div class="mb-2">
                                <label class="form-label">Título</label>
                                <input type="text" name="secciones[0][titulo]" class="form-control">
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Imagen</label>
                                <input type="file" name="secciones[0][imagen]" class="form-control" accept="image/*">
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Descripción</label>
                                <textarea name="secciones[0][descripcion]" class="form-control" rows="2"></textarea>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-secondary" id="add-seccion">+ Añadir
                        sección</button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-main">Guardar</button>
                </div>
            </form>

        </div>
    </div>
@endsection

@section('scripts')
    document.addEventListener("DOMContentLoaded", function () {
    let seccionIndex = 1;

    document.getElementById('add-seccion').addEventListener('click', () => {
    const container = document.getElementById('secciones-container');
    const html = `
    <div class="zona-seccion border rounded p-3 mb-3 bg-light">
        <div class="mb-2">
            <label class="form-label">Título</label>
            <input type="text" name="secciones[${seccionIndex}][titulo]" class="form-control">
        </div>
        <div class="mb-2">
            <label class="form-label">Imagen</label>
            <input type="file" name="secciones[${seccionIndex}][imagen]" class="form-control" accept="image/*">
        </div>
        <div class="mb-2">
            <label class="form-label">Descripción</label>
            <textarea name="secciones[${seccionIndex}][descripcion]" class="form-control" rows="2"></textarea>
        </div>
    </div>
    `;
    container.insertAdjacentHTML('beforeend', html);
    seccionIndex++;
    });
    });

    let zonaSeccionCounters = {};

    function addSeccion(zonaId) {
    const container = document.getElementById('secciones-container-' + zonaId);
    const index = container.querySelectorAll('.zona-seccion').length;

    const sectionHTML = `
    <div class="zona-seccion border rounded p-3 mb-3 bg-light">
        <div class="mb-2">
            <label class="form-label">Título</label>
            <input type="text" name="secciones[${index}][titulo]" class="form-control">
        </div>
        <div class="mb-2">
            <label class="form-label">Imagen</label>
            <input type="file" name="secciones[${index}][imagen]" class="form-control">
        </div>
        <div class="mb-2">
            <label class="form-label">Descripción</label>
            <textarea name="secciones[${index}][descripcion]" class="form-control"></textarea>
        </div>
    </div>
    `;

    container.insertAdjacentHTML('beforeend', sectionHTML);
    }

@endsection
