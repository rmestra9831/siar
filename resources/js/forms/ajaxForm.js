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
            console.log(response);
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
          $form_create_radic.form('set value', 'affair', value_txt_motivo)
        });
      });
    }
  });
}

