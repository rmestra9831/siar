@extends('layouts.extructure')
@section('title','Filtrado General')
{{-- vista del main --}}
@include('components.Main')
@section('title_content') Filtrado general @endsection

@section('body_main')
  <div class="container">
    {{-- DataPicker --}}
    <h3>Range</h3>
    <div class="ui form">
      <div class="two fields">
        <div class="field">
          <label>Start date</label>
          <div class="ui calendar" id="rangestart">
            <div class="ui input left icon">
              <i class="calendar icon"></i>
              <input type="text" placeholder="Start">
            </div>
          </div>
        </div>
        <div class="field">
          <label>End date</label>
          <div class="ui calendar" id="rangeend">
            <div class="ui input left icon">
              <i class="calendar icon"></i>
              <input type="text" placeholder="End">
            </div>
          </div>
        </div>
      </div>
    </div>
    <br/>
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
            <th class="ui center aligned text-capitalize">Fecha Creado</th>
            <th class="ui center aligned text-capitalize">Fecha Enviado Dirección</th>
            <th class="ui center aligned text-capitalize">Fecha Recibido Dirección</th>
            <th class="ui center aligned text-capitalize">Fecha Delegado</th>
            <th class="ui center aligned text-capitalize">Fecha Respondido</th>
            <th class="ui center aligned text-capitalize">Fecha Enviado a Admisiones</th>
            <th class="ui center aligned text-capitalize">Fecha Email Enviado</th>
            <th class="ui center aligned text-capitalize">Fecha Entregado Final</th>
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
            <th name="Fecha Creado">Fecha Creado</th>
            <th name="Fecha Enviado DirecciOn">Fecha Enviado Dirección</th>
            <th name="Fecha Recibido DirecciOn">Fecha Recibido Dirección</th>
            <th name="Fecha Delegado">Fecha Delegado</th>
            <th name="Fecha Respondido">Fecha Respondido</th>
            <th name="Fecha Enviado a Admisiones">Fecha Enviado a Admisiones</th>
            <th name="Fecha Email Enviado">Fecha Email Enviado</th>
            <th name="Fecha Entregado Final">Fecha Entregado Final</th>
        </tfoot>
      </table>
  </div>
@endsection