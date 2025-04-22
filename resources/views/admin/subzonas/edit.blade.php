@extends('layouts.admin')

@section('title', 'Editar Subzona')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Editar Subzona</h1>
        <a href="{{ route('admin.subzonas.index') }}" class="btn btn-secondary">Volver</a>
    </div>

    <form action="{{ route('admin.subzonas.update', $subzona) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" value="{{ $subzona->nombre }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Slug</label>
            <input type="text" name="slug" class="form-control" value="{{ $subzona->slug }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Promoción asociada</label>
            <select name="zona_id" class="form-select">
                @foreach ($zonas as $zona)
                    <option value="{{ $zona->id }}" {{ $subzona->zona_id == $zona->id ? 'selected' : '' }}>
                        {{ $zona->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Imagen destacada</label><br>
            @if($subzona->imagen_destacada)
                <img src="{{ asset('storage/' . $subzona->imagen_destacada) }}" class="img-fluid mb-2" style="max-height: 200px;">
            @endif
            <input type="file" name="imagen_destacada" class="form-control" accept="image/*">
        </div>

        <div class="mb-3">
            <label class="form-label">Descripción</label>
            <textarea name="descripcion" class="form-control" rows="6">{{ $subzona->descripcion }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Características</label>
            <textarea name="caracteristicas" class="form-control" rows="4">{{ $subzona->caracteristicas }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Galería (subir nuevas)</label>
            <input type="file" name="galeria[]" class="form-control" multiple accept="image/*">
        </div>

        @if ($subzona->galeria && $subzona->galeria->count())
            <div class="mb-3">
                <label class="form-label">Imágenes actuales</label>
                <div class="row g-3">
                    @foreach ($subzona->galeria as $img)
                        <div class="col-3">
                            <img src="{{ asset('storage/' . $img->path) }}" class="img-fluid rounded shadow-sm">
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="text-end mt-4">
            <button type="submit" class="btn btn-main">Actualizar Subzona</button>
        </div>
        <div class="mb-4">
            <label class="form-label">Imágenes de la subzona</label>
            <div class="dropzone" id="dropzone">
                Arrastra las imágenes aquí o haz clic para seleccionar
                <input type="file" name="imagenes[]" id="images" class="form-control d-none" multiple>
            </div>
            <div class="form-text mt-2">Las imágenes se mostrarán en la galería de esta subzona.</div>
        </div>
    </form>
@endsection

@section('scripts')

    const dropzone = document.getElementById('dropzone');
    const fileInput = document.getElementById('images');
    const previewContainer = document.createElement('div');
    previewContainer.classList.add('row', 'mt-3');
    dropzone.after(previewContainer);

    fileInput.addEventListener('change', function () {
        showPreviews(this.files);
    });

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
