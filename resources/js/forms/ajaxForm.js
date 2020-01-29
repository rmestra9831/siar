//MODAL PARA CONFIRMAR LA CREACION DE UN RADICADO
$('.ui.basic.create_radic.modal')
  .modal({
    closable  : false,
    onApprove : function(e) {
      e.preventDefault();
      var first_name = $("input[name='first-name']").val();
      var last_name = $("input[name='last_name']").val();
      var email = $("input[name='email']").val(); 
      var celphone = $("input[name='celphone']").val();
      var program_radic = $('#program_radic').change(function (e) { $("#program_radic option:selected").val(); });
      var destination_radic = $('#destination_radic').change(function (e) { $("#destination_radic option:selected").val(); });
      var reason_radic = $('#reason_radic').change(function (e) { $("#reason_radic option:selected").val(); });
      var affair = $("input[name='affair']").val();
      var atention_radic = $('#atention_radic').change(function (e) { $("#atention_radic option:selected").val(); });
      var origin_radic = $('#origin_radic').change(function (e) { $("#origin_radic option:selected").val(); });   
      var uploadDocument = $("input[id='uploadRadic']").val(); //cargar el archivo
      var note = $("input[name='note']").val();
      
      alert(program_radic);
      // $.ajax({
      //   type: "POST",
      //   url: "radicado",
      //   data: "data",
      //   success: function (response) {
          
      //   }
      // });
    }
  })
.modal('attach events', '.create_radic.button','show');