<div class="row">
	<div class="col-md-12">
		
		<div class="portlet light bordered">
	        <div class="portlet-title">
	            <div class="caption font-green-haze">
	                <i class="icon-settings font-green-haze"></i>
	                <span class="caption-subject bold uppercase"> Patrocinadores</span>
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
	        	<div class="row">


	        		


	        		<div class="col-md-12 col-sm-12">
				         <div class="clear"></div>
        				<!-- BEGIN ACCORDION PORTLET-->
		                <div class="panel-group accordion scrollable" id="accordion2">
		                    		                            	
				        	<div class="col-md-12 col-sm-12">
				        		<form role="form" class="form-horizontal">
					                <div class="form-body">
					                	 <a href="javascript:productEdit(1,1);"  class="btn green pull-right"><i class="fa fa-plus"></i> Crear Patrocinador</a>
					                </div>
				            	</form>
				        	</div>
		                </div>
			            
			        </div>

			        <div class="col-md-12 col-sm-12" style="margin-top: 15px">
			        	<div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Productos del evento</h3>
                            </div>
                            <div class="panel-body"> 

                            	<!-- BEGIN SAMPLE TABLE PORTLET-->
                                
                                <div class="table-scrollable">
                                    <table id="asigned-sponsors" class="table table-hover">
                                        <thead>
                                            <tr>
                                            	<th style="display: none"> ID</th>
                                            	<th> Imagen </th>
                                                <th> Nombre </th>
                                                <th> Acciones </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	@foreach($sponsors as $sponsor)
	                                            <tr>
	                                            	<td class="id" style="display: none">{{$sponsor->id}}</td>
	                                                <td style="vertical-align: middle"> <img src="{{url('/')}}/{{$sponsor->eventWebResourcePath}}/{{$sponsor->eventWebResourceValue}}" width="65"></td>
	                                                <?php  $newFileName = substr($sponsor->eventWebResourceValue, 0 , (strrpos($sponsor->eventWebResourceValue, ".")));    ?>
	                                                <td> <?php  echo str_replace("_", " ", $newFileName)   ?> </td>
	                                                
	                                                <td class="{{$sponsor->id}}"> 
	                                                	<!--<a href="javascript:productEdit(2,{{$sponsor->id}});" id="edit-btn" class="btn btn-xs btn-default"><i class="fa fa-edit"></i>Editar</a> -->
	                                                	<button id="sweet-8" class="btn btn-xs btn-default sweet-8"><i class="fa fa-trash"></i> Eliminar</button>
	                                                	
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
                        <h4 id="user-modal-title" class="modal-title">Editar Patrocinador</h4>
                        <p id="user-modal-tip">Ingresa los datos para el nuevo patrocinador.</p>
                    </div>
                    <div class="modal-body"> 

                    	<form id="form-sponsor-create" class="form-horizontal" method="POST" role="form" action="{{ route('event-sponsor-store') }}">
			                                	<!-- BEGIN FORM BODY -->
			                                	<div class="form-body">
			                                		 {{ csrf_field() }}
			                                		<input id="action" name="action" type="hidden" class="form-control">
			                                		<input id="sponsorId" name="sponsorId" type="hidden" class="form-control"> 
			                                		<input id="tableRow" name="tableRow" type="hidden" class="form-control"> 
			                                		<input id="eventId" name="eventId" type="hidden" value="{{$eventId}}" class="form-control"> 
			                                		

								                  	<div class="form-group custom-form-group">
					                        			<div class="col-sm-6 text-center">
										          			<label for="companyLogo" class="custom-file-upload" >
															    <i class="fa fa-cloud-upload"></i> Imagen del patrocinador
															</label>
										                    <input id="sponsorPicture" name="sponsorPicture" type="file" onchange="loadPicture(event)">
												        </div>
								                        <div class="col-md-6">
								                        	<div class="col-md-12" style="padding: 10px 0px 0px 0px">
								                        		<label>Nombre del Patrocinador</label>
								                            	<input id="sponsorName"" name="sponsorName" type="text"  class="form-control custom-form-control" placeholder="Nombre de la Empersa" required maxlength="50" />
								                           	</div> 
								                        </div>
								                    </div>

								                    
								                  <!--  <div class="form-group custom-form-group">
								                        <label class="col-md-3 control-label" for="eventFacebookLink">Nombre del patrocinador <span class="required" aria-required="true"> * </span></label>
								                        <div class="col-md-9">
								                           <input id="sponsorName" name="sponsorName" type="text"  class="form-control" placeholder="Nombre del producto" required maxlength="100" />
								                        </div>
								                    </div>
								                    <div class="form-group custom-form-group">
								                        <label class="col-md-3 control-label" for="eventFacebookLink">Imágen<span class="required" aria-required="true"> * </span></label>
								                        <div class="col-md-9">
								                        	<input id="sponsorPicture" name="sponsorPicture" type="file" class="form-control" placeholder="Imagen de Producto" accept="image/*" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])" multiple="false" required>
								                        </div>
								                        <br>
								                        <div class="col-md-12" style="border: 1px dotted grey; height: 105px; text-align: center; vertical-align: middle;">
								                        	<img id="blah" alt="imagen del patrocinador" height="100" style="" />
								                        </div>
								                    </div> -->
								                    
								                   

								                    <button id="btn-create-sponsor" type="submit" class="btn green pull-right" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Registrando Patrocinador...">Guardar Cambios</button>                            	
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

		$('#large').on('shown.bs.modal', function() {
		  $('#sponsorName').focus();
		});
		</script>




<!-- BEGIN CREATE NEW USER (FORM) -->
<script>
	$( "#form-sponsor-create" ).submit(function( event ) {
		event.preventDefault();
		var $btnc = $('#btn-create-sponsor');
		$btnc.button('loading');

		var action = $('#action').val();
		var tablebody = $("#asigned-sponsors tbody");
		
		
		var data = new FormData($(this)[0]);

		if(action == 1)
		{
			$('#overlay-msg').text('Creando patrocinador');
		}
		else{
			$('#overlay-msg').text('Editando patrocinador');
		}
		
		/*$('#page-overlay').fadeIn('slow');*/

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
           
            var btn='<button class="btn btn-xs btn-default sweet-8"><i class="fa fa-trash"></i> Eliminar</button>';
            
            
            if(action == 1)
			{
				

				if(uData.status=='success')
				{
				$('#overlay-msg').text(uData.msg);
				$('#asigned-sponsors tbody').append("<tr><td class='id' style='display:none'>" + uData.sId + "</td><td style='vertical-align: middle'> <img src='"+ uData.sPicture +"' width='65'>    </td><td> "+ uData.sName +" </td><td>"+ btn +"</td></tr>");

				setTimeout(function(){
						$('#page-overlay').fadeOut('slow');
						$('#large').modal('hide');
						 $btnc.button('reset');
						Command: toastr["success"]("Se ha registrado correctamente el patrocinador!", "Mensaje");

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
				if(uData.status=='exists')
				$('#overlay-msg').text(uData.msg);
				
			}
			else{
				$('#overlay-msg').text('Patrocinador editado con éxito');
			}

		 	setTimeout(function(){
		  		$('#page-overlay').fadeOut('slow');
			}, 1000);    
          }
        });
	});	


</script>
<!-- END CREATE NEW USER (FORM) -->

<!-- BEGIN EDIT USER (FORM) -->
<script>
function productEdit(act, pId){

	
	/*$('#page-overlay').fadeIn('slow');*/
   $('.custom-file-upload').css('background', 'url(../../images/events/companies/logos/noCompanyPicture.png) center center no-repeat');	
		
   var row = $('.'+pId).closest('tr').index();	
    
    $('#action').val(act);
    $('#sponsorId').val(pId);

    $('#tableRow').val(row);

    if(act == 1)
    {
    	$('#form-sponsor-create').trigger("reset");
    	$('#user-modal-title').text('Crear Nuevo Patrocinador');
    	$('#user-modal-tip').text('	Ingresa los datos para el nuevo patrocinador.');
    	/*document.getElementById('blah').src = "";*/

    	
    }
    if(act == 2)
    {
    	
    	url= "{{ url('admin/event/sponsors/geteditdata')}}"+"/"+pId;
	    $.get(url, function(data){
	    	var uData = jQuery.parseJSON(data);
	    	console.log(uData);
	    	
	    	$('#user-modal-title').text('Editar Patrocinador');
	    	$('#user-modal-tip').text('Modifica los datos del patrocinador.');
	    	$('#productId').val(pId);
	    	$('#sponsorName').val(uData.pName);
	    	console.log("{{url('')}}/"+uData.pPicture);
	    	$('#sponsorPicture').attr('value',"{{url('')}}/"+uData.pPicture);
	    	
	    	
	    	document.getElementById('blah').src = "{{url('')}}/"+uData.pPicture;
    	
    	
    	});
    }
    $('#large').modal('show');
    $('.modal-backdrop').appendTo('body');  
	$('.modal').appendTo('body'); 
};	

</script>
<!-- END EDIT USER (FORM) -->

<!-- DELETE USER -->
 <script type="text/javascript">
 	$("body").on("click", ".sweet-8", function() {
 		var row = $(this).parent().parent();
 		var tablebody = $("#asigned-sponsors tbody");
		var pId = $(this).closest('tr').children('td.id').text();;
        swal({
		  title: "Confirmar",
		  text: "Está seguro de eliminar el patrocinador seleccionado?",
		  type: "warning",
		  showCancelButton: true,
		  cancelButtonText: "Cancelar",
		  confirmButtonClass: "btn-danger",
		  confirmButtonText: "Eliminar",
		  closeOnConfirm: false,

		},
		
		function(isConfirm){
			if (isConfirm) {
				$.ajax(
			    {
			        url: "{{ url('admin/event/sponsors/delete')}}/"+pId,
			        type: 'delete', // replaced from put
			        dataType: "JSON",
			        data: {
			            "id": pId // method and token not needed in data
			        },
			        success: function (response)
			        {
			        	row.remove();
			        	console.log(response);
			            swal("Eliminado!", response.message, "success");
			            if (tablebody.children().length == 0) {
						    tablebody.html("<tr class='table-empty'><td colspan='6' class='text-center'>No existen patrocinadores en el evento!</td></tr>");
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
<!-- END DELETE USER -->



<!--
<script>
		
$('#itemName').on("change", function(e) { 
	$('#page-overlay').fadeIn('slow');
	$('#itemName').empty();
	$('#overlay-msg').text('Asignando Usuario');
 	setTimeout(function(){
  		$('#page-overlay').fadeOut('slow');
	}, 1500);
	
});
				    
		
</script>	 -->	    	


<!--- Load picture -->
<script>
function loadPicture(event){
var selectedFile = event.target.files[0];
	var inputLength = $("#sponsorPicture").size();

    if(inputLength > 0){
    	//$('#pictureChanged').val(1);
    	
    	$('.custom-file-upload').css('background', 'url('+ window.URL.createObjectURL(selectedFile) +') center center no-repeat');

    }
    else{
    	$('#pictureChanged').val(0);	
    	$('.custom-file-upload').css('background', 'url(../../images/icons/companyAvatar.png) center center no-repeat');

    }

    if(!inputLength){
    	$('.custom-file-upload').css('background', 'url(../../images/icons/companyAvatar.png) center center no-repeat');
    }
	
}
</script>
