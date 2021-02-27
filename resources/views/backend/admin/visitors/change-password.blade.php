@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/login-style.css')}}" type="text/css" />
     <link rel="stylesheet" href="{{ asset('css/animate.css')}}" type="text/css" />
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-5 col-md-offset-3">
            <div class="panel panel-default ">
                <div class="row">
                        <div class="col-md-12 nomargin nopadding">
                            <div class="circle-logo-expo" style="margin-top: 20px">
                                 <!--<div class="lft"></div>-->
                            </div>
                            <span style="margin: 0 auto; margin-top:5px; position: absolute; width: 100%; text-align: center; font-weight: 500; font-size: 18px">Net Working App</span>
                            <span style="margin: 0 auto; margin-top: 25px; position: absolute; width: 100%; text-align: center; font-weight: 300; font-size: 14px">Reestablecer contraseña</span>
                        </div>
                    </div><br><br><br><br><br>
                    
                    
                <div class="panel-body">
                  
                    <form id="register-form" class="form-horizontal" method="POST" action="{{ route('update-visitor-password') }}">
                        {{ csrf_field() }}
                        @if (count($errors) > 0)
                        <div class="alert alert-danger" style="border-radius: 1px">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li style="list-style: none"> {{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <input id="userType" name="userType" type="hidden" value="">
                         
                        <div class="group">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" type="email" id="userEmail" name="userEmail" value="{{ old('userEmail') }}" required>
                                <label class="mdl-textfield__label" for="userEmail" >Correo Electrónico</label>
                                 <div class="err-msg uemail">
                                    <span>Es necesario ingresar un email válido</span>
                                </div>
                            </div>
                        </div>

                        <div class="group">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" type="password" id="userPassword" name="userPassword" required>
                                <label class="mdl-textfield__label" for="userPassword">Contraseña</label>
                                <span class="mdl-textfield__error">La contraseña debe de tener mas de 8 caracteres</span>
                            </div>
                        </div>

                         <div class="group">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" type="password" id="userPasswordConfirm" name="userPasswordConfirm" minlength=8>
                                <label class="mdl-textfield__label" for="userPasswordConfirm">Confirmar Contraseña</label>
                                <span class="mdl-textfield__error">Las contraseñas deben coincidir</span>
                            </div>
                        </div>

                        @if(isset($status))
                            @if($status == 'updated')
                                <div class="alert alert-success" style="border-radius: 1px;"><ul><li style="list-style: none;"> Se ha actualizado la contraseña con éxito.</li></ul></div>
                            @endif
                            @if($status == 'not-found')
                                <div class="alert alert-warning" style="border-radius: 1px;"><ul><li style="list-style: none;"> No se ha encontrado el usuario con el email especificado. Por favor intente de nuevo.</li></ul></div>
                            @endif
                            
                        @endif
                        <div class="form-group">
                            <div class="col-md-12 ">
                                
                                <button type="submit" class="btn btn-primary button" style="width: 100%" >
                                    Reestablecer Contraseña
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

<script>
jQuery(document).ready( function($) {
     $(".circle-logo-expo").slideDown("slow");
});
</script>

<script>
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
</script>

<script>
jQuery(document).ready( function($) {   
      $( "#register-form" ).submit(function( event ) {
        
        var errors = 0;
       
        var uemail = $('#userEmail').val();
        var upass = $('#userPassword').val();
        var upassconfirm = $('#userPasswordConfirm').val();

        var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;


        
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

</script>
@endsection