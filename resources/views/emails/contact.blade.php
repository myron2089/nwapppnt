<!DOCTYPE html>
	<body>
		<div style="width: 100%; min-height: 300px">
			<div style="width: 75%; margin: 0 auto; background: #f9f9f9; padding: 40px; border-bottom: 1px solid #d8d8d8;">
			    
				<p><span style="font-size: 16px; color: orange; font-weight: 600;">{{$data['email']}}</span><span> Ha enviado un mensaje.</span></p>
				<p style="margin-top: 10px;font-family: 'Open Sans','Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif; color: #294661 !important;font-size: 16px;"><span style="color: #294661">Nombre: </span>{{$data['name']}}</p>
				<p style="margin-top: 10px;font-family: 'Open Sans','Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif; color: #294661 !important;font-size: 16px;"><span style="color: #294661">Teléfono: </span>{{$data['phone']}}</p>

				<p style="margin-top: 10px;font-family: 'Open Sans','Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif; color: #294661 !important;font-size: 16px;"><span style="color: #294661">{{$data['subject']}}</p>
				<p style="margin-top: 10px;font-family: 'Open Sans','Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif; color: #294661 !important;font-size: 16px;"><span style="color: #294661; font-style: italic;">{{$data['message']}}</p>
				
			</div>
		</div>
	</body>
</html>