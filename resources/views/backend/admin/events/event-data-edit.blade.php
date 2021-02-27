<div class="row" style="margin-top: 10px;">
	<div class="col-md-12">
	 <!-- BEGIN SAMPLE FORM PORTLET-->
	    <div class="portlet light bordered">
	        <div class="portlet-title">
	            <div class="caption font-green-haze">
	                <i class="icon-settings font-green-haze"></i>
	                <span class="caption-subject bold uppercase"> EVENTO</span>
	            </div>
	            <div class="actions">
	                <!--<a class="btn btn-circle btn-icon-only blue" href="javascript:;">
	                    <i class="icon-cloud-upload"></i>
	                </a>
	                <a class="btn btn-circle btn-icon-only green" href="javascript:;">
	                    <i class="icon-wrench"></i>
	                </a>
	                <a class="btn btn-circle btn-icon-only red" href="javascript:;">
	                    <i class="icon-trash"></i>
	                </a> 
	                <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>-->
	            </div>
	        </div>
	        <div class="portlet-body form">
	            <form id="form-event-edit-data" method="POST" role="form" class="form-horizontal" action="{{route('event-store-edit-data')}}">
	                <div class="form-body">
	                	@foreach ($eventData as $event)
	                	<input type="hidden" id="evId" name="evId" value="{{$eventId}}">
	                	{{ csrf_field() }}
	                     
	                	 <h3 class="page-header" style="margin-top:-15px"><i class="fa fa-pencil-square-o font-red" ></i> Datos del Evento</h3>
                         <div class="form-group custom-form-group">
                            <label class="control-label col-md-2"> Nombre del Evento <span class="required"> * </span></label>
                            <div class="col-md-10">
                                <div class="input-icon right">
                                	<i class="fa fa-exclamation tooltips" data-original-title="please write a valid email"></i>
                                	<input id="eventName" name="eventName" type="text" class="form-control" placeholder="Subtítulo del Evento" autofocus value="{{$event->NAME}}" disabled /> 
                                </div>
                            </div>
                        </div>

                        <div class="form-group custom-form-group">
	                        <label class="col-md-2 control-label" for="form_control_1">Tipo de Evento <span class="required"> * </span></label>
	                        <div class="col-md-10">
	                            <select id="eventType" name="eventType" class="form-control" required>
	                            	<option value="">Seleccionar Tipo de Evento</option>
	                            	@foreach($eventTypes as $type)
	                            		<option value="{{$type->ID}}" @if($type->ID == $event->EVENTTYPE) selected  @endif >{{$type->NAME}}</option>
	                            	@endforeach
	                           	</select>
	                        </div>
	                    </div>	

                        <div class="form-group custom-form-group">
	                        <label class="col-md-2 control-label" for="form_control_1">Fecha de Inicio <span class="required"> * </span></label>
	                        <div class="col-md-10">
	                            <input id="eventDateStart" name="eventDateStart" type="date" class="form-control" value="{{$event->DATESTART}}" required >
	                        </div>
	                    </div>	


                        <div class="form-group custom-form-group">
	                        <label class="col-md-2 control-label" for="form_control_1">Hora de Inicio <span class="required"> * </span></label>
	                        <div class="col-md-10">
	                            <input id="eventTimeStart" name="eventTimeStart" type="time" class="form-control" value="{{$event->TIMESTART}}" required >
	                        </div>
	                    </div>	

	                    <div class="form-group custom-form-group">
	                        <label class="col-md-2 control-label" for="form_control_1">Fecha de Finalización <span class="required"> * </span></label>
	                        <div class="col-md-10">
	                            <input id="eventDateEnd" name="eventDateEnd" type="date" class="form-control" value="{{$event->DATEFINISH}}" required >
	                        </div>
	                    </div>	


                        <div class="form-group custom-form-group">
	                        <label class="col-md-2 control-label" for="form_control_1">Hora de Finalización <span class="required"> * </span></label>
	                        <div class="col-md-10">
	                            <input id="eventTimeEnd" name="eventTimeEnd" type="time" class="form-control" value="{{$event->TIMEFINISH}}" required >
	                        </div>
	                    </div>	

						<div class="form-group custom-form-group">
	                        <label class="col-md-2 control-label" for="eventPrice">Precio <span class="required"> * </span></label>
	                        <div class="col-md-10">
	                            <input id="eventPrice" name="eventPrice" type="text" class="form-control number" value="{{$event->PRICE}}" autocomplete="off" required >
	                        </div>
	                    </div>	

						<div class="form-group custom-form-group">
	                        <label class="col-md-2 control-label" for="eventCurrency1">Moneda <span class="required"> * </span></label>
	                        <div class="col-md-10">
								<select id="eventCurrency" name="eventCurrency" class="form-control" required="" aria-required="true" aria-invalid="false" aria-describedby="eventCurrency-error">
									<option value="1" @if($event->CURRENCY == 1) selected  @endif >Quetzales Q</option>
									<option value="2" @if($event->CURRENCY == 2) selected  @endif >Dolares $</option>
									<option value="3" @if($event->CURRENCY == 3) selected  @endif >Euros €</option>
								</select>
	                        </div>
	                    </div>	

	                   

	                    <div class="form-group custom-form-group">
                            <label class="control-label col-md-2"> Url <span class="required"> * </span></label>
                            <div class="col-md-10">
                                <div class="input-icon right">
                                	<input type="text" name="eventBaseUrl" id="eventBaseUrl" class="form-control" value="{{url('')}}/eventos/{{$event->BASEURL}}/{{$event->URL}}" disabled>
                                	<!--<input id="eventUrl" name="eventUrl" type="text" class="form-control" placeholder="Subtítulo del Evento" autofocus value="{{$event->URL}}" style="width: 50%; float: left"	/> -->
                                </div>
                            </div>
                        </div>

                        <h3 class="page-header" style="margin-top:25px" name="event-multimedia"><i class="icon-picture font-red" ></i> Imágenes</h3>
                        <div class="row col-md-offset-2">
	                        <div class="form-group custom-form-group col-xl-4 col-md-6 col-sm-6 col-xs-12">
	                        	<label>Imagen Principal del Evento</label>
		                        <div class="col-sm-12 text-center">
				          			<label for="eventImage" class="custom-file-upload-event-image" style="background: url('{{url('')}}/{{$event->PICTURE}}') center center no-repeat;">
									    <i class="fa fa-cloud-upload"></i> Imagen Principal del Evento
									</label>
				                    <input id="eventImage" name="eventImage" type="file" onchange="loadPicture(event, 'bg')">
						        </div>
						    </div>

						    <div class="form-group custom-form-group col-xl-4 col-md-6 col-sm-6 col-xs-12">
						    	<label>Logotipo para el Evento</label>
		                        <div class="col-sm-12 text-center">
				          			<label for="eventLogo" class="custom-file-upload-event-logo" style="background: url('{{url('')}}/{{$event->logoUrl}}') center center no-repeat;">
									    <i class="fa fa-cloud-upload"></i> Logotipo del Evento
									</label>
				                    <input id="eventLogo" name="eventLogo" type="file" onchange="loadPicture(event, 'lg')">
						        </div>
						    </div>
						</div>

	                 @endforeach   
	                </div>
	                <div class="form-actions margin-top-10">
	                    <div class="row">
	                        <div class="col-md-offset-2 col-md-10">
	                            <!--<button type="button" class="btn default">Cancelar</button>-->
	                            
	                             <button id="update-data"  type="submit" class="btn blue ladda-button btn-orange" data-style="slide-up" style="margin-top: 10px;" data-spinner-color="#333">
                                    <span class="ladda-label">
                                        <i id="check-icon" class="fa fa-check"></i> Actualizar datos</span>
                                </button>
	                        </div>
	                    </div>
	                </div>
	            </form>
	        </div>
	


	    </div>


	</div>


</div>

<script>
function loadPicture(event, type){
	var selectedFile = event.target.files[0];
	var inputLength = $(this).size();


	if(type=='bg'){

		var imgContainer = $('.custom-file-upload-event-image');

	}else if(type=='lg'){

		var imgContainer = $('.custom-file-upload-event-logo');

	}


    if(inputLength > 0){
    	//$('#pictureChanged').val(1);
    	
    	imgContainer.css('background', 'url('+ window.URL.createObjectURL(selectedFile) +') center center no-repeat');
    	imgContainer.css('background-size', '100% auto');
    }
    else{
    	$('#pictureChanged').val(0);	
    	imgContainer.css('background', 'url(../../images/icons/productAvatar.png) center center no-repeat');
    	imgContainer.css('background-size', '100% auto');
    }

    if(!inputLength){
    	imgContainer.css('background', 'url(../../images/icons/productAvatar.png) center center no-repeat');
    	imgContainer.css('background-size', '100% auto');
    }
	
}
</script>

<!-- UPDATE DATA -->

<script>
	
	$( "#form-event-edit-data" ).submit(function( event ) {
		$('#content-overlay').fadeIn('slow');
		event.preventDefault();
		var btn = $('#update-data');

		var l = Ladda.create(document.querySelector( '#update-data' ));
		l.start();

		var data = new FormData($(this)[0]);
		var form = $(this);

		var url = form.attr( "action" );
		$.ajax({
			type: "POST",	
         	url : url,
         	data: data,
         	async: false,
          	cache: false,
          	contentType: false,
          	processData: false,
	     	  success: function(data){
	            	var uData = jQuery.parseJSON(data);
	            	
	            	if(uData.status == 'success'){
	            		console.log(uData);

	            	}
	           }
         }); //end ajax


			setTimeout(function(){
                        l.stop();
                        $('#content-overlay').fadeOut('slow');
                    }, 1000 );

	});



</script>

<!-- validate only decimal -->
<script type="text/javascript">
	$('.number').keypress(function(event) {
  		if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
    	event.preventDefault();
  	}
});

</script>
