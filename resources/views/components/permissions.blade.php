@can('create user')
  <a href=" {{ route('settingUser') }} " class="item item_main">
    <i class="c-white large user plus icon"></i>
    <div class="content">
      Usuarios
    </div>
  </a>
@endcan

@can('create program')
  <a href=" {{ route('settingsProgram') }} " class="item item_main">
    <i class="c-white large magento icon"></i>
    <div class="content">
      Programas
    </div>
  </a>
@endcan

@can('create motivo')
  <a href=" {{ route('settingsMotivo') }} " class="item item_main">
    <i class="c-white large tasks icon"></i>
    <div class="content">
      Motivos
    </div>
  </a>
@endcan

@can('create sede')
  <a href=" {{ route('settingsSede') }} " class="item item_main">
    <i class="c-white large map marker icon"></i>
    <div class="content">
      sedes
    </div>
  </a>
@endcan
