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
			<div style="width: 75%; margin: 0 auto; background: #f9f9f9; padding: 40px; border-bottom: 1px solid #d8d8d8;">
					<h2 style="margin-top: 5px; font-size: 24px; font-family: 'Open Sans','Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif; color: #294661 !important;">Hola {{$user->userFirstName}}!</h2>
                	

	                <p style="margin-top: 10px;font-family: 'Open Sans','Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif; color: #294661 !important;font-size: 16px;">
	                	No tiene de qué preocuparse!!! Puede restablecer su contraseña de NetworkingApp haciendo clic en el enlace de abajo<br>
					</p>

					
					
					
                	@if($formData && $formData['fromEventRegister']==1)

                		<a href="{{route('password.reset', ['token' => $token])}}?userEmail={{$user->userEmail}}&userFirstName={{$formData['userFirstName']}}&userLastName={{$formData['userLastName']}}&userCellPhoneNumber={{$formData['userCellPhoneNumber']}}&fromEventRegister={{$formData['fromEventRegister']}}&eventId={{$formData['eventId']}}" style="height: 50px; padding: 10px; background-color: #ef7d0e; color: #fff; text-decoration: none; font-size: 14px; position: relative; margin-top: 20px;"><i class="fa fa-key"></i> Restablecer Contraseña</a>


                		<p style="margin-top: 10px;font-family: 'Open Sans','Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif; color: #294661 !important;font-size: 16px;">
						Despues de restablecer su contraseña, podrá continuar con su registro en el evento.</p>


                	@else

                		<a href="{{route('password.reset', ['token' => $token])}}?userEmail={{$user->userEmail}}" style="height: 50px; padding: 10px; background-color: #ef7d0e; color: #fff; text-decoration: none; font-size: 14px; position: relative; margin-top: 20px;"><i class="fa fa-key"></i> Restablecer Contraseña</a>

                	@endif

                	<p style="margin-top: 10px;font-family: 'Open Sans','Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif; color: #294661 !important;font-size: 16px;">
						Si no solicitó restablecer su contraseña, no dude en eliminar este mensaje<br>
						<span style="color: #294661"> NetworkingApp.net</span>
					</p>
      
			</div>
		</div>
	</body>
</html>