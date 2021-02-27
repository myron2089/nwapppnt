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
                            <div class="circle-logo-tur" style="margin-top: 20px; background: url('{{url($eventLogo)}}') center center !important; background-size: 120px 120px;">
                                 <!--<div class="lft"></div>-->
                            </div>
                            <span style="margin: 0 auto; margin-top:5px; position: absolute; width: 100%; text-align: center; font-weight: 600; font-size: 18px">{{$eventName}}</span>
                            <span style="margin: 0 auto; margin-top: 25px; position: absolute; width: 100%; text-align: center; font-weight: 300; font-size: 14px">{{$title}}</span>
                        </div>
                    </div><br><br><br><br><br>
                    
                    
                <div class="panel-body">
                  
                    <form id="register-form" class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="eventCreate" id="eventCreate" value="{{$eventCreate}}">
                        <input type="hidden" name="eventId" id="eventId" value="{{$eventId}}">

                        @if (count($errors) > 0 && !$errors->has('incorrectpw'))
                        <div class="alert alert-danger" style="border-radius: 1px; float: left;">
                            <ul style="padding-left: 5px;">
                                <?php //@foreach ($errors->all() as $error)
                                 //<li style="list-style: none"> {{ $error }}  </li>
                                //@endforeach
                                ?>
                                @if($errors->has('email'))
                                    Si ya tienes una cuenta en NetWorkingApp, puedes iniciar sesión para registrarte en el evento <a class="btn btn-sm btn-default button" style="z-index: 99" href="{{url('login')}}?evUrl={{$evUrl}}"> Aquí </a>
                                    <br>
                                    De lo contrario, ingresa un correo electrónico diferente.
                                @endif
                            </ul>
                        </div>
                        @endif
                        <input id="userType" name="userType" type="hidden" value="{{$type}}">
                         <div class="group">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input id="userFirstName" name="userFirstName" class="mdl-textfield__input" type="text" data-trigger="manual" value="{{ old('userFirstName') }}" autofocus @if($ufname != null) value="{{$ufname}}"  class="used"  @endif required maxlength="30">
                                <label class="mdl-textfield__label" for="sample4">Nombres</label>
                                <span class="mdl-textfield__error">Es necesario ingresar un nombre</span>
                                
                            </div>
                        </div>

                        <div class="group">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input id="userLastName" name="userLastName" class="mdl-textfield__input" type="text" adta-trigger="manual" value="{{ old('userLastName') }}"  autofocus @if($ulname != null) value="{{$ulname}}" class="used"  @endif required maxlength="30">
                                <label class="mdl-textfield__label" for="userLastName">Apellidos</label>
                                <span class="mdl-textfield__error">Es necesario ingresar los apellidos.</span>
                                <div class="err-msg ulname">
                                    <span>Es necesario ingresar el apellido</span>
                                </div>
                            </div>
                        </div>

                        <div class="group">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input id="userCellPhoneNumber" name="userCellPhoneNumber" class="mdl-textfield__input" type="number" data-trigger="manual" value="{{ old('userCellPhoneNumber') }}"  autofocus @if($ucellphone != null) value="{{$ucellphone}}" class="used"  @endif required maxlength="12">
                                <label class="mdl-textfield__label" for="userLastName">Celular</label>
                                <span class="mdl-textfield__error">Es necesario ingresar el número de celular</span>
                                <div class="err-msg ulname">
                                    <span>Es necesario ingresar número de celular.</span>
                                </div>
                            </div>
                        </div>

                    
                        <div class="group">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <select id="userState" name="userState" class="mdl-textfield__input" type="text" ata-trigger="manual" value="{{ old('userState') }}"  autofocus @if($ustate != null) value="{{$ustate}}" class="used"  @endif  maxlength="100" required>
                                    <option value="0">Selecciona Departamento</option>
                                    @foreach($states as $state)

                                        <option value="{{$state->id}}"  {{ (old("userState") == $state->id ? "selected":"") }}>{{$state->countryStateName}}</option>
                                    @endforeach
                                </select>
                                <label class="mdl-textfield__label" for="userLastName">Departamento</label>
                                <span class="mdl-textfield__error">Es necesario ingresar una dirección</span>
                                <div class="err-msg stconfirm">
                                    <span>Es necesario seleccionar un departamento.</span>
                                </div>
                            </div>
                        </div>



                        <div class="group">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <select id="userTown" name="userTown" class="mdl-textfield__input" type="text" ata-trigger="manual" value="{{ old('userTown') }}"  autofocus @if($utown != null) value="{{$utown}}" class="used"  @endif  maxlength="100">
                                    <option value="0">Selecciona Municipio</option>                                 
                                </select>
                                <label class="mdl-textfield__label" for="userLastName">Municipio</label>
                                <span class="mdl-textfield__error">Es necesario ingresar una dirección</span>
                                <div class="err-msg munconfirm">
                                    <span>Es necesario seleccionar un municipio.</span>
                                </div>
                            </div>
                        </div>
                    

                        <div class="group">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input id="userAddress" name="userAddress" class="mdl-textfield__input" type="text" ata-trigger="manual" value="{{ old('userAddress') }}"  autofocus @if($uaddress != null) value="{{$uaddress}}" class="used"  @endif  maxlength="100">
                                <label class="mdl-textfield__label" for="userLastName">Dirección</label>
                                <span class="mdl-textfield__error">Es necesario ingresar una dirección</span>
                                <div class="err-msg ulname">
                                    <span>Es necesario ingresar una dirección.</span>
                                </div>
                            </div>
                        </div>

                       <!-- <div class="group">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fix-height">
                                <input type="text" value="" class="mdl-textfield__input" id="userState" readonly>
                                    <input type="hidden" value="" name="userState" id="userStateValue">
                                    <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
                                    <label for="depto" class="mdl-textfield__label">Selecciona Departamento</label>
                                        <ul for="depto" class="mdl-menu mdl-menu--bottom-left mdl-js-menu">
                                           
                                            @foreach($states as $state)
                                            
                                                <li class="mdl-menu__item" data-val="{{$state->id}}">{{$state->countryStateName}}</li>
                                            @endforeach
                                        </ul>
                            </div>
                        </div>


                        <div class="group">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fix-height">
                                <input type="text" value="" class="mdl-textfield__input" id="userTown" readonly>
                                    <input type="hidden" value="" name="userTown" id="userTownValue">
                                    <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
                                    <label for="userTown" class="mdl-textfield__label">Selecciona Municipio</label>
                                        <ul for="userTown" id="townMenu" class="mdl-menu mdl-menu--bottom-left mdl-js-menu">
                                            <li class="mdl-menu__item" data-val="3333">4444</li>
                                           
                                        </ul>
                            </div>
                        </div> -->

                        <!--<div class="group">
                            <input id="userFirstName" name="userFirstName" type="text"  data-trigger="manual" value="{{$ufname}}" autofocus @if($ufname != null) class="used"  @endif><span class="highlight" ></span><span class="bar"></span>
                            <label>Nombres</label>
                            <div class="err-msg ufname">
                                <span>Es necesario ingresar el nombre</span>
                            </div>
                        </div>

                        <div class="group">
                            <input id="userLastName" name="userLastName" type="text"  data-trigger="manual" value="{{$ulname}}" @if($ulname != null) class="used"  @endif><span class="highlight"></span><span class="bar"></span>
                            <label>Apellidos</label>
                            <div class="err-msg ulname">
                                <span>Es necesario ingresar el apellido</span>
                            </div>
                        </div> -->

                        <!--<div class="group">
                            
                            <input type="text" id="userDob" name="userDob" class="form-control floating-label" ><span class="highlight"></span><span class="bar"></span>
                            <label>Nacimiento</label>

                            <div class="err-msg udob">
                                <span>Es necesario ingresar una fecha de nacimiento válida.</span>
                            </div>
                        </div>-->

                       
                        <!--<div class="group">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" type="text" pattern="-?[0-9]*(\.[0-9]+)?" id="sample4">
                                <label class="mdl-textfield__label" for="sample4">Number...</label>
                                <span class="mdl-textfield__error">Input is not a number!</span>
                            </div>
                        </div> 
                        <div class="group" style="margin-top: -10px">
                            <input id="userCompany" name="userCompany" type="text"  data-trigger="manual" ><span class="highlight"></span><span class="bar"></span>
                            <label>Empresa</label>
                            <div class="err-msg uemail">
                                <span>Es necesario ingresar una empresa</span>
                            </div>
                        </div> -->

                        <div class="group">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" type="text"  id="userCompany" name="userCompany" value="{{ old('userCompany') }}">
                                <label class="mdl-textfield__label" for="userCompany">Empresa</label>
                                <span class="mdl-textfield__error">Input is not a number!</span>
                            </div>
                        </div>
                        
                        <input type="hidden" id="dinamicFields" name="dinamicFields" value="{{$countFields}}">
                        {!! $fields !!}
                        <div class="account-section">
                        <div class="group" style="margin-top: 0px; margin-bottom: 60px">
                        <h4 style="font-size: 16px; color: #FF800A"><i class="icon icon-user"></i> Datos para la cuenta</h4>
                       
                        </div>
                        <div class="group">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" type="email" id="userEmail" name="userEmail" value="{{ old('userEmail') }}" @if($uemail != null) class="used"  @endif required>
                                <label class="mdl-textfield__label" for="userEmail" >Correo Electrónico</label>
                                <span class="mdl-textfield__error">Ingrese una dirección de correo</span>
                            </div>
                        </div>

                        <div class="group">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" type="password" id="userPassword" name="userPassword" required @if($errors->has('incorrectpw')) autofocus @endif>
                                <label class="mdl-textfield__label" for="userPassword">Contraseña</label>
                                <span class="mdl-textfield__error">La contraseña debe de tener mas de 8 caracteres</span>
                            </div>
                        </div>
                        @if (count($errors) > 0)
                        <div class="alert alert-danger" style="border-radius: 1px; float: left;">
                            <ul style="padding-left: 5px;">
                               @if($errors->has('incorrectpw'))
                                     <li style="list-style: none"> Ya tienes una cuentra creada en NetWorkingApp, por favor ingresa la contraseña que tienes registrada.  </li>
                                     <li style="list-style: none"> Si deseas crear una cuenta nueva, ingresa un correo electrónico diferente.  </li>
                                @endif
                            </ul>
                        </div>
                        @endif
                        <!--
                         <div class="group">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" type="password" id="userPasswordConfirm" name="userPasswordConfirm" minlength=8>
                                <label class="mdl-textfield__label" for="userPasswordConfirm">Confirmar Contraseña</label>
                                <span class="mdl-textfield__error">Las contraseñas deben coincidir</span>
                            </div>
                        </div> -->
                        </div>




                     <!--  <div class="group" style="margin-top: -10px">
                            <input id="userEmail" name="userEmail" type="text"  data-trigger="manual" value="{{$uemail}}" @if($uemail != null) class="used"  @endif><span class="highlight"></span><span class="bar"></span>
                            <label>Correo</label>
                            <div class="err-msg uemail">
                                <span>Es necesario ingresar correo electrónico válido</span>
                            </div>
                        </div>

                        <div class="group">
                            <input id="userPassword" name="userPassword" type="password"  data-trigger="manual"><span class="highlight"></span><span class="bar"></span>
                            <label>Contraseña</label>
                            <div class="err-msg upassword">
                                <span>Es necesario ingresar una contraseña válida</span>
                            </div>
                        </div>

                        <div class="group">
                            <input id="userPasswordConfirm" name="userPasswordConfirm" type="password"  data-trigger="manual"><span class="highlight"></span><span class="bar"></span>
                            <label> Confirmar Contraseña</label>
                            <div class="err-msg uconfirm">
                                <span>Las contraseñas no coinciden.</span>
                            </div>
                        </div>
                         -->       
                      <!-- <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        -->
                        <input type="hidden" id="cityValue" name="cityValue" value="{{ old('cityValue') }}">
                        <input type="hidden" id="townValue" name="townValue" value="{{ old('townValue') }}">
                        <div class="form-group">
                            <div class="col-md-12 ">
                                
                                <button type="submit" class="btn btn-primary button" style="width: 100%" >
                                    REGISTRARSE
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
 <script type="text/javascript" src="{{ URL::asset('js/jquery.blockUI.js')}}"></script>
<!-- GET TOWNS BY STATE ID -->
<script>
jQuery(document).ready( function($) {
    town = $('#townValue').val();

    changeUserTown($('#cityValue').val(), town);


    $("#userState").change(function() {
        var town = 0;
        $('#cityValue').val($(this).val());
        changeUserTown($(this).val(), town);
        
    });


    $("#userTown").change(function() {
        $('#townValue').val($(this).val(),0);
               
    });

    
    
    
});
</script> 


<script>
    function changeUserTown(stateId, townId){
    $('div.panel-default').block({ 
        message: '<div class="spinner"><div class="dot1"></div><div class="dot2"></div></div><h4 style="color:#fff; font-size:14px">Obteniendo municipios.</h4>', 
         css: { 
            border: 'none', 
            padding: '5px', 
            backgroundColor: '#000', 
            '-webkit-border-radius': '4px', 
            '-moz-border-radius': '4px', 
            opacity: .6, 
            color: '#fff' 
        } 
    }); 

    var url = "{{ url('/register/get-towns') }}"+"/"+stateId;
 
    $.get(url, function(data){ 
            var uData = jQuery.parseJSON(data);
            if(uData.status == 'success'){

                var options = '';
                var selected ='';
                options += '<option value="0">Selecciona Municipio</option>';
                for (var x = 0; x < uData.towns.length; x++) {
                    selected = '';
                    if(uData.towns[x]['ID']==townId){
                        selected = 'selected';
                          
                    }
                    options += '<option ' + selected +' value="' + uData.towns[x]['ID'] + '">' + uData.towns[x]['TOWN'] + '</option>';
                }
                
                $('#userTown').html(options);


                
            } else{
                alert('error');
            }   
    });  

     $('div.panel-default').unblock();
           

    }
</script>

<script>
jQuery(document).ready( function($) {
     $(".circle-logo-tur").slideDown("slow");
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
      $( "#register-forms" ).submit(function( event ) {
        event.preventDefault();
        var errors = 0;
        var userFirstName = $('#userFirstName').val();

        var userLastName = $('#userLastName').val();
        var userDob = $('#userDob').val();
        var uemail = $('#userEmail').val();
        var upass = $('#userPassword').val();
   //     var upassconfirm = $('#userPasswordConfirm').val();
        var state = $('#userState').val();



        var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;


        if (userFirstName.length <= 0) {
            showErrMessage($('#userFirstName'), $('.ufname'));
            errors++;
        }

        else if (userLastName.length <= 0) {
            showErrMessage($('#userLastName'), $('.ulname'));
            errors++;
        }
       /* else if(userDob.length && userDob <= 0){
            showErrMessage($('#userDob'), $('.udob'));
            errors++;

        }*/ 
        else if(state == 0){
            showErrMessage($('#userState'), $('.stconfirm'));

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

      /*  else if(upass != upassconfirm){
            $('#userPasswordConfirm').setCustomValidity('Las contraseñas deben coincidir.');
            showErrMessage($('#userPasswordConfirm'), $('.uconfirm'));
            errors++;
        }*/
         console.log(errors);
        if(errors > 0)
        {
            event.preventDefault();
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
</script> -->
@endsection