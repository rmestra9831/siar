// menu desplegable para crear correspondencia
$('.ui.accordion').accordion();
$('select.dropdown').dropdown();
//**** NOTA ****//
/** Como los botones se esstan cargando dentro de la tabla todas las funcions js que se generen deben estar 
 * dentro de la FUNCION setTimeout para que se pueda ejecutar
 **/

// inicialización del modals despues que se ejecuta la pag
setTimeout(function(){
    $('.ui.modal').modal({
      inverted: true,
      blurring: true
      }).modal('attach events', '.permission.button', 'show');
  },500);

// $('.ui.basic.modal').modal('show');
// cambiado icono de menu de correspondencia
$('#btnsCorrespondence').click(function () { 
    if ($('#btnsCorrespondence .title').attr('class') == 'c-white title active') {
        icon_correspondence = document.querySelector('#btnsCorrespondence .title #icon-main-c');
        icon_correspondence.setAttribute('class','c-white large folder open outline icon');
    }else{
        icon_correspondence.setAttribute('class','c-white large folder outline icon'); 
    }
});
