<div class="modal fade" id="editZonaModal{{ $zona->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $zona->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('admin.zonas.update', $zona) }}" method="POST" class="modal-content zona-edit-form" data-id="{{ $zona->id }}">
            @csrf
            @method('PUT')
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel{{ $zona->id }}">Editar Zona</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Nombre</label>
                    <input type="text" name="nombre" class="form-control" value="{{ $zona->nombre }}" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-main">Guardar</button>
            </div>
        </form>
    </div>
</div>
