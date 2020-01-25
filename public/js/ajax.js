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
/******/ 	return __webpack_require__(__webpack_require__.s = 2);
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
});
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
}); // EVENTOS AL CAMBIAR LOS ROLES

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
    "language": {
      "info": "_TOTAL_ Registros",
      "search": "Buscar",
      "paginate": {
        "next": "Siguiente",
        "previous": "Anterior"
      },
      "lengthMenu": 'Mostrar <select class="ui compact selection dropdown">' + '<option value="5">5</option>' + '<option value="10">10</option>' + '<option value= "-1">Todos</option>' + '</select> registros',
      "loadingRecords": "Cargando...",
      "Processing": "Procesando...",
      "emptyTable": "No se encontraron datos",
      "zeroRecords": "No hay coincidencias",
      "infoEmpty": "",
      "infoFiltered": ""
    }
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
}); // tabla de permisos

/***/ }),

/***/ 2:
/*!************************************!*\
  !*** multi ./resources/js/ajax.js ***!
  \************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\laragon\www\siar\resources\js\ajax.js */"./resources/js/ajax.js");


/***/ })

/******/ });