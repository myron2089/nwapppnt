<!DOCTYPE html>
	<html lang="en">
		<head>

			<style type="text/css">
				i {
					transform: rotate(-45deg);
				    -webkit-transform: rotate(-45deg);
				    border: solid #fff;
				    border-width: 0 3px 3px 0;
				    display: inline-block;
				    padding: 3px;
				    color: #fff;
				     
				}

				.right {
				    transform: rotate(-45deg);
				    -webkit-transform: rotate(-45deg);
				}

			</style>
		</head>
		<body>
			<div style="width: 100%; min-height: 300px">
				<div style="width: 95%; margin: 0 auto; border: 1px solid #adadad; padding: 20px">
					<h2 style="margin-top: 5px; font-size: 24px; font-family: 'Open Sans','Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif; color: #294661 !important;">Hola {{$fullname}}!</h2>
				
					<!--<h2 style="margin-top: 5px;">{{$fullname}}</h2>-->
				    
					<p style="color: #5e5e5e; font-size: 14px;">El Comité Organizador de <span style="font-size: 16px; color: #f87f1d; font-weight: 600;">{{$eventName}}</span> le hace llegar un ticket con el que podrá ingresar al evento sin incurrir en ningún costo. </p>


					<div style="background:#004f84; color: #fff; margin: 20px; padding: 20px; text-align: center; height: 30px;">
						<p style="font-size: 22px;margin-top: 0px !important;">{{$codeNumber}}</p>
					</div>

					<p style="color: #5e5e5e; font-size: 14px;">Al llegar al lugar del evento, busque la taquilla exclusiva para tickets de ingreso digitales y presente su ticket con su código único para poder ingresar.</p>
					<br>
					<p style="color: #5e5e5e; font-size: 14px;">Además de conservar este Ticket de Ingreso para presentar en la taquilla, le recomendamos: </p>
					<p style="color: #092348; font-size: 14px; font-weight: 600">1) Pre Registrarse antes de llegar a la feria para evitar colas y acelerar su proceso de ingreso a {{$eventName}}.<p>
						<a href="https://www.networkingapp.net/eventos/{{$URL}}/registro/nuevo" style="margin-top: -8px !important; background: #F87F1D; border: 0; border-radius: 3px !important; padding: 5px 8px 5px 8px; text-decoration: none; color: #fff; font-weight: 550; float: left">Pre Registrarse <i class="right"></i></a>
						<br><br>
					<p style="color: #092348; font-size: 14px; font-weight: 600">2) Bajar Networkingapp.net en su teléfono móvil para estar preparado para hacer Networking en {{$eventName}}</p>
					
					<a href="https://play.google.com/store/apps/details?id=net.Networkingapp" style="width: 120px; height: 36px; float: left; background: url('{{ $message->embed('images/logos/play-store.png')}}') center center no-repeat; background-size: cover; "></a>
						
					<a href="https://itunes.apple.com/gt/app/networkingapp-net/id1207597316?mt=8" style="width: 120px; height: 36px; float: left; background: url('{{ $message->embed('images/logos/app-store.png')}}') center center no-repeat; background-size: cover; "></a>

					<br><br>
					<p style="color: #5e5e5e; font-size: 14px;">Su Ticket de ingreso es válido para ingresar durante los 3 días del evento.</p>
					<p style="color: #5e5e5e; font-size: 14px;">Lo esperamos.</p>
					
					<!--<p style="font-size: 14px">Presenta el siguiente pase día del evento.</p>
					<span style="color: orange; font-size: 18px">{{$codeNumber}}</span>-->
				

					

					<div style="width: 99%; height: auto; position: relative; margin-top: 30px">
						<a href="https://www.networkingapp.net/eventos/{{$URL}}/registro/nuevo">
							<div style="width: 320px; height: 529px; background: url('{{ $message->embed($picture_path)}}') center center no-repeat; background-repeat: no-repeat; background-size: cover;">
								
							</div>
						</a>
					</div>

					<a href="https://www.networkingapp.net/eventos/{{$URL}}/registro/nuevo" style="    background: #F87F1D; border: 0; border-radius: 3px !important; padding: 10px 15px 10px 15px; text-decoration: none; color: #fff; font-weight: 500; float: left; margin-top: 10px; margin-left: 35px">Ahorra tiempo pre-registrándote online en {{$eventName}} <i class="right"></i></a>


					
				</div>
			</div>
		</body>
	</html>