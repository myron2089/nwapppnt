<!DOCTYPE html>
	<body>
		<div style="width: 100%; min-height: 300px">
			<div style="width: 95%; margin: 0 auto; background: #f2f2f2; padding: 40px; border-bottom: 0px solid #d8d8d8; min-height: 350px;">
				
			
				<h2 style="margin-top: 5px; font-size: 24px; font-family: 'Open Sans','Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif; color: #294661 !important;">Hola, {{$fullname}}</h2>
			    
				<p style="margin-top: 10px;font-family: 'Open Sans','Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif; color: #294661 !important;font-size: 16px;">Se ha registrado una cuenta para el evento <span style="font-size: 18px; color: #ee7f22; font-weight: 600;">{{$eventName}}</span> como {{$userType}}</p>
				

				<hr style="width: 100%; border: 1px solid #e2e2e2;">

				<p style="margin-top: 10px;font-family: 'Open Sans','Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif; color: #294661 !important;font-size: 16px;">Ingrese a <a href="https://www.networkingapp.net/login">NetworkingApp </a></p>

				<p style="margin-top: 10px;font-family: 'Open Sans','Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif; color: #294661 !important;font-size: 16px;">Utilice los siguientes datos para el inicio de sesión en la aplicación:</p>

				<div style="width: 95%; float: left; border: 0px solid gray; border-radius: 5px; background-color: #a1d8f3; text-align: center">
                	<p style="color: #5e5e5e; font-size: 16px; margin-top: -10px"><B>Usuario:</B> <span style="font-size: 16px; color: #2b2a2a; text-decoration: none !important;">{{$userEmail}}</span></p>
                	<p style="color: #5e5e5e; font-size: 16px; margin-top: -10px"><B>Contraseña:</B> <span style="font-size: 16px; color: #2b2a2a">{{$userPass}}</span></p>
            	</div>

            	<hr style="width: 100%; border: 1px solid #e2e2e2;">

				<p style="margin-top: 10px;font-family: 'Open Sans','Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif; color: #294661 !important;font-size: 16px; float: left;">Imprima el código QR y presentelo el día del evento!. </p>

				<div style="width: 95%; height: 400px; margin: 0 auto; text-align: center;">
				 	<img src="{!!$message->embedData($qr, 'QrCode.png', 'image/png')!!}">
				</div>

				<p style="margin-top: 10px;font-family: 'Open Sans','Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif; color: #294661 !important;font-size: 16px;">Descargue la aplicación en Google Play y App Store.</p>

                <div class="col-md-12" style="text-align: center; margin-top: 0px; width: 99%">
                    <a href="https://play.google.com/store/apps/details?id=net.Networkingapp" style="width: 120px; height: 36px; float: left; background: url('{{ $message->embed('images/logos/play-store.png')}}') center center no-repeat; background-size: cover; "></a>
						
					<a href="https://itunes.apple.com/gt/app/networkingapp-net/id1207597316?mt=8" style="width: 120px; height: 36px; float: left; background: url('{{ $message->embed('images/logos/app-store.png')}}') center center no-repeat; background-size: cover; "></a>
                </div>
				
			</div>
		</div>
	</body>
</html>