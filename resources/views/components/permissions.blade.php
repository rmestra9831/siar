{{-- @can('create correspondence')
  <a id="btnsCorrespondence" class="item item_main_accordion ui accordion field">
    <div class="c-white title">
      <i id="icon-main-c" class="c-white large folder outline icon"></i>
      Nueva Corr.
    </div>
    <div class="content field">
      @can('create internal correspondence')
        <div class="item ml-5 c-white title">
          <i class="c-white large file outline icon"></i>
          Interna
        </div>
      @endcan
      
      @can('create external correspondence')
        <div class="item ml-5 c-white title">
          <i class="c-white large file outline icon"></i>
          Externa
        </div>
      @endcan
      
      @can('create received correspondence', Model::class)
        <div class="item ml-5 c-white title">
          <i class="c-white large file outline icon"></i>
          Recibida
        </div>
      @endcan
    </div>
  
  </a>
@endcan --}}


@can('create radicado')
<a href="{{route('radicado.index')}}" class="item item_main">
  <i class="c-white large clipboard outline icon"></i>
  <div class="content">
    Nuevo Radicado
  </div>
</a>
@endcan

@can('settings user')
  <a href=" {{ route('settingUser') }} " class="item item_main">
    <i class="c-white large user plus icon"></i>
    <div class="content">
      Usuarios
    </div>
  </a>
@endcan

@can('settings program')
  <a href=" {{ route('settingsProgram') }} " class="item item_main">
    <i class="c-white large magento icon"></i>
    <div class="content">
      Programas
    </div>
  </a>
@endcan

@can('settings motivo')
  <a href=" {{ route('settingsMotivo') }} " class="item item_main">
    <i class="c-white large tasks icon"></i>
    <div class="content">
      Motivos
    </div>
  </a>
@endcan

@can('settings sede')
  <a href=" {{ route('settingsSede') }} " class="item item_main">
    <i class="c-white large map marker icon"></i>
    <div class="content">
      sedes
    </div>
  </a>
@endcan
