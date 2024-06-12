{{-- Botón para eliminar --}}
<form action="{{ route('cursos.destroy', $cursito->id) }}" method="POST" style="display: inline;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger">Eliminar</button>
</form>

