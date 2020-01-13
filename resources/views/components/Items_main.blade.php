<div class="ui list">
 
  <a href=" {{ route('home') }} " class="item item_main">
    <i class="large home icon"></i>
    <div class="content">
      Inicio
    </div>
  </a>
@role('admissions')
  <a href="#1" class="item item_main">
    <i class="large plus square outline icon"></i>
    <div class="content">
      Nuevo Radicado
    </div>
  </a>
  <a href="#2" class="item item_main">
    <i class="large linkify icon"></i>
    <div class="content">
      asasd
    </div>
  </a>
@endrole

@role('super admin')
<a href="#1" class="item item_main">
  <i class="large star outline icon"></i>
  <div class="content">
    Permisos de Usuario
  </div>
</a>
@endrole

@include('components.permissions')
  
</div>