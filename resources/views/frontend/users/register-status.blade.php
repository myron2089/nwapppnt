 @extends('layouts.public.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/login-style.css')}}" type="text/css" />
     <link rel="stylesheet" href="{{ asset('css/animate.css')}}" type="text/css" />
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-5 col-md-offset-3">
            <div class="panel panel-default " style="margin-top: 50px">
                <div class="row">
                        <div class="col-md-12 nomargin nopadding">
                            <div class="circle-logo" style="margin-top: 20px">
                                 <!--<div class="lft"></div>-->
                            </div>
                            <span style="margin: 0 auto; position: absolute; width: 100%; text-align: center; font-weight: 500; font-size: 18px; margin-top: 15px">NetWorkingApp</span>
                            <!--<span style="margin: 0 auto; margin-top: 25px; position: absolute; width: 100%; text-align: center; font-weight: 300; font-size: 14px">Registro de Visitantes par ExpoMotriz 2018</span> -->
                        </div>
                         <div class="panel-body" style="height: 400px;">
                         
                     	<div class="group" style="margin-top: 100px !important"><br><br>
                     		<h4 style="text-align: center; color: #FF800A; font-size: 20px; line-height: 1.2">Se ha registrado correctamente al evento {{$eventName}}</h4>
                            <p style="font-size: 14px;">El siguiente paso es descargar el app de Google Play y App Store.</p>
                            <div class="col-md-12" style="text-align: center; margin-top: 0px; padding-bottom: 20px;">
                                <a href="https://play.google.com/store/apps/details?id=net.Networkingapp" style="width: 120px; height: 36px; float: left; background: url('{{url('images/icons/playStore.png')}}') center center no-repeat; background-size: cover; "></a>
                            
                                <a href="https://itunes.apple.com/gt/app/networkingapp-net/id1207597316?mt=8" style="width: 120px; height: 36px; float: left; background: url('{{url('images/icons/appStore.png')}}') center center no-repeat; background-size: cover;  "></a> 
                            </div>
                            
                            <p style="font-size: 14px;">Sus datos para iniciar sesión en Networkingapp.net son:</p>
                            <p style="font-size: 14px; margin-top: -10px">Usuario: <span style="font-size: 14px; color: #FF7D08">{{$email}}</span></p>
                            <p style="font-size: 14px; margin-top: -10px">Contraseña: <span style="font-size: 14px; color: #FF7D08">{{$password}}</span></p>
                            <div class="col-md-12" style="text-align: center; margin-top: -20px">
                                 {!! QrCode::size(200)->generate($qr); !!}
                            </div>
                            <p style="text-align: center; font-size: 14px">Le recomendamos guardar esta información y tenerla a la mano para su fácil acceso al evento.</p>


                     		<p style="text-align: center; float: left">Adicionalmente te hemos enviado un correo con información de inicio de sesión y del evento. </p>

                         
                            <br><br><br>
                            <div style="float: left; width: 100%; height: 25px;">
                            </div>
                     		<!--<a style="text-align: center: width: 100%" href="https://www.facebook.com/ExpoMotriz">Visita nuestra página de facebook</a>-->
                     	</div>
                   
                         </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection




