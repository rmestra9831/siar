<div class="ui list">
 
  <a href=" {{ route('home') }} " class="item item_main">
    <i class="c-white large home icon"></i>
    <div class="content">
      Inicio
    </div>
  </a>

@can('Super Admin')
<a href=" {{route('Permissions')}} " class="item item_main">
  <i class="c-white large star outline icon"></i>
  <div class="content">
    Permisos de Usuario
  </div>
</a>
@endcan

@role('Dirección')
<a href="#1" class="item item_main">
  <i class="c-white large star outline icon"></i>
  <div class="content">
    Bandeja de entrada
  </div>
</a>
@endrole

@role('Admisiones')
  <a href="{{route('radicado.index')}}" class="item item_main">
    <i class="c-white large clipboard outline icon"></i>
    <div class="content">
      Nuevo Radicado
    </div>
  </a>
@endrole

@include('components.permissions')
  
</div>