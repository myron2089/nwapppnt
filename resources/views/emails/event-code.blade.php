<!DOCTYPE html>
	<head>
		<style type="text/css">
			body{
				font-family: 'Open Sans','Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif; color: #294661 !important;
				font-size: 16px;
			}

		</style>
	</head>
	<body>
		<div style="width: 100%; min-height: 300px">
			<div style="width: 95%; margin: 0 auto; border: 1px solid #adadad; padding: 20px">
				
			
				<h2 style="margin-top: 5px; font-size: 24px; font-family: 'Open Sans','Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif; color: #294661 !important;">Hola {{$email}}!</h2>
			    
				<p style="color: #294661 !important; font-size: 16px;">Un administrador ha generado un código para que puedas crear tu evento</p>
			
				<div style="width: 100%; float: left; border: 0px solid gray; border-radius: 3px; background-color: #a1d8f3; text-align: center">
                	<p style="color: #5e5e5e; font-size: 16px; margin-top: -10px">Utiliza este código para crear un nuevo evento</p>
                	<p style="color: #5e5e5e; font-size: 18px; margin-top: -10px"><B>{{$code}}</B></p>
            	</div>
				
				<p style="margin-top: 140px;font-family: 'Open Sans','Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif; color: #294661 !important;font-size: 16px;">Ya tienes un usuario en networkingapp.net?<br> Sigue el enlace para ingresar y poder crear un nuevo evento.</p>
            	<a href="{{url('login')}}?eventRegister=1" style="height: 50px; padding: 10px; background-color: #ef7d0e; color: #fff; text-decoration: none; font-size: 14px;"><i class="fa fa-arrow-circle-right"></i> Ingresar para crear un nuevo evento</a>

            	<p style="margin-top: 40px;font-family: 'Open Sans','Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif; color: #294661 !important; font-size: 16px;">No tienes una cuenta en networkingapp.net?<br> Sigue el enlace para registrarte y poder crear un nuevo evento.</p>
            	<a href="{{url('registro')}}?crear=1" style="height: 50px; padding: 10px; background-color: #ef7d0e; color: #fff; text-decoration: none; font-size: 14px;"><i class="fa fa-arrow-circle-right"></i> Ingresar para crear un nuevo evento</a>
			</div>
		</div>
	</body>
</html>