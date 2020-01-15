<div class="ui list">
 
  <a href=" {{ route('home') }} " class="item item_main">
    <i class="c-white large home icon"></i>
    <div class="content">
      Inicio
    </div>
  </a>

@role('super admin')
<a href="#1" class="item item_main">
  <i class="c-white large star outline icon"></i>
  <div class="content">
    Permisos de Usuario
  </div>
</a>
@endrole

@role('direction')
<a href="#1" class="item item_main">
  <i class="c-white large star outline icon"></i>
  <div class="content">
    Bandeja de entrada
  </div>
</a>
@endrole

@role('admissions')
  <a href="#1" class="item item_main">
    <i class="c-white large plus square outline icon"></i>
    <div class="content">
      Nuevo Radicado
    </div>
  </a>
@endrole

@include('components.permissions')
  
</div>