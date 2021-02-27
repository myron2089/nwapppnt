<div class="row">
	<div class="col-md-12">
		
		<div class="portlet light bordered">
	        <div class="portlet-title">
	            <div class="caption font-black">
	                <i class="fa fa-clock-o font-black"></i>
	                <span class="caption-subject bold font-black"> Actividades</span>
	            </div>
	            <div class="actions">
	            	<a href="javascript:sessionEdit(1,1);"  class="btn green pull-right"><i class="fa fa-plus"></i> Crear actividad</a>
	                <!--<a class="btn btn-circle btn-icon-only blue" href="javascript:;">
	                    <i class="icon-cloud-upload"></i>
	                </a>
	                <a class="btn btn-circle btn-icon-only green" href="javascript:;">
	                    <i class="icon-wrench"></i>
	                </a>
	                <a class="btn btn-circle btn-icon-only red" href="javascript:;">
	                    <i class="icon-trash"></i>
	                </a> 
	                <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a> -->
	            </div>
	        </div>
	        <div class="portlet-body form">
	        	<div class="row">
			        <div class="col-md-12 col-sm-12" style="margin-top: 15px">
			        	<div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Actividades Creadas</h3>
                            </div>
                            <div class="panel-body"> 

                            	<!-- BEGIN SAMPLE TABLE PORTLET-->
                                
                                <div class="table-scrollable">
                                    <table id="event-sessions" class="table table-hover">
                                        <thead>
                                            <tr>
                                            	<th style="display: none"> ID</th>
                                            	<th> Actividad  </th>
                                                <th> Tipo de Actividad </th>
                                                <th> Localidad </th>
                                                <th> Fecha / Hora de inicio</th>
                                                <th> Acciones </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	@foreach($sessions as $session)
	                                            <tr>
	                                            	<td class="id" style="display: none">{{$session->ID}}</td>
	                                                <td> {{$session->TITLE}}</td>
	                                                <td> {{$session->TYPE}} </td>
	                                                <td> {{$session->LOCATION}}</td>
	                                                <td> {{$session->STARTS}}</td>
	                                                <td class="{{$session->ID}}"> 
	                                                	<a href="javascript:sessionEdit(2,{{$session->ID}});" id="edit-btn" class="btn btn-xs btn-default"><i class="fa fa-edit"></i> Editar</a> 
	                                                	<button id="sweet-8" class="btn btn-xs btn-default sweet-8" onclick="_gaq.push(['_trackEvent', 'exit', 'footer', 'Lipis']);"><i class="fa fa-trash"></i> Eliminar</button>
	                                                	
	                                                </td>
	                                            </tr>
                                            @endforeach
                                         </tbody>
                                    </table>
                                </div>
                                  


                            </div>
                        </div>
			        </div>
			    </div>
	        </div>
	    </div>

	    <div class="modal fade bs-modal-lg" id="large" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 id="user-modal-title" class="modal-title">Nueva actividad</h4>
                        <p id="user-modal-tip">Ingresa los datos para la actividad.</p>
                    </div>
                    <div class="modal-body"> 

                    	<form id="form-schedule-create" class="form-horizontal" method="POST" role="form" action="{{ route('store-schedule') }}">
			                                	<!-- BEGIN FORM BODY -->
			                                	<div class="form-body">
			                                		 {{ csrf_field() }}
			                                		<input id="action" name="action" type="hidden" class="form-control">
			                                		<input id="userId" name="sessionId" type="hidden" class="form-control"> 
			                                		<input id="evId" name="evId" type="hidden" class="form-control" value="{{$eventId}}"> 
			                                		<input id="tableRow" name="tableRow" type="hidden" class="form-control"> 
			                                		<div class="form-group custom-form-group">
								                        <label class="col-md-4 control-label" for="sessionName">Nombre <span class="required" aria-required="true"> * </span></label>
								                        <div class="col-md-8">
								                           <input id="sessionName" name="sessionName" type="text"  class="form-control" placeholder="Nombre de la actividad" required maxlength="50" />
								                        </div>
								                    </div>


								                    <div class="form-group custom-form-group">
								                        <label class="col-md-4 control-label" for="sessionDescription">Descripción <span class="required" aria-required="true"> * </span></label>
								                        <div class="col-md-8">
								                           <textarea id="sessionDescription" name="sessionDescription" class="form-control form-control-inline input-medium" size="16" type="text" value="" style="width: 100% !important" required maxlength="255"></textarea>
								                        </div>
								                    </div>

								                    <div class="form-group custom-form-group">
									                        <label class="col-md-4 control-label" for="eventFacebookLink">Tipo de Actividad<span class="required" aria-required="true"> * </span></label>
								                        <div class="col-md-8">
								                           <select id="sessionType" name="sessionType" class="form-control" required>
								                           		<option value="">Seleccionar</option>
								                           	@foreach($sessionTypes as $sType)
								                           		<option value="{{ $sType->id}}">{{ $sType->eventSessionTypeName }}</option>
								                           	@endforeach
								                           </select> 
								                        </div>
								                    </div>

								                    <div class="form-group custom-form-group">
									                        <label class="col-md-4 control-label" for="sessionSpeaker">Conferencista <span class="required" aria-required="true">  </span></label>
								                        <div class="col-md-8">
								                        	<select id="sessionSpeaker" name="sessionSpeaker"  class="form-control" >
								                        		<option value="0">Sin Especificar</option>
								                           	@foreach($speakers as $speaker)
								                           		<option value="{{ $speaker->USERID}}">{{ $speaker->USERFNAME }} {{ $speaker->USERLNAME }}</option>
								                           	@endforeach
								                           	</select> 
								                        </div>
								                    </div>


								                    <div class="form-group custom-form-group">
								                        <label class="col-md-4 control-label" for="sessionDateStart">Fecha Inicio<span class="required" aria-required="true"> * </span></label>
								                        <div class="col-md-8">
								                           <!--<div class="input-group date session-date">-->
								                           	<input id="sessionDateStart" name="sessionDateStart" type="date" class="form-control" value="{{$eventDateStart}}" required ><!--<span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>-->
								                            	
							                            	<!--</div>-->
								                        </div>
								                    </div>

													
								                    
								                    <div class="form-group custom-form-group">
								                        <label class="col-md-4 control-label" for="sessionTime">Hora Inicio<span class="required" aria-required="true"> * </span></label>
								                        <div class="col-md-8">
								                        	<div class="input-group date-time time-start">
							                            		<span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
							                                	<input id="sessionTimeStart" name="sessionTimeStart" type="time" class="form-control" placeholder="Hora de la actividad" value="{{$eventHourStart}}" required> 
							                                </div>
							                            </div>
								                        </div>
								                    </div>

								                    <div class="form-group custom-form-group">
								                        <label class="col-md-4 control-label" for="sessionDateStart">Fecha Finalización<span class="required" aria-required="true"> </span></label>
								                        <div class="col-md-8">
								                           <!--<div class="input-group date session-date">-->
								                           	<input id="sessionDateFinish" name="sessionDateFinish" type="date" class="form-control"><!--<span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>-->
								                            	
							                            	<!--</div>-->
								                        </div>
								                    </div>

								                    
								                    <div class="form-group custom-form-group">
								                        <label class="col-md-4 control-label" for="sessionTime">Hora de finalización<span class="required" aria-required="true"> </span></label>
								                        <div class="col-md-8">
								                        	<div class="input-group date-time time-end">
							                            		<span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
							                                	<input id="sessionTimeFinish" name="sessionTimeFinish" type="time" class="form-control timepicker timepicker-default" placeholder="Hora de la actividad" > 
							                                </div>
							                            </div>
								                        </div>
								                    
								                    
								                   <div class="form-group custom-form-group">
								                        <label class="col-md-3 control-label" for="sessionLocation">Localidad<span class="required" aria-required="true"> * </span></label>
								                        <div class="col-md-9">
								                           <input id="sessionLocation" name="sessionLocation" type="text"  class="form-control" placeholder="Lugar de la actividad" required maxlength="150"/>
								                        </div>
								                    </div>


								                    <button type="submit" class="btn green pull-right" id="btn-create-session" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Registrando Actividad...">Guardar Actividad</button>                            	
			                                		<button type="button" class="btn dark btn-outline btn-default pull-right" style="margin-right: 10px" data-dismiss="modal">Cerrar</button>
			                                	</div> 
			                                	<!-- END FORM BODY -->  
			                                	<br><br>
                        						
			                                </form>

                    </div>
                    <div class="modal-footer">
                                                        
					</div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>  
        <!-- /.modal-fade end --> 
	</div>
</div>

<script type="text/javascript">
		$.ajaxSetup({
		   headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
		});

		$('#large').on('shown.bs.modal', function() {
		  $('#sessionName').focus();
		});
		</script>


<!-- datepicker -->
<script>
jQuery(document).ready( function($) {
	/*$('.input-group.date.session-date').datepicker({
    	language: "es"
	});
	 $('.input-group.date-time.time-start').datetimepicker({
                    format: 'LT',
                });

	  $('.input-group.date-time.time-end').datetimepicker({
                    format: 'LT',
                });
	*/
});
</script>		
<!-- SET THE SELECTED USER IN ASIGNED TABLE -->
<script>

	$('#itemName').on("change", function(e) {
		var safunction = "'_gaq.push(['_trackEvent', 'exit', 'footer', 'Lipis']);'";
		var tablebody = $("#asigned-users tbody");
		var tableemptyrow = $("#asigned-users tbody tr.table-empty");
		if (tablebody.children().length > 0) {
			tableemptyrow.remove();
		}

		
	    var btn='<button class="btn btn-xs btn-default sweet-8" onclick='+safunction+' ><i class="fa fa-trash"></i> Eliminar</button>'; 
		$('#page-overlay').fadeIn('slow');
		$('#asigned-users tbody').append("<tr><td class='id'>2</td><td> lbtx@gmail.com </td><td> Roberto Hernández </td><td> Vendedor </td><td> <a href='javascript:sessionEdit(2,1);' id='edit-btn' class='btn btn-xs btn-default'><i class='fa fa-edit'></i>Editar</a> "+ btn +"</td></tr>");
		$('#itemName').empty();
		$('#overlay-msg').text('Asignando Usuario');
		 	setTimeout(function(){
		  		$('#page-overlay').fadeOut('slow');
			}, 1000);
	});
</script>



<!-- BEGIN CREATE NEW USER (FORM) -->
<script>
	$( "#form-schedule-create" ).submit(function( event ) {
		event.preventDefault();
		var $btnc = $('#btn-create-session');
		
		var action = $('#action').val();
		var tablebody = $("#event-sessions tbody");
		var row;
		
		var data = new FormData($(this)[0]);

		
		
		

		var form = $(this);
		$.ajax({
          	type: "POST",
          	url: form.attr( "action" ),
         	data: data,
      		cache: false,
      		contentType: false,
      		processData: false,
	        beforeSend: function(){
	        	$btnc.button('loading');
	        	if(action == 1)
				{
					$('#overlay-msg').text('Creando Actividad');
				}
				else{
					$('#overlay-msg').text('Editando Actividad');
					row = $('#tableRow').val();
					var newRow = + row + 1;
					$('#event-sessions tr:eq('+newRow+')').addClass('table-row-editing');
				}
				$('#page-overlay').fadeIn('slow');

	        },
          	success: function (data) {
                
          	},
          	statusCode: {
                401: function() { 
                    window.location.href = 'login'; //or what ever is your login URI 
                },
	      	},
          	error: function(){
          		setTimeout(function(){
				$('#page-overlay').fadeOut('slow');
				/*$('#large').modal('hide');*/

				$btnc.button('reset');
				Command: toastr["warning"]("Ha ocurrido un error!", "Alerta");

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
            console.log(uData);

            var safunction = "'_gaq.push(['_trackEvent', 'exit', 'footer', 'Lipis']);'";
            var btn='<button class="btn btn-xs btn-default sweet-8" onclick='+safunction+' ><i class="fa fa-trash"></i> Eliminar</button>';
            
            
            if(action == 1)
			{
				

				if(uData.status=='success')
				{
				
				setTimeout(function(){
		  			$('#overlay-msg').text(uData.msg);
				}, 2000);
				$('#event-sessions tbody').append("<tr><td class='id' style='display:none'>" + uData.sId + "</td><td> "+ uData.sName +" </td><td>"+ uData.sType + "</td><td>"+ uData.sLocation +"</td><td>"+ uData.sDateStart +"</td><td class="+ uData.sId +"> <a href='javascript:sessionEdit(2,"+ uData.sId +");' id='edit-btn' class='btn btn-xs btn-default'><i class='fa fa-edit'></i>Editar</a> "+ btn +"</td></tr>");

				setTimeout(function(){
						$('#page-overlay').fadeOut('slow');
						$('#large').modal('hide');
						 $btnc.button('reset');
						swal({
							type: "success",
							title: "Mensaje",
							text: "Se ha registrado la actividad con éxito!",
							timer: 3000,
							 showCancelButton: false,
						});
					}, 1000);


				}
				if(uData.status=='exists')
				setTimeout(function(){
		  			$('#overlay-msg').text(uData.msg);
				}, 2000);
				
			}
			else{
				$('#overlay-msg').text('Usuario editado con éxito');
				
				var newRow = + row + 1;
				$('#event-sessions tr:eq('+newRow+') td').eq(0).text(uData.sId);
				$('#event-sessions tr:eq('+newRow+') td').eq(1).text(uData.sName);
				$('#event-sessions tr:eq('+newRow+') td').eq(2).text(uData.sType);
				$('#event-sessions tr:eq('+newRow+') td').eq(3).text(uData.sLocation);
				$('#event-sessions tr:eq('+newRow+') td').eq(4).text(uData.sDateStart);
				setTimeout(function(){
		  		$('#overlay-msg').text('Actividad actualizada con éxito');
			}, 2000);

				setTimeout(function(){
						$('#page-overlay').fadeOut('slow');
						$('#large').modal('hide');
						 $btnc.button('reset');
						swal({
							type: "success",
							title: "Mensaje",
							text: "Se ha actualizado la actividad con éxito!",
							timer: 3000,
							 showCancelButton: false,
						});
					}, 1000);

			}

		 	setTimeout(function(){
		  		$('#page-overlay').fadeOut('slow');
			}, 1000);




        }); /*end done*/
	});	


</script>
<!-- END CREATE NEW USER (FORM) -->

<!-- BEGIN EDIT USER (FORM) -->
<script>
function sessionEdit(act, sId){

	
	/*$('#page-overlay').fadeIn('slow');*/
	
	var row = $('.'+sId).closest('tr').index();	
    
    $('#action').val(act);
    $('#sessionId').val(sId);
    $('#tableRow').val(row);

    if(act == 1)
    {
    	$('#form-schedule-create').trigger("reset");
    	$('#user-modal-title').text('Crear Nueva actividad');
    	$('#user-modal-tip').text('	Ingresa los datos para la nueva actividad.');

    	
    }
    if(act == 2)
    {
    	
    	url= "{{ url('admin/event/session/geteditdata')}}"+"/"+sId;
	    $.get(url, function(data){
	    	var uData = jQuery.parseJSON(data);
	    	
	    	$('#user-modal-title').text('Editar actividad');
	    	$('#user-modal-tip').text('Modifica los datos de la actividad.');
	    	$('#userId').val(sId);
	    	$('#sessionName').val(uData.sName);
	    	$('#sessionDescription').val(uData.sDesc);
	    	$('#sessionDateStart').val(uData.sDateStart);
	    	$('#sessionTimeStart').val(uData.sTimeStart);
	    	$('#sessionDateFinish').val(uData.sDateFinish);
	    	$('#sessionTimeFinish').val(uData.sTimeFinish);
	    	$('#sessionLocation').val(uData.sLocation);
    	
    	
    		$('#sessionType')[0].selectedIndex = uData.sType;
    		$('#sessionType').trigger('change');

    		

    		$("#sessionSpeaker option ").each(function(){
				var t = $(this);
				var cValue = t.attr("value");
				if(t.attr("selected") =="selected"){
				t.removeAttr("selected");
				}
				//new code
				if(t.attr("value") == uData.sSpeak ){
				t.attr("selected","selected");
				}
			});
    	});
    }
	$('#large').modal('show');
	$('.modal-backdrop').appendTo('body');  
	$('.modal').appendTo('body'); 

	/*$('#myModal').modal('hide');*/	
};	

</script>
<!-- END EDIT USER (FORM) -->

<!-- DELETE USER -->
 <script type="text/javascript">
 	$("body").on("click", ".sweet-8", function() {
 		var row = $(this).parent().parent();
 		var tablebody = $("#event-sessions tbody");
		var sId = $(this).closest('tr').children('td.id').text();
        swal({
		  title: "Confirmar",
		  text: "Está seguro de eliminar la se´sión seleccionada?",
		  type: "warning",
		  showCancelButton: true,
		  cancelButtonText: "Cancelar",
		  confirmButtonClass: "btn-danger",
		  confirmButtonText: "Eliminar",
		  closeOnConfirm: false,

		},
		
		function(isConfirm){
			if (isConfirm) {
				$.ajax({
			        url: "{{ url('admin/event/session/delete/')}}/"+sId,
			        type: 'delete', // replaced from put
			        dataType: "JSON",
			        data: {
			            "id": sId // method and token not needed in data
			        },
			        success: function (response)
			        {
			        	if(response.status == 'success'){
				        	row.remove();
				            swal("Eliminado!", response.message, "success");
				            if (tablebody.children().length == 0) {
							    tablebody.html("<tr class='table-empty'><td colspan='6' class='text-center'>No existen usuarios asignados al evento!</td></tr>");
							}
						}
						else{
							console.log(response);
						}
									            
			        },
			        error: function(xhr) {
			         console.log(xhr.responseText); // this line will save you tons of hours while debugging
			        // do something here because of error
			       }
			    });	   
			}
		});
      });
 </script>
    	
<script>
function testAnim(x) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog  ' + x + '  animated');
};
$('#large').on('show.bs.modal', function (e) {
  var anim = 'fadeIns';
      testAnim(anim);
})
$('#large').on('hide.bs.modal', function (e) {
  var anim = 'fadeOut';
      testAnim(anim);
})
</script>