<div class="row">
	<div class="col-md-12">
		
		<div class="portlet light bordered">
	        <div class="portlet-title">
	            <div class="caption font-green-haze">
	                <i class="fa fa-clock-o font-green-haze"></i>
	                <span class="caption-subject bold uppercase"> Visitantes</span>
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
	                </a> -->
	                <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
	            </div>
	        </div>
	        <div class="portlet-body form">
	        	<div class="row">


	        		


	        		<div class="col-md-12 col-sm-12">
				         <div class="clear"></div>
        				<!-- BEGIN ACCORDION PORTLET-->
		                <div class="panel-group accordion scrollable" id="accordion2">
		                    <div class="panel panel-default">
		                        <div class="panel-heading">
		                            <h4 class="panel-title">
		                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse_2_1" aria-expanded="true"> Acciones </a>
		                            </h4>
		                        </div>
		                        <div id="collapse_2_1" class="panel-collapse in">
		                            <div class="panel-body">
		                            	
							        	<div class="col-md-12 col-sm-12">
							        		<form role="form" class="form-horizontal">
								                <div class="form-body">
								                	 <a href="javascript:userEdit(1,1);"  class="btn green"><i class="fa fa-plus"></i> Crear Nuevo Visitante</a>
								                </div>
							            	</form>
							        	</div>
		                            </div>
		                        </div>
		                    </div>
		                </div>
			            
			        </div>

			        <div class="col-md-12 col-sm-12">
			        	<div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Visitantes del Evento</h3>
                            </div>
                            <div class="panel-body"> 

                            	<!-- BEGIN SAMPLE TABLE PORTLET-->
                                
                                <div class="table-scrollable">
                                    <table id="user-visitor" class="table table-hover">
                                        <thead>
                                            <tr>
                                            	<th style="display: none"> ID</th>
                                            	<th> Email </th>
                                                <th> Nombre del Visitante </th>
                                                <th> Teléfono </th>
                                                <th> Acciones </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	@foreach($visitors as $visitor)
	                                            <tr>
	                                            	<td class="id" style="display: none">{{$visitor->USERID}}</td>
	                                            	<td> {{$visitor->EMAIL}} </td>
	                                                <td> {{$visitor->FIRSTNAME}} {{ $visitor->LASTNAME }}</td>
	                                                <td> {{$visitor->PHONE }}</td>
	                                                <td class="{{$visitor->USERID}}"> 
	                                                	<a href="javascript:userEdit(2,{{$visitor->USERID}});" id="edit-btn" class="btn btn-xs btn-default"><i class="fa fa-edit"></i>Editar</a> 
	                                                	<button id="sweet-8" class="btn btn-xs btn-default sweet-8"><i class="fa fa-trash"></i> Eliminar</button>
	                                                	<button id="getQr" class="btn btn-xs btn-default getQr"><i class="fa fa-qrcode"></i> Generar QR</button>
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
                        <h4 id="user-modal-title" class="modal-title">Nuevo Visitante</h4>
                        <p id="user-modal-tip">Ingresa los datos para el nuevo visitante.</p>
                    </div>
                    <div class="modal-body"> 

                    	<form id="form-user-create" class="form-horizontal" method="POST" role="form" action="{{ route('event-user-store') }}">
                        	<!-- BEGIN FORM BODY -->
                        	<div class="form-body">
                        		 {{ csrf_field() }}
                        		<input id="action" name="action" type="hidden" class="form-control">
                        		<input id="userId" name="userId" type="hidden" class="form-control"> 
                        		<input id="tableRow" name="tableRow" type="hidden" class="form-control"> 
                        		<div class="form-group custom-form-group">
			                        <label class="col-md-3 control-label" for="eventFacebookLink">Nombre <span class="required" aria-required="true"> * </span></label>
			                        <div class="col-md-9">
			                           <input id="userFirstName" name="userFirstName" type="text"  class="form-control" placeholder="Nombres del usuario" required />
			                        </div>
			                    </div>

			                     <div class="form-group custom-form-group">
			                        <label class="col-md-3 control-label" for="eventFacebookLink">Apellido <span class="required" aria-required="true"> * </span></label>
			                        <div class="col-md-9">
			                           <input id="userLastName" name="userLastName" type="text"  class="form-control" placeholder="Apellidos del usuario" required/>
			                        </div>
			                    </div>

			                    <div class="form-group custom-form-group">
			                        <label class="col-md-3 control-label" for="eventFacebookLink">Fecha de Nacimiento <span class="required" aria-required="true"> * </span></label>
			                        <div class="col-md-9">
			                           <input id="userDob" name="userDob" class="form-control form-control-inline input-medium date-picker" size="16" type="text" value="" style="width: 100% !important" placeholder="dd/mm/aaaa" required/>
			                        </div>
			                    </div>


			                    <div class="form-group custom-form-group">
			                        <label class="col-md-3 control-label" for="eventFacebookLink">Email <span class="required" aria-required="true"> * </span></label>
			                        <div class="col-md-9">
			                           <input id="userMail" name="userMail" type="text"  class="form-control" placeholder="user@mymail.com" required/>
			                        </div>
			                    </div>

			                 <!--   <div class="form-group custom-form-group">
			                        <label class="col-md-3 control-label" for="eventFacebookLink">Ocupación </label>
			                        <div class="col-md-9">
			                           <input id="userOccupation" name="userOccupation" type="text"  class="form-control" placeholder="Indique su ocupación"/>
			                        </div>
			                    </div>

			                    <div class="form-group custom-form-group">
			                        <label class="col-md-3 control-label" for="eventFacebookLink">Empresa <span class="required" aria-required="true"> * </span></label>
			                        <div class="col-md-9">
			                           <input id="userCompany" name="userCompany" type="text"  class="form-control" placeholder="Empresa a la que representa/pertenece"/>
			                        </div>
			                    </div> -->

			                    <div class="form-group custom-form-group">
			                        <label class="col-md-3 control-label" for="eventFacebookLink">Dirección <span class="required" aria-required="true"> * </span></label>
			                        <div class="col-md-9">
			                           <input id="userAddress" name="userAddress" type="phone"  class="form-control" placeholder=""/>
			                        </div>
			                    </div>

			                    <div class="form-group custom-form-group">
			                        <label class="col-md-3 control-label" for="eventFacebookLink">Teléfono <span class="required" aria-required="true"> * </span></label>
			                        <div class="col-md-9">
			                           <input id="userPhone" name="userPhone" type="phone"  class="form-control" placeholder="50504040" required/>
			                        </div>
			                    </div>
			                    <input type="hidden" id="userEventType" name="userEventType" value="5">
			                    <button type="submit" class="btn green pull-right">Guardar Cambios</button>                            	
                        		<button type="button" class="btn dark btn-outline pull-right" style="margin-right: 10px" data-dismiss="modal">Cerrar</button>
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


        <!-- QR modal -->
      <div class="modal fade" tabindex="-1" role="dialog" id="modal-qr">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title">Código QR</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <div class="qrcode" id="qrcode" style="width: 400px; height: 400px; border: 0px solid; margin: 0 auto">
	        			
					</div>
	      </div>
	      <div class="modal-footer">
	      	 <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
	        <button type="button" class="btn btn-primary qrPrint">Imprimir</button>
	       
	      </div>
	    </div>
	  </div>
	</div> 

	</div>
</div>
<script type="text/javascript" src="{{ URL::asset('metronic/scripts/bootstrap-daterangepicker/daterangepicker.min.js')}}"></script>
<script type="text/javascript" src="{{ URL::asset('metronic/scripts/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
<script type="text/javascript" src="{{ URL::asset('metronic/scripts/bootstrap-timepicker/js/bootstrap-timepicker.min.js')}}"></script>
<script type="text/javascript" src="{{ URL::asset('metronic/scripts/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js')}}"></script>
<script type="text/javascript" src="{{ URL::asset('metronic/scripts/clockface/js/clockface.js')}}"></script>
<script type="text/javascript" src="{{ URL::asset('metronic/scripts/components-date-time-pickers.min.js')}}"></script>
<script type="text/javascript" src="{{ URL::asset('metronic/scripts/ui-buttons-spinners.min.js')}}"></script>
<script type="text/javascript" src="{{ URL::asset('metronic/scripts/components-bootstrap-select.min.js')}}"></script>

<script type="text/javascript">
		$.ajaxSetup({
		   headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
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
		$('#asigned-users tbody').append("<tr><td class='id'>2</td><td> lbtx@gmail.com </td><td> Roberto Hernández </td><td> Vendedor </td><td> <a href='javascript:userEdit(2,1);' id='edit-btn' class='btn btn-xs btn-default'><i class='fa fa-edit'></i>Editar</a> "+ btn +"</td></tr>");
		$('#itemName').empty();
		$('#overlay-msg').text('Asignando Usuario');
		 	setTimeout(function(){
		  		$('#page-overlay').fadeOut('slow');
			}, 1000);
	});
</script>



<!-- BEGIN CREATE NEW USER (FORM) -->
<script>
	$( "#form-user-create" ).submit(function( event ) {
		event.preventDefault();
		var action = $('#action').val();
		var tablebody = $("#user-visitor tbody");
		var row;
		
		var data = new FormData($(this)[0]);

		if(action == 1)
		{
			$('#overlay-msg').text('Creando Usuario');
		}
		else{
			$('#overlay-msg').text('Editando Usuario');
			row = $('#tableRow').val();
			var newRow = + row + 1;
			$('#user-visitor tr:eq('+newRow+')').addClass('table-row-editing');
		}
		$('#large').modal('hide');
		$('#page-overlay').fadeIn('slow');

		var form = $(this);
		$.ajax({
          type: "POST",
          url: form.attr( "action" ),
          data: data,
          async: false,
          cache: false,
          contentType: false,
          processData: false,
          success: function (data) {
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
				$('#user-visitor tbody').append("<tr><td class='id' style='display:none'>" + uData.uId + "</td><td> "+ uData.uMail +" </td><td> "+ uData.uName +" </td><td>"+ uData.uPhone + "</td><td> <a href='javascript:userEdit(2," + uData.uId + ");' id='edit-btn' class='btn btn-xs btn-default'><i class='fa fa-edit'></i>Editar</a> "+ btn +"</td></tr>");

				}
				if(uData.status=='exists')
				setTimeout(function(){
		  			$('#overlay-msg').text(uData.msg);
				}, 2000);
				
			}
			else{
				
				
				var newRow = + row + 1;
				
				$('#user-visitor tr:eq('+newRow+') td').eq(0).text(uData.uId);
				$('#user-visitor tr:eq('+newRow+') td').eq(1).text(uData.uName);
				$('#user-visitor tr:eq('+newRow+') td').eq(2).text(uData.uMail);
				$('#user-visitor tr:eq('+newRow+') td').eq(3).text(uData.uPhone);
				
				setTimeout(function(){
		  		$('#overlay-msg').text('Usuario actualizado con éxito');
			}, 2000);
				
			}

		 	setTimeout(function(){
		  		$('#page-overlay').fadeOut('slow');
		  		$('#user-visitor tr:eq('+newRow+')').removeClass('table-row-editing');
			}, 1000);    
          }
        });
	});	


</script>
<!-- END CREATE NEW USER (FORM) -->

<!-- BEGIN EDIT USER (FORM) -->
<script>
function userEdit(act, uId){

	
	/*$('#page-overlay').fadeIn('slow');*/

	var row = $('.'+uId).closest('tr').index();	
    
    $('#action').val(act);
    $('#sessionId').val(uId);
    $('#tableRow').val(row);
    $('#form-user-create').trigger("reset");
    if(act == 1)
    {
    	
    	$('#user-modal-title').text('Crear Nuevo Visitante');
    	$('#user-modal-tip').text('	Ingresa los datos para el visitante.');

    	
    }
    if(act == 2)
    {
    	$('#user-modal-title').text('Editar Visitante');
	    $('#user-modal-tip').text('Modifica los datos del visitante.');
    	url= "{{ url('admin/users/geteditdata')}}"+"/"+uId;
	    $.get(url, function(data){
	    	var uData = jQuery.parseJSON(data);
	    	console.log(uData);
	    	
	    	$('#userId').val(uId);
	    	$('#userFirstName').val(uData.userFirstName);
	    	$('#userLastName').val(uData.userLastName);
	    	$('#userDob').val(uData.userDob);
	    	$('#userMail').val(uData.userEmail);
	    	$('#userAddress').val(uData.userAddress);
    		$('#userPhone').val(uData.userPhone);
    		
    	});
    }
	$('#large').modal('show');

	/*$('#myModal').modal('hide');*/	
};	

</script>
<!-- END EDIT USER (FORM) -->

<!-- DELETE USER -->
 <script type="text/javascript">
 	$("body").on("click", ".sweet-8", function() {
 		var row = $(this).parent().parent();
 		var tablebody = $("#user-visitor tbody");
		var uId = $(this).closest('tr').children('td.id').text();
        swal({
		  title: "Se eliminará el visitante del evento.",
		  text: "El usuario quedará disponible para seleccionarlo posteriormente.",
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
			        url: "{{ url('admin/visitors/delete')}}/"+uId+"/"+"{{$eventId}}",
			        type: 'delete', // replaced from put
			        dataType: "JSON",
			        data: {
			            "id": uId // method and token not needed in data
			        },
			        success: function (response)
			        {
			        	if(response.status == 'success'){
				        	row.remove();
				            swal("Eliminado!", response.message, "success");
				            if (tablebody.children().length == 0) {
							    tablebody.html("<tr class='table-empty'><td colspan='6' class='text-center'>No existen visitantes asignados al evento!</td></tr>");
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
    	
  <!-- Print QR CODE -->
<script>
$('.getQr').on("click", function(e) {
	var type = "users";
	var row = $(this).parent().parent();
	var tablebody = $("#user-visitor tbody");
	var companyId = $(this).closest('tr').children('td.id').text();

	
 	$.ajax({
        url: "{{url('admin/qrs/generate')}}",
        type: 'POST', // replaced from put
        dataType: "JSON",
        data: {
            "id": companyId,
            "type": type, // method and token not needed in data
        },
        success: function (response)
        {
        	
        	 $(".qrcode").html(response.html); 

        	
			 var content = $('.qrcode').html();
			var mywindow = window.open('', 'Print', 'height=800,width=1200');

		    mywindow.document.write('<html><head><title>Impresión de QR</title>');
		    mywindow.document.write('</head><body >');
		    mywindow.document.write(content);
		    mywindow.document.write('</body></html>');

		    /*mywindow.document.close();
		    mywindow.focus()
		    
		    mywindow.close();*/
		    mywindow.print();
        	 /*$('#modal-qr').modal('show');*/
        /*	if(response.status == 'success'){
	        	
			}
			else{
				console.log(response);
			}
		*/				            
        },
        error: function(xhr) {
         console.log(xhr.responseText); // this line will save you tons of hours while debugging
        // do something here because of error
       }
    });	
});


 </script>	

