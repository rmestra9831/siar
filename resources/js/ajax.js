setTimeout(function (){ //cargando todas las funciones ajax

    $('.permission').click(function () {
        // configurando token de laravel en ajax
        $.ajaxSetup({headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }});
        
        // opciones ajax para traer los permsos que tiene un usuario
        $.ajax({
          type: "GET",
          url: "getPermissions/"+this.value+"", 
          success: function (response) {
            var users = response[0];
            var permissions = response[1];
            
            // console.log(permissions);
            
            for(p=0; p<permissions.length; p++){
                console.log(permissions[p]);
            }

            // if ($.isEmptyObject(response)) {
            //     $('#info_title').html('Sin permisos de Usuario');
            //     console.log('sin datos');
            // } else {
            //     $('#info_title').html('Permisos de Usuario');
            //     for(i=0; i<response.length; i++){
            //         console.log(response[i].name);
            //     }
            // }
          }
        });
      
      });

},500);