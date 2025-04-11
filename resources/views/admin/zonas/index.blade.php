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

        </div>
    </div>

    {{-- Modal de creación --}}
    <div class="modal fade" id="createZonaModal" tabindex="-1" aria-labelledby="createZonaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('admin.zonas.store') }}" method="POST" class="modal-content">
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
        document.addEventListener("DOMContentLoaded", function() {
            // Crear zona
            const createForm = document.querySelector('#createZonaModal form');
            createForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);

                fetch(this.action, {
                        method: 'POST',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: formData
                    })
                    .then(res => res.json())
                    .then(data => {
                        document.querySelector('#zona-tbody').insertAdjacentHTML('beforeend', data
                        .html);
                        this.reset();
                        bootstrap.Modal.getInstance(document.getElementById('createZonaModal')).hide();
                    });
            });

            // Editar zona (delegado)
            document.querySelectorAll('.zona-edit-form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const formData = new FormData(this);
                    const id = this.dataset.id;

                    fetch(this.action, {
                            method: 'POST',
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            },
                            body: formData
                        })
                        .then(res => res.json())
                        .then(data => {
                            document.querySelector(`#zona-row-${id}`).outerHTML = data.html;
                            bootstrap.Modal.getInstance(document.getElementById(
                                `editZonaModal${id}`)).hide();
                        });
                });
            });

            // Eliminar zona
            document.querySelectorAll('.zona-delete-form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const id = this.dataset.id;
                    if (confirm('¿Seguro que deseas eliminar esta zona?')) {
                        fetch(this.action, {
                            method: 'POST',
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'X-CSRF-TOKEN': this.querySelector('[name=_token]').value
                            },
                            body: new URLSearchParams({
                                _method: 'DELETE'
                            })
                        }).then(() => {
                            document.querySelector(`#zona-row-${id}`).remove();
                        });
                    }
                });
            });
        });
@endsection
