@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/login-style.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('css/animate.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('metronic/global/plugins/bootstrap-sweetalert/sweetalert.css')}}" type="text/css" />
    <script type="text/javascript" src="{{ URL::asset('metronic/global/plugins/ladda/spin.min.js')}}"></script>
    <script type="text/javascript" src="{{ URL::asset('metronic/global/plugins/ladda/ladda.min.js')}}"></script>
    <script type="text/javascript" src="{{ URL::asset('metronic/scripts/ui-buttons-spinners.min.js')}}"></script>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-5 col-md-offset-3">
            <div class="panel panel-default ">
                <div class="row">
                        <div class="col-md-12 nomargin">
                            <div class="circle-logo-tur" style="margin-top: 0px; background: url('{{url($eventLogo)}}') center center !important; background-size: 100% 120px; background-size: cover; background-repeat: no-repeat;">
                                 <!--<div class="lft"></div>-->
                            </div>
                            <div class="row">
                                <div class="col-md-12" style="text-align: center; padding: 30px 0px;">
                                    
                                        <span style="margin: 0 auto; margin-top: 5px; position: relative; display: block; width: 100%; text-align: center; font-weight: 600; font-size: 20px; color: #000;">{{$title}}</span>
                                        <span style="margin: 0 auto; margin-top: 5px; position: relative; display: block; width: 100%; text-align: center; font-weight: 500; font-size: 18px; color: #000;">{{$eventName}}</span>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                <div class="panel-body" style="margin-top: -20px;">
                  
                    <form id="register-form" class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="eventCreate" id="eventCreate" value="{{$eventCreate}}">
                        <input type="hidden" name="eventId" id="eventId" value="{{$eventId}}">
                        <input type="hidden" name="registerFrom" id="registerFrom" value="{{$regFrom}}">

                        @if (count($errors) > 0 && !$errors->has('incorrectpw') && !$errors->has('userPassword'))
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
                           
                                <input id="userFirstName" name="userFirstName" class="form-control custom-form-control" type="text" data-trigger="manual" value="{{ old('userFirstName') }}" autofocus @if($ufname != null) value="{{$ufname}}"  class="used"  @endif required maxlength="30" placeholder="Nombres *">
                                
                                <span class="mdl-textfield__error">Es necesario ingresar un nombre</span>
                                
                           
                        </div>

                        <div class="group">
                           
                                <input id="userLastName" name="userLastName" class="form-control custom-form-control" type="text" adta-trigger="manual" value="{{ old('userLastName') }}"  autofocus @if($ulname != null) value="{{$ulname}}" class="used"  @endif required maxlength="30"  placeholder="Apellidos *">
                               
                                <span class="mdl-textfield__error">Es necesario ingresar los apellidos.</span>
                                <div class="err-msg ulname">
                                    <span>Es necesario ingresar el apellido</span>
                                </div>
                            
                        </div>

                        <div class="group">
                          
                                <input id="userCellPhoneNumber" name="userCellPhoneNumber" class="form-control custom-form-control" type="phone" data-trigger="manual" value="{{ old('userCellPhoneNumber') }}"  autofocus @if($ucellphone != null) value="{{$ucellphone}}" class="used"  @endif required maxlength="12" placeholder="Número de celular *">
                                
                                <span class="mdl-textfield__error">Es necesario ingresar el número de celular</span>
                                <div class="err-msg ulname">
                                    <span>Es necesario ingresar número de celular.</span>
                                </div>
                            
                        </div>

                    
                        <div class="group">
                           
                                <select id="userState" name="userState" class="form-control custom-form-control" type="text" ata-trigger="manual" value="{{ old('userState') }}"  autofocus @if($ustate != null) value="{{$ustate}}" class="used"  @endif  maxlength="100" required>
                                    <option value="0">Selecciona Departamento</option>
                                    @foreach($states as $state)

                                        <option value="{{$state->id}}"  {{ (old("userState") == $state->id ? "selected":"") }}>{{$state->countryStateName}}</option>
                                    @endforeach
                                </select>
                              
                                <span class="mdl-textfield__error">Es necesario ingresar una dirección</span>
                                <div class="err-msg stconfirm">
                                    <span>Es necesario seleccionar un departamento.</span>
                                </div>
                           
                        </div>



                        <div class="group">
                            
                                <select id="userTown" name="userTown" class="form-control custom-form-control" type="text" ata-trigger="manual" value="{{ old('userTown') }}"  autofocus @if($utown != null) value="{{$utown}}" class="used"  @endif  maxlength="100">
                                    <option value="0">Selecciona Municipio</option>                                 
                                </select>
                               
                                <span class="mdl-textfield__error">Es necesario ingresar una dirección</span>
                                <div class="err-msg munconfirm">
                                    <span>Es necesario seleccionar un municipio.</span>
                                </div>
                            
                        </div>
                    

                        <div class="group" style="display: none">
                            
                                <input id="userAddress" name="userAddress" class="form-control custom-form-control" type="text" ata-trigger="manual" value="{{ old('userAddress') }}"  autofocus @if($uaddress != null) value="{{$uaddress}}" class="used"  @endif  maxlength="100" placeholder="Dirección">
                                
                                <span class="mdl-textfield__error">Es necesario ingresar una dirección</span>
                                <div class="err-msg ulname">
                                    <span>Es necesario ingresar una dirección.</span>
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

                        <div class="group" style="display: none">
                         
                            <input class="form-control custom-form-control" type="text"  id="userCompany" name="userCompany" value="{{ old('userCompany') }}" maxlength="100" placeholder="Empresa">
                            
                            <span class="mdl-textfield__error">Input is not a number!</span>
                        
                        </div>
                        
                        <input type="hidden" id="dinamicFields" name="dinamicFields" value="{{$countFields}}">
                        

                        {!! $fields !!}


                        <div class="account-section">
                        <div class="group text-center" style="margin-top: 0px; margin-bottom: 10px">
                        <h4 style="font-size: 18px; color: #000; font-weight: 500;"><i class="icon icon-user"></i> Datos para la cuenta</h4>
                       
                        </div>
                        <div class="group">
                            <input class="form-control custom-form-control" type="email" id="userEmail" name="userEmail" value="{{ old('userEmail') }}" @if($uemail != null) class="used"  @endif required maxlength="150" placeholder="Correo electrónico">
                            
                            <span class="mdl-textfield__error">Ingrese una dirección de correo</span>
                           
                        </div>

                        <div class="group">
                            
                            <input class="form-control custom-form-control" type="password" id="userPassword" name="userPassword" required maxlength="250" minlength="8"  placeholder="Contraseña" @if($errors->has('incorrectpw')) autofocus @endif >
                          
                            <span class="mdl-textfield__error">La contraseña debe de tener mas de 8 caracteres</span>
                        
                        </div>
                        @if (count($errors) > 0)

                            @if ($errors->has('incorrectpw'))
                            <div class="alert alert-danger alert-message" style="float: left; margin-top: 15px;">
                                <ul style="padding-left: 5px; font-size: 16px;">
                                     <li style="list-style: none"> Ya tiene una cuentra creada en NetworkingApp, por favor ingrese la contraseña que tiene registrada.  </li>

                                     <li style="list-style: none"> Si olvido su contraseña, puede recuperarla en el siguiente enlace:</li>

                                     <li style="list-style: none; text-align: center;"> <a  class="btn btn-default btn-blue" data-toggle="modal" data-target="#exampleModal"> Recuperar contraseña </a>  </li>
                                     
                                     <li style="list-style: none"> Si desea crear una cuenta nueva, ingrese un correo electrónico diferente.  </li>
                                   
                                </ul>
                            </div>
                            @endif

                            @if ($errors->has('userPassword'))
                                <div class="alert alert-danger alert-message" style="float: left; margin-top: 15px;">
                                   <ul style="padding-left: 5px; font-size: 16px;">
                                     <li style="list-style: none">La contraseña debe de contener al menos 8 caracteres!</li>
                                    </ul>
                                </div>
                            @endif


                            
                        @endif

                         

                        <!--
                         <div class="group"> target="_blank" href="{{url('/password/reset')}}"
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
                        <div class="form-group" style="margin-top: 20px !important;">
                            <div class="col-md-12 ">
                                
                                <button type="submit" class="btn btn-primary button btn-register" id="btn-user-register" style="width: 100%" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Registrando visitante...">
                                    Registrarse
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" style="display: flex;
    align-items: center;" role="document">
        <div class="modal-content">

          <form id="reset-mail-form" method="POST" action="{{ route('password.email.reset') }}">  
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel" style="    float: left;">Recuperar contraseña</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
           
                {{ csrf_field() }}
                <p style="font-size: 16px;">Enviaremos los pasos para poder recuperar su contraseña al siguiente correo:</p>

                <input class="form-control custom-form-control" type="email" id="userEmailReset" name="userEmailReset" value="{{old('userEmail')}}" ata-trigger="manual" autofocus required maxlength="150" placeholder="Correo electrónico">
                <!--<label class="mdl-textfield__label" for="userPassword">Correo Electrónico</label>-->
                <div class="err-msg uemail">
                    <span>Es necesario ingresar un email válido</span>
                </div>
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary text-capitalize" data-dismiss="modal" style="text-transform: none !important;">Cancelar</button>
            <button id="sendMailPasswordLink" type="submit" class="btn btn-primary btn-orange" style="text-transform: none !important;">Enviar link a mi correo</button>
          </div>
          </form>

        </div>
      </div>
    </div>


</div>

@endsection

@section('scripts')
<script type="text/javascript" src="{{ URL::asset('metronic/scripts/ui-buttons-spinners.min.js')}}"></script>
<script type="text/javascript" src="{{ URL::asset('js/jquery.blockUI.js')}}"></script>

<script>
    jQuery(document).ready( function($) {
         $( "#register-form" ).submit(function( event ) {
            /* event.preventDefault();*/
           
            var $btnc = $('#btn-user-register');
            $btnc.button('loading');
        });

    });
</script>

<!-- GET TOWNS BY STATE ID -->
<script>
jQuery(document).ready( function($) {
     var $btnc = $('#btn-user-register');
    $btnc.button('reset');


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
    
    if(stateId){


        var url = "{{ url('/register/get-towns') }}"+"/"+stateId;
     
        /*$.get(url, function(data){ 
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

                        townName = capitalize(uData.towns[x]['TOWN']);
                        console.log(townName);
                        options += '<option class="town" ' + selected +' value="' + uData.towns[x]['ID'] + '">' + townName + '</option>';
                    }
                    
                    $('#userTown').html(options);




                    $('div.panel-default').unblock();

                    
                } else{
                    alert('error');
                }   
        }) */


        $.ajax({
              type: "GET",
              url: url,
              data: null,
              /*async: false,*/
              cache: false,
              contentType: false,
              processData: false,
              beforeSend:function(xhr){
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
                },
              success: function (data) {

              }

          })
        .done(function(data){
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

                        townName = capitalize(uData.towns[x]['TOWN']);
                        console.log(townName);
                        options += '<option class="town" ' + selected +' value="' + uData.towns[x]['ID'] + '">' + townName + '</option>';
                    }
                    
                    $('#userTown').html(options);




                    $('div.panel-default').unblock();

                    
                } else{
                    alert('error');
                }   
              $(".town").addClass("capitalize");
              $('div.panel-default').unblock();
              console.log("done...");

        })
        .fail(function() {
            $('div.panel-default').unblock();
            alert( "error" );
          })
         .always(function() {
            $(".town").addClass("capitalize");
            
          }); 
          
               
     }
 }

    const capitalize = (s) => {
      if (typeof s !== 'string') return ''
      return s.charAt(0).toUpperCase() + s.slice(1);

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
</script>


<!-- Reset password -->
<script>
    $('#reset-mail-form').submit(function( event ) {
         event.preventDefault();

        var mail = $('#userEmailReset').val();
        var token = $('[name=_token]').val();
        var userFirstName = $('#userFirstName').val();
        var userLastName = $('#userLastName').val();
        var userCellPhoneNumber = $('#userCellPhoneNumber').val();
        var fromEventRegister = 1;
        var eventId = $('#eventId').val();

        var fData = $("#register-form").serialize();

       

        console.log(fData);
       
      
        var aData = { userEmail : mail, _token : token, formData : fData,
                      userFirstName : userFirstName, userLastName : userLastName, userCellPhoneNumber : userCellPhoneNumber, eventId : eventId, fromEventRegister : fromEventRegister};

        var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;

        if (!testEmail.test(mail)){
            showErrMessage($('#userEmailReset'), $('.uemail'));
            
            return;
        }

        $.ajax({
              type: "POST",
              url: "{{ route('password.email.reset') }}",
              data: aData,
              dataType:'json',
              /*async: false,*/
             
              beforeSend:function(xhr){
                $('#exampleModal').block({ 
                        message: '<div class="spinner"><div class="dot1"></div><div class="dot2"></div></div><h4 style="color:#fff; font-size:14px">Enviando correo de recuperación.</h4>', 
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
              }
          }).done(function(data){
            swal({
                type: "success",
                title: "Mensaje",
                text: data.message,
                icon: "success",
                button: "Listo!",
            });
            $('#exampleModal').unblock();
            $('#userEmailReset').val("");
            $('#exampleModal').modal('hide');
          });



        //alert(mail);

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