

jQuery(document).ready( function($) {
     $(".circle-logo-tur").slideDown("slow");
});

jQuery(document).ready( function($) {    
    $('#userFirstName').focus();
    $('#userDob').bootstrapMaterialDatePicker({
        time: false,
        clearButton: true,
        format : 'DD/MM/YYYY', 
        lang : 'es',
        cancelText: 'CANCELAR',
        clearText: 'LIMPIAR',

        });
    /*$.material.init();*/


});

jQuery(document).ready( function($) {   
      $( "#register-form" ).submit(function( event ) {
        
        var errors = 0;
        var userFirstName = $('#userFirstName').val();

        var userLastName = $('#userLastName').val();
        var userDob = $('#userDob').val();
        var uemail = $('#userEmail').val();
        var upass = $('#userPassword').val();
        var upassconfirm = $('#userPasswordConfirm').val();

        var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;


        if (userFirstName.length <= 0) {
            showErrMessage($('#userFirstName'), $('.ufname'));
            errors++;
        }

        else if (userLastName.length <= 0) {
            showErrMessage($('#userLastName'), $('.ulname'));
            errors++;
        }
        else if(userDob.length <= 0){
            showErrMessage($('#userDob'), $('.udob'));
            errors++;

        }
        else if (!testEmail.test(uemail)){
            showErrMessage($('#userEmail'), $('.uemail'));
            errors++;

        }

        else if (upass.length <= 8) {
            showErrMessage($('#userPassword'), $('.upassword'));
            errors++;
        }

        else if(upass != upassconfirm){
            $('#userPasswordConfirm').setCustomValidity('Las contraseñas deben coincidir.');
            showErrMessage($('#userPasswordConfirm'), $('.uconfirm'));
            errors++;
        }

        if(errors > 0)
        {
            return false;
        }
        
        
        
    });

      function showErrMessage(element, msg){
        element.css('border-color', '#ee7f22');
        element.select();
         msg.fadeIn(500);
         setTimeout(function () {
            msg.fadeOut(50);
            element.css('border-color', '#cccccc');
         }, 6000);
        
      }
    
});


<!-- GET TOWNS BY STATE ID -->

jQuery(document).ready( function($) {
    $("#userState").change(function() {
        var stateId = $(this).val();
        var url = "{{ url('register/get-towns') }}/"+stateId;

        $.get(url, function(data){ 
                var uData = jQuery.parseJSON(data);
                if(uData.status == 'success'){

                    var options = '';
                    options += '<option value="0">Selecciona Municipio</option>';
                    for (var x = 0; x < uData.towns.length; x++) {
                        options += '<option value="' + uData.towns[x]['ID'] + '">' + uData.towns[x]['TOWN'] + '</option>';
                    }
                    
                    $('#userTown').html(options);


                    
                } else{
                    alert('error');
                }     
                 
        });
    });
});


/*
<!--
<script>
jQuery(document).ready( function($) {
    $( "#userState" ).change(function() {
        
        var stateId = $("#userStateValue").val();
        
        var url = "{{ url('register/get-towns') }}/"+stateId;

        $.get(url, function(data){ 
                var uData = jQuery.parseJSON(data);
                if(uData.status == 'success'){

                    var options = '';
                    
                    for (var x = 0; x < uData.towns.length; x++) {
                        
                        options += '<li class="mdl-menu__item" data-val="' + uData.towns[x]['ID'] + '">' + uData.towns[x]['TOWN'] + '</li>';
                    }
                    
                    $('#townMenu').html(options);


                    console.log(uData.towns);
                } else{
                    alert('error');
                }     
                 
        });
    });

});
</script> --> */