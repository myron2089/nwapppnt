@extends('layouts.login-app')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/login-style.css')}}" type="text/css" />
     <link rel="stylesheet" href="{{ asset('css/animate.css')}}" type="text/css" />
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-5 col-md-offset-3">
            <div class="panel panel-default">
                
                <div class="reset-image-top-rarrow">
                    <!--<div class="panel-heading" style="background: rgba(0,0,0,0.2); margin-top: -15px;font-weight: 600; color: #525252;">Restablecer contraseña</div>-->
                </div>
                
                <!--<div class="row">
                        <div class="col-md-12 nomargin nopadding">
                            <div class="circle-logo">
                            </div>
                        </div>
                    </div> -->

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('password.request') }}">
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
                        <input type="hidden" name="token" value="{{ $token }}">
                        <!--
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="userEmail" type="email" class="form-control" name="userEmail" value="{{ $email or old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif

                                
                            </div>
                        </div> -->

                        <input class="form-control" type="hidden" id="userFirstName" name="userFirstName" value="{{ $userFirstName or old('userFirstName') }}" >
                        <input class="form-control" type="hidden" id="userLastName" name="userLastName" value="{{ $userLastName or old('userLastName') }}" >
                        <input class="form-control" type="hidden" id="userCellPhoneNumber" name="userCellPhoneNumber" value="{{ $userCellPhoneNumber or old('userCellPhoneNumber') }}" >
                        <input class="form-control" type="hidden" id="fromEventRegister" name="fromEventRegister" value="{{ $fromEventRegister or old('fromEventRegister') }}" >
                        <input class="form-control" type="hidden" id="eventId" name="eventId" value="{{ $eventId or old('eventId') }}" >


                         <div class="group" style="">
                           
                                <input class="form-control custom-form-control" placeholder="Correo electronico" type="email" id="userEmail" name="userEmail" value="{{ $userEmail or old('userEmail')}}" ata-trigger="manual" autofocus required>
                               
                                <div class="err-msg uemail">
                                    <span>Es necesario ingresar un email válido</span>
                                </div>
                                <!--<span class="mdl-textfield__error"></span>-->
                            
                        </div>


                         <div class="group" style="">
                           
                                <input class="form-control custom-form-control" type="password" placeholder="Nueva contraseña" id="password" name="password"  ata-trigger="manual" required>
                               
                                <div class="err-msg uemail">
                                    <span>La contraseña es obligatoria</span>
                                </div>
                                <!--<span class="mdl-textfield__error"></span>-->
                            
                        </div>

                        <div class="group" style="">
                            
                                <input class="form-control custom-form-control" placeholder="Reingresar nueva contraseña" type="password" id="password-confirm" name="password_confirmation"  ata-trigger="manual" required>
                                
                                <div class="err-msg uemail">
                                    <span>La contraseña es obligatoria</span>
                                </div>
                                <!--<span class="mdl-textfield__error"></span>-->
                            
                        </div>


                       <!-- <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
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

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> -->

                        <div class="group"  style="margin-top: 10px">

                             <button type="submit" class="btn btn-primary button" style="height: 40px; padding-top: 10px" >
                                Restablecer contraseña
                            </button>
                            
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
    $("#userEmail" ).select();     
    $( "#email-container" ).addClass('is-focused');

});

</script>



@endsection
