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
/******/ 	return __webpack_require__(__webpack_require__.s = 3);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/forms/ajaxform.js":
/*!****************************************!*\
  !*** ./resources/js/forms/ajaxform.js ***!
  \****************************************/
/*! no static exports found */
/***/ (function(module, exports) {

//VALIDACION DE LOS FORMULARIOS
$('.ui.create_radic.form') //validacion creacion de radicado
.form({
  inline: true,
  fields: {
    firstName: 'empty',
    lastName: 'empty',
    email: ['email', 'empty'],
    celphone: 'empty',
    program_radic: 'empty',
    destination_radic: 'empty',
    type_reason_radic: 'empty',
    reason_radic: 'empty',
    affair: 'empty',
    atention_radic: 'empty',
    origin_radic: 'empty'
  },
  onSuccess: function onSuccess(event) {
    event.preventDefault();
    $form = $('#create_radic');
    data_for = $form.form('get values');
    $.ajax({
      type: "POST",
      url: "/radicado",
      data: data_for,
      serializeForm: true,
      beforeSend: function beforeSend() {
        spinner_load = '<i class="spinner loading icon" style="font-size: 7em !important"></i> Creando...';
        $('.icon.header').empty();
        $('.icon.header').append(spinner_load);
      },
      success: function success(response) {
        // $('.ui.create_radic.form').form('clear');
        console.log(response);
        $.alert({
          theme: 'Modern',
          icon: 'lh check circle outline icon',
          title: 'Está Hecho',
          content: 'Radicado creado con exito',
          type: 'blue',
          typeAnimated: true
        });
      },
      complete: function complete() {
        spinner_load = '<i class="question circle outline icon" style="font-size: 7em !important"></i>Creando nuevo Radicado';
        $('.icon.header').empty();
        $('.icon.header').append(spinner_load);
      }
    });
  }
}); //seteo del campo de celular

var backspacePressedLast = false;
$(document).on('keydown', '#celphone', function (e) {
  var currentKey = e.which;

  if (currentKey === 8 || currentKey === 46) {
    backspacePressedLast = true;
  } else {
    backspacePressedLast = false;
  }
});
$(document).on('input', '#celphone', function (e) {
  if (backspacePressedLast) return;
  if (this.value.length > 14) this.value = this.value.slice(0, 14);
  var $this = $(e.currentTarget),
      currentValue = $this.val(),
      newValue = currentValue.replace(/\D+/g, ''),
      formattedValue = formatToTelephone(newValue);
  $this.val(formattedValue);
});

function formatToTelephone(str) {
  var splitString = str.split(''),
      returnValue = '';

  for (var i = 0; i < splitString.length; i++) {
    var currentLoop = i,
        currentCharacter = splitString[i];

    switch (currentLoop) {
      case 0:
        returnValue = returnValue.concat('(');
        returnValue = returnValue.concat(currentCharacter);
        break;

      case 2:
        returnValue = returnValue.concat(currentCharacter);
        returnValue = returnValue.concat(') ');
        break;

      case 5:
        returnValue = returnValue.concat(currentCharacter);
        returnValue = returnValue.concat('-');
        break;

      default:
        returnValue = returnValue.concat(currentCharacter);
    }
  }

  return returnValue;
} //seteo del campo de celular
// MODAL PARA CONFIRMAR LA CREACION DE UN RADICADO


$('.ui.basic.create_radic.modal').modal({
  closable: false
}).modal('attach events', '.create_radic.button', 'show'); //traer DATA a selects del formulario crear radicado

if (window.location.pathname == '/radicado') {
  $.ajax({
    type: "get",
    url: "getDataSelects",
    success: function success(response) {
      $.each(response['select_program'], function (p, item) {
        //datos de select program
        $('select[name="program_radic"]').append('<option value="' + item['id'] + '">' + item['name'] + '</option>');
      });
      $.each(response['select_destino'], function (p, item) {
        //datos de select destino
        $('select[name="destination_radic"]').append('<option value="' + item['id'] + '">' + item['name'] + '</option>');
      });
      $.each(response['select_origen'], function (p, item) {
        //datos de select origin
        $('select[name="origin_radic"]').append('<option value="' + item['id'] + '">' + item['origin_name'] + '</option>');
      });
    }
  });
}

$('select[name="type_reason_radic"]').change(function (e) {
  $('select[name="reason_radic"]').removeClass('disabled');
});

/***/ }),

/***/ 3:
/*!**********************************************!*\
  !*** multi ./resources/js/forms/ajaxform.js ***!
  \**********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\laragon\www\siar\resources\js\forms\ajaxform.js */"./resources/js/forms/ajaxform.js");


/***/ })

/******/ });