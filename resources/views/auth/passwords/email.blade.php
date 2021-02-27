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
                    
                </div>
                
               <!-- <div class="row">
                        <div class="col-md-12 nomargin nopadding">
                            <div class="circle-logo">
                            </div>
                        </div>
                    </div> -->

                <div class="panel-body">
                    

                   <!-- <form class="form-horizontal" method="POST" action="{{ route('password.email') }}"> -->
                    <form class="form-horizontal" method="POST" action="{{ route('password.email.reset') }}">
                        {{ csrf_field() }}
                        <div class="group"  style="margin-top: 20px; text-align: justify;">
                            <span>Ingrese el correo electrónico con el que se dio de alta en nuestro sistema, donde le enviaremos los pasos para generar su nueva contraseña.</span>

                        </div>
                        <div class="group" style="margin-top: 10px">
                            <!--<div id="email-container" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">-->
                                <input class="form-control custom-form-control" type="email" id="userEmail" name="userEmail" value="{{old('userEmail')}}" ata-trigger="manual" autofocus required maxlength="150" placeholder="Correo electrónico">
                                <!--<label class="mdl-textfield__label" for="userPassword">Correo Electrónico</label>-->
                                <div class="err-msg uemail">
                                    <span>Es necesario ingresar un email válido</span>
                                </div>
                                <!--<span class="mdl-textfield__error"></span>-->
                            <!--</div>-->
                        </div>

                          @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif


                        <!--<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> -->

                        <div class="group" style="margin-top: 10px">
                            
                                <button type="submit" class="btn btn-primary button" style="height: 40px; padding-top: 10px" >
                                    Enviar link a mi correo
                                </button>
                                
                           
                        </div>
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if (count($errors) > 0)
                            <div class="alert alert-danger" style="border-radius: 1px">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li style="list-style: none"> {{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

<script type="text/javascript" src="{{ URL::asset('js/formValidate.js')}}"></script>


<script type="text/javascript">
    jQuery(document).ready( function($) {   
      $( "#register-forms" ).submit(function( event ) {
      


      });
    
    }):


</script>

<script>
    
jQuery(document).ready( function($) {
    $("#userEmail" ).select();     
    $( "#email-container" ).addClass('is-focused');
});

</script>

@endsection
