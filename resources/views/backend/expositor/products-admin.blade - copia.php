<div class="row">
	<div class="col-md-12">
		
		<div class="portlet light bordered">
	        <div class="portlet-title">
	            <div class="caption font-green-haze">
	                <i class="icon-settings font-green-haze"></i>
	                <span class="caption-subject bold uppercase"> Productos</span>
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
								                	 <a href="javascript:productEdit(1,1);"  class="btn green"><i class="fa fa-plus"></i> Crear Nuevo Producto</a>
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
                                <h3 class="panel-title">Productos del evento</h3>
                            </div>
                            <div class="panel-body"> 

                            	<!-- BEGIN SAMPLE TABLE PORTLET-->
                                
                                <div class="table-scrollable">
                                    <table id="asigned-users" class="table table-hover">
                                        <thead>
                                            <tr>
                                            	<th> ID</th>
                                            	<th> Imagen </th>
                                                <th> Producto </th>
                                                <th> Descripción </th>
                                                <th> Precio </th>
                                                <th> Acciones </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	
	                                            <tr>
	                                            	<td class="id">1</td>
	                                                <td> <img src="nopicture.png" height="25"></td>
	                                                <td> Audi A4</td>
	                                                <td> Modelo 2017, motor </td>
	                                                <td> $ 12,000</td>
	                                                <td> 
	                                                	<a href="javascript:productEdit(2,4);" id="edit-btn" class="btn btn-xs btn-default"><i class="fa fa-edit"></i>Editar</a> 
	                                                	<button id="sweet-8" class="btn btn-xs btn-default sweet-8" onclick="_gaq.push(['_trackEvent', 'exit', 'footer', 'Lipis']);"><i class="fa fa-trash"></i> Eliminar</button>
	                                                	
	                                                </td>
	                                            </tr>
                                           
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
                        <h4 id="user-modal-title" class="modal-title">Editar Producto</h4>
                    </div>
                    <div class="modal-body"> 

                    	<form id="form-user-create" class="form-horizontal" method="POST" role="form" action="{{ route('event-user-store') }}">
			                                	<!-- BEGIN FORM BODY -->
			                                	<div class="form-body">
			                                		 {{ csrf_field() }}
			                                		<input id="action" name="action" type="hidden" class="form-control">
			                                		<input id="userId" name="userId" type="hidden" class="form-control"> 
			                                		<div class="form-group custom-form-group">
								                        <label class="col-md-3 control-label" for="eventFacebookLink">Nombre <span class="required" aria-required="true"> * </span></label>
								                        <div class="col-md-9">
								                           <input id="userFirstName" name="userFirstName" type="text"  class="form-control" placeholder="Nombre del producto"/>
								                        </div>
								                    </div>

								                     <div class="form-group custom-form-group">
								                        <label class="col-md-3 control-label" for="eventFacebookLink">Tipo <span class="required" aria-required="true"> * </span></label>
								                        <div class="col-md-9">
								                           <select class="form-control" >
								                           		<option value="1">Tipo 1</option>
								                           		<option value="2">Tipo 3</option>
								                           		<option value="3">Tipo 2</option>
								                           </select> 
								                        </div>
								                    </div>

								                    <div class="form-group custom-form-group">
								                        <label class="col-md-3 control-label" for="eventFacebookLink">Descripción <span class="required" aria-required="true"> * </span></label>
								                        <div class="col-md-9">
								                           <textarea name="userDob" class="form-control form-control-inline input-medium date-picker" size="16" type="text" value="" style="width: 100% !important" ></textarea>
								                        </div>
								                    </div>

								                    <div class="form-group custom-form-group">
									                        <label class="col-md-3 control-label" for="eventFacebookLink">Marca <span class="required" aria-required="true"> * </span></label>
								                        <div class="col-md-9">
								                           <input id="userFirstName" name="userFirstName" type="text"  class="form-control" placeholder="Marca del Producto"/>
								                        </div>
								                    </div>

								                    <div class="form-group custom-form-group">
									                        <label class="col-md-3 control-label" for="eventFacebookLink">Modelo <span class="required" aria-required="true"> * </span></label>
								                        <div class="col-md-9">
								                           <input id="userFirstName" name="userFirstName" type="text"  class="form-control" placeholder="Modelo del Producto"/>
								                        </div>
								                    </div>


								                    <div class="form-group custom-form-group">
								                        <label class="col-md-3 control-label" for="eventFacebookLink">Precio <span class="required" aria-required="true"> * </span></label>
								                        <div class="col-md-9">
								                           <input id="userMail" name="userMail" type="number"  class="form-control" placeholder="150.00"/>
								                        </div>
								                    </div>

								                    <div class="form-group custom-form-group">
								                        <label class="col-md-3 control-label" for="eventFacebookLink">Moneda<span class="required" aria-required="true"> * </span></label>
								                        <div class="col-md-9">
								                           <select class="form-control" >
								                           		<option value="1">Dolares $</option>
								                           		<option value="2">Euros E</option>
								                           		<option value="3">Quetzales Q</option>
								                           </select> 
								                        </div>
								                    </div>

								                    <div class="form-group custom-form-group">
								                        <label class="col-md-3 control-label" for="eventFacebookLink">Imágenes<span class="required" aria-required="true"> * </span></label>
								                        <div class="col-md-9">
								                        	<input type="file" class="form-control" placeholder="seleccione las imágenes para el producto">
								                        </div>
								                    </div>
								                    
								                   

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
		$('#asigned-users tbody').append("<tr><td class='id'>2</td><td> lbtx@gmail.com </td><td> Roberto Hernández </td><td> Vendedor </td><td> <a href='javascript:productEdit(2,1);' id='edit-btn' class='btn btn-xs btn-default'><i class='fa fa-edit'></i>Editar</a> "+ btn +"</td></tr>");
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
		var tablebody = $("#asigned-users tbody");
		
		
		var data = new FormData($(this)[0]);

		if(action == 1)
		{
			$('#overlay-msg').text('Creando y Asignando Usuario');
		}
		else{
			$('#overlay-msg').text('Editando Usuario');
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
            var safunction = "'_gaq.push(['_trackEvent', 'exit', 'footer', 'Lipis']);'";
            var btn='<button class="btn btn-xs btn-default sweet-8" onclick='+safunction+' ><i class="fa fa-trash"></i> Eliminar</button>';
            
            
            if(action == 1)
			{
				

				if(uData.status=='success')
				{
				$('#overlay-msg').text(uData.msg);
				$('#asigned-users tbody').append("<tr><td class='id'>" + uData.uId + "</td><td> "+ uData.uMail +" </td><td>"+ uData.uName + "</td><td>"+ uData.uPermission +"</td><td> <a href='javascript:productEdit(2,1);' id='edit-btn' class='btn btn-xs btn-default'><i class='fa fa-edit'></i>Editar</a> "+ btn +"</td></tr>");

				}
				if(uData.status=='exists')
				$('#overlay-msg').text(uData.msg);
				
			}
			else{
				$('#overlay-msg').text('Usuario editado con éxito');
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
function productEdit(act, uId){

	
	/*$('#page-overlay').fadeIn('slow');*/

		
    
    $('#action').val(act);
    $('#userId').val(uId);
    
    if(act == 1)
    {
    	$('#user-modal-title').text('Crear Nuevo Producto');
    	
    }
    else
    {
    	url= "{{ url('expositor/admin/users/edit')}}"+"/"+uId;
	    $.get(url, function(data){
	    	var uData = jQuery.parseJSON(data);
	    	console.log(uData.uId);

	    });
    	$('#user-modal-title').text('Editar Producto');
    	$('#userId').val(uId);

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
 		var tablebody = $("#asigned-users tbody");
		var uId = $(this).closest('tr').children('td.id').text();;
        swal({
		  title: "Confirmar",
		  text: "Está seguro de eliminar el usuario seleccionado?",
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
			        url: "{{ url('expositor/admin/users/delete/')}}/"+uId,
			        type: 'delete', // replaced from put
			        dataType: "JSON",
			        data: {
			            "id": uId // method and token not needed in data
			        },
			        success: function (response)
			        {
			        	row.remove();
			            swal("Eliminado!", response, "success");
			            if (tablebody.children().length == 0) {
						    tablebody.html("<tr class='table-empty'><td colspan='6' class='text-center'>No existen usuarios asignados al evento!</td></tr>");
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
