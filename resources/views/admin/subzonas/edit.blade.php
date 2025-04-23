@extends('layouts.admin')

@section('title', 'Editar Subzona')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Editar Subzona</h1>
        <a href="{{ route('admin.subzonas.index') }}" class="btn btn-secondary">Volver</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body" style="max-height: 100vh; overflow-y: auto;">
            <form action="{{ route('admin.subzonas.update', $subzona) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="nombre" class="form-control" value="{{ $subzona->nombre }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Slug (URL única)</label>
                        <input type="text" name="slug" class="form-control" value="{{ $subzona->slug }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Promoción asociada</label>
                        <select name="zona_id" class="form-select" required>
                            @foreach ($zonas as $zona)
                                <option value="{{ $zona->id }}" {{ $subzona->zona_id == $zona->id ? 'selected' : '' }}>
                                    {{ $zona->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Imagen destacada</label><br>
                        @if($subzona->imagen_destacada)
                            <img src="{{ asset('storage/' . $subzona->imagen_destacada) }}" class="img-fluid rounded shadow-sm mb-2" style="max-height: 200px;">
                        @endif
                        <input type="file" name="imagen_destacada" class="form-control" accept="image/*">
                    </div>

                    <div class="col-12">
                        <label class="form-label">Resumen corto</label>
                        <textarea name="resumen" class="form-control" rows="3" maxlength="300">{{ $subzona->resumen }}</textarea>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Descripción completa</label>
                        <textarea name="descripcion" class="form-control" rows="6">{{ $subzona->descripcion }}</textarea>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Habitaciones</label>
                        <input type="number" name="habitaciones" class="form-control" value="{{ $subzona->habitaciones }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Baños</label>
                        <input type="number" name="banos" class="form-control" value="{{ $subzona->banos }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Superficie total (m²)</label>
                        <input type="number" step="0.01" name="superficie" class="form-control" value="{{ $subzona->superficie }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Precio desde (€)</label>
                        <input type="number" name="precio_desde" class="form-control" value="{{ $subzona->precio_desde }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Estado</label>
                        <input type="text" name="estado" class="form-control" value="{{ $subzona->estado }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Fecha de entrega</label>
                        <input type="text" name="fecha_entrega" class="form-control" value="{{ $subzona->fecha_entrega }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Equipamiento</label>
                        <textarea name="equipamiento" class="form-control">{{ $subzona->equipamiento }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Ventajas</label>
                        <textarea name="ventajas" class="form-control">{{ $subzona->ventajas }}</textarea>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Plano (imagen)</label>
                        <input type="file" name="plano" class="form-control" accept="image/*">
                        @if($subzona->plano)
                            <img src="{{ asset('storage/' . $subzona->plano) }}" class="img-fluid mt-2" style="max-height: 150px;">
                        @endif
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">PDF info comercial</label>
                        <input type="file" name="pdf_info_comercial" class="form-control" accept="application/pdf">
                        @if($subzona->pdf_info_comercial)
                            <a href="{{ asset('storage/' . $subzona->pdf_info_comercial) }}" target="_blank" class="d-block mt-2">
                                Ver documento actual
                            </a>
                        @endif
                    </div>

                    {{-- Galería --}}
                    <div class="col-12">
                        <label class="form-label">Galería de imágenes (subir nuevas)</label>
                        <div class="dropzone border rounded p-4 text-center" id="dropzone">
                            Arrastra imágenes aquí o haz clic para seleccionar
                            <input type="file" name="imagenes[]" id="images" class="form-control d-none" multiple>
                        </div>
                        <div class="form-text">Las imágenes se mostrarán en la galería principal.</div>

                        {{-- Imágenes actuales --}}
                        @if ($subzona->imagenes && $subzona->imagenes->count())
                            <div class="row mt-3">
                                @foreach ($subzona->imagenes as $img)
                                    <div class="col-6 col-sm-4 col-md-3 col-lg-2 mb-2">
                                        <img src="{{ asset('storage/' . $img->path) }}" class="img-fluid rounded shadow-sm">
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-main">Actualizar Subzona</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    const dropzone = document.getElementById('dropzone');
    const fileInput = document.getElementById('images');
    const previewContainer = document.createElement('div');
    previewContainer.classList.add('row', 'mt-3');
    dropzone.after(previewContainer);

    dropzone.addEventListener('click', () => fileInput.click());
    dropzone.addEventListener('dragover', e => {
        e.preventDefault();
        dropzone.classList.add('dragover');
    });
    dropzone.addEventListener('dragleave', () => dropzone.classList.remove('dragover'));
    dropzone.addEventListener('drop', e => {
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
