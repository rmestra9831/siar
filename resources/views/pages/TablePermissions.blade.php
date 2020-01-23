@extends('layouts.extructure')

{{-- vista del main --}}
@include('components.Main')

@section('title_content')
  Permisos de Usuarios
@endsection

@section('body_main')
<nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Permisos de usuarios</a>
    <a class="nav-item nav-link" id="nav-permissions-role-tab" data-toggle="tab" href="#nav-permissions-role" role="tab" aria-controls="nav-permissions-role" aria-selected="false">Permisos de roles</a>
    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Contact</a>
  </div>
</nav>
<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active p-3" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
    {{-- aqui van todos los usuarios con permisos --}}
    <div class="container">
      {{-- tabla e muestra de usuarios --}}
        <table id="table-permisos" class="ui single line celled table">
          <thead>
            <tr>
              <th class="ui center aligned">Nombre</th>
              <th class="ui center aligned">Sede</th>
              <th class="ui center aligned">Rol</th>
              <th class="ui center aligned">Permisos</th>
            </tr>
          </thead>
        </table>
    </div>
  </div>

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

  <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">

  </div>
</div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
          $('#table-permisos').DataTable({
              "serverSide": false,
              "scrollCollapse": true,
              "ajax": {
                "type": "GET",
                "url": "{{ route('getUserPermissions') }}",
                "complete":function () {
                  
                  $('.modal_permissions.modal').modal({ // inicialización del modals despues que se ejecuta la pag
                  inverted: true,
                  blurring: true,
                  onApprove : function() { //confirmar
                    $.confirm({ //aqui va el alerta personalizado
                        title: 'Confirm!',
                        content: 'Simple confirm!',
                        buttons: {
                            confirm: function () {
                                $.alert('Confirmed!');
                            },
                            cancel: function () {
                                $.alert('Canceled!');
                            },
                            somethingElse: {
                                text: 'Something else',
                                btnClass: 'btn-blue',
                                keys: ['enter', 'shift'],
                                action: function(){
                                    $.alert('Something else?');
                                }
                            }
                        }
                    });
                  }}).modal('attach events', '.permission.button');
                  
                  $('.permission').click(function () {
                    // configurando token de laravel en ajax
                    $.ajaxSetup({headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }});
                              
                    // opciones ajax para traer los permsos que tiene un usuario
                    $.ajax({
                      type: "GET",
                      url: "getPermissions/"+this.value+"", 
                      success: function (response) {
                        var users = response.users;
                        var permissions = response.permissions;

                        if ($.isEmptyObject(permissions)) {
                            $('#infoModalTitle').html('Sin permisos de Usuario');
                            $('#infoModalDescription').html('<strong>Este usuario no posee permisos directos</strong>');
                            console.log('sin datos');
                          } else {
                            console.log(permissions);
                            $('#infoModalTitle').html('Permisos de Usuario');
                            $('#infoModalDescription').html('<strong>Este TIENE permisos directos</strong>');                   
                            $.each(permissions, function (p) { //TRAYENDO TODOS LOS PERMISOS QUE NO ESTAN ASIGNADOS
                              permission_select = 
                              '<div class="column">'+
                                '<div class="ui test slider checkbox">'+
                                  '<input value="'+permissions[p].id+'" type="checkbox">'+
                                  '<label>'+permissions[p].name+'</label>'+
                                '</div>'+
                              '</div>';
                              $('#content_view_permissions').append(permission_select);
                            });  
                        }

                      }
                    });
                  
                  });

                }
              }, //traigo los usuarios para mirar sus permisos
              "columns": [
                  {data: 'name'},
                  {data: 'sede'},
                  {data: 'rol'},
                  {data: 'permissions'},               
              ],
              "language": {
                "info":"_TOTAL_ Registros",
                "search": "Buscar",
                "paginate":{
                  "next": "Siguiente",
                  "previous": "Anterior",
                },
                "lengthMenu": 'Mostrar <select class="ui compact selection dropdown">'+
                              '<option value="5">5</option>'+
                              '<option value="10">10</option>'+
                              '<option value="-1">Todos</option>'+
                              '</select> registros',
                "emptyTable": "No se encontraron datos",
                "zeroRecords": "No hay coincidencias",
                "infoEmpty": "",
                "infoFiltered": "",
              },
          })
        });
    </script>
@endsection