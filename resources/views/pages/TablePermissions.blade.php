@extends('layouts.extructure')

{{-- vista del main --}}
@include('components.Main')

@section('title_content')
  Permisos de Usuarios
@endsection

@section('body_main')

<nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="nav-item nav-link active" id="nav-permissions-users-tab" data-toggle="tab" href="#nav-permissions-users" role="tab" aria-controls="nav-permissions-users" aria-selected="true">Permisos de usuarios</a>

    {{-- menu para editar los roles --}}
    <a class="nav-item nav-link" id="nav-permissions-role-tab" data-toggle="tab" href="#nav-permissions-role" role="tab" aria-controls="nav-permissions-role" aria-selected="false">Permisos de roles</a>

    <a class="nav-item nav-link" id="nav-create-rol-tab" data-toggle="tab" href="#nav-create-rol" role="tab" aria-controls="nav-create-rol" aria-selected="false">Nuevo Rol</a>
  </div>
</nav>
<div class="tab-content" id="nav-tabContent">

  <div class="tab-pane fade show active p-3" id="nav-permissions-users" role="tabpanel" aria-labelledby="nav-permissions-users-tab">
    {{-- aqui van todos los usuarios con permisos --}}
    <div class="container">
      {{-- tabla e muestra de usuarios --}}
        <table id="table-permisos" class="ui single line celled table">
          <thead>
            <tr>
              <th class="ui center aligned">Nombre</th>
              <th class="ui center aligned">Sede</th>
              <th class="ui center aligned">Rol</th>
              <th class="ui center aligned">Acciones</th>
            </tr>
          </thead>
        </table>
    </div>
  </div>
  {{-- cuerpo 2 --}}
  <div class="tab-pane fade p-3" id="nav-permissions-role" role="tabpanel" aria-labelledby="nav-permissions-role-tab">
    <div class="container">
      @include('common.Info')
      {{-- Muestra los roles y sus permisos correspondientes --}}
      <div class="ui form">
        <div class="inline field">
          <label>Roles</label>
          <select class="ui fluid dropdown" id="rolesWithPermissions">
            <option value="">Seleccione una rol</option>
          </select>
        </div>
      </div>
      {{-- tabla e muestra de usuarios --}}
      <div class="m-4">
          <table id="permisos-rol" class="ui single line celled table">
            <thead>
              <tr>
                <th class="ui center aligned">Permiso</th>
                <th class="ui center aligned">Acciones</th>
              </tr>
            </thead>
          </table>
      </div>
      <div id="btn_add_permission"></div>
    </div>
  </div>

  <div class="tab-pane fade p-3" id="nav-create-rol" role="tabpanel" aria-labelledby="nav-create-rol-tab">
    <div class="container">
      {{-- formulario para crear un nuevo rol con sus permisos --}}
      <div class="ui center aligned basic segment">
        <div class="ui left icon action input">
          <i class="search icon"></i>
          <input type="text" placeholder="Order #">
          <div class="ui blue submit button">Search</div>
        </div>
        <div class="ui horizontal divider">Permisos</div> {{--divisor--}}
        <div class="container">
          <div class="ui form three column grid">
            <div class="left aligned grouped fields row" id="chech_permissions">
                
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
@endsection

@section('scripts')

@endsection