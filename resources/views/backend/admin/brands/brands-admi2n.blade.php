@extends('layouts.admin.app')


@section('content')
	<div class="page-bar">
	    <ul class="page-breadcrumb">
	        <li>
	            <a href="{{ route('full-admin-home')}}">Inicio</a>
	            <i class="fa fa-circle"></i>
	        </li>
	        <li>
	        	<a href="{{ route('full-admin-home')}}">Administración</a>
	            <i class="fa fa-circle"></i>
	        </li>
	        <li>
	        	<a href="{{ route('full-admin-home')}}">Usuarios</a>

	        </li>
	           
	    </ul>
	</div>
	<div class="page-title">
		<h3><i class="fa fa-users"></i> Administración de Usuarios </h3>
	</div>

	<div class="row" style="margin-top: -10px">
		<div class="portlet box blue-hoki ">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-users"></i> Usuarios </div>
                <div class="actions">
                    
                    <a href="javascript:userEdit(1,1);" class="btn btn-default btn-sm">
                        <i class="fa fa-plus"></i> Crear Nuevo </a>
                </div>
            </div>
            <div class="portlet-body">
            <div class="row">
            	<div class="col-md-12 nopadding">
            		<h4 style="font-weight: 600">Filtros de búsqueda</h4>
            		<form>
		            	<div class="col-md-6">
		            		<label for="roleFilter">Permisos</label>
		            		<select id="roleFilter" name="roleFilter" class="bs-select form-control bs-select-36">
		            			<option value="0">Todos</option>
		            			@foreach($roles as $rol)
		            				<option value="{{$rol->id}}">{{$rol->roleName}}</option>
		            			@endforeach
		            		</select>
		            	</div>
		            	<div class="col-md-6">
		            		<label for="roleFilter">Estado</label>
		            		<select id="statusFilter" name="statusFilter" class="bs-select form-control bs-select-36">
		            			<option value="0">Todos</option>
		            			<option value="1">Activos</option>
		            			<option value="2">Inactivos</option>
		            			
		            		</select>
		            	</div>
		            	<br><br>
		            	<div class="col-md-10" style="margin-top: 20px; margin-bottom: 20px">
		            		<label for="textFilter">Filtro de texto (Nombres / Email)</label>
		            		<input type="text" name="textFilter" class="form-control">
		            	</div>
		            	<div class="col-md-2">
		            		<button class="btn pull-right" style="margin-top: 45px"><i class="fa fa-search"></i> Buscar</button>
		            	</div>
	            	</form>
            		
					<div class="table-scrollable">
			            <table id="asigned-users" class="table table-hover">
			                <thead>
			                    <tr>
			                        <th> Correo </th>
			                        <th> Nombre </th>
			                        <th> Permisos </th>
			                        <th> Estado </th>
			                        <th> Opciones </th>
			                    </tr>
			                </thead>
			                <tbody>
			                	@foreach($users as $user)
			                        <tr>
			                        
			                            <td> {{ $user->Email }}</td>
			                            <td> {{ $user->FName}} {{ $user->LName }} </td>
			                            <td> {{ $user->Role }} </td>
			                            <td> Activo <button id="sweet-8" class="btn btn-xs btn-default sweet-8" onclick="_gaq.push(['_trackEvent', 'exit', 'footer', 'Lipis']);"><i class="fa fa-user-times"></i></button> </td>
			                            <td class="{{ $user->ID}}"> 
			                            	<a href="javascript:userEdit(2,{{ $user->ID}});" id="edit-btn" class="btn btn-xs btn-default"><i class="fa fa-edit"></i>Editar</a> 
			                            	
			                            </td>
			                        </tr>
			                    @endforeach
			                 </tbody>
			            </table>
			        </div>
		        </div>
		    </div> <!-- end portlet body -->
		</div>

		</div> <!-- end portlet -->
	</div>






 <div class="modal fade bs-modal-xl fade2" id="large" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 id="user-modal-title" class="modal-title">Editar Usuario</h4>
                <p id="user-modal-tip">Ingresa los datos para el nuevo usuario</p>
            </div>
            <div class="modal-body"> 


            	<form id="form-user-create" class="form-horizontal" method="POST" role="form" action="{{ route('admin-user-store') }}">
                	<!-- BEGIN FORM BODY -->
                	<div class="form-body">
                		
                		 {{ csrf_field() }}
                		<input id="action" name="action" type="hidden" class="form-control">
                		<input id="userId" name="userId" type="hidden" class="form-control"> 
                		<input id="tableRow" name="tableRow" type="hidden" class="form-control"> 
                		<div class="form-group custom-form-group">
	                        
	                       	<div class="col-md-6">
	                           <input id="userFirstName" name="userFirstName" type="text"  class="form-control custom-form-control" placeholder="Nombres"/>
	                      	</div>
	                      	<div class="col-md-6 top-10">
	                           <input id="userLastName" name="userLastName" type="text"  class="form-control custom-form-control" placeholder="Apellidos"/>
	                        </div>
	                    </div>
	                    <div class="form-group custom-form-group">
	                        <div class="col-md-12">
	                        	<div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
	                           		<input id="userDob" name="userDob" class="form-control form-control-inline input-medium date-picker custom-form-control" size="16" type="text" value="" style="width: 100% !important" placeholder="Fecha de Nacimiento dd/mm/aaaa" />
	                       		</div>
	                        </div>
	                    </div>


	                    <div class="form-group custom-form-group">
	                     
	                        <div class="col-md-12">
	                         
	                           <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-envelope"></i>
                                                        </span>
                                                        <input id="userMail" name="userMail" type="text" class="form-control custom-form-control" placeholder="myuseremail@yourmail.com"> </div>
	                        </div>
	                    </div>

	                    <div class="form-group custom-form-group">
	                      
	                        <div class="col-md-12">
	                           <input id="userOccupation" name="userOccupation" type="text"  class="form-control custom-form-control" placeholder="Ocupación"/>
	                        </div>
	                    </div>

	                    <div class="form-group custom-form-group">
                        
                            <div class="col-md-12">
                            	<div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-unlock-alt"></i>
                                    </span>
	                                	
	                                 
	                                 <select id="roleType" name="roleType" class="form-control">
                                            <option value="0">Permisos</option>

	                                    @foreach($roles as $rol)
	                                    	<option value="{{ $rol->id}} ">{{ $rol->roleName }}</option>
	                                    @endforeach
                                     </select>
                            </div>
                            </div>
                        </div>

	                    <div class="form-group custom-form-group">
	                      
	                        <div class="col-md-12">
	                           <input id="userCompany" name="userCompany" type="text"  class="form-control custom-form-control" placeholder="Empresa a la que representa/pertenece"/>
	                        </div>
	                    </div>



	                    <div class="form-group custom-form-group">
	                   
	                        <div class="col-md-6">
	                        	<div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-map"></i>
                                    </span>
	                           		<input id="userAddress" name="userAddress" type="phone"  class="form-control custom-form-control" placeholder="Dirección"/>
	                           	</div>
	                        </div>
	                        <div class="col-md-6">
	                        	<div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-phone"></i>
                                    </span>
	                           		<input id="userPhone" name="userPhone" type="phone"  class="form-control custom-form-control" placeholder="Teléfono"/>
	                           	</div>
	                        </div>
	                    </div>

	                    <div class="form-group custom-form-group">
	                        <label class="col-md-3 control-label" for="eventFacebookLink">Imágen<span class="required" aria-required="true"> * </span></label>
	                        <div class="col-md-5">
	                        	<input id="productPicture" name="productPicture" type="file" class="form-control" placeholder="Imagen de Producto" accept="image/*" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])" multiple="false" required>
	                        </div>
	                        <div class="col-md-4" style="border: 1px dotted grey; height: 105px; text-align: center; vertical-align: middle;">
	                        	<img id="blah" alt="imagen del producto" height="100" style="" />
	                        </div>
	                    </div>

	                    <div class="form-group custom-form-group">
                        
                            <div class="col-md-12">
                            	<div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-unlock-alt"></i>
                                    </span>
	                                	
	                                 
	                                 <select id="roleType" name="roleType" class="form-control">
                                            <option value="0">Permisos</option>

	                                    @foreach($roles as $rol)
	                                    	<option value="{{ $rol->id}} ">{{ $rol->roleName }}</option>
	                                    @endforeach
                                     </select>
                            </div>
                            </div>
                        </div>

                        

	                    
                	</div> 
                	<!-- END FORM BODY -->  
                	<div class="modal-footer">
                                                
			
                	<button type="submit" class="btn green pull-right">Guardar Cambios</button>                            	
				    <button type="button" class="btn dark btn-outline pull-right" style="margin-right: 10px" data-dismiss="modal">Cerrar</button>
					</div>
                </form>

            </div>
            
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>  
<!-- /.modal-fade end --> 





@endsection

@section('scripts')
<script type="text/javascript" src="{{ URL::asset('metronic/scripts/bootstrap-daterangepicker/daterangepicker.min.js')}}"></script>
<script type="text/javascript" src="{{ URL::asset('metronic/scripts/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
<script type="text/javascript" src="{{ URL::asset('metronic/scripts/bootstrap-timepicker/js/bootstrap-timepicker.min.js')}}"></script>
<script type="text/javascript" src="{{ URL::asset('metronic/scripts/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js')}}"></script>
<script type="text/javascript" src="{{ URL::asset('metronic/scripts/clockface/js/clockface.js')}}"></script>
<script type="text/javascript" src="{{ URL::asset('metronic/scripts/components-date-time-pickers.min.js')}}"></script>
<script type="text/javascript" src="{{ URL::asset('metronic/scripts/ui-buttons-spinners.min.js')}}"></script>
<script type="text/javascript" src="{{ URL::asset('metronic/global/plugins/bootstrap-toastr/toastr.min.js')}}"></script>

<script>
jQuery(document).ready( function($) { 
$("#roleType").select2({
	dropdownCssClass : 'no-search',
	width: '100%',
});
});
</script>


<!-- BEGIN CREATE/EDIT USER  (FORM) -->
<script>
function userEdit(act, uId){

	var row = $('.'+uId).closest('tr').index();
	//console.log(row);
	/*$('#page-overlay').fadeIn('slow');*/

		
    
    $('#action').val(act);
    $('#userId').val(uId);
    $('#tableRow').val(row);
    if(act == 1)
    {
    	$('#form-user-create').trigger("reset");
    	$('#user-modal-title').text('Crear Nuevo Usuario');
    	$('#user-modal-tip').text('Ingresa los datos para el nuevo usuario.');
    	
    	$('#roleType')[0].selectedIndex = 0;
    	$('#roleType').trigger('change');
    	
    	
    }
    if(act == 2)
    {
    	url= "{{ url('admin/users/geteditdata')}}"+"/"+uId;
	    $.get(url, function(data){
	    	var uData = jQuery.parseJSON(data);
	    	console.log(uData);
	    	$('#user-modal-title').text('Editar Usuario');
    	$('#user-modal-tip').text('Modifica los datos del usuario.');
    	$('#userId').val(uId);
    	$('#userFirstName').val(uData.userFirstName);
    	$('#userLastName').val(uData.userLastName);
    	$('#userDob').val(uData.userDob);
    	$('#userMail').val(uData.userEmail);
    	$('#userAddress').val(uData.userAddress);
    	$('#userPhone').val(uData.userPhone);
    	
    	
    	$('#roleType')[0].selectedIndex = uData.userRole;
    	$('#roleType').trigger('change');
       
    	
    	
	    });
    	


    }
	$('#large').modal('show');
	
	/*$('#myModal').modal('hide');*/	
};	
 $('#large').on('shown.bs.modal', function () {
 $('#userFirstName').focus();
})
</script>
<!-- END EDIT USER (FORM) -->

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
			row = $('#tableRow').val();
			var newRow = + row + 1;
			$('#asigned-users tr:eq('+newRow+')').addClass('table-row-editing');
			
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
            var btn='<button class="btn btn-xs btn-default sweet-8" onclick='+safunction+' ><i class="fa fa-user-times"></i> Inhabilitar</button>';
            
            
            if(action == 1)
			{
				

				if(uData.status=='success')
				{

				$('#overlay-msg').text(uData.msg);
				$('#asigned-users tbody').append("<tr><td> "+ uData.uMail +" </td><td>"+ uData.uName + "</td><td>"+ uData.uPermission +"</td><td>Activo "+ btn +"</td><td class='"+uData.uId+"'> <a href='javascript:userEdit(2,1);' id='edit-btn' class='btn btn-xs btn-default'><i class='fa fa-edit'></i>Editar</a> </td></tr>");

				}
				if(uData.status=='exists')
				$('#overlay-msg').text(uData.msg);

				$.toaster({ priority : 'success', title : 'Notice', message : 'Your message here'});
				
			}
			else{
				$('#overlay-msg').text('Usuario editado con éxito');
				
				var newRow = + row + 1;
				$('#asigned-users tr:eq('+newRow+') td').eq(0).text(uData.uMail);
				$('#asigned-users tr:eq('+newRow+') td').eq(1).text(uData.uName);
				$('#asigned-users tr:eq('+newRow+') td').eq(2).text(uData.uRole);
			}

		 	setTimeout(function(){
		  		$('#page-overlay').fadeOut('slow');
			}, 1000);    
          }
        });
	});	


</script>
<!-- END CREATE NEW USER (FORM) -->


<!-- DELETE USER -->
 <script type="text/javascript">
 	$("body").on("click", ".sweet-8", function() {
 		var row = $(this).parent().parent();
 		var tablebody = $("#asigned-users tbody");
		var uId = $(this).closest('tr').children('td.id').text();;
        swal({
		  title: "Confirmar",
		  text: "Está seguro de Inhabilitar el usuario seleccionado?",
		  type: "warning",
		  showCancelButton: true,
		  cancelButtonText: "Cancelar",
		  confirmButtonClass: "btn-danger",
		  confirmButtonText: "Deshabilitar",
		  closeOnConfirm: false,

		},
		
		function(isConfirm){
			if (isConfirm) {
				$.ajax(
			    {
			        url: "{{ url('expositor/admin/users/disable/')}}/"+uId,
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

@endsection