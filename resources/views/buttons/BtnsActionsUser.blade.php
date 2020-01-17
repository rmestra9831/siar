
@can('edit sede') <button data-tooltip="Editar" data-position="top center" id="{{ $id }}" class="circular ui icon green button"><i class="icon edit outline"></i></button> @endcan
@can('delete sede') <button data-tooltip="Eliminar" data-position="top center" id="{{ $id }}" class="circular ui icon red button"><i class="icon trash"></i></button> @endcan