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

setTimeout(function () {
  //cargando todas las funciones ajax
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
          $('#infoModalTitle').html('Sin permisos de Usuario');
          $('#infoModalDescription').html('<strong>Este usuario no posee permisos directos</strong>');
          console.log('sin datos');
        } else {
          $('#infoModalTitle').html('Permisos de Usuario');
          $('#infoModalDescription').html('<strong>Este TIENE permisos directos</strong>');

          for (p = 0; p < permissions.length; p++) {
            permissions_name = permissions[p].name;
            console.log(permissions_name);
          }
        }
      }
    });
  });
}, 500); // TRAYENDO LOS PERMISOS DEL ROL SELCCIONADO EN LA VISTA TABLEPERMISSIONS

$.ajax({
  type: "GET",
  url: "getRole",
  beforeSend: function beforeSend() {
    $('#rolesWithPermissions').html('<option value="">Cargando...</option>');
  },
  success: function success(response) {
    var rol_select = '<option value="">Seleccione el rol</option>';
    $.each(response, function (r) {
      rol_select = '<option value="' + response[r].id + '">' + response[r].name + '</option>';
      $('#rolesWithPermissions').append(rol_select);
    });
  }
});
$('#rolesWithPermissions').change(function () {
  var id_rol = this.value;
  $.ajax({
    type: "GET",
    url: "getPermissionsOnRole/" + id_rol + "",
    beforeSend: function beforeSend() {},
    success: function success(response) {
      $('#permisos-rol').DataTable({
        //MOSTRANDO LOS DATOS DE LOS PERMISOS SEGUN USUARIO
        "destroy": true,
        "scrollCollapse": true,
        "data": response,
        //traigo los usuarios para mirar sus permisos
        "columns": [{
          data: 'name'
        }, {
          defaultContent: '<a href="" data-tooltip="Eliminar" data-position="top center" id="" class="circular ui icon red button"><i class="icon trash"></i></a>'
        }],
        "language": {
          "info": "_TOTAL_ Registros",
          "search": "Buscar",
          "paginate": {
            "next": "Siguiente",
            "previous": "Anterior"
          },
          "lengthMenu": 'Mostrar <select class="ui compact selection dropdown">' + '<option value="5">5</option>' + '<option value="10">10</option>' + '<option value="-1">Todos</option>' + '</select> registros',
          "loadingRecords": "Cargando...",
          "Processing": "Procesando...",
          "emptyTable": "No se encontraron datos",
          "zeroRecords": "No hay coincidencias",
          "infoEmpty": "",
          "infoFiltered": ""
        }
      });
    }
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