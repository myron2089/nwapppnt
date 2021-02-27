@extends('layouts.expositor.app')

@section('css')
<link rel="stylesheet" href="{{ asset('metronic/css/tagsinput.css')}}" type="text/css" />
<link rel="stylesheet" href="{{ asset('metronic/css/select2/css/select2.min.css')}}" type="text/css" />
<link rel="stylesheet" href="{{ asset('metronic/css/select2/css/select2-bootstrap.min.css')}}" type="text/css" />
@endsection

@section('content')
<div class="page-title">
	<h3><!--<i class="fa fa-edit"></i>--> Crear Nuevo Evento </h3>
</div>

<div class="page-bar">
	<ul class="page-breadcrumb">
	    <li>
	        <a href="{{ route('home-expositor')}}">Inicio</a>
	        <i class="fa fa-angle-right"></i>
	    </li>
	    <li>
	        <a href="{{ route('home-expositor')}}">Eventos</a>
	        <i class="fa fa-angle-right"></i>
	    </li>
	    <li>
	        <span>Nuevo Evento</span>

	    </li>
	    
	</ul>
</div>

	<!-- BEGIN ROW PP -->
	<div class="row" style="margin-top: -5px;">

		<!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light bordered" id="form_wizard_1">
            <!--<div class="portlet-title">
                <div class="caption font-dark">
                    <i class="fa fa-list-alt font-dark"></i>
                    <span class="caption-subject bold uppercase">DATOS DEL EVENTO</span>
                </div>
            </div> -->
            <div class="portlet-body form">
            	 <form id="submit_form" method="POST" action="{{ route('event-store')}}" role="form" class="form-horizontal">
            	 	{{ csrf_field() }}
	                <div class="form-wizard form-wizard-orange">
						<div class="form-body">

							<ul class="nav nav-pills nav-justified steps">
                                <li>
                                    <a href="#tab1" data-toggle="tab" class="step">
                                        <span class="number"> 1 </span>
                                        <span class="desc">
                                            <i class="fa fa-check"></i> Datos Principales </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#tab2" data-toggle="tab" class="step">
                                        <span class="number"> 2 </span>
                                        <span class="desc">
                                            <i class="fa fa-check"></i> Ubicación y Horarios </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#tab3" data-toggle="tab" class="step active">
                                        <span class="number"> 3 </span>
                                        <span class="desc">
                                            <i class="fa fa-check"></i> Pago </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#tab4" data-toggle="tab" class="step">
                                        <span class="number"> 4 </span>
                                        <span class="desc">
                                            <i class="fa fa-check"></i> Confirmar </span>
                                    </a>
                                </li>
                            </ul>
							<div id="bar" class="progress progress-striped" role="progressbar">
                                <div class="progress-bar progress-bar-success"> </div>
                            </div>
                            <div class="tab-content">
                            	<div class="tab-pane active" id="tab1">
	                                <div class="alert alert-danger display-none">
	                                    <button class="close" data-dismiss="alert"></button> Se encontraron algunos errores, por favor revisa los campos.</div>
	                                <div class="alert alert-success display-none">
	                                    <button class="close" data-dismiss="alert"></button> Your form validation is successful! </div>
	                                <input type="hidden" id="uId" name="uId" value="{{$userId}}">
				                	<input type="hidden" id="action" name="action" value="1">

				                	 
				                	
									


				                     <div class="form-group custom-form-group">
			                            <label class="control-label col-md-2"> Nombre del Evento
			                                <span class="required"> * </span>
			                            </label>
			                            <div class="col-md-10">                          
			                                <input id="eventName" name="eventName" type="text" class="form-control"  placeholder="Título del Evento" data-toggle="tooltip" title="Campo Obligatorio" data-trigger="manual" autofocus  autocomplete="off"> 
			                             <span class="help-block"> El nombre del evento debe contener al menos 5 caracteres. </span>
                                             <span class="event-error-name">El nombre ingresado ya se encuentra registrado</span>                  
			                            </div>
			                        </div>

			                         <div class="form-group custom-form-group">
				                        <label class="col-md-2 control-label" for="form_control_1">Descripción <span class="required"> * </span></label>
				                        <div class="col-md-10">
				                            <textarea id="eventDescription" name="eventDescription" class="form-control" rows="4" placeholder="Escriba una breve descripción de la página" title="Campo Obligatorio"></textarea>
				                        </div>
				                    </div>
				                    <div class="form-group custom-form-group">
			                            <label for="eventType" class="control-label col-md-2">Tipo de Evento
			                                <span class="required" aria-required="true"> * </span>
			                            </label>
			                            <div class="col-md-10">
			                                <select id="eventType" name="eventType" class="bs-select form-control"  aria-required="true" aria-invalid="false" aria-describedby="select-error" title="Campo Obligatorio">
			                                    <option value="">Seleccionar tipo de evento</option>

			                                    @foreach($eventTypes as $eventType)
			                                    	<option value="{{ $eventType->id}} ">{{ $eventType->eventTypeName }}</option>
			                                    @endforeach
			                                </select><span id="select-error" class="help-block help-block-error"></span>
			                            </div>

			                           
				                       
			                        </div>

			                        <div class="form-group custom-form-group">
				                        <label class="col-md-2 control-label" for="eventCurrency">Moneda <span class="required" aria-required="true"> * </span></label>
				                        <div class="col-md-4">
				                        	<select id="eventCurrency" name="eventCurrency" class="form-control" required >
				                           		@foreach($currencies as $currency)
				                           			<option value="{{$currency->id}}">{{$currency->currencyName}} {{$currency->currencySymbol}}</option>
				                           		@endforeach
				                           	</select>
				                        </div>
				                    </div>

				                    <div class="form-group custom-form-group">
				                    	<label class="col-md-2 control-label" for="eventPrice">Precio <span class="required" aria-required="true"> * </span></label>
				                        <div class="col-md-4">
				                            <input id="eventPrice" name="eventPrice" type="text" class="form-control number" placeholder="Ingresa '0' si el evento es gratuito." title="Campo Obligatorio"  autocomplete="off"> 
				                        </div>
				                    </div>


			                         <div class="form-group custom-form-group">
				                        <label class="col-md-2 control-label" for="eventUrl">Url para acceder <span class="required" aria-required="true"> * </span></label>
				                        <div class="col-md-4">
				                        	 <input id="eventUrl" name="eventUrl" type="text" class="form-control" placeholder="{{url('')}}/eventos" disabled> 
				                        	 <input id="eventUrlStore" name="eventUrlStore" type="hidden" class="form-control" placeholder=""> 
				                        </div>
				                    </div>

			                        <!-- event tips -->
									<div class="row">
										<div class="col-xl-12 col-md-12 col-sm-12">
											<div class="event-tips-container">
												<h3><i class="fa fa-info-circle"></i> IMPORTANTE</h3>
												<ul>
													<li><i class="fa fa-circle"></i> Si el evento se realiza anualmente, puedes agregar el año al final del nombre e. (Ej. ‘Auto Ventas 2018’)</li>
													<li><i class="fa fa-circle"></i> Si el evento se realiza mensualmente, puedes agregar el mes y año al final del nombre (Ej. ‘Feria de La Comida Mayo 2018‘)</li>											
												</ul>
											</div>
										</div>	
									</div>
									<!--#end event tips -->
				                    
					            </div> <!-- end tab-pane 1 -->

					            <div class="tab-pane" id="tab2">
					            	<!--<h3 class="page-header"><i class="fa fa-map-o font-green"></i> Indique la ubicación y horarios del evento</h3>-->


					            	


				                    <div class="form-group custom-form-group">
			                            <label class="control-label col-md-2"> Ubicación  <span class="required"> * </span></label>
			                            <div class="col-md-10">
			                                <div class="input-icon right">
			                                	<i class="fa fa-exclamation tooltips" data-original-title="Ingrese el Departamento/Municipio"></i>
			                                	<input id="eventPlace" name="eventPlace" type="text" class="form-control" placeholder="Ubicación donde se llevará a cabo el evento"  placeholder="Título del Evento" data-toggle="tooltip" title="Campo Obligatorio" data-trigger="manual" autofocus /> 
			                                </div>
			                                <span class="help-block"> Ingrese la Ubicación </span>
			                            </div>
			                        </div>

			                        <div class="form-group custom-form-group">
			                            <label class="control-label col-md-2"> Dirección  <span class="required"> * </span></label>
			                            <div class="col-md-10">
			                                <div class="input-icon right">
			                                	<i class="fa fa-exclamation tooltips" data-original-title="Ingrese la dirección del evento"></i>
			                                	<input id="eventAddress" name="eventAddress" type="text" class="form-control" placeholder="Ubicación donde se llevará a cabo el evento" title="Campo Obligatorio" /> 
			                                </div>
			                                <span class="help-block"> La dirección debe contener al menos 5 caracteres. </span>
			                            </div>
			                        </div>
				                	
			                       
				                    <!-- Fecha / Hora Inicio-->
				                     <div class="form-group custom-form-group">

			                            <label class="col-md-2 control-label" for="eventDateStart">Fecha de Inicio <span class="required"> * </span></label>
			                            <div class="col-md-6">
			                            	<div class="input-group">
				                            		<!-- <span class="input-group-addon"><i class="fa fa-clock-o"></i></span> -->
				                            		<input id="eventDateStart" name="eventDateStart" type="date" class="form-control form-control-inline input-large" placeholder="dd/mm/AA">
			                            		
			                            	</div>
				                               
			                            </div>
			                        </div>

			                        <div class="form-group custom-form-group">
			                            <label class="col-md-2 control-label" for="eventTimeStart">Hora de Inicio<span class="required"> * </span></label>
				                        <div class="col-md-6">
				                            <!--<div class="input-icon">-->
				                            	<div class="input-group">
				                            		<!-- <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>-->
				                                	
				                                	<input id="eventTimeStart" name="eventTimeStart" type="time" class="form-control form-control-inline input-large" > 
				                                </div>
				                            <!--</div>-->
				                        </div>
			                        </div>       

			                         <!-- Fecha / Hora Finalizacion-->
				                     <div class="form-group custom-form-group">
			                            <label class="col-md-2 control-label" for="eventDateEnd">Fecha de Finalización <span class="required"> * </span></label>
			                            <div class="col-md-6">
			                            	<div class="input-group">
				                            	<!--<span class="input-group-addon"><i class="fa fa-calendar"></i></span>-->
			                            		
			                            		<input id="eventDateEnd" name="eventDateEnd" type="date" class="form-control form-control-inline input-large" placeholder="dd/mm/AA">
			                            	</div>
				                               
			                            </div>
			                        </div>

			                        <div class="form-group custom-form-group">
			                            <label class="col-md-2 control-label" for="eventTimeEnd">Hora de Finalización <span class="required"> * </span></label>
				                        <div class="col-md-6">
				                            <div class="input-group">
				                            	<!--<span class="input-group-addon"><i class="fa fa-clock-o"></i></span>-->
				                                <input id="eventTimeEnd" name="eventTimeEnd" type="time" class="form-control form-control-inline input-large">    
				                                                          
				                            </div>
				                        </div>
				                    </div>
					            </div> <!-- end tab-pane 2 -->

					            <div class="tab-pane" id="tab3">
					            	<!--<h3 class="page-header"><i class="fa fa-credit-card font-green"></i> Información de Pago</h3>-->

					            	



					            	<!-- payment-->
				                	<div class="row">
					                	<div class="col-xl-6 col-md-6 col-sm-12">
						                	<div class="payment-type">
											  <input class="payment-select" type="radio" id="control_01" name="select" value="1" checked>
											  <label for="control_01" class="payment-description">
											    <h2>Tengo un código</h2>
											    <p>Utilice esta opción si ha obtenido un código promocional para crear un evento.</p>
											    <input type="text" class="form-control" name="eventCode" id="eventCode" placeholder="Ingrese el código recibido." required title="Por favor ingresa un código">
											   	
											    <button id="check-code"  type="button" class="btn btn-orange  ladda-button" data-style="slide-up" style="margin-top: 10px;" data-spinner-color="#333">
                                                        <span class="ladda-label">
                                                            <i id="check-icon" class="fa fa-chevron-circle-right "></i> Validar Código</span>
                                                    </button>
											  </label>
											</div>

											<a href="javascript:codeGenerate();"  class="btn green center text-center"><i class="fa fa-plus"></i> Generar Código</a>
										</div>
									

										<div class="col-xl-6 col-md-6 col-sm-12">
											<div class="payment-type">
											  <input class="payment-select" class="payment-type" type="radio" id="control_02" name="select" value="2" disabled>
											  <label for="control_02" class="payment-description payment-description-disabled">
											    <h2>Pago con tarjeta de Débito o Crédito</h2>
											    <span class=""><i class="fa fa-info-circle"></i> No disponible actualmente.</span>
											    <!--<p>You're not a gaming God by any stretch of the imagination.</p>-->
											    <div class="clear" style="height: 19px"></div>
											   	<div class="payment-container">
											    	<label for="cardNumber" class="label-form-control">Número de Tarjeta</label>
											    	<input type="text" class="form-control" name="cardNumber" id="cardNumber" placeholder="xxxx-xxxx-xxxx-xxxx" style="border: 0;">
											    	<br>
											    	<select type="text"  name="cardMonth" id="cardMonth" style="margin-top: 5px; " class="bs-select form-control"  aria-required="true" aria-invalid="false" aria-describedby="select-error" title="Campo Obligatorio">
											    		<option value>- Mes -</option>
											    		<option value="1">01</option>
											    		<option value="2">02</option>
											    		<option value="3">03</option>
											    		<option value="4">04</option>
											    		<option value="5">05</option>
											    		<option value="6">06</option>
											    		<option value="7">07</option>
											    		<option value="8">08</option>
											    		<option value="9">09</option>
											    		<option value="10">10</option>
											    		<option value="11">11</option>
											    		<option value="12">12</option>
											    	</select>
											    	<span id="select-error" class="help-block help-block-error"></span>
											    	<select type="text" class="form-control" name="cardYear" id="cardYear" style="margin-top: 5px; border: 0;">
											    		<option value="">- Año -</option>
											    		<option value="2018">2018</option>
											    	</select><br>
											    	<label for="cardNumber" class="label-form-control">CVV</label>
											    	<input type="text" class="form-control" name="cardCvv" id="cardCvv" style="margin-top: -4px;border: 0;">
												</div>
											  </label>
											</div>
										</div>
									</div>

									<!-- payment -->



					            </div> <!-- end tab-pane 3 -->

					            <div class="tab-pane" id="tab4">
					            	<h3 class="page-header"><i class="fa fa-map-o font-green"></i> Resumen</h3>
					            	 <div class="form-group">
                                        <label class="control-label col-md-3">Nombre del Evento:</label>
                                        <div class="col-md-4">
                                            <p class="form-control-static" data-display="eventName"> </p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Descripción del Evento:</label>
                                        <div class="col-md-4">
                                            <p class="form-control-static" data-display="eventDescription"> </p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Tipo de Evento:</label>
                                        <div class="col-md-4">
                                            <p class="form-control-static" data-display="eventType"> </p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Precio:</label>
                                        <div class="col-md-4">
                                            <p class="form-control-static" data-display="eventPrice"> </p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Ubicación:</label>
                                        <div class="col-md-4">
                                            <p class="form-control-static" data-display="eventPlace"> </p>
                                        </div>
                                    </div>
					            </div> <!-- end tab-pane 4 -->
				            </div> <!--End tab-content -->
	                    </div> <!-- END form-body -->
	                    <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-1 col-md-10">
                                    <a href="javascript:;" class="btn default button-previous">
                                        <i class="fa fa-angle-left"></i> Regresar </a>
                                    <a id="continue-button" href="javascript:;" class="btn btn-outline green button-next"> Continuar
                                        <i class="fa fa-angle-right"></i>
                                    </a>
                                    <button type="submit"  class="btn green button-submit"> Guardar
                                        <i class="fa fa-check"></i>
                                    </button>
                                </div>
                            </div>
                        </div> <!-- end form-actions -->
                	</div><!-- end form-wizard -->
                </form> <!-- end form -->    
            </div> <!-- end portlet-body -->
        </div> <!-- end portlet -->
	</div> <!-- end row -->




	<div class="modal fade bs-modal-md in" id="large" tabindex="1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md" style="overflow-y: initial !important">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 id="user-modal-title" class="modal-title">Crear Código Promocional</h4>
                    <p id="user-modal-tip">Ingrese el correo electrónico para recibir el código</p>
                </div>
                <div class="modal-body" style="overflow-y: auto;     height: 700px;"> 

                	<form id="form-code-create" class="form-horizontal" method="POST" role="form" action="{{url('admin/codes/store')}}" enctype="multipart/form-data">
                    	<!-- BEGIN FORM BODY -->
                    	<div class="form-body">
                    		 {{ csrf_field() }}

                    		<div class="form-group custom-form-group">
                        		<div class="col-md-12 text-center">
			                    	<label for="emails">Escriba el correo electrónico del receptor del código</label>
			    					<!--<input id='emails' type='text' class='tags' placeholder="Escriba un correo electrónico..." max-tags="3" enforce-max-tags></p>-->
			    					<select class="form-control emails-container" multiple="multiple" id="emails" style="width: 100%">
			    					  
			    					</select>
			    				</div>
			    			</div>

			    			<div class="clear" style="height: 100px; width: 100%"></div>

			    			<button type="submit" id="btn-code-create" class="btn green pull-right" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Creando Código...">Generar Código</button>

			    			<button type="button" class="btn dark btn-outline btn-default pull-right" style="margin-right: 10px" data-dismiss="modal">Cerrar</button>


                        </div> <!-- end:: form-body -->
                    </form> <!-- end form form-code-create -->
                </div> <!-- end:: modal-body -->
            </div> <!-- end:: modal-content -->
        </div> <!-- end:: modal-dialog -->
    </div> <!-- end moodal modal fade -->
@endsection


@section('scripts')

<script type="text/javascript" src="{{ URL::asset('metronic/scripts/tagsinput.js')}}"></script>

<script>

	$( "#submit_form" ).submit(function( event ) {
		var data = new FormData($(this)[0]);
		$('#overlay-msg').text('Creando Evento...');
		$('#page-overlay').fadeIn('slow');
		

		event.preventDefault();
		$.ajax({
          type: "POST",
          url: "{{route('event-store')}}",
          data: data,
          async: false,
          cache: false,
          contentType: false,
          processData: false,
          success: function (data) {
          	
          	
            var uData = jQuery.parseJSON(data);
            console.log(uData);
            if(uData.status=='success'){
           
		 	setTimeout(function(){
		 		$('#overlay-msg').text('Evento creado con éxito.');
		  		swal({
					  title: "Evento creado con éxito",
					  text: "Qué desea realizar?",
					  type: "success",
					  showCancelButton: true,
					  confirmButtonClass: "btn green-sharp",
					  confirmButtonText: "Administrar este evento.",
					  cancelButtonText: "Ver mis eventos.",
					  closeOnConfirm: false,
					  closeOnCancel: false
					},
					function(isConfirm) {
					  if (isConfirm) {
					     window.location.replace("{{url('administracion/eventos')}}/"+uData.evId);
					  } else {
					    window.location.replace("{{url('admin/home')}}");
					  }
					});

			}, 1000);    


		 	}

		 	if(uData.status == 'error'){
		 		
		 		swal("Error", "Ha ocurrido un problema. Por favor contacte con el administrador.", "warning");
		 	}

			setTimeout(function(){
		 		$('#page-overlay').fadeOut('slow');
			}, 2000); 

			
          }
        });
	 return false;
	});



</script>

<script>
	
	$('#control_01').click(function(e){
		$('#eventCode').focus();
	});

</script>

<!-- CHECK EVENT NAME AND ANOTHER DATA -->
<script>
	/*Event Name*/
	$('#eventName').keyup(function(event){
		event.preventDefault();
		var evName = $('#eventName').val();
		var type = $('#eventType option:selected').text();
		
		eventUrlLink(evName,type);

		var url = "{{url('/admin/events/checkeventname')}}";
		$.ajax({
		  type: 'post',
		  url: url,
		  data: {
		   evName:evName,
		  },
		  success: function (response) {
		   var data = jQuery.parseJSON(response);
		   //console.log(data);
		   if(data.found > 0){
		    	console.log('Este nombre ya se encuentra registrado');
		    	$('#continue-button').addClass('disabled');
                $('#continue-button').attr("disabled", true);
		    	$('.event-error-name').show();	
		   }
		   else{
		   		//console.log('Nombre de evento disponible');
		   		$('.event-error-name').hide();	
		   		$('#continue-button').removeClass('disabled');
                $('#continue-button').attr("disabled", false);
		   }
		  }
		  });


	}); /*End change function*/


	$('#eventType').change(function(){

		var evName = $('#eventName').val();
		var type = $('#eventType option:selected').text();
		
		eventUrlLink(evName,type);

	});

	function eventUrlLink(eventName, eventType){
		var urlLink = "{{url('')}}/" + 'eventos/'+eventType.replace(/\s/g,"-").toLowerCase()+'/'+ eventName.replace(/\s/g,"-").toLowerCase();
		$('#eventUrl').val(urlLink);
		$('#eventUrlStore').val(eventName.replace(/\s/g,"-").toLowerCase());

	}
</script>

<!-- Check code event -->
<script>
	
	$('#check-code').click(function(event){

		var l = Ladda.create(this);
		l.start();
		
		
        var url = "{{route('check-event-codes')}}";
        var code = $('#eventCode').val();
         $.ajax({
         	url : url,
         	data: { 'code': code },
                
                success: function(data){
                	var uData = jQuery.parseJSON(data);
                	if(uData.status == 'free'){
                		
                		$('#check-code > .ladda-label').html('<i id="check-icon" class="fa fa-check-circle"></i> Código Valido!');
                		$('#check-code').removeClass('chevron-circle-left');


                		
                		
                		

                		setTimeout(function(){
                        	l.stop();
                        	$('#check-code').addClass('disabled');
                			$('#check-code').attr("disabled", true);
                        }, 500);
                        $('#check-code').bind('click', false);
                        $('#continue-button').removeClass('disabled');
                        	$('#continue-button').attr("disabled", false);
                	}//end if
                	else if(uData.status == 'used'){
                		$('#check-icon').removeClass('chevron-circle-left');
                		$('#check-icon').addClass('fa fa-times-circle');

                		Command: toastr["warning"]("El código ingresado ya se encuentra en uso, intenta con un código diferente o ponte en contacto con el Administrador.", "Mensaje");

                        toastr.options = {
                          "closeButton": false,
                          "debug": false,
                          "newestOnTop": false,
                          "progressBar": false,
                          "positionClass":  "toast-bottom-right",
                          "preventDuplicates": false,
                          "onclick": null,
                          "showDuration": "300",
                          "hideDuration": "1000",
                          "timeOut": "8000",
                          "extendedTimeOut": "1000",
                          "showEasing": "swing",
                          "hideEasing": "linear",
                          "showMethod": "fadeIn",
                          "hideMethod": "fadeOut"
                        };

                        setTimeout(function(){
                        	l.stop();
                        	$('#check-code > .ladda-label').html('<i id="check-icon" class="fa fa-chevron-circle-right"></i> Intentar nuevamente');
                        	$('#continue-button').attr("disabled", true);
                        }, 500);

                	}
                	else if(uData.status == 'notfound'){


                		Command: toastr["warning"]("El código ingresado no se encuentra, por favor verifica y vuelve a intentarlo.", "Mensaje");

                        toastr.options = {
                          "closeButton": false,
                          "debug": false,
                          "newestOnTop": false,
                          "progressBar": false,
                          "positionClass":  "toast-bottom-right",
                          "preventDuplicates": false,
                          "onclick": null,
                          "showDuration": "300",
                          "hideDuration": "1000",
                          "timeOut": "8000",
                          "extendedTimeOut": "1000",
                          "showEasing": "swing",
                          "hideEasing": "linear",
                          "showMethod": "fadeIn",
                          "hideMethod": "fadeOut"
                        };

                        setTimeout(function(){
                        	l.stop();
                        	
                        	$('#check-code > .ladda-label').html('<i id="check-icon" class="fa fa-chevron-circle-right"></i> Intentar nuevamente');
                        	$('#continue-button').addClass('disabled');
                        	$('#continue-button').attr("disabled", true);
                        }, 500);

                	}
                	else if(uData.status == 'error'){

                	}

                },//end success  
                
                error: function(XMLHttpRequest, textStatus, errorThrown) { 

                }, // end error
                statusCode: {
                        401: function() { 
                            window.location.href = 'login'; //or what ever is your login URI 
                        },
                    },

         }); //end ajax

        console.log('checking...');
       

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

<script>

	function codeGenerate(){

		$('#large').modal('show');
		$('.modal-backdrop').appendTo('body');  
		$('.modal').appendTo('body'); 


	}


    $("#form-code-create").submit(function( event ) {
        event.preventDefault();



        var emails = $('#emails').val();

        if(emails == null){

           Command: toastr["error"]('Por favor ingrese correos electrónicos válidos' , "Error");

            toastr.options = {
              "closeButton": false,
              "debug": false,
              "newestOnTop": false,
              "progressBar": false,
              "positionClass":  "toast-bottom-right",
              "preventDuplicates": false,
              "onclick": null,
              "showDuration": "300",
              "hideDuration": "1000",
              "timeOut": "8000",
              "extendedTimeOut": "1000",
              "showEasing": "swing",
              "hideEasing": "linear",
              "showMethod": "fadeIn",
              "hideMethod": "fadeOut"
            }

            return;

        }
        
        //var evId = $('#eventId').val();
       

        var $btnc = $('#btn-code-create');
        
        
        var data = new FormData($(this)[0]);
       
        var form = $(this);
        $.ajax({
          type: "POST",
          url: form.attr( "action" ),
          data: {'emails':emails},
          beforesend: function(b){

          	$btnc.button('loading');
          	$('#overlay-msg').text('Creando y enviando código, por favor espere...');
        	$('#page-overlay').fadeIn('slow');

          },
          
          success: function (data) {
            
          },
          error: function(XMLHttpRequest, textStatus, errorThrown) { 
          /*alert("Status: " + textStatus); alert("Error: " + errorThrown);*/ 

          setTimeout(function(){
            $('#page-overlay').fadeOut('slow');
            
            $btnc.button('reset');
            Command: toastr["error"](textStatus + ' ' + errorThrown + 'Ha ocurrido un error inténtelo de nuevo!' , "Error");

            toastr.options = {
              "closeButton": false,
              "debug": false,
              "newestOnTop": false,
              "progressBar": false,
              "positionClass":  "toast-bottom-right",
              "preventDuplicates": false,
              "onclick": null,
              "showDuration": "300",
              "hideDuration": "1000",
              "timeOut": "8000",
              "extendedTimeOut": "1000",
              "showEasing": "swing",
              "hideEasing": "linear",
              "showMethod": "fadeIn",
              "hideMethod": "fadeOut"
            }
          }, 2000);

      
        }
        }).done(function(data){

        	var uData = jQuery.parseJSON(data);
            console.log(data);
          

            $('#emails').empty().trigger("change");
            
             setTimeout(function(){
                        
                        
                        $btnc.button('reset');
                        Command: toastr["success"]("Se ha generado y enviado correctamente el código.", "Mensaje");

                        toastr.options = {
                          "closeButton": false,
                          "debug": false,
                          "newestOnTop": false,
                          "progressBar": false,
                          "positionClass":  "toast-bottom-right",
                          "preventDuplicates": false,
                          "onclick": null,
                          "showDuration": "300",
                          "hideDuration": "1000",
                          "timeOut": "8000",
                          "extendedTimeOut": "1000",
                          "showEasing": "swing",
                          "hideEasing": "linear",
                          "showMethod": "fadeIn",
                          "hideMethod": "fadeOut"
                        };
                        $('#page-overlay').fadeOut('slow');
                    }, 2000);

        });
        

    });
</script>

<!-- setup select2 -->
<script>
jQuery(document).ready( function($) {	
	$('#emails').select2({
	tags: true,
    tokenSeparators: [';', ' '],
    maximumSelectionLength: 1,
    width: 'resolve',
    language: 'es-ES',
    language: {
  		// You can find all of the options in the language files provided in the
  		// build. They all must be functions that return the string that should be
  		// displayed.
	  inputTooShort: function () {
	    return "You must enter more characters...";
	  },
	  noResults: function(){
        return ""
    },
    maximumSelected: function( e ){
        var t = "Sólo puedes enviar " + e.maximum + " código a la vez!";

        return e.maximum == 1 ? t += "m" : t += "", t
    },
	},
    createTag: function(term, data) {
		    var value = term.term;
		    if(validateEmail(value)) {
		        return {
		          id: value,
		          text: value
		        };
		    }
		     if(!validateEmail(value)){
                            return {
                                text: "Escribe un correo electrónico válido...",
                            };
                        }

		    return null;            
		}
	});
});

function validateEmail(email) {
    var re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

</script>

@endsection