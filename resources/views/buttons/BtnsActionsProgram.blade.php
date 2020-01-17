
@can('edit program') <button id="{{ route('editProgram', $id) }}" class="ui inverted green button">Editar</button> @endcan
@can('delete program') <button id="{{ route('deleteProgram', $id) }}" class="ui red button">Eliminar</button> @endcan