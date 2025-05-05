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
            <h1 class="m-0 fs-4">Editar Propiedad</h1>
        </div>

        <div class="card-body overflow-auto" style="max-height: 80vh;">
            <form action="{{ route('admin.properties.update', $property) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @include('admin.properties._form')
                @if ($property->images->count() > 0)
                    <h5 class="mt-4">Imágenes actuales</h5>
                        <div class="row g-2">
                            @foreach ($property->images as $image)
                                <div class="col-3 position-relative">
                                    <img src="{{ asset('storage/' . $image->path) }}" class="img-fluid rounded" style="object-fit: cover; aspect-ratio: 1/1;">
                                    <button class="btn btn-sm btn-danger position-absolute top-0 end-0 m-1" onclick="deleteImage({{ $image->id }})">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
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
        function deleteImage(id) {
        if (!confirm("¿Seguro que quieres eliminar esta imagen?")) return;

        fetch("{{ url('/admin/properties/images') }}/" + id, {
        method: 'DELETE',
        headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}',
        'Accept': 'application/json',
        }
        })
        .then(res => res.json())
        .then(data => {
        if (data.success) {
        location.reload(); // recarga el modal para reflejar los cambios
        } else {
        alert('No se pudo eliminar la imagen');
        }
        });
        }
    @endsection
