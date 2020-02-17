@extends('layouts.extructure')
@section('title','Filtrado de estados')
{{-- vista del main --}}
@include('components.Main')
@section('title_content') Filtrado de estado @endsection

@section('body_main')
  <div class="container container-sm container-md">

  @hasrole('Admisiones')
    <div class="ui six item menu">
      <a class="item filterState" dataStatus="newsRadic">Enviados Dir.</a>
      <a class="item filterState" dataStatus="recived_dir">Recibidos Dir.</a>
      <a class="item filterState" dataStatus="answered">Respondidos</a>
      <a class="item filterState" dataStatus="pendingAdmission">Pendientes</a>
      <a class="item filterState" dataStatus="delivered">Entregados</a>
      <a class="item filterState" dataStatus="importants">Importantes</a>
    </div> 
  @endhasrole
  @hasrole('Direccion')
    <div class="ui eight item menu">
      <a class="item filterState" dataStatus="newsRadic">Nuevos</a>
      <a class="item filterState" dataStatus="pendingAnswer">Pendientes Res.</a>
      <a class="item filterState" dataStatus="answered">Repondidos</a>
      <a class="item filterState" dataStatus="delegateAnswer">Respuesta Del.</a>
      <a class="item filterState" dataStatus="modifyAnswer">Modificando Res.</a>
      <a class="item filterState" dataStatus="verifyAnswer">Verificar Res.</a>
      <a class="item filterState" dataStatus="aproved">Aprobados</a>
      <a class="item filterState" dataStatus="importants">Importantes</a>
    </div> 
  @endhasrole
  @hasrole('Jef Programa')
    <div class="ui seven item menu">
      <a class="item filterState" dataStatus="newsRadic">Nuevos</a>
      <a class="item filterState" dataStatus="pendingAnswer">Pendientes Res.</a>
      <a class="item filterState" dataStatus="answered">Repondidos</a>
      <a class="item filterState" dataStatus="verifyAnswer">Verificar Res.</a>
      <a class="item filterState" dataStatus="aproved">Aprobados</a>
      <a class="item filterState" dataStatus="importants">Importantes</a>
    </div> 
  @endhasrole

    <div class="contentFilterState">
      {{-- tabla e muestra de usuarios --}}
      <div class="ui icon message viewStates">
        <i class="inbox icon"></i>
        <div class="content">
          <div class="header">
            No has seleccionado que deseas ver
          </div>
          <p>Selecciona uno de los menús para visualizar en que estado se encuentran los radicados</p>
        </div>
      </div>
      <table id="tableFilterState" class="ui selectable single line celled table">
        <thead>
          <tr>
            <th class="ui center aligned">Consecutivo</th>
            <th class="ui center aligned">Nombres</th>
            <th class="ui center aligned">Correo</th>
            <th class="ui center aligned">Celular</th>
            <th class="ui center aligned">Programa</th>
            <th class="ui center aligned">Origen</th>
            <th class="ui center aligned">Destino</th>
            <th class="ui center aligned">Caracter</th>
            <th class="ui center aligned">Motivo</th>
            <th class="ui center aligned">Asunto</th>
            <th class="ui center aligned">Creado por</th>
            <th class="ui center aligned">Delegado a</th>
            <th class="ui center aligned text-capitalize">Respondido por</th>
            {{-- <th class="ui center aligned justify-content-center"style="width: 20%;" >Delegado</th> --}}
          </tr>
        </thead>
        <tfoot class="ttt">
            <th name="Consecutivo">Consecutivo</th>
            <th name="Nombres">Nombres</th>
            <th name="Correo">Correo</th>
            <th name="Celular">Celular</th>
            <th name="Programa">Programa</th>
            <th name="Origen">Origen</th>
            <th name="Destino">Destino</th>
            <th name="Caracter">Caracter</th>
            <th name="Motivo">Motivo</th>
            <th name="Asunto">Asunto</th>
            <th name="Creado por">Creado por</th>
            <th name="Delegado a">Delegado a</th>
            <th name="Respondido por">Respondido por</th>
        </tfoot>
      </table>
    </div>
  </div>
@endsection
