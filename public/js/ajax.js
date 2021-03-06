/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 4);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/ajax.js":
/*!******************************!*\
  !*** ./resources/js/ajax.js ***!
  \******************************/
/*! no static exports found */
/***/ (function(module, exports) {

// TRAYENDO LOS PERMISOS DEL ROL SELCCIONADO EN LA VISTA TABLEPERMISSIONS
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
}); //variables universales

var configLanguageDatatable = {
  "info": "_TOTAL_ Registros",
  "search": "Buscar",
  "paginate": {
    "next": "Siguiente",
    "previous": "Anterior"
  },
  "lengthMenu": 'Mostrar <select class="ui compact selection dropdown">' + '<option value="5">5</option>' + '<option value="10">10</option>' + '<option value="-1">Todos</option>' + '</select> registros',
  "emptyTable": "No se encontraron datos",
  "zeroRecords": "No hay coincidencias",
  "infoEmpty": "",
  "infoFiltered": ""
};

if (window.location.pathname == '/admin/Permissions') {
  $.ajax({
    //obteniendo los roles 
    type: "GET",
    url: "getRole",
    success: function success(response) {
      var rol_select = '<option value="">Seleccione el rol</option>';
      $.each(response, function (r) {
        rol_select = '<option value="' + response[r].id + '">' + response[r].name + '</option>';
        $('#rolesWithPermissions').append(rol_select);
      });
    }
  });
} // EVENTOS AL CAMBIAR LOS ROLES


$('#rolesWithPermissions').change(function () {
  var id_rol = this.value;
  $('#permisos-rol').DataTable({
    //MOSTRANDO LOS DATOS DE LOS PERMISOS SEGUN USUARIO
    "destroy": true,
    "scrollCollapse": true,
    "ajax": "getPermissionsOnRole/" + id_rol + "",
    //traigo los usuarios para mirar sus permisos
    "columns": [{
      data: 'name'
    }, {
      data: 'opciones'
    }],
    "language": configLanguageDatatable
  });
  $('#btn_add_permission').html('<button id="' + id_rol + '" class="ui violet add_permissions button"><i class="plus icon"></i>Asignar nuevo permiso</button>'); //variables para editar, eliminar o agregar permisos

  $('.ui.longer.modal').modal({
    inverted: true,
    blurring: true,
    onApprove: function onApprove() {
      //confirmar
      var arr_permissions = $('[name="check_add_permissions_on_rol"]:checked').map(function () {
        //obteniendo los datos de los checkers add_permissions to rol
        return this.value;
      }).get();
      var str = String(arr_permissions);

      if ($.isEmptyObject(arr_permissions)) {
        $.alert({
          title: 'No se han encontrado datos',
          content: 'Por favor selecciona los permisos a ser añadadidos a este rol'
        });
      } else {
        $.confirm({
          //aqui va el alerta personalizado
          animation: 'zoom',
          closeAnimation: 'zoom',
          theme: 'modern',
          icon: 'lh exclamation triangle icon',
          backgroundDismissAnimation: 'glow',
          title: 'Confirmación!',
          content: 'Esta seguro que desea agregar estos permisos al rol seleccionado?',
          type: 'orange',
          buttons: {
            aceptar: function aceptar() {
              var data = "array=" + str + "&idRol=" + id_rol + "";
              $.ajax({
                type: "post",
                url: "assingPermissionsOnRole",
                data: data,
                success: function success(response) {
                  $.alert({
                    theme: 'Modern',
                    icon: 'lh check circle outline icon',
                    title: 'Está Hecho',
                    content: 'Permiso/s ' + response + ' asignado correctamente',
                    type: 'blue',
                    typeAnimated: true
                  });
                  $('#permisos-rol').DataTable().ajax.reload(); //recargando la tabla de los datos                               
                },
                error: function error() {
                  console.log('error' + response);
                }
              });
            },
            cancel: function cancel() {}
          }
        });
      }
    }
  }).modal('attach events', '.add_permissions.button', 'show'); // mostrando select de los permisos

  $('.add_permissions.button').click(function () {
    $.getJSON("getAddPermissions/" + id_rol + "", function (data) {
      $('#content_add_permissions').empty().fadeIn();

      if ($.isEmptyObject(data)) {
        $('#title_add_permissions').html('Este rol cuenta con todos los permisos');
      } else {
        $('#title_add_permissions').html('Asignando permisos al rol');
        $.each(data, function (p) {
          //TRAYENDO TODOS LOS PERMISOS QUE NO ESTAN ASIGNADOS
          permission_select = '<div class="column">' + '<div class="ui slider checkbox">' + '<input class="hidden" id="check' + data[p].id + '" name="check_add_permissions_on_rol" value="' + data[p].name + '" type="checkbox">' + '<label for="check' + data[p].id + '">' + data[p].name + '</label>' + '</div>' + '</div>';
          $('#content_add_permissions').append(permission_select).fadeIn();
        });
      }
    });
  });
}); //Cargando permisos directamente de la base de datos para CREAR NUEVO ROL

$('#nav-create-rol-tab').click(function () {
  $('#chech_permissions').empty();
  $.get("getAllPermissions", function (data) {
    $.each(data, function (p) {
      //TRAYENDO TODOS LOS PERMISOS QUE NO ESTAN ASIGNADOS
      permission_select = '<div class="column">' + '<div class="ui slider checkbox">' + '<input class="hidden" id="check' + data[p].id + '" name="check_add_permissions_on_rol[]" value="' + data[p].id + '" type="checkbox">' + '<label for="check' + data[p].id + '">' + data[p].name + '</label>' + '</div>' + '</div>';
      $('#chech_permissions').append(permission_select).fadeIn();
    });
  });
}); //TABLA DE PERMISOS DE USUARIOS

$('#table-permisos').DataTable({
  "serverSide": false,
  "scrollCollapse": true,
  "ajax": {
    "type": "GET",
    "url": "getUserPermissions",
    "complete": function complete() {
      $('.modal_permissions.modal').modal({
        // inicialización del modals despues que se ejecuta la pag
        inverted: true,
        blurring: true,
        onApprove: function onApprove() {
          //confirmar
          $.confirm({
            //aqui va el alerta personalizado
            theme: 'Modern',
            title: 'Eliminar',
            content: 'Seguro que desea quitar el/los permiso/s a este usuario?',
            icon: 'lh exclamation triangle icon',
            backgroundDismissAnimation: 'glow',
            type: 'red',
            buttons: {
              Elimiar: function Elimiar() {
                $.alert('Confirmed!');
              },
              cancel: function cancel() {
                $.alert('Canceled!');
              }
            }
          });
        }
      }).modal('attach events', '.permission.button'); //trayendo los permissos para agregar

      $('.modal_add_direct_permission.modal').modal({
        // inicialización del modals despues que se ejecuta la pag
        inverted: true,
        blurring: true,
        onApprove: function onApprove() {
          //confirmar
          var arr_permissions_direct = $('[name="check_add_permissions_on_user"]:checked').map(function () {
            //obteniendo los datos de los checkers add_permissions to rol
            return this.value;
          }).get();
          var str_apd = String(arr_permissions_direct);

          if ($.isEmptyObject(arr_permissions_direct)) {
            $.alert({
              title: 'No se han encontrado datos',
              content: 'Por favor selecciona los permisos a ser añadadidos a este rol'
            });
          } else {
            $.confirm({
              //aqui va el alerta personalizado
              animation: 'scale',
              closeAnimation: 'scale',
              theme: 'modern',
              icon: 'lh exclamation triangle icon',
              backgroundDismissAnimation: 'glow',
              title: 'Confirmación!',
              content: 'Esta seguro que desea <strong>AGREGAR</strong> estos permisos al usuario seleccionado?',
              type: 'orange',
              buttons: {
                aceptar: function aceptar() {
                  var data = "array=" + str_apd + "&idUser=" + id_user + "";
                  $.ajax({
                    type: "post",
                    url: "assignDirectPermissionsOnUser",
                    data: data,
                    success: function success(response) {
                      $.alert({
                        theme: 'Modern',
                        icon: 'lh check circle outline icon',
                        title: 'Está Hecho',
                        content: 'Permiso/s ' + response + ' asignado correctamente',
                        type: 'blue',
                        typeAnimated: true
                      });
                      $('#table-permisos').DataTable().ajax.reload(); //recargando la tabla de los datos                               
                    },
                    error: function error() {
                      console.log('error al enviar los datos');
                    }
                  });
                },
                cancel: function cancel() {}
              }
            });
          }
        }
      }).modal('attach events', '.add_direct_permission.button'); //trayendo los permissos directos para eleiminarlos

      $('.modal_delete_direct_permission.modal').modal({
        // inicialización del modals despues que se ejecuta la pag
        inverted: true,
        blurring: true,
        onApprove: function onApprove() {
          //confirmar
          var arr_permissions_direct = $('[name="check_delete_permissions_on_user"]:checked').map(function () {
            //obteniendo los datos de los checkers add_permissions to rol
            return this.value;
          }).get();
          var str_dpd = String(arr_permissions_direct);

          if ($.isEmptyObject(arr_permissions_direct)) {
            $.alert({
              title: 'No se han encontrado datos',
              content: 'Por favor selecciona los permisos a ser añadadidos a este rol'
            });
          } else {
            $.confirm({
              //aqui va el alerta personalizado
              animation: 'scale',
              closeAnimation: 'scale',
              theme: 'modern',
              icon: 'lh exclamation triangle icon',
              backgroundDismissAnimation: 'glow',
              title: 'Confirmación!',
              content: 'Esta seguro que desea <strong>ELIMINAR</strong> estos permisos al usuario seleccionado?',
              type: 'orange',
              buttons: {
                aceptar: function aceptar() {
                  var data = "array=" + str_dpd + "&idUser=" + id_user + "";
                  $.ajax({
                    type: "delete",
                    url: "deleteDirectPermissionsOnUser/" + id_user + "/delete",
                    data: data,
                    success: function success(response) {
                      $.alert({
                        theme: 'Modern',
                        icon: 'lh check circle outline icon',
                        title: 'Está Hecho',
                        content: 'Permiso/s ' + response + ' Eliminado correctamente',
                        type: 'blue',
                        typeAnimated: true
                      });
                      $('#table-permisos').DataTable().ajax.reload(); //recargando la tabla de los datos                               
                    },
                    error: function error() {
                      $.alert({
                        animation: 'scale',
                        closeAnimation: 'scale',
                        theme: 'modern',
                        type: 'red',
                        icon: 'lh exclamation triangle icon',
                        title: '! Error ¡',
                        content: 'No se pudieron enviar los datos'
                      });
                    }
                  });
                },
                cancel: function cancel() {}
              }
            });
          }
        }
      }).modal('attach events', '.delete_direct_permission.button');
      $('.permission').click(function () {
        // configurando token de laravel en ajax
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        }); // opciones ajax para traer los permsos que tiene un usuario

        $.ajax({
          type: "GET",
          url: "getPermissions/" + this.value + "",
          success: function success(response) {
            var users = response.users;
            var permissions = response.permissions;

            if ($.isEmptyObject(permissions)) {
              $('#content_view_permissions').empty().fadeIn();
              $('#infoModalTitle').html('Sin permisos de Usuario');
              $('#infoModalDescription').html('<strong>Este usuario no posee permisos directos</strong>');
              console.log('sin datos');
            } else {
              // console.log(permissions);
              $('#infoModalTitle').html('Permisos de Usuario');
              $('#infoModalDescription').html('<strong>Este TIENE permisos directos</strong>'); // console.log(permissions);

              $('#content_view_permissions').empty();
              $.each(permissions, function (p) {
                //TRAYENDO TODOS LOS PERMISOS QUE NO ESTAN ASIGNADOS
                permission_select = '<div class="column">' + '<div class="ui test slider checkbox">' + '<input value="' + permissions[p].id + '" type="checkbox">' + '<label>' + permissions[p].name + '</label>' + '</div>' + '</div>';
                $('#content_view_permissions').append(permission_select).fadeIn();
              });
            }
          },
          error: function error() {
            $.alert({
              title: 'Oh lo siento!',
              content: 'Ocurrió un error al momento de traer los datos, por favor vuelve a recargar la página'
            });
          }
        });
      });
      $('.add_direct_permission.button').click(function () {
        id_user = this.value;
        $.ajax({
          type: "GET",
          url: "DirectPermissionsOnUser/" + this.value + "",
          success: function success(response) {
            if (response == false) {
              $('#content_add_direct_permissions').empty().fadeIn();
              $('#infoModalTitle_add_direct_permission').html('Este usuario cuenta con todos los permisos');
            } else {
              $('#infoModalTitle_add_direct_permission').html('Añadir permisos');
              $('#infoModalDescription').html('<strong>Este TIENE permisos directos</strong>'); //cuerpo del modal

              $('#content_add_direct_permissions').empty();
              $('#content_add_direct_permissions').append('<div class="ui icon info message"><i class="exclamation icon"></i><div class="content"><div class="header">Los permisos que no vea en pantalla, ya hacen parte de las funcionalidades del rol que tenga asignado cada usuario</div></div></div>').fadeIn(); // impresion de los check

              $.each(response, function (p) {
                //TRAYENDO TODOS LOS PERMISOS QUE NO ESTAN ASIGNADOS
                permission_select = '<div class="column">' + '<div class="ui slider checkbox">' + '<input class="hidden" id="check' + response[p].id + '" name="check_add_permissions_on_user" value="' + response[p].name + '" type="checkbox">' + '<label for="check' + response[p].id + '">' + response[p].name + '</label>' + '</div>' + '</div>';
                $('#content_add_direct_permissions').append(permission_select).fadeIn();
              });
            }
          },
          error: function error() {
            $.alert({
              title: 'Oh lo siento!',
              content: 'Ocurrió un error al momento de traer los datos, por favor vuelve a recargar la página'
            });
          }
        });
      });
      $('.delete_direct_permission.button').click(function () {
        id_user = this.value;
        $.ajax({
          type: "GET",
          url: "deleteViewDirectPermissionsOnUser/" + this.value + "",
          success: function success(response) {
            if (response == false) {
              $('#content_delete_direct_permissions').empty().fadeIn();
              $('#infoModalTitle_delete_direct_permission').html('No hay permsisos por remover');
            } else {
              $('#infoModalTitle_delete_direct_permission').html('Eliminar permisos'); //cuerpo del modal

              $('#content_delete_direct_permissions').empty();
              $('#content_delete_direct_permissions').append('<div class="ui icon info message"><i class="exclamation icon"></i><div class="content"><div class="header">Seleccione solo los permisos que desea remover de este usuario</div></div></div>').fadeIn(); // impresion de los check

              $.each(response, function (p) {
                //TRAYENDO TODOS LOS PERMISOS QUE NO ESTAN ASIGNADOS
                permission_select = '<input name="" id="#id_xdelet_permission" class="btn btn-primary" type="hidden" value="' + response[p].id + '">' + '<div class="column">' + '<div class="ui slider checkbox">' + '<input class="hidden" id="check' + response[p].id + '" name="check_delete_permissions_on_user" value="' + response[p].name + '" type="checkbox">' + '<label for="check' + response[p].id + '">' + response[p].name + '</label>' + '</div>' + '</div>';
                $('#content_delete_direct_permissions').append(permission_select).fadeIn();
              });
            }
          },
          error: function error() {
            $.alert({
              title: 'Oh lo siento!',
              content: 'Ocurrió un error al momento de traer los datos, por favor vuelve a recargar la página'
            });
          }
        });
      });
    }
  },
  //traigo los usuarios para mirar sus permisos
  "columns": [{
    data: 'name'
  }, {
    data: 'sede'
  }, {
    data: 'rol'
  }, {
    data: 'permissions'
  }],
  "language": configLanguageDatatable
}); // tabla de permisos
//TABLA DE FILTRADO GENERAL -------------------------------------------------------------------

var date = new Date();
var dateReport = date.getDate() + "_" + (date.getMonth() + 1) + "_" + date.getFullYear();
var tableFilterGeneral = $('#tableFilterGeneral').DataTable({
  "deferRender": true,
  "serverSide": false,
  "scroller": true,
  "scrollX": true,
  "ajax": {
    "type": "GET",
    "url": "getFilterRadics",
    "complete": function complete() {
      $('.dataTables_filter.ui.form').append("<div class='ui form'><div class='two fields'><div class='field'><div class='ui calendar' id='rangestart'><div class='ui input left icon'><i class='calendar icon'></i><input id='min' name='min' type='text' placeholder='Desde'></div></div></div><div class='field'><div class='ui calendar' id='rangeend'><div class='ui input left icon'><i class='calendar icon'></i><input id='max' name='max' type='text' placeholder='Hasta'></div></div></div></div></div>"); //   //datapicker RANGOS DE FECHAS DATATABLE

      $('#rangeend').calendar({
        // type: 'date',
        startCalendar: $('#rangestart'),
        formatter: {
          date: function date(_date, settings) {
            if (!_date) return '';

            var day = _date.getDate();

            var month = _date.getMonth() + 1;

            var year = _date.getFullYear();

            return year + '-' + month + '-' + day;
          }
        }
      });
      $('#rangestart').calendar({
        // type: 'date',
        endCalendar: $('#rangeend'),
        formatter: {
          date: function date(_date2, settings) {
            if (!_date2) return '';

            var day = _date2.getDate();

            var month = _date2.getMonth() + 1;

            var year = _date2.getFullYear();

            return year + '-' + month + '-' + day;
          }
        }
      }); // filtrado entre fechas

      $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
        var min = new Date($('#min').val());
        var max = new Date($('#max').val());
        var dataFilter = new Date(data[13]) || 0; // use data for the dataFilter column

        if (isNaN(min) && isNaN(max) || isNaN(min) && dataFilter <= max || min <= dataFilter && isNaN(max) || min <= dataFilter && dataFilter <= max) {
          return true;
        }

        return false;
      }); // Event listener to the two range filtering inputs to redraw on input

      $('#min').focusout(function () {
        tableFilterGeneral.draw();
      });
      $('#max').focusout(function () {
        tableFilterGeneral.draw();
      });
    }
  },
  //traigo los usuarios para mirar sus permisos
  "columns": [{
    data: 'consecutive'
  }, {
    data: 'names'
  }, {
    data: 'origin_correo'
  }, {
    data: 'origin_cel'
  }, {
    data: 'programa'
  }, {
    data: 'origen'
  }, {
    data: 'destino'
  }, {
    data: 'caracter'
  }, {
    data: 'motivo'
  }, {
    data: 'affair'
  }, {
    data: 'createBy'
  }, {
    data: 'delegateTo'
  }, {
    data: 'answerBy'
  }, {
    data: 'creation'
  }, {
    data: 'sent_dir'
  }, {
    data: 'get_dir'
  }, {
    data: 'delegado'
  }, {
    data: 'answered'
  }, {
    data: 'sentAdmission'
  }, {
    data: 'sentMail'
  }, {
    data: 'sentDelivered'
  }],
  "language": configLanguageDatatable
}); // Display the buttons tabla filtrado general

if (window.location.pathname == '/radicado/filtrado_general') {
  new $.fn.dataTable.Buttons(tableFilterGeneral, [{
    extend: 'excelHtml5',
    exportOptions: {
      columns: ':visible'
    }
  }, {
    extend: 'pdfHtml5',
    exportOptions: {
      columns: ':visible'
    },
    orientation: 'landscape',
    pageSize: 'LEGAL'
  }, {
    extend: 'print',
    text: 'Imprimir',
    messageBottom: null,
    exportOptions: {
      columns: ':visible'
    }
  }, {
    extend: "colvis",
    text: 'Mostrar columnas'
  }]);
}

tableFilterGeneral.buttons().container().appendTo($('div.eight.column:eq(0)', tableFilterGeneral.table().container()));
$('#tableFilterGeneral tbody').on('click', 'tr', function () {
  var data = tableFilterGeneral.row(this).data();
  $.confirm({
    //aqui va el alerta personalizado
    animation: 'zoom',
    closeAnimation: 'zoom',
    theme: 'modern',
    icon: 'lh eye icon',
    backgroundDismissAnimation: 'glow',
    title: 'Ir al Radicado',
    content: 'Deseas ver el radicado ' + data['consecutive'],
    type: 'orange',
    buttons: {
      aceptar: function aceptar() {
        location.replace(' ');
        window.location.assign('/radicado/' + data['slug'] + '/show');
      },
      cancel: function cancel() {}
    }
  }); // console.log(data);
});
$('#tableFilterGeneral tfoot th').each(function () {
  //BUSCADOR POR CAMPOS
  $('.ttt th').html('<div class="ui input"><input type="text" placeholder="Buscar por..."></div>');
}); // Apply the search

tableFilterGeneral.columns().every(function () {
  var that = this;
  $('input', this.footer()).on('keyup change clear', function () {
    if (that.search() !== this.value) {
      that.search(this.value).draw();
    }
  });
}); //TABLA DE FILTRADOD DE ESTADOS -------------------------------------------------------------------

var btnsFilterState = document.querySelectorAll('.item.filterState');
var status;
var tableFilterState;
$(btnsFilterState).click(function (e) {
  e.preventDefault();
  $('.message.viewStates').fadeOut();
  $(btnsFilterState).removeClass('active');
  $(this).addClass('active');
  status = $(this).attr('dataStatus');
  tableFilterState = $('#tableFilterState').DataTable({
    "destroy": true,
    "deferRender": true,
    "serverSide": false,
    "scroller": true,
    "scrollX": true,
    "ajax": {
      "type": "GET",
      "url": "getFilterState/" + status + "",
      "complete": function complete() {
        $('.dataTables_filter.ui.form').append("<div class='ui form'><div class='two fields'><div class='field'><div class='ui calendar' id='rangestart'><div class='ui input left icon'><i class='calendar icon'></i><input id='min' name='min' type='text' placeholder='Desde'></div></div></div><div class='field'><div class='ui calendar' id='rangeend'><div class='ui input left icon'><i class='calendar icon'></i><input id='max' name='max' type='text' placeholder='Hasta'></div></div></div></div></div>"); //   //datapicker RANGOS DE FECHAS DATATABLE

        $('#rangeend').calendar({
          // type: 'date',
          startCalendar: $('#rangestart'),
          formatter: {
            date: function date(_date3, settings) {
              if (!_date3) return '';

              var day = _date3.getDate();

              var month = _date3.getMonth() + 1;

              var year = _date3.getFullYear();

              return year + '-' + month + '-' + day;
            }
          }
        });
        $('#rangestart').calendar({
          // type: 'date',
          endCalendar: $('#rangeend'),
          formatter: {
            date: function date(_date4, settings) {
              if (!_date4) return '';

              var day = _date4.getDate();

              var month = _date4.getMonth() + 1;

              var year = _date4.getFullYear();

              return year + '-' + month + '-' + day;
            }
          }
        }); // filtrado entre fechas

        $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
          var min = new Date($('#min').val());
          var max = new Date($('#max').val());
          var dataFilter = new Date(data[13]) || 0; // use data for the dataFilter column

          if (isNaN(min) && isNaN(max) || isNaN(min) && dataFilter <= max || min <= dataFilter && isNaN(max) || min <= dataFilter && dataFilter <= max) {
            return true;
          }

          return false;
        }); // Event listener to the two range filtering inputs to redraw on input

        $('#min').focusout(function () {
          tableFilterState.draw();
        });
        $('#max').focusout(function () {
          tableFilterState.draw();
        });
      }
    },
    //traigo los usuarios para mirar sus permisos
    "columns": [{
      data: 'consecutive'
    }, {
      data: 'names'
    }, {
      data: 'origin_correo'
    }, {
      data: 'origin_cel'
    }, {
      data: 'programa'
    }, {
      data: 'origen'
    }, {
      data: 'destino'
    }, {
      data: 'caracter'
    }, {
      data: 'motivo'
    }, {
      data: 'affair'
    }, {
      data: 'createBy'
    }, {
      data: 'delegateTo'
    }, {
      data: 'answerBy'
    }, {
      data: 'creation'
    }, {
      data: 'sent_dir'
    }, {
      data: 'get_dir'
    }, {
      data: 'delegado'
    }, {
      data: 'answered'
    }, {
      data: 'sentAdmission'
    }, {
      data: 'sentMail'
    }, {
      data: 'sentDelivered'
    }],
    "language": configLanguageDatatable
  }); // Display the buttons tabla filtrado general

  if (window.location.pathname == '/radicado/filtrado_de_estado') {
    new $.fn.dataTable.Buttons(tableFilterState, [{
      extend: 'excelHtml5',
      exportOptions: {
        columns: ':visible'
      }
    }, {
      extend: 'pdfHtml5',
      exportOptions: {
        columns: ':visible'
      },
      orientation: 'landscape',
      pageSize: 'LEGAL'
    }, {
      extend: 'print',
      text: 'Imprimir',
      messageBottom: null,
      exportOptions: {
        columns: ':visible'
      }
    }, {
      extend: "colvis",
      text: 'Mostrar columnas'
    }]);
  }

  tableFilterState.buttons().container().appendTo($('div.eight.column:eq(0)', tableFilterState.table().container()));
  $('#tableFilterState tfoot th').each(function () {
    //BUSCADOR POR CAMPOS
    $('.ttt th').html('<div class="ui input"><input type="text" placeholder="Buscar por..."></div>');
  }); // Apply the search

  tableFilterState.columns().every(function () {
    var that = this;
    $('input', this.footer()).on('keyup change clear', function () {
      if (that.search() !== this.value) {
        that.search(this.value).draw();
      }
    });
  });
});

/***/ }),

/***/ 4:
/*!************************************!*\
  !*** multi ./resources/js/ajax.js ***!
  \************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\laragon\www\siar\resources\js\ajax.js */"./resources/js/ajax.js");


/***/ })

/******/ });