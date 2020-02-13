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
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
$form_create_radic = $('#create_radic');
$('.ui.create_radic.form') //validacion creacion de radicado
.form({
  inline: true,
  fields: {
    firstName: 'empty',
    lastName: 'empty',
    email: ['email', 'empty'],
    celphone: ['minLength[14]', 'empty'],
    program_radic: 'empty',
    destination_radic: 'empty',
    type_reason_radic: 'empty',
    reason_radic: 'empty',
    affair: ['minLength[8]', 'empty'],
    atention_radic: 'empty',
    origin_radic: 'empty'
  },
  onSuccess: function onSuccess(event) {
    event.preventDefault();
    data_for = $form_create_radic.form('get values');
    $.ajax({
      type: "post",
      url: "/radicado",
      data: data_for,
      serializeForm: true,
      dataType: 'json',
      beforeSend: function beforeSend() {
        spinner_load = '<i class="spinner loading icon" style="font-size: 7em !important"></i> Creando...';
        $('.icon.header').empty();
        $('.icon.header').append(spinner_load);
      },
      success: function success(response) {
        $.alert({
          theme: 'Modern',
          icon: 'lh check circle outline icon',
          title: 'Radicado Creado',
          content: 'Con número ' + response.consecutive + '',
          type: 'blue',
          typeAnimated: true
        });
      },
      complete: function complete() {
        spinner_load = '<i class="question circle outline icon" style="font-size: 7em !important"></i>Creando nuevo Radicado';
        $('.icon.header').empty();
        $('.icon.header').append(spinner_load);
      },
      error: function error() {
        $.alert({
          theme: 'Modern',
          icon: 'lh check circle outline icon',
          title: 'Error',
          content: 'Se a presentado un error',
          type: 'red',
          typeAnimated: true
        });
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
      //agregando info
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
      }); //reasons tridos desde ajax

      $('select[name="type_reason_radic"]').change(function (e) {
        $('.fluid.reason').removeClass('disabled bg-secondary');
        value_motivo = $form_create_radic.form('get value', 'type_reason_radic');
        $.getJSON("getReasons/" + value_motivo + "", function (data) {
          //tratendo todos los motivos segun el select
          $('select[name="reason_radic"]').empty(); //limpiando el select

          $.each(data, function (p) {
            select_motivo = '<option value="' + data[p].id + '">' + data[p].name + '</option>';
            $('select[name="reason_radic"]').append(select_motivo);
          });
        });
        $('select[name="reason_radic"]').change(function (e) {
          value_txt_motivo = $('select[name="reason_radic"] option:selected').text();
          $form_create_radic.form('set value', 'affair', value_txt_motivo);
        });
      });
    }
  });
} //BOTONES DE RESPOSNER Y DELEGAR DE DIRECCION


$('.fileAnswer').hide();
$('.btnFile').hide();
$('.textAnswer.btn').addClass('disabled');
$('textarea[name="answer"]').keydown(function (e) {
  valorTxtArea = $('textarea[name="answer"]').val();

  if (valorTxtArea.length >= 9) {
    $('.textAnswer.btn').removeClass('disabled');
  } else {
    $('.textAnswer.btn').addClass('disabled');
  }
});
$('#answerMe').click(function (e) {
  // console.log('sas');
  $('.btnFile').hide();
  $('textarea[name="answer"]').val('');
  $('.textAnswer.btn').addClass('disabled');
  $('select[name="selectMulipleAnswer"]').empty();
  select_motivo = '<option value="1">Texto</option> <option value="2">Archivo</option>';
  $('textarea[name="answer"]').removeAttr('disabled');
  $('textarea[name="answer"]').removeClass('disabled');
  $('select[name="selectMulipleAnswer"]').append(select_motivo); //AGREGA LOS OPTIONS

  $('select[name="selectMulipleAnswer"]').change(function (e) {
    //EVENTO QUE CAMBIA EL INPUT PARA AGREGAR LA RESPUESTA
    value_typeAnswer = $('select[name="selectMulipleAnswer"] option:selected').val();

    if (value_typeAnswer == 2) {
      $('.textAnswer').hide();
      $('.fileAnswer').show();
    } else {
      $('.textAnswer.btn').addClass('disabled');
      $('textarea[name="answer"]').val('');
      $('.textAnswer').show();
      $('.fileAnswer').hide();
    }
  });
  $('.typeAnswer').fadeIn().show();
});
$('#delegateAnswer').click(function (e) {
  $('.typeAnswer').hide();
  $('select[name="selectMulipleAnswer"]').empty();
  $('.btnFile').show();
  $.get("/getonlyUsers", function (data, p) {
    //TRAYENDO LOS DATOS DE LOS PROGRAMAS A DELEGAR LA RESPUESTA
    $.each(data, function (p) {
      select_motivo = '<option value="' + data[p].id + '">' + data[p].name + '</option>';
      $('select[name="selectMulipleAnswer"]').append(select_motivo);
    });
  });
});
$('.textAnswer.btn').click(function (e) {
  $.confirm({
    //aqui va el alerta personalizado
    animation: 'zoom',
    closeAnimation: 'zoom',
    theme: 'modern',
    icon: 'lh exclamation triangle icon',
    backgroundDismissAnimation: 'glow',
    title: 'Confirmación!',
    content: '¿ Está seguro que desea responder este radicado ?',
    type: 'orange',
    buttons: {
      aceptar: function aceptar() {
        $('#AnswertextForm').submit();
      },
      cancel: function cancel() {}
    }
  });
});
$('.fileAnswer.btn').click(function (e) {
  $.confirm({
    //aqui va el alerta personalizado
    animation: 'zoom',
    closeAnimation: 'zoom',
    theme: 'modern',
    icon: 'lh exclamation triangle icon',
    backgroundDismissAnimation: 'glow',
    title: 'Confirmación!',
    content: '¿ Está seguro que desea responder este radicado ?',
    type: 'orange',
    buttons: {
      aceptar: function aceptar() {
        $('#fileAnswerForm').submit();
      },
      cancel: function cancel() {}
    }
  });
});
$('.delegate.btn').click(function (e) {
  $.confirm({
    //aqui va el alerta personalizado
    animation: 'zoom',
    closeAnimation: 'zoom',
    theme: 'modern',
    icon: 'lh exclamation triangle icon',
    backgroundDismissAnimation: 'glow',
    title: 'Confirmación!',
    content: '¿ Está seguro que desea responder este radicado ?',
    type: 'orange',
    buttons: {
      aceptar: function aceptar() {
        $('#delegateAnswerForm').submit();
      },
      cancel: function cancel() {}
    }
  });
}); //BOTONES DEL JEFE DE PROGRAMA O OTROS

$('.redirectAnswer').hide();
$('#delegateAnswerUser').click(function (e) {
  // console.log('sas');
  $('.selectMulipleAnswer').show();
  $('.redirectAnswer').hide();
  $('.btnFile').hide();
  $('textarea[name="answer"]').val('');
  $('.textAnswer.btn').addClass('disabled');
  $('select[name="selectMulipleAnswer"]').empty();
  select_motivo = '<option value="1">Texto</option> <option value="2">Archivo</option>';
  $('textarea[name="answer"]').removeAttr('disabled');
  $('textarea[name="answer"]').removeClass('disabled');
  $('select[name="selectMulipleAnswer"]').append(select_motivo); //AGREGA LOS OPTIONS

  $('select[name="selectMulipleAnswer"]').change(function (e) {
    //EVENTO QUE CAMBIA EL INPUT PARA AGREGAR LA RESPUESTA
    value_typeAnswer = $('select[name="selectMulipleAnswer"] option:selected').val();

    if (value_typeAnswer == 2) {
      $('.textAnswer').hide();
      $('.fileAnswer').show();
    } else {
      $('.textAnswer.btn').addClass('disabled');
      $('textarea[name="answer"]').val('');
      $('.textAnswer').show();
      $('.fileAnswer').hide();
    }
  });
  $('.typeAnswer').fadeIn().show();
});
$('#answerRedirect').click(function (e) {
  $('.selectMulipleAnswer').hide();
  $('.redirect.btn').addClass('disabled');
  $('.typeAnswer').hide();
  $('.redirectAnswer').show();
  $('textarea[name="redirectAnswer"]').keydown(function (e) {
    valorTxtArea = $('textarea[name="redirectAnswer"]').val();

    if (valorTxtArea.length >= 5) {
      $('.redirect.btn').removeClass('disabled');
    } else {
      $('.redirect.btn').addClass('disabled');
    }
  });
  $('.redirect.btn').click(function (e) {
    $.confirm({
      //aqui va el alerta personalizado
      animation: 'zoom',
      closeAnimation: 'zoom',
      theme: 'modern',
      icon: 'lh exclamation triangle icon',
      backgroundDismissAnimation: 'glow',
      title: 'Redireccionamiento',
      content: '¿ Está seguro que desea Redireccionar este radicado ?',
      type: 'orange',
      buttons: {
        aceptar: function aceptar() {
          $('#redirectAnswer').submit();
        },
        cancel: function cancel() {}
      }
    });
  });
}); //BOTONES DE ACEPTACION DE REDIRECCION

$('.refuseRedirection').click(function (e) {
  $.confirm({
    //aqui va el alerta personalizado
    animation: 'zoom',
    closeAnimation: 'zoom',
    theme: 'modern',
    icon: 'lh exclamation triangle icon',
    backgroundDismissAnimation: 'glow',
    title: 'Confirmación!',
    content: '¿ Está seguro que desea denegar esta solicitud ?',
    type: 'orange',
    buttons: {
      aceptar: function aceptar() {
        $('#refuseRedirectionForm').submit();
      },
      cancel: function cancel() {}
    }
  });
});
$('.acceptRedirection').click(function (e) {
  $.confirm({
    //aqui va el alerta personalizado
    animation: 'zoom',
    closeAnimation: 'zoom',
    theme: 'modern',
    icon: 'lh exclamation triangle icon',
    backgroundDismissAnimation: 'glow',
    title: 'Confirmación!',
    content: '¿ Está seguro que desea denegar esta solicitud ?',
    type: 'orange',
    buttons: {
      aceptar: function aceptar() {
        $('#acceptRedirectionForm').submit();
      },
      cancel: function cancel() {}
    }
  });
}); //MODAL PARA MOSTRAR LOS RADICADOS

$('.modal.previewPdf').modal({
  inverted: true,
  blurring: true
}).modal('attach events', '#previewRadic', 'show'); //MODAL PARA FORMULARIO DE EDITAR RESPUESTA

$('.modal.reasonAnswerCheck').modal({
  inverted: true
}).modal('attach events', '#EditAnswer', 'show'); //ENVIAR FORMULARIO DE EDICION DE RESPUESTA

$('#EditAnswerFormSend').click(function (e) {
  if ($('#answerReasonEdit').val()) {
    $.alert({
      //aqui va el alerta personalizado
      animation: 'zoom',
      closeAnimation: 'zoom',
      theme: 'modern',
      icon: 'lh exclamation triangle icon',
      backgroundDismissAnimation: 'glow',
      title: 'Confirmación!',
      content: '¿ Está seguro que desea enviar la solicitud de modificación a esta respuesta ?',
      type: 'orange',
      buttons: {
        aceptar: function aceptar() {
          $('#EditAnswerForm').submit();
        },
        cancel: function cancel() {}
      }
    });
  } else {
    $.alert({
      //aqui va el alerta personalizado
      animation: 'zoom',
      closeAnimation: 'zoom',
      theme: 'modern',
      icon: 'lh exclamation triangle icon',
      backgroundDismissAnimation: 'glow',
      title: 'Error!',
      content: 'El campo se encuentra vacio, por favor ingrese datos correctos',
      type: 'red',
      buttons: {
        aceptar: function aceptar() {}
      }
    });
  }
}); //FUNCIONES DE LOS ITEMS DE NOTIFICACION

var itemsNotify = document.querySelectorAll('#itemNotify');
$(itemsNotify).click(function (e) {
  // console.log($(this).attr('xvurl'));
  userAuth = $(this).attr('idUser');
  idNotify = $(this).attr('idNotidy');
  url = $(this).attr('xvurl');
  var data = "idNotify=" + idNotify + "&slug=" + url + "";
  location.replace(' ');
  $.ajax({
    type: "PUT",
    url: "radicado/" + userAuth + "/readNotify",
    data: data,
    success: function success(response) {
      window.location.assign('/radicado/' + url + '/show');
    }
  });
});
$('#allNotifyReaded').click(function (e) {
  userAuth = $(this).attr('idUser'); // location.replace(' ');

  var data = "userAuth=" + userAuth + "";
  $.ajax({
    type: "PUT",
    url: "radicado/" + userAuth + "/readAllNotify",
    data: data,
    success: function success(response) {
      // console.log(response);
      window.location.reload();
    }
  });
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