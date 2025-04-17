@extends('layouts.admin')

@section('title', 'Editar Zona')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Editar Zona</h1>
        <a href="{{ route('admin.zonas.index') }}" class="btn btn-secondary">Volver</a>
    </div>

    {{-- Contenedor scrollable --}}
    <div class="card shadow-sm">
        <div class="card-body" style="max-height: 80vh; overflow-y: auto;">

            <form action="{{ route('admin.zonas.update', $zona) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Nombre</label>
                    <input type="text" name="nombre" class="form-control" value="{{ $zona->nombre }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Imagen principal</label>
                    <input type="file" name="imagen_principal" class="form-control">
                    @if ($zona->imagen_principal)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $zona->imagen_principal) }}" style="height: 100px;"
                                class="img-thumbnail">
                        </div>
                    @endif
                </div>
                <div class="mb-3">
                    <label class="form-label">Contenido adicional</label>
                    <textarea type="" name="contenido_html" class="form-control">{{ $zona->contenido_html }}</textarea>
                </div>

                <hr>

                <h5>Secciones de la zona</h5>
                <div id="secciones-container">
                    @foreach ($zona->secciones as $index => $seccion)
                        <div class="zona-seccion border rounded p-3 mb-3 bg-light position-relative">
                            <button type="button" class="btn-close position-absolute top-0 end-0 m-2 remove-seccion"
                                aria-label="Eliminar"></button>
                            <div class="mb-2">
                                <label class="form-label">Título</label>
                                <input type="text" name="secciones[{{ $index }}][titulo]" class="form-control"
                                    value="{{ $seccion->titulo }}">
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Imagen</label>
                                <input type="file" name="secciones[{{ $index }}][imagen]" class="form-control">
                                @if ($seccion->imagen)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $seccion->imagen) }}" style="height: 80px;"
                                            class="img-thumbnail">
                                    </div>
                                @endif
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Descripción</label>
                                @php $descId = 'desc-' . $index; @endphp

                                <input id="{{ $descId }}" type="hidden"
                                    name="secciones[{{ $index }}][descripcion]"
                                    value="{{ $seccion->descripcion }}">
                                <trix-editor input="{{ $descId }}"
                                    class="trix-content bg-white rounded shadow-sm"></trix-editor>
                            </div>
                        </div>
                    @endforeach
                </div>

                <button type="button" class="btn btn-sm btn-outline-primary my-3" id="add-seccion">+ Añadir
                    sección</button>

                <div class="text-end">
                    <button type="submit" class="btn btn-main">Actualizar Zona</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    let seccionIndex = {{ count($zona->secciones ?? []) }};

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
