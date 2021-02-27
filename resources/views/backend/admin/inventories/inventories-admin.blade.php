<div class="row">
	<div class="col-md-12">
		
		<div class="portlet light bordered">
	        <div class="portlet-title">
	            <div class="caption font-green-haze">
	                <i class="icon-settings font-green-haze"></i>
	                <span class="caption-subject bold uppercase"> Inventarios</span>
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
		                            	<div class="col-md-6 col-sm-12">
			                               	<form role="form" class="form-horizontal">
								                <div class="form-body">
								                	 <select id="compnayId" class="form-control" style="width:500px;" name="companyId">
								                	 	<option value="">Seleccionar Empresa</option>
								                	 	@foreach($companies as $company)
								                	 		<option value="{{$company->id}}" >{{$company->companyName}}</option>
								                	 	@endforeach
								                	 </select>
								                </div>
								            </form>
							        	</div>
							        	<div class="col-md-6 col-sm-12">
							        		<form role="form" class="form-horizontal">
								                <div class="form-body">
								                	 <a href="javascript:userEdit(1,1);"  class="btn green"><i class="fa fa-plus"></i> Crear Nuevo Usuario</a>
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
                                <h3 id="compnayTitle" class="panel-title">Inventario de</h3>
                            </div>
                            <div class="panel-body"> 

                            	<!-- BEGIN SAMPLE TABLE PORTLET-->
                                
                                <div class="table-scrollable">
                                    <table id="asigned-users" class="table table-striped  table-hover  order-column">
                                        <thead>
                                            <tr>
                                            	<th style="display: none" class="hidden"> ID</th>
                                            	<th> Imagen </th>
                                                <th> Correo </th>
                                                <th> Nombre </th>
                                                <th> Empresa </th>
                                                <th> Permisos </th>
                                                <th> Opciones </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	
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
                        <h4 id="user-modal-title" class="modal-title">Editar Usuario</h4>
                    </div>
                    <div class="modal-body"> 

                    	<form id="form-user-create" class="form-horizontal" method="POST" role="form" action="{{ route('event-user-store') }}">
			                                	<!-- BEGIN FORM BODY -->
			                                	<div class="form-body">
			                                		 {{ csrf_field() }}
			                                		<input id="action" name="action" type="hidden" class="form-control">
			                                		<input id="userId" name="userId" type="hidden" class="form-control"> 
			                                		<input id="tableRow" name="tableRow" type="hidden" class="form-control">
			                                		<input id="userEventId" name="userEventId" type="hidden">
			                                		<div class="form-group custom-form-group">
								                        <label class="col-md-3 control-label" for="eventFacebookLink">Nombre <span class="required" aria-required="true"> * </span></label>
								                        <div class="col-md-9">
								                           <input id="userFirstName" name="userFirstName" type="text"  class="form-control" placeholder="Nombres del usuario" required />
								                        </div>
								                    </div>

								                     <div class="form-group custom-form-group">
								                        <label class="col-md-3 control-label" for="userLastName">Apellido <span class="required" aria-required="true"> * </span></label>
								                        <div class="col-md-9">
								                           <input id="userLastName" name="userLastName" type="text"  class="form-control" placeholder="Apellidos del usuario" required/>
								                        </div>
								                    </div>

								                    <div class="form-group custom-form-group">
								                        <label class="col-md-3 control-label" for="userDob">Fecha de Nacimiento <span class="required">  </span></label>
								                         <div class="col-md-9">
								                           <div class="input-group date" id="userDobContainer">
								                           	<input id="userDob" name="userDob" type="date" class="form-control" placeholder="dd/mm/AA"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
								                            	
							                            	</div>
								                        </div>
								                    </div>


								                    <div class="form-group custom-form-group">
								                        <label class="col-md-3 control-label" for="userEmail">Email <span class="required" aria-required="true"> * </span></label>
								                        <div class="col-md-9">
								                           <input id="userMail" name="userMail" type="text"  class="form-control" placeholder="user@mymail.com" required/>
								                        </div>
								                    </div>

								                    <!--<div class="form-group custom-form-group">
								                        <label class="col-md-3 control-label" for="eventFacebookLink">Ocupación </label>
								                        <div class="col-md-9">
								                           <input id="userOccupation" name="userOccupation" type="text"  class="form-control" placeholder="Indique su ocupación"/>
								                        </div>
								                    </div>-->

								                   <!-- <div class="form-group custom-form-group">
								                        <label class="col-md-3 control-label" for="eventFacebookLink">Empresa <span class="required" aria-required="true"> * </span></label>
								                        <div class="col-md-9">
								                           <input id="userCompany" name="userCompany" type="text"  class="form-control" placeholder="Empresa a la que representa/pertenece"/>
								                        </div>
								                    </div> -->


								                    <div class="form-group custom-form-group">
							                            <label class="control-label col-md-3">Empresa
							                                <span class="required" aria-required="true">  </span>
							                            </label>
							                            <div class="col-md-9">
							                                <select id="userCompany" name="userCompany" class="form-control">
							                                    <option value="0">Sin Especificar</option>

							                                    @foreach($companies as $company)
							                                    	<option value="{{$company->id}}">{{ $company->companyName }}</option>
							                                    @endforeach
							                                </select><span id="select-error" class="help-block help-block-error"></span>
							                            </div>
							                        </div>

								                    <div class="form-group custom-form-group">
								                        <label class="col-md-3 control-label" for="eventFacebookLink">Dirección <span class="required">  </span></label>
								                        <div class="col-md-9">
								                           <input id="userAddress" name="userAddress" type="phone"  class="form-control" placeholder=""/>
								                        </div>
								                    </div>

								                    <div class="form-group custom-form-group">
								                        <label class="col-md-3 control-label" for="eventFacebookLink">Teléfono <span class="required" ></span></label>
								                        <div class="col-md-9">
								                           <input id="userPhone" name="userPhone" type="phone"  class="form-control" placeholder="50504040"/>
								                        </div>
								                    </div>

								                    <div class="form-group custom-form-group">
							                            <label class="control-label col-md-3">Permisos
							                                <span class="required" aria-required="true"> * </span>
							                            </label>
							                            <div class="col-md-9">
							                                <select id="userEventType" name="userEventType" class="form-control"  aria-required="true" aria-invalid="false" aria-describedby="select-error" required>
							                                    <option value="">Seleccione el permiso para el usuario</option>

							                                   
							                                </select><span id="select-error" class="help-block help-block-error"></span>
							                            </div>
							                        </div>

							                        <div class="form-group custom-form-group">
								                        <label class="col-md-3 control-label" for="userProfileImage">Imagen de Perfil<span> </span></label>
								                        <div class="col-md-5">
								                        	<input id="userProfileImage" name="userProfileImage" type="file" class="form-control" placeholder="Imagen del usuario" accept="image/*" onchange="loadPicture(event)" multiple="false">
								                        </div>
								                        <div class="col-md-4" style="border: 1px dotted grey; height: 105px; text-align: center; vertical-align: middle;">
								                        	<img id="blah" alt="Imagen del usuario" height="100" style="" />
								                        </div>
								                    </div>
								                    <input type="hidden" name="pictureChanged" id="pictureChanged" value="0">
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

        <div class="modal fade bs-modal-lg" id="asign-user" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <p id="user-modal-tip">Hemos encontrado el correo en nuestros registros, puedes agregarlo al evento</p>
                        <h4 id="user-modal-title" class="modal-title">Datos del Usuario Encontrado</h4>
                        

                    </div> 
                    <div class="modal-body"> 

                    	<form id="form-user-assign" class="form-horizontal" method="POST" role="form" action="{{ route('event-user-assign') }}">
                    		<input type="hidden" name="userAsignedId" id="userAsignedId">
                    		<input type="hidden" name="uEventId" id="uEventId" value="">
                    		<input type="hidden" name="uAsignedEventId" id="uAsignedEventId" value="{{$eventId}}">
                			
                    		<div class="col-md-4">
                    			<div class="form-group custom-form-group">
		                    	<div class="col-md-12" style="border: 0px dotted grey; height: 120px; text-align: center; vertical-align: middle;">
		                        	<img id="userPicAss" alt="Imagen del usuario" height="150" style="max-width: 95%" />
		                        </div>
		                    	</div>
							</div>
							<div class="col-md-8">
                			<div class="form-group custom-form-group">
		                        <label class="control-label" for="userAsignedLastName">Nombre <span class="required" aria-required="true" > * </span></label>
		                       
		                           <input id="userAsignedFirstName" name="userAsignedFirstName" type="text"  class="form-control form-control-show" placeholder="Nombres del usuario" disabled/>
		                        
		                    </div>

		                    <div class="form-group custom-form-group">
			                        <label class="control-label" for="userAsignedLastName">Apellidos <span class="required" aria-required="true"> * </span></label>
		                        
		                           <input id="userAsignedLastName" name="userAsignedLastName" type="text"  class="form-control form-control-show" placeholder="Nombres del usuario" disabled/>
		                        
		                    </div>

		                    <div class="form-group custom-form-group">
		                        <label class="control-label" for="userAsignedEmail">Correo Electrónico <span class="required" aria-required="true"> * </span></label>
		                       
		                           <input id="userAsignedEmail" name="userAsignedEmail" type="text"  class="form-control form-control-show" placeholder="Email del usuario" disabled/>
		                       
		                    </div>

		                    
		                	</div>
		                    <hr>
		                    <h4>
		                    <div class="form-group custom-form-group">
		                    	<h4>Datos para el evento</h4>
		                    </div>
		                    <div class="form-group custom-form-group">
	                            <label class="control-label col-md-3">Empresa
	                                <span class="required" aria-required="true">  </span>
	                            </label>
	                            <div class="col-md-9">
	                                <select id="userAsignedCompany" name="userAsignedCompany" class="form-control">
	                                    <option value="0">Sin Especificar</option>

	                                    @foreach($companies as $company)
	                                    	<option value="{{$company->id}}">{{ $company->companyName }}</option>
	                                    @endforeach
	                                </select><span id="select-error" class="help-block help-block-error"></span>
	                            </div>
	                        </div>
		                    <div class="form-group custom-form-group">
	                            <label class="control-label col-md-3">Permisos
	                                <span class="required" aria-required="true"> * </span>
	                            </label>
	                            <div class="col-md-9">
	                                <select id="userAsignedEventType" name="userAsignedEventType" class="form-control"  aria-required="true" aria-invalid="false" aria-describedby="select-error" required>
	                                    <option value="">Seleccione el permiso para el usuario</option>

	                                    
	                                </select><span id="select-error" class="help-block help-block-error"></span>
	                            </div>
	                        </div><br><br>
	                         <button type="submit" class="btn green pull-right">Agregar Al Evento</button>                            	
			                                		<button type="button" class="btn dark btn-outline pull-right" style="margin-right: 10px" data-dismiss="modal">Cerrar</button>
                    	</form>
                    </div> <!--End modal body -->
                    
					  </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>  
 <!-- /.modal-fade end --> 
       
</div>


<script type="text/javascript" src="{{ URL::asset('metronic/scripts/ui-buttons-spinners.min.js')}}"></script>
<script type="text/javascript" src="{{ URL::asset('metronic/scripts/components-bootstrap-select.min.js')}}"></script>

<!-- datepicker -->
<script>
jQuery(document).ready( function($) {
/*	$('#userDobContainer').datepicker({
    language: "es",
    format: "dd/mm/yyyy",
	});
*/
});
</script>
<!-- Datatable -->
<script>
    
jQuery(document).ready( function($) {
 myTable =   $('#asigned-users').DataTable( {
         responsive: true,
         "createdRow": function ( row, data, index ) {
                        $('td', row).eq(0).addClass("hidden");
                         $('td', row).eq(0).addClass("id");
                       
                    },
         "language": {
            "lengthMenu": "Mostrar _MENU_ usuarios por página",
            "zeroRecords": "Nothing found - sorry",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "No se encontraror registros",
            "search": "Buscar",
            "infoEmpty": "No hay registros disponibles",
            "zeroRecords": "No se han encontrado usuarios",
            "infoFiltered": "(filtrados de _MAX_ registros)",
            paginate:{previous:"Anterior",next:"Next",
            last:"Last",first:"First"}
        },
        columnDefs: [ {
            targets: 2,
            render: function ( data, type, row ) {
                return data.length > 50 ?
                    data.substr( 0, 50 ) +'…' :
                    data;
                }
            }, 
            
        ]
    } );
});
</script>

<script type="text/javascript">
		$.ajaxSetup({
		   headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
		});
		</script>
<!-- SET THE SELECTED USER IN ASIGNED TABLE -->
<script>

$('#itemName').on("change", function(e) {
	$('#page-overlay').fadeIn('slow');
	
	var uId = $('#itemName').val();
	url= "{{ url('expositor/admin/users/edit')}}"+"/"+uId;
	    $.get(url, function(data){
	    	var uData = jQuery.parseJSON(data);
	    	console.log(uData);
	    	$('#userEventId').val(uData.uEventId);
	    	$('#userAsignedFirstName').val(uData.uFName);
	    	$('#userAsignedLastName').val(uData.uLName);

	    	$('#userAsignedEmail').val(uData.uMail);
	    	$('#userMail').val(uData.uMail);
	    	$('#userAsignedId').val(uData.uId);
		    $('#uEventId').val(uData.eventId);
	    	$('#userPicAss').attr('src',"{{url('')}}/"+uData.uPic);
	    	
	    	$('#userAsignedCompany').val(0);
	    	$('#userAsignedEventType').val('');
	    });
    	$('#user-modal-title').text('Editar Usuario');
    	$('#userId').val(uId);
	
	$('#asign-user').modal('show');

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
		var row;
		
		var data = new FormData($(this)[0]);

		if(action == 1)
		{
			$('#overlay-msg').text('Creando y Asignando Usuario');
		}
		else{
			$('#overlay-msg').text('Editando Usuario');
		}
		$('#overlay-msg').css('display', 'none');
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
			    var img = "{{url('/')}}/"+uData.uPic;
				
				swal({
				  title: "Usuario Creado",
				  text: uData.msg,
				  type: "info"});

				var t = $('#asigned-users').DataTable();
                

                var rowNode = t.row.add( [
                    uData.uId,
                    "<img class='product-list-image' src='"+ img +"' height='25'>",
                    uData.uMail,
                    uData.uName,
                    uData.uCompany,
                    uData.uPermission,
                    "<a href='javascript:userEdit(2,"+uData.uId+");' id='edit-btn' class='btn btn-xs btn-default'><i class='fa fa-edit'></i>Editar</a> "+ btn
                ] ).draw().node();

                var rId = uData.uId;
               
                $( rowNode ).find('td').eq(0).addClass(""+rId);

				

				}
				if(uData.status=='exists'){
					$('#overlay-msg').text(uData.msg);
				    $('#userAsignedFirstName').val(uData.uFName);
				    $('#userAsignedLastName').val(uData.uLName);
				    $('#userAsignedEmail').val(uData.uMail);
				    $('#userAsignedId').val(uData.uId);
				    $('#uEventId').val(uData.eventId);
				    $('#userAsignedId').val(uData.uId);
		    		$('#uEventId').val(uData.eventId);
	    			$('#userPicAss').attr('src',"{{url('')}}/"+uData.uPic);
	    			$('#userAsignedCompany').val(0);
	    			$('#userAsignedEventType').val('');

			    	console.log(uData);

					$('#asign-user').modal('show');
				}


				
			}
			else{
				row = $('#tableRow').val();
				var newRow = ++row;
				var img = "{{url('/')}}/"+uData.uPic;
				$('#asigned-users tr:eq('+newRow+') td').eq(0).text(uData.uId);
				$('#asigned-users tr:eq('+newRow+') td').eq(1).html("<img class='product-list-image' src='"+ img +"' height='25'>");
				$('#asigned-users tr:eq('+newRow+') td').eq(2).text(uData.uMail);
				$('#asigned-users tr:eq('+newRow+') td').eq(3).text(uData.uName);
				$('#asigned-users tr:eq('+newRow+') td').eq(4).text(uData.uCompany);
				$('#asigned-users tr:eq('+newRow+') td').eq(5).text(uData.uPermission);
				
				


				//alert(row);
				$('#asigned-users tr:eq('+newRow+')').addClass('table-row-editing');
				$('#overlay-msg').text('Usuario editado con éxito');
			}

		 	setTimeout(function(){
		  		$('#page-overlay').fadeOut('slow');
			}, 1000);    
          	
          },
           error: function(XMLHttpRequest, textStatus, errorThrown) { 
        	alert("Status: " + textStatus); alert("Error: " + errorThrown); 

		 	setTimeout(function(){
		  		$('#page-overlay').fadeOut('slow');
			}, 1000);  
    		}    


        });
	});	


$("#form-user-assign" ).submit(function( event ) {
		event.preventDefault();
		var data = new FormData($(this)[0]);
		alert (data);

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
      			console.log(data);

      			var t = $('#asigned-users').DataTable();
                var rowNode = t.row.add( [
                    uData.uId,
                    "<img class='product-list-image' src='"+ img +"' height='25'>",
                    uData.uMail,
                    uData.uName,
                    uData.uCompany,
                    uData.uPermission,
                    "<a href='javascript:userEdit(2,"+uData.uId+");' id='edit-btn' class='btn btn-xs btn-default'><i class='fa fa-edit'></i>Editar</a> "+ btn
                ] ).draw().node();

      			$('#asign-user').modal('show');
      		},
      		error: function(XMLHttpRequest, textStatus, errorThrown) { 
        		alert("Status: " + textStatus); alert("Error: " + errorThrown); 
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
 
function userEdit(act, uId){

	
	/*$('#page-overlay').fadeIn('slow');*/

	var row = $('.'+uId).closest('tr').index();		
     $("#userProfileImage").val(null);
     $('#blah').attr('src', '#');
 	$('#blah').attr('alt', 'Imagen del usuario');
    $('#action').val(act);
    $('#userId').val(uId);
    $('#tableRow').val(row);

    
    if(act == 1)
    {
    	$('#user-modal-title').text('Crear Nuevo Usuario');
    	
    }
    else 
    {
    	url= "{{ url('expositor/admin/users/edit')}}"+"/"+uId;
	    $.get(url, function(data){
	    	var uData = jQuery.parseJSON(data);
	    	console.log(uData);
	    	$('#userEventId').val(uData.uEventId);
	    	$('#userFirstName').val(uData.uFName);
	    	$('#userLastName').val(uData.uLName);

	    	$('#userDob').val(uData.uDob);
	    	$('#userMail').val(uData.uMail);
	    	$('#userAddress').val(uData.uAddress);
	    	$('#userPhone').val(uData.uPhone);
	    	$('#blah').attr('src',"{{url('')}}/"+uData.uPic);
	    	
	    	$("#userCompany option[value='"+uData.uCompanyId+"']").attr("selected", true);
	    	$("#userEventType option[value='"+uData.uRol+"']").attr("selected", true);
	    });
    	$('#user-modal-title').text('Editar Usuario');
    	$('#userId').val(uId);
    	
    }
    $('#pictureChanged').val(0);
	$('#large').modal('show');

	/*$('#myModal').modal('hide');*/	
};	


function loadPicture(event){
var selectedFile = event.target.files[0];
	var inputLength = $("#userProfileImage").size();


    if(inputLength > 0){
    	$('#pictureChanged').val(1);
    	document.getElementById('blah').src = window.URL.createObjectURL(selectedFile);
    }
    else{
    	$('#pictureChanged').val(0);	
    }
	
}

</script>
<!-- END EDIT USER (FORM) -->

<!-- DELETE USER -->
 <script type="text/javascript">
 	$("body").on("click", ".sweet-8", function() {

 		var row = $(this).parent().parent();
 		var tablebody = $("#asigned-users tbody");
		var uId = $(this).closest('tr').children('td.id').text();
		
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
			        	if(response.status == 'success'){
				        	row.remove();
				            swal("Eliminado!", response.message, "success");
				            if (tablebody.children().length == 0) {
							    tablebody.html("<tr class='table-empty'><td colspan='6' class='text-center'>No existen usuarios asignados al evento!</td></tr>");
							}
						}else if(response.status == 'error'){
							swal("Error", response.message, "warning");
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
