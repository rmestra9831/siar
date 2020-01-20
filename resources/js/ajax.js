setTimeout(function (){ //cargando todas las funciones ajax

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
                $('#infoModalTitle').html('Permisos de Usuario');
                $('#infoModalDescription').html('<strong>Este TIENE permisos directos</strong>');


                for(p=0; p<permissions.length; p++){
                    permissions_name = permissions[p].name;
                    console.log(permissions_name);
              }
            }
          }
        });
      
      });

},500);

// TRAYENDO LOS PERMISOS DEL ROL SELCCIONADO EN LA VISTA TABLEPERMISSIONS
$.ajax({
  type: "GET",
  url: "getRole",
  beforeSend(){
    $('#rolesWithPermissions').html('<option value="">Cargando...</option>');
  },
  success: function (response) {
    var rol_select = '<option value="">Seleccione el rol</option>';
    $.each(response, function (r) { 
      rol_select = '<option value="'+response[r].id+'">'+response[r].name+'</option>';
      $('#rolesWithPermissions').append(rol_select);
    });
  }
});

$('#rolesWithPermissions').change(function (){
  var id_rol = this.value;
  $.ajax({
    type: "GET",
    url: "getPermissionsOnRole/"+id_rol+"",
    beforeSend(){
    },
    success: function (response) {
      $('#permisos-rol').DataTable({ //MOSTRANDO LOS DATOS DE LOS PERMISOS SEGUN USUARIO
            "destroy": true,
            "scrollCollapse": true,
            "data": response, //traigo los usuarios para mirar sus permisos
            "columns": [
                {data: 'name'},
                {defaultContent: '<a href="" data-tooltip="Eliminar" data-position="top center" id="" class="circular ui icon red button"><i class="icon trash"></i></a>'}            
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
              "loadingRecords": "Cargando...",
              "Processing": "Procesando...",
              "emptyTable": "No se encontraron datos",
              "zeroRecords": "No hay coincidencias",
              "infoEmpty": "",
              "infoFiltered": "",
            },
      })

    }
  });
});
// tabla de permisos 