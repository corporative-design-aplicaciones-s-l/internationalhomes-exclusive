<table class="table table-hover align-middle">
    <thead class="table-dark">
        <tr>
            <th>Imagen</th>
            <th>Referencia</th>
            <th>Tipo</th>
            <th>Ubicación</th>
            <th>Precio</th>
            <th class="text-end">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($properties as $property)
            <tr>
                <td style="width: 100px;">
                    <img src="{{ asset('storage/' . $property->thumbnail) }}" class="img-thumbnail" style="width: 80px;">
                </td>
                <td>{{ $property->ref ?? '-' }}</td>
                <td>{{ ucfirst($property->tipo) }}</td>
                <td>{{ $property->location }}</td>
                <td>{{ number_format($property->price, 0, ',', '.') }} €</td>
                <td class="text-end">
                    <a href="{{ route('admin.properties.edit', $property) }}" class="btn btn-sm btn-outline-primary">
                        Editar
                    </a>
                    <form action="{{ route('admin.properties.destroy', $property) }}" method="POST" class="d-inline"
                        onsubmit="return confirm('¿Estás seguro de eliminar esta propiedad?');">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal"
                            data-bs-target="#deleteModal" data-id="{{ $property->id }}"
                            data-title="{{ $property->title }}">
                            Eliminar
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<!-- Modal de confirmación -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form method="POST" id="deleteForm">
          @csrf
          @method('DELETE')
          <div class="modal-header">
            <h5 class="modal-title" id="deleteModalLabel">Eliminar Propiedad</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
          </div>
          <div class="modal-body">
            ¿Estás seguro de que quieres eliminar <strong id="propertyTitle"></strong>?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-danger">Sí, eliminar</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script>
    const deleteModal = document.getElementById('deleteModal');
    deleteModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const id = button.getAttribute('data-id');
        const title = button.getAttribute('data-title');

        const modalTitle = deleteModal.querySelector('#propertyTitle');
        modalTitle.textContent = title;

        const form = deleteModal.querySelector('#deleteForm');
        form.action = `/admin/properties/${id}`;
    });
</script>
