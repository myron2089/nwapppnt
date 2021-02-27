@extends('frontend.layouts.app')
@section('css')
	
@endsection


@section('content')
 
	@if($eventRole == 5)
		<div class="container clearfix">
	@endif
	<div class="row" style="margin-top: -5px;">
		<div class="col-md-12  field-content" style="margin-top:-50px; padding: 20px;  background: #fff;">
			<div class="col-md-12 " style="background: transparent; padding: 0">
				<div class="col-md-8 " style="float: left">
					@if($countFields >0)
						<h3>Datos adicionales para {{$eventName}}</h3>
					@else
						<h3>Confirmar Registro en {{$eventName}}</h3>
					@endif


					<form id="form-update-fields" method="POST" action="{{url('events/save-data-fields')}}">
						{{ csrf_field() }}
						<input type="hidden" id="evId" name="evId" value="{{$eventId}}">
						<input type="hidden" id="dinamicFields" name="dinamicFields" value="{{$countFields}}">
						{!! $fields !!}

						<button type="submit" class="button button-3d button-rounded btn-orange pull-rigth"><i class="fa fa-check"></i>Continuar con registro</button>
						
						<br><br>
						@if($countFields >0)
						<!--<div class="style-msg successmsg">
							<div class="sb-msg"><i class="icon-thumbs-up"></i><strong>Información!</strong> Para continuar con el registro en {{$eventName}} se solicita que completes los datos adicionales.</div>
							
						</div><br><br>-->
						@endif
						<!--
						<div class="style-msg successmsg">
							<div class="sb-msg"><i class="icon-thumbs-up"></i><strong>Tip!</strong> Recuerda actualizar tu información en <span>My Badge</span>.</div>
							
						</div> -->
						
					</form>
				</div>
				<div class="col-md-3" style="float: left; min-height: 800px;">
					<div class="fancy-title title-border topmargin-lg">
							<h4>Datos del Evento</h4>
						</div>
					<div class="col-md-12" style="height: 120px; margin-top: 20px;">
						
						<img src="{{url($eventLogo)}}">

						<div class="feature-box fbox-plain fbox-dark fbox-small" style="padding-left: 5px;">
							
							<h3><i class="icon-info"></i> Lugar / Fecha de Inicio</h3>
							<p class="notopmargin">{{$eventPlace}}</p>
							<p class="notopmargin" style="margin-top: 10px !important;">{{$eventStarts}}</p>
							
							<h3 style="margin-top: 10px !important;"><i class="icon-money"></i> Precio</h3>
							<p class="notopmargin">{{$eventPrice}}</p>
						</div>

					</div>

				</div> 
			</div>
		</div> <!-- end col-md-12 -->
	</div> <!-- end row -->
	@if($eventRole == 5)
		</div> <!-- end container clearfix -->
	@endif
@endsection


@section('scripts')
	
 <script type="text/javascript" src="{{ URL::asset('js/jquery.blockUI.js')}}"></script>


 <script type="text/javascript">
 	$('#form-update-fields').submit(function( event ) {
    	event.preventDefault();
    	var data = new FormData($(this)[0]);
    	var form = $(this);
    	
    	
    	$.ajax({
          type: "POST",
          url: form.attr( "action" ),
          data: data,
          //async: false,
          cache: false,
          contentType: false,
          processData: false,
          beforeSend: function(){
          	$('body.stretched').block({ 
                message: '<div class="spinner"><div class="dot1"></div><div class="dot2"></div></div><h4 style="color:#fff">Regitrando en el Evento...</h4>', 
                 css: { 
                    border: 'none', 
                    padding: '10px', 
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
        }).done(function(data){

        	var uData = jQuery.parseJSON(data);

          	if(uData.status=='success'){
          		console.log(uData.eventUrl);
          		var urle = "{{url('')}}/"+uData.eventUrl;
          		
          		location.href =  urle;
          	}
          	if(uData.status=='error'){

          		alert('Error!');
          	}

          	setTimeout(function(){ $('body.stretched').unblock()}, 2000);

        });

         

	});

 

	 </script>
	
@endsection