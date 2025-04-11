@extends('layouts.admin')

@section('title', 'Crear Propiedad')

@section('styles')
    <style>
        .dropzone {
            border: 2px dashed #ccc;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            cursor: pointer;
            background-color: #f9f9f9;
            transition: background 0.2s ease-in-out;
        }

        .dropzone.dragover {
            background-color: #e3e3e3;
        }

        .card-body {
            overflow-y: auto;
            max-height: 100vh;
        }

        .sticky-footer {
            position: sticky;
            bottom: -0;
            background: #fff;
            padding: 12px 20px;
            border-top: 1px solid #ddd;
            text-align: end;
        }
    </style>
@endsection

@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">
            <h1 class="m-0 fs-4">Nueva Propiedad</h1>
        </div>

        <div class="card-body overflow-auto" style="max-height: 80vh;">
            <form action="{{ route('admin.properties.update', $property) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @include('admin.properties._form')
                @if ($property->images->count() > 0)
                    <h5 class="mt-4">Imágenes actuales</h5>
                    <div class="row mb-4">
                        @foreach ($property->images as $image)
                            <div class="col-6 col-sm-4 col-md-3 col-lg-2 position-relative mb-3">
                                <img src="{{ asset('storage/' . $image->path) }}"
                                    class="img-fluid rounded shadow-sm {{ $property->thumbnail === $image->path ? 'border border-success border-3' : '' }}"
                                    style="height: 100px; object-fit: cover; width: 100%;">

                                @if ($property->thumbnail === $image->path)
                                    <div class="position-absolute bottom-0 start-0 bg-success text-white px-2 py-1 small">
                                        Thumbnail</div>
                                @else
                                    <form
                                        action="{{ route('admin.properties.images.set-thumbnail', [$property->id, $image->id]) }}"
                                        method="POST" class="position-absolute bottom-0 start-0">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-outline-success w-100 rounded-0"
                                            style="font-size: 0.75rem;">
                                            Usar como principal
                                        </button>
                                    </form>
                                @endif

                                <form action="{{ route('admin.properties.images.destroy', $image) }}" method="POST"
                                    class="position-absolute top-0 end-0 me-1 mt-1">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger px-2 py-1" title="Eliminar imagen"
                                        onclick="return confirm('¿Eliminar esta imagen?')">
                                        &times;
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                @endif
                <div class="mb-4">
                    <label class="form-label">Añadir nuevas imágenes</label>
                    <div class="dropzone" id="dropzone">
                        Arrastra las imágenes aquí o haz clic para seleccionar
                        <input type="file" name="images[]" id="images" class="form-control d-none" multiple>
                    </div>
                    <div class="form-text mt-2">Las nuevas imágenes se añadirán al final. El thumbnail no se cambia aquí.
                    </div>
                </div>
            </form>

        </div>
    @endsection

    @section('scripts')
        const dropzone = document.getElementById('dropzone');
        const fileInput = document.getElementById('images');
        const previewContainer = document.createElement('div');
        previewContainer.classList.add('row', 'mt-3');
        dropzone.after(previewContainer);

        // 👇 Manejo de selección manual
        fileInput.addEventListener('change', function () {
        showPreviews(this.files);
        });

        // 👇 Drag & drop
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
