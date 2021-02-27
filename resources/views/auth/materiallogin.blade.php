@extends('layouts.login-app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/login-style.css')}}" type="text/css" />
     <link rel="stylesheet" href="{{ asset('css/animate.css')}}" type="text/css" />
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-5 col-md-offset-3">
            <div class="panel panel-default" >
               <!-- <div class="panel-heading">Login</div>-->
                <div class="log-image-top-rarrow">
                	
                </div>
                
                <div class="row">
                        <div class="col-md-12 nomargin nopadding">
                            <div class="circle-logo">
                            </div>
                        </div>
                    </div>
                <div class="panel-body panel-body-login">


                    
                    <form id="login-form" class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="evUrl" id="evUrl" value="{{$evUrl}}">
                        <input type="hidden" name="eventRegister" id="eventRegister" value="{{$createEvent}}">
                        <input type="hidden" name="fromPublic" id="fromPublic" value="{{$fromPublic}}">
                        <div class="clear" style="height: 50px">
                        </div>
                        <div class="group">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" id="email-focus">
                                <input class="mdl-textfield__input" type="email" id="userEmail" name="userEmail" value="{{old('userEmail')}}" ata-trigger="manual" autofocus>
                                <label class="mdl-textfield__label" for="userPassword">Correo Electrónico</label>
                                <div class="err-msg uemail">
                                    <span>Es necesario ingresar un email válido</span>
                                </div>
                                <!--<span class="mdl-textfield__error"></span>-->
                            </div>
                        </div>

                         <div class="group">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" type="password" id="password" name="password">
                                <label class="mdl-textfield__label" for="userPassword">Contraseña</label>
                                <div class="err-msg upassword">
                                    <span>Debes ingresar una contraseña</span>
                                </div>

                                <!--<span class="mdl-textfield__error"></span>-->
                            </div>
                        </div>

                     <!--   <div class="group">
						    <input id="userEmail" name="userEmail" type="text"  data-trigger="manual" autofocus><span class="highlight"></span><span class="bar"></span>
						    <label>EMAIL</label>
						    <div class="err-msg uemail">
						    	<span>Es necesario ingresar un email válido</span>
						    </div>
						</div> 

						<div class="group">
						    <input id="password" name="password" type="password"  data-trigger="manual"><span class="highlight"></span><span class="bar"></span>
						    <label>CONTRASEÑA</label>
						    <div class="err-msg upassword">
						    	<span>Es necesario ingresar una contraseña</span>
						    </div>

                            <a style="margin-top: 20px" class="btn btn-link pull-left" href="{{ route('password.request') }}" style="margin-left: -15px; margin-top: 10px">Recuperar contraseña</a>
						</div> -->
                        @if (count($errors) > 0)
                            <div class="alert alert-danger" style="border-radius: 1px">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li style="list-style: none"> {{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
						<br>



                       <!-- <div class="form-group{{ $errors->has('userEmail') ? ' has-error' : '' }}" style="margin-top: 20px;">
                            <label for="userEmail" class="col-md-4 control-label">E-Mail</label>

                            <div class="col-md-6">
                                <input id="userEmail" type="email" class="form-control" name="userEmail" value="{{ old('userEmail') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('userEmail') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}" style="margin-top: 25px;">
                            <label for="password" class="col-md-4 control-label">Contraseña</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> -->

                     <!--   <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div> -->
                         
                        <div class="group buttons">
                            
                                <button type="submit" class="btn btn-primary button" style="width: 100%" >
                                    INGRESAR
                                </button>
                                
                           
                        </div>
                        <div class="group nomargin nopadding login-create-account">
                            @if(isset($createEvent) && $createEvent==1)
                                <span>¿NO TIENES UNA CUENTA? <a id="get-create-fields2" href="{{url('usuarios/registro')}}?crear=1">CREAR</a></span>
                            @else
                        	   <span>¿NO TIENES UNA CUENTA? <a id="get-create-fields2" href="{{url('registro')}}">CREAR</a></span>
                            @endif
                        </div>

                    </form>
                </div>

                <div class="group nomargin login-reset-password">
                      <span>¿Olvidaste tu contraseña? <a id="get-create-fields2" href="{{url('password/reset')}}">Recuperala aquí</a></span>
                </div>

                <div class="panel-body panel-body-register">
                	 <form class="form-horizontal" method="POST" action="{{ url('visitor/register') }}">
                        {{ csrf_field() }}
                	 	 <div class="group">
						    <input id="userFirstName" name="userFirstName" type="text"><span class="highlight"></span><span class="bar"></span>
						    <label>NOMBRES</label>
						</div>

						<div class="group">
						    <input id="userLastName" name="userLastName" type="text"><span class="highlight"></span><span class="bar"></span>
						    <label>APELLIDOS</label>
						</div>

						<div class="group">
						    <input id="userRemail" name="userRemail" type="text" type="text"><span class="highlight"></span><span class="bar"></span>
						    <label>EMAIL</label>
						</div>

						<div class="group" style="margin-bottom: 5px;">
                            <button type="submit" class="btn btn-primary button" style="width: 100%" >CONTINUAR REGISTRO</button>
                        </div>

                        <div class="group nomargin nopadding login-create-account" style="margin-top:-50px;">
                        	<span><a id="get-log-in" href="#">INICIAR SESION</a></span>
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
	  $( "#login-form" ).submit(function( event ) {

	  	var errors = 0;
	  	var uemail = $('#userEmail').val();
	  	var upass = $('#password').val();

	  	var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;

	  	if (!testEmail.test(uemail)){
	  		showErrMessage($('#userEmail'), $('.uemail'));
	  		errors++;

	  	}

	  	else if (upass.length <= 0) {
	  		showErrMessage($('#password'), $('.upassword'));
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

<script>
    jQuery(document).ready( function($) {   

        $('#email-focus').addClass('is-focused');
        $('#userEmail').select();

    });

</script>

@endsection
