@section('title_content')
  Inicio
@endsection

@section('body_main')
<div class="cont-panel-adm">
  <div class="container">
    <div id="d-view-vue">
      <example-component></example-component>
    </div>
          <a href="  " class="col card desing-1">
              <img src=" {{asset('img/radic-2.svg')}} " alt="">
              <div class="h3">Radicados</div>
              <div class="p">  </div>
          </a>

          <a href="" class="col card desing-1">
              <img src=" {{asset('img/usuarios.svg')}} " alt="">
              <div class="h3">Usuarios</div>
              <div class="p"></div>
          </a>

          <a href="" class="col card desing-1">
              <img src=" {{asset('img/directors.svg')}} " alt="">
              <div class="h3">Directores</div>
              <div class="p"> </div>
          </a>

          <a href="" class="col card desing-1">
              <img src=" {{asset('img/inge.svg')}} " alt="">
              <div class="h3">Programas</div>
              <div class="p"></div>
          </a>      
  </div>
</div>
@endsection