// menu desplegable para crear correspondencia
$('.ui.accordion').accordion();
$('select.dropdown').dropdown();
$('.labeled.icon.dropdown').dropdown();
$('.tag.example .ui.dropdown').dropdown({
    allowAdditions: true});
$('.message .close').on('click', function() {$(this).closest('.message').transition('fade') ;});
$('.notifications .dropdown')
  .dropdown({
    action: 'hide'
});
window.setTimeout(function () {
    $(".alert").fadeTo(500, 0).slideUp(500, function () {
      $(this).remove();
    });
  }, 4000);
//**** NOTA ****//
/** Como los botones se esstan cargando dentro de la tabla todas las funcions js que se generen deben estar 
 * dentro de la FUNCION setTimeout para que se pueda ejecutar
 **/

// $('.ui.basic.modal').modal('show');
// cambiado icono de menu de correspondencia

$("input:text").click(function() {
    $(this).parent().find("input:file").click();
});
  
$('input:file', '.ui.upload_radic.input')
    .on('change', function(e) {
      var name = e.target.files[0].name;
      $('input:text', $(e.target).parent()).val(name);  //validando el boton de carga del archivo
});