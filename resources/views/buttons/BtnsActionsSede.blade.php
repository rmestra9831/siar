
@can('edit sede') <a href="" data-tooltip="Editar" data-position="top center" id="{{ route('editSede', $id) }}" class="circular ui icon green button"><i class="icon edit outline"></i></a> @endcan
@can('delete sede') <a href="" data-tooltip="Eliminar" data-position="top center" id="{{ route('deleteSede', $id) }}" class="circular ui icon red button"><i class="icon trash"></i></a> @endcan