// TRAYENDO LOS PERMISOS DEL ROL SELCCIONADO EN LA VISTA TABLEPERMISSIONS
$.ajaxSetup({headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }});

$.ajax({ //obteniendo los roles 
    type: "GET",
    url: "getRole",
    success: function(response) {
        var rol_select = '<option value="">Seleccione el rol</option>';
        $.each(response, function(r) {
            rol_select = '<option value="' + response[r].id + '">' + response[r].name + '</option>';
            $('#rolesWithPermissions').append(rol_select);
        });
    }
});
// EVENTOS AL CAMBIAR LOS ROLES
$('#rolesWithPermissions').change(function() {
    var id_rol = this.value;
    $('#permisos-rol').DataTable({ //MOSTRANDO LOS DATOS DE LOS PERMISOS SEGUN USUARIO
        "destroy": true,
        "scrollCollapse": true,
        "ajax": "getPermissionsOnRole/" + id_rol + "", //traigo los usuarios para mirar sus permisos
        "columns": [{
                data: 'name'
            },
            {
                data: 'opciones'
            },
        ],
        "language": {
            "info": "_TOTAL_ Registros",
            "search": "Buscar",
            "paginate": {
                "next": "Siguiente",
                "previous": "Anterior",
            },
            "lengthMenu": 'Mostrar <select class="ui compact selection dropdown">' +
                '<option value="5">5</option>' +
                '<option value="10">10</option>' +
                '<option value= "-1">Todos</option>' +
                '</select> registros',
            "loadingRecords": "Cargando...",
            "Processing": "Procesando...",
            "emptyTable": "No se encontraron datos",
            "zeroRecords": "No hay coincidencias",
            "infoEmpty": "",
            "infoFiltered": "",
        },
    });
    $('#btn_add_permission').html('<button id="' + id_rol + '" class="ui violet add_permissions button"><i class="plus icon"></i>Asignar nuevo permiso</button>');

    //variables para editar, eliminar o agregar permisos
    $('.ui.longer.modal').modal({
        inverted: true,
        blurring: true,
        onApprove: function() { //confirmar
            var arr_permissions = $('[name="check_add_permissions_on_rol"]:checked').map(function(){ //obteniendo los datos de los checkers add_permissions to rol
                return this.value;
              }).get();
              var str = String(arr_permissions);
              if ($.isEmptyObject(arr_permissions)) {
                  $.alert({
                      title: 'No se han encontrado datos',
                      content: 'Por favor selecciona los permisos a ser añadadidos a este rol'
                  })
              } else {
                  $.confirm({ //aqui va el alerta personalizado
                      animation: 'zoom',
                      closeAnimation: 'zoom',
                      theme: 'modern',
                      icon: 'lh exclamation triangle icon',
                      backgroundDismissAnimation: 'glow',
                      title: 'Confirmación!',
                      content: 'Esta seguro que desea agregar estos permisos al rol seleccionado?',
                      type: 'orange',
                      buttons: {
                          aceptar: function() {
                              var data = "array="+str+"&idRol="+id_rol+"";
                              $.ajax({
                                  type: "post",
                                  url: "assingPermissionsOnRole",
                                  data: data,
                                  success: function (response) {
                                      $.alert({
                                          theme: 'Modern',
                                          icon: 'lh check circle outline icon',
                                          title: 'Está Hecho',
                                          content: 'Permiso/s '+response+' asignado correctamente',
                                          type: 'blue',
                                          typeAnimated: true,
                                    })
                                    $('#permisos-rol').DataTable().ajax.reload(); //recargando la tabla de los datos                               
                                  },
                                  error: function () {
                                      console.log('error'+ response);
                                  }
                              });
                          },
                          cancel: function() {
      
                          },
                      }
                  });
                  
              }
        }
    }).modal('attach events', '.add_permissions.button', 'show');

    // mostrando select de los permisos
    $('.add_permissions.button').click(function() {
        $.getJSON("getAddPermissions/" + id_rol + "", function(data) {
            $('#content_add_permissions').empty().fadeIn();
            if ($.isEmptyObject(data)) {
                $('#title_add_permissions').html('Este rol cuenta con todos los permisos');

                } else {
                $('#title_add_permissions').html('Asignando permisos al rol');
                $.each(data, function(p) { //TRAYENDO TODOS LOS PERMISOS QUE NO ESTAN ASIGNADOS
                    permission_select =
                        '<div class="column">' +
                        '<div class="ui slider checkbox">' +
                        '<input class="hidden" id="check' + data[p].id + '" name="check_add_permissions_on_rol" value="' + data[p].name + '" type="checkbox">' +
                        '<label for="check' + data[p].id + '">' + data[p].name + '</label>' +
                        '</div>' +
                        '</div>';
                    $('#content_add_permissions').append(permission_select).fadeIn();
                });
            }
            
        });
    });

});

//Cargando permisos directamente de la base de datos para CREAR NUEVO ROL
$('#nav-create-rol-tab').click(function () { 
    $('#chech_permissions').empty();
    $.get("getAllPermissions", function (data) {
        $.each(data, function(p) { //TRAYENDO TODOS LOS PERMISOS QUE NO ESTAN ASIGNADOS
            permission_select =
                '<div class="column">' +
                '<div class="ui slider checkbox">' +
                '<input class="hidden" id="check' + data[p].id + '" name="check_add_permissions_on_rol[]" value="' + data[p].id + '" type="checkbox">' +
                '<label for="check' + data[p].id + '">' + data[p].name + '</label>' +
                '</div>' +
                '</div>';
            $('#chech_permissions').append(permission_select).fadeIn();
        });
    });
    
});
// tabla de permisos