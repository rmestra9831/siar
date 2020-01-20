
@can('edit user') <button data-tooltip="Editar" data-position="top center" id="{{ $id }}" class="circular ui icon green button"><i class="icon edit outline"></i></button> @endcan

@if ($id != auth()->user()->id)
    @can('delete user') <button data-tooltip="Eliminar" data-position="top center" id="{{ $id }}" class="circular ui icon red button"><i class="icon trash"></i></button> @endcan
@endif

