<tr id="zona-row-{{ $zona->id }}">
    <td>{{ $zona->id }}</td>
    <td>{{ $zona->nombre }}</td>
    <td class="text-end">
        <button class="btn btn-sm btn-outline-primary"
            data-bs-toggle="modal"
            data-bs-target="#editZonaModal{{ $zona->id }}">
            Editar
        </button>

        <form action="{{ route('admin.zonas.destroy', $zona) }}" method="POST"
            class="d-inline-block zona-delete-form"
            data-id="{{ $zona->id }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
        </form>
    </td>


</tr>
