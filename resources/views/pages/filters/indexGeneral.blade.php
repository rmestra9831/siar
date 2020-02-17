@extends('layouts.extructure')
@section('title','Filtrado General')
{{-- vista del main --}}
@include('components.Main')
@section('title_content') Filtrado general @endsection

@section('body_main')
  <div class="container">
    {{-- tabla e muestra de usuarios --}}
      <table id="tableFilterGeneral" class="ui selectable single line celled table">
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
@endsection