// menu desplegable para crear correspondencia
$('.ui.accordion').accordion();
// inicialización del modals
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
