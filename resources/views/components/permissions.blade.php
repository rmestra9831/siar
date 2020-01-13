@can('create user')
  <a href="#1" class="item item_main">
    <i class="user plus icon"></i>
    <div class="content">
      Usuarios
    </div>
  </a>
@endcan

@can('create program')
  <a href=" {{ route('createProgram') }} " class="item item_main">
    <i class="large user plus icon"></i>
    <div class="content">
      Programas
    </div>
  </a>
@endcan

@can('create motivo')
  <a href="#1" class="item item_main">
    <i class="large tasks icon"></i>
    <div class="content">
      Motivos
    </div>
  </a>
@endcan

@can('create sede')
  <a href="#1" class="item item_main">
    <i class="large map marker icon"></i>
    <div class="content">
      sedes
    </div>
  </a>
@endcan
