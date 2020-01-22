
@can('edit program') <button id="{{ route('editProgram', $id) }}" data-tooltip="Editar" class="circular ui icon green button"><i class="icon edit outline"></i></button> @endcan
@can('delete program') <button id="{{ route('deleteProgram', $id) }}" data-tooltip="Eliminar" class="circular ui icon red button"><i class="icon trash"></i></button> @endcan