@extends('layouts.admin')

@section('title', 'Añadir Zona')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Nueva Zona</h1>
        <a href="{{ route('admin.zonas.index') }}" class="btn btn-secondary">Volver</a>
    </div>

    {{-- Contenedor scrollable --}}
    <div class="card shadow-sm">
        <div class="card-body" style="max-height: 100vh; overflow-y: auto;">


            <form action="{{ route('admin.zonas.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nombre</label>
                    <input type="text" name="nombre" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Imagen principal</label>
                    <input type="file" name="imagen_principal" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Contenido adicional</label>
                    <textarea type="" name="contenido_html" class="form-control"></textarea>
                </div>

                <hr>

                <h5>Secciones de la zona</h5>
                <div id="secciones-container"></div>
                <button type="button" class="btn btn-sm btn-outline-primary my-3" id="add-seccion">+ Añadir
                    sección</button>

                <div class="text-end">
                    <button type="submit" class="btn btn-main">Guardar Zona</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    let seccionIndex = 0;

    document.getElementById('add-seccion').addEventListener('click', () => {
    const container = document.getElementById('secciones-container');
    const html = `
    <div class="zona-seccion border rounded p-3 mb-3 bg-light position-relative">
        <button type="button" class="btn-close position-absolute top-0 end-0 m-2 remove-seccion"
            aria-label="Eliminar"></button>
        <div class="mb-2">
            <label class="form-label">Título</label>
            <input type="text" name="secciones[${seccionIndex}][titulo]" class="form-control">
        </div>
        <div class="mb-2">
            <label class="form-label">Imagen</label>
            <input type="file" name="secciones[${seccionIndex}][imagen]" class="form-control">
        </div>
        <div class="mb-2">
            <label class="form-label">Descripción</label>
            <input id="desc-${seccionIndex}" type="hidden" name="secciones[${seccionIndex}][descripcion]">
            <trix-editor input="desc-${seccionIndex}" class="trix-content bg-white rounded shadow-sm"></trix-editor>
        </div>
    </div>
    `;
    container.insertAdjacentHTML('beforeend', html);
    seccionIndex++;
    });

    document.addEventListener('click', function(e) {
    if (e.target.classList.contains('remove-seccion')) {
    e.target.closest('.zona-seccion').remove();
    }
    });
@endsection
