//VALIDACION DE LOS FORMULARIOS
$.ajaxSetup({headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }});
$form_create_radic = $('#create_radic');
$('.ui.create_radic.form') //validacion creacion de radicado
  .form({
    inline : true,
    fields: {
      firstName         : 'empty',
      lastName          : 'empty',
      email             : ['email','empty'],
      celphone          : ['minLength[14]','empty'],
      program_radic     : 'empty',
      destination_radic : 'empty',
      type_reason_radic : 'empty',
      reason_radic      : 'empty',
      affair            : ['minLength[8]','empty'],
      atention_radic    : 'empty',
      origin_radic      : 'empty',
    },onSuccess: function (event){
        event.preventDefault();
        data_for = $form_create_radic.form('get values');
        
        $.ajax({
          type: "post",
          url: "/radicado",
          data: data_for,
          serializeForm: true,
          dataType: 'json',
          beforeSend: function(){
            spinner_load = '<i class="spinner loading icon" style="font-size: 7em !important"></i> Creando...';
            $('.icon.header').empty();
            $('.icon.header').append(spinner_load);
          },
          success: function (response) {
            $.alert({
              theme: 'Modern',
              icon: 'lh check circle outline icon',
              title: 'Radicado Creado',
              content: 'Con número '+response.consecutive+'',
              type: 'blue',
              typeAnimated: true,
            })
          },complete: function(){
            spinner_load = '<i class="question circle outline icon" style="font-size: 7em !important"></i>Creando nuevo Radicado';
            $('.icon.header').empty();
            $('.icon.header').append(spinner_load);
          },error: function() {
            $.alert({
              theme: 'Modern',
              icon: 'lh check circle outline icon',
              title: 'Error',
              content: 'Se a presentado un error',
              type: 'red',
              typeAnimated: true,
            })
          }
        });
    }
});
//seteo del campo de celular
  var backspacePressedLast = false;
  $(document).on('keydown', '#celphone', function(e) {
    var currentKey = e.which;

    if (currentKey === 8 || currentKey === 46) {
        backspacePressedLast = true;
    } else {
        backspacePressedLast = false;
    }
  });
  $(document).on('input', '#celphone', function(e) {
    if (backspacePressedLast) return;
    if (this.value.length > 14) 
    this.value = this.value.slice(0,14);
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
  }
//seteo del campo de celular

// MODAL PARA CONFIRMAR LA CREACION DE UN RADICADO
$('.ui.basic.create_radic.modal')
  .modal({
    closable  : false,
  })
.modal('attach events', '.create_radic.button','show');

//traer DATA a selects del formulario crear radicado
if (window.location.pathname == '/radicado') {
  $.ajax({
    type: "get",
    url: "getDataSelects",
    success: function (response) {
      //agregando info
      $.each(response['select_program'], function (p,item) {  //datos de select program
        $('select[name="program_radic"]').append('<option value="'+item['id']+'">'+item['name']+'</option>');
      });
      $.each(response['select_destino'], function (p,item) { //datos de select destino
        $('select[name="destination_radic"]').append('<option value="'+item['id']+'">'+item['name']+'</option>');
      });
      $.each(response['select_origen'], function (p,item) { //datos de select origin
        $('select[name="origin_radic"]').append('<option value="'+item['id']+'">'+item['origin_name']+'</option>');
      });
      //reasons tridos desde ajax
      $('select[name="type_reason_radic"]').change(function (e) {
        $('.fluid.reason').removeClass('disabled bg-secondary');
        value_motivo = $form_create_radic.form('get value', 'type_reason_radic');
        $.getJSON("getReasons/"+value_motivo+"",function (data) { //tratendo todos los motivos segun el select
          $('select[name="reason_radic"]').empty(); //limpiando el select
          $.each(data, function (p) {
            select_motivo = '<option value="'+data[p].id+'">'+data[p].name+'</option>';
            $('select[name="reason_radic"]').append(select_motivo);
          });
          },
        );

        $('select[name="reason_radic"]').change(function (e) { 
          value_txt_motivo = $('select[name="reason_radic"] option:selected').text();
          if (value_txt_motivo == 'otro' || value_txt_motivo == 'Otro') {
            $('textarea[name="affair"]').removeAttr("disabled");
            $('textarea[name="affair"]').removeAttr("class");
            $('textarea[name="affair"]').val('');
          } else {
            $('textarea[name="affair"]').attr("disabled","disabled");
            $('textarea[name="affair"]').attr("class","c-white bg-secondary");
            $form_create_radic.form('set value', 'affair', value_txt_motivo)
          }
        });
      });
    }
  });
}
//BOTONES DE RESPOSNER Y DELEGAR DE DIRECCION
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
  $('textarea[name="answer"]').removeAttr('disabled'); $('textarea[name="answer"]').removeClass('disabled');
  $('select[name="selectMulipleAnswer"]').append(select_motivo); //AGREGA LOS OPTIONS

  $('select[name="selectMulipleAnswer"]').change(function (e) { //EVENTO QUE CAMBIA EL INPUT PARA AGREGAR LA RESPUESTA
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
  $.get("/getonlyUsers", function (data, p) { //TRAYENDO LOS DATOS DE LOS PROGRAMAS A DELEGAR LA RESPUESTA
      $.each(data, function (p) { 
        select_motivo = '<option value="'+data[p].id+'">'+data[p].name+'</option>';
        $('select[name="selectMulipleAnswer"]').append(select_motivo);
      });
    },
  );
});

$('.textAnswer.btn').click(function (e) { 
  $.confirm({ //aqui va el alerta personalizado
    animation: 'zoom',
    closeAnimation: 'zoom',
    theme: 'modern',
    icon: 'lh exclamation triangle icon',
    backgroundDismissAnimation: 'glow',
    title: 'Confirmación!',
    content: '¿ Está seguro que desea responder este radicado ?',
    type: 'orange',
    buttons: {
        aceptar: function() {
            $('#AnswertextForm').submit();
        },
        cancel: function() {},
    }
  }); 
});
$('.fileAnswer.btn').click(function (e) { 
  $.confirm({ //aqui va el alerta personalizado
    animation: 'zoom',
    closeAnimation: 'zoom',
    theme: 'modern',
    icon: 'lh exclamation triangle icon',
    backgroundDismissAnimation: 'glow',
    title: 'Confirmación!',
    content: '¿ Está seguro que desea responder este radicado ?',
    type: 'orange',
    buttons: {
        aceptar: function() {
            $('#fileAnswerForm').submit();
        },
        cancel: function() {},
    }
  });
});
$('.delegate.btn').click(function (e) { 
  $.confirm({ //aqui va el alerta personalizado
    animation: 'zoom',
    closeAnimation: 'zoom',
    theme: 'modern',
    icon: 'lh exclamation triangle icon',
    backgroundDismissAnimation: 'glow',
    title: 'Confirmación!',
    content: '¿ Está seguro que desea responder este radicado ?',
    type: 'orange',
    buttons: {
        aceptar: function() {
            $('#delegateAnswerForm').submit();
        },
        cancel: function() {},
    }
  });
});

//BOTONES DEL JEFE DE PROGRAMA O OTROS
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
  $('textarea[name="answer"]').removeAttr('disabled'); $('textarea[name="answer"]').removeClass('disabled');
  $('select[name="selectMulipleAnswer"]').append(select_motivo); //AGREGA LOS OPTIONS

  $('select[name="selectMulipleAnswer"]').change(function (e) { //EVENTO QUE CAMBIA EL INPUT PARA AGREGAR LA RESPUESTA
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
    $.confirm({ //aqui va el alerta personalizado
      animation: 'zoom',
      closeAnimation: 'zoom',
      theme: 'modern',
      icon: 'lh exclamation triangle icon',
      backgroundDismissAnimation: 'glow',
      title: 'Redireccionamiento',
      content: '¿ Está seguro que desea Redireccionar este radicado ?',
      type: 'orange',
      buttons: {
          aceptar: function() {
              $('#redirectAnswer').submit();
          },
          cancel: function() {},
      }
    });
  });
});
//BOTONES DE ACEPTACION DE REDIRECCION
$('.refuseRedirection').click(function (e) { 
  $.confirm({ //aqui va el alerta personalizado
    animation: 'zoom',
    closeAnimation: 'zoom',
    theme: 'modern',
    icon: 'lh exclamation triangle icon',
    backgroundDismissAnimation: 'glow',
    title: 'Confirmación!',
    content: '¿ Está seguro que desea denegar esta solicitud ?',
    type: 'orange',
    buttons: {
        aceptar: function() {
            $('#refuseRedirectionForm').submit();
        },
        cancel: function() {},
    }
  });
});
$('.acceptRedirection').click(function (e) { 
  $.confirm({ //aqui va el alerta personalizado
    animation: 'zoom',
    closeAnimation: 'zoom',
    theme: 'modern',
    icon: 'lh exclamation triangle icon',
    backgroundDismissAnimation: 'glow',
    title: 'Confirmación!',
    content: '¿ Está seguro que desea denegar esta solicitud ?',
    type: 'orange',
    buttons: {
        aceptar: function() {
            $('#acceptRedirectionForm').submit();
        },
        cancel: function() {},
    }
  });
});
//MODAL PARA MOSTRAR LOS RADICADOS
$('.modal.previewPdf').modal({
  inverted: true,
  blurring: true
})
.modal('attach events', '#previewRadic', 'show');
//MODAL PARA FORMULARIO DE EDITAR RESPUESTA
$('.modal.reasonAnswerCheck').modal({
  inverted: true,
})
.modal('attach events', '#EditAnswer', 'show');
//ENVIAR FORMULARIO DE EDICION DE RESPUESTA
$('#EditAnswerFormSend').click(function (e) {
  if ($('#answerReasonEdit').val()) {
    $.alert({ //aqui va el alerta personalizado
      animation: 'zoom',
      closeAnimation: 'zoom',
      theme: 'modern',
      icon: 'lh exclamation triangle icon',
      backgroundDismissAnimation: 'glow',
      title: 'Confirmación!',
      content: '¿ Está seguro que desea enviar la solicitud de modificación a esta respuesta ?',
      type: 'orange',
      buttons: {
          aceptar: function() {
            $('#EditAnswerForm').submit();
          },
          cancel: function() {},
      }
    }); 
  }else{
    $.alert({ //aqui va el alerta personalizado
      animation: 'zoom',
      closeAnimation: 'zoom',
      theme: 'modern',
      icon: 'lh exclamation triangle icon',
      backgroundDismissAnimation: 'glow',
      title: 'Error!',
      content: 'El campo se encuentra vacio, por favor ingrese datos correctos',
      type: 'red',
      buttons: {
          aceptar: function() {},
      }
    }); 
  }
});
//FUNCIONES DE LOS ITEMS DE NOTIFICACION
var itemsNotify = document.querySelectorAll('#itemNotify');
$(itemsNotify).click(function (e) { 
  // console.log($(this).attr('xvurl'));
  userAuth = $(this).attr('idUser');
  idNotify = $(this).attr('idNotidy');
  url = $(this).attr('xvurl');
  var data = "idNotify="+idNotify+"&slug="+url+"";
  $.ajax({
      type: "PUT",
      url: "/radicado/"+userAuth+"/readNotify",
      data: data,
      success: function (response) {
        console.log(response);
        location.replace(' ');
        window.location.assign('/radicado/'+url+'/show');
      }
  });
});

$('#allNotifyReaded').click(function (e) { 
  userAuth = $(this).attr('idUser');
  // location.replace(' ');
  var data = "userAuth="+userAuth+"";
  $.ajax({
      type: "PUT",
      url: "radicado/"+userAuth+"/readAllNotify",
      data: data,
      success: function (response) {
        // console.log(response);
          window.location.reload();
      }
  });
});