@extends('layouts.admin')

@section('title', 'Añadir Subzona')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Nueva Subzona</h1>
        <a href="{{ route('admin.subzonas.index') }}" class="btn btn-secondary">Volver</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body mb-4" style="max-height: 90vh; overflow-y: auto;">

            <form action="{{ route('admin.subzonas.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="nombre" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Slug (URL única)</label>
                        <input type="text" name="slug" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Promoción asociada</label>
                        <select name="zona_id" class="form-select" required>
                            <option value="">Selecciona una promoción</option>
                            @foreach ($zonas as $zona)
                                <option value="{{ $zona->id }}">{{ $zona->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Imagen destacada</label>
                        <input type="file" name="imagen_destacada" class="form-control" accept="image/*">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Plano (imagen)</label>
                        <input type="file" name="plano" class="form-control" accept="image/*">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Pdf informativo</label>
                        <input type="file" name="pdf_info_comercial" class="form-control" accept="pdf/*">
                    </div>

                    <div class="col-12">
                        <label class="form-label">Resumen corto</label>
                        <textarea name="resumen" class="form-control" rows="3" maxlength="300"
                            placeholder="Resumen breve para mostrar en listados y cabeceras..."></textarea>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Descripción completa</label>
                        <textarea name="descripcion" class="form-control" rows="6"></textarea>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Contenido adicional (HTML enriquecido)</label>
                        <textarea name="contenido_html" class="form-control" rows="6" placeholder="Puedes insertar tablas, listas, contenido más detallado..."></textarea>
                    </div>

                    {{-- Características estructuradas --}}
                    <div class="col-md-3">
                        <label class="form-label">Habitaciones</label>
                        <input type="number" name="habitaciones" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Baños</label>
                        <input type="number" name="banos" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Superficie total (m²)</label>
                        <input type="number" step="0.01" name="superficie" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Precio desde (€)</label>
                        <input type="number" name="precio_desde" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Estado</label>
                        <input type="text" name="estado" class="form-control"
                            placeholder="Ej: En construcción, Disponible...">
                    </div>

                    {{-- Galería --}}
                    <div class="col-12">
                        <label class="form-label">Galería de imágenes</label>
                        <div class="dropzone border rounded p-4 text-center" id="dropzone">
                            Arrastra imágenes aquí o haz clic para seleccionar
                            <input type="file" name="imagenes[]" id="images" class="form-control d-none" multiple>
                        </div>
                        <div class="form-text">Las imágenes se mostrarán en la galería principal.</div>
                        <div class="row mt-3" id="previewContainer"></div>
                    </div>
                </div>

                <div class="text-end my-4">
                    <button type="submit" class="btn btn-main">Guardar Subzona</button>
                </div>
                <br/>
                <br/>
                <br/>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    const dropzone = document.getElementById('dropzone');
    const fileInput = document.getElementById('images');
    const previewContainer = document.getElementById('previewContainer');

    dropzone.addEventListener('click', () => fileInput.click());

    dropzone.addEventListener('dragover', (e) => {
    e.preventDefault();
    dropzone.classList.add('dragover');
    });

    dropzone.addEventListener('dragleave', () => {
    dropzone.classList.remove('dragover');
    });

    dropzone.addEventListener('drop', (e) => {
    e.preventDefault();
    dropzone.classList.remove('dragover');
    fileInput.files = e.dataTransfer.files;
    showPreviews(e.dataTransfer.files);
    });

    fileInput.addEventListener('change', function () {
    showPreviews(this.files);
    });

    function showPreviews(files) {
    previewContainer.innerHTML = '';
    Array.from(files).forEach(file => {
    if (!file.type.startsWith('image/')) return;
    const reader = new FileReader();
    reader.onload = function (e) {
    const col = document.createElement('div');
    col.className = 'col-6 col-sm-4 col-md-3 col-lg-2 mb-2';

    const img = document.createElement('img');
    img.src = e.target.result;
    img.className = 'img-fluid rounded shadow-sm';
    img.style.height = '100px';
    img.style.objectFit = 'cover';

    col.appendChild(img);
    previewContainer.appendChild(col);
    };
    reader.readAsDataURL(file);
    });
    }
@endsection
