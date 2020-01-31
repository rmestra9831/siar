//VALIDACION DE LOS FORMULARIOS
$('.ui.create_radic.form') //validacion creacion de radicado
  .form({
    inline : true,
    fields: {
      firstName         : 'empty',
      lastName          : 'empty',
      email             : ['email','empty'],
      celphone          : 'empty',
      program_radic     : 'empty',
      destination_radic : 'empty',
      type_reason_radic : 'empty',
      reason_radic      : 'empty',
      affair            : 'empty',
      atention_radic    : 'empty',
      origin_radic      : 'empty',
    },onSuccess: function (event){
        event.preventDefault();
        $form = $('#create_radic');
        data_for = $form.form('get values');
    
        $.ajax({
          type: "POST",
          url: "/radicado",
          data: data_for,
          serializeForm: true,
          beforeSend: function(){
            spinner_load = '<i class="spinner loading icon" style="font-size: 7em !important"></i> Creando...';
            $('.icon.header').empty();
            $('.icon.header').append(spinner_load);
          },
          success: function (response) {
            // $('.ui.create_radic.form').form('clear');
            console.log(response);
            $.alert({
              theme: 'Modern',
              icon: 'lh check circle outline icon',
              title: 'Está Hecho',
              content: 'Radicado creado con exito',
              type: 'blue',
              typeAnimated: true,
            })
          },complete: function(){
            spinner_load = '<i class="question circle outline icon" style="font-size: 7em !important"></i>Creando nuevo Radicado';
            $('.icon.header').empty();
            $('.icon.header').append(spinner_load);
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
      $.each(response['select_program'], function (p,item) {  //datos de select program
        $('select[name="program_radic"]').append('<option value="'+item['id']+'">'+item['name']+'</option>');
      });
      $.each(response['select_destino'], function (p,item) { //datos de select destino
        $('select[name="destination_radic"]').append('<option value="'+item['id']+'">'+item['name']+'</option>');
      });
      $.each(response['select_origen'], function (p,item) { //datos de select origin
        $('select[name="origin_radic"]').append('<option value="'+item['id']+'">'+item['origin_name']+'</option>');
      });
    }
  });
}

$('select[name="type_reason_radic"]').change(function (e) { 
  $('select[name="reason_radic"]').removeClass('disabled');
});

