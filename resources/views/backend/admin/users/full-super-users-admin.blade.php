@extends('layouts.expositor.app')
@section('css')
<link rel="stylesheet" href="{{ asset('css/cards.css')}}" type="text/css" />
<link rel="stylesheet" href="{{ asset('metronic/css/tagsinput.css')}}" type="text/css" />
<link rel="stylesheet" href="{{ asset('metronic/css/select2/css/select2.min.css')}}" type="text/css" />
<link rel="stylesheet" href="{{ asset('metronic/css/select2/css/select2-bootstrap.min.css')}}" type="text/css" />
@endsection
@section('content')

<div class="page-title">
	<h3><!--<i class="fa fa-edit"></i>--> Usuarios  </h3>
</div>
<div class="page-bar">
	<ul class="page-breadcrumb">
	    <li>
	        <a href="#">Inicio</a>
	        <i class="fa fa-angle-right"></i>
	    </li>
        <li>
            <a href="#">Administración de Usuarios</a>
            
        </li>
	    
	</ul>
	
</div>
<div class="row">
	<div class="col-md-12" style="padding-left: 0px; padding-right: 0px">
		
		<div class="portlet light bordered">
	        <!--<div class="portlet-title">
	            <div class="caption font-green-haze">
	                <i class="icon-settings font-green-haze"></i>
	                <span class="caption-subject bold uppercase"> Usuarios del Evento</span>
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
	               <!-- <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
	            </div>
	        </div> -->
	        <div class="portlet-body form">
	        	<div class="row">

	        		<div class="col-md-12">
	        			<form role="form" method="POST" action="{{route('full-users-admin')}}">
			              	{{ csrf_field() }}
	    		    		
	    		    		<div class="col-md-12">
	                			<label for="searchParams">Ingrese correo/nombres del usuario  </label>
	                			<input class="form-control" id="searchParams" name="searchParams"><br>
	                		</div>
	                		<div class="col-md-12">
	    						<button style="margin-top:-5px" id="btn-send-invitations" type="submit" class="btn blue-soft btn-md pull-left" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Enviado ticket(s)..."><i class="fa fa-search"></i> Buscar Usuario</button>
	    					</div>
		  				  </form>

	        		</div>
	        		


	        		<div class="col-md-12 col-sm-12">
				         <div class="clear"></div>
        				<!-- BEGIN ACCORDION PORTLET-->
		               <!-- <div class="panel-group accordion scrollable" id="accordion2">
		                    <div class="panel panel-default">
		                        <div class="panel-heading">
		                            <h4 class="panel-title">
		                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse_2_1" aria-expanded="true"> Acciones </a>
		                            </h4>
		                        </div>
		                        <div id="collapse_2_1" class="panel-collapse in">
		                            <div class="panel-body"> -->
		                            	<!--<div class="col-md-6 col-sm-12">
			                               	<form role="form" class="form-horizontal">
								                <div class="form-body">
								                	 <select id="itemName" class="itemName form-control" style="width:500px;" name="itemName"></select>
								                </div>
								            </form>
							        	</div> -->
							        	<div class="col-md-12 col-sm-12">
							        		<form role="form" class="form-horizontal">
								                <div class="form-body">
								                	 <a href="javascript:userEdit(1,1);"  class="btn green pull-right"><i class="fa fa-plus"></i> Crear Nuevo Usuario</a>
								                </div>
							            	</form>
							        	</div>
		                            <!--</div>
		                        </div>
		                    </div>
		                </div> -->
			            
			        </div><br><br>

			        <div class="col-md-12 col-sm-12" style="margin-top: 20px">
			        	<div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Usuarios asignados al evento</h3>
                            </div>
                            <div class="panel-body"> 

                            	<!-- BEGIN SAMPLE TABLE PORTLET-->
                                
                                <div class="table-scrollable">
                                    <table id="asigned-users" class="table table-striped  table-hover  order-column" style="width: 100%">
                                        <thead>
                                            <tr>
                                            	<th style="display: none" class="hidden"> ID</th>
                                            	<th> Imagen </th>
                                                <th> Correo </th>
                                                <th> Nombre </th>
                                              
                                                <th> Permisos </th>
                                                <th> Opciones </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	@foreach($users as $uAsigned)
	                                            <tr>
	                                            	<td class="id {{$uAsigned->ASIGID}}" style="display: none">{{ $uAsigned->ASIGID}}</td>
	                                            	<td style="vertical-align: middle"> <img src="{{url('/')}}/images/users/profiles/{{$uAsigned->PICTURE}}" width="50"></td>
	                                                <td> {{ $uAsigned->EMAIL }}</td>
	                                                <td> {{ $uAsigned->FIRSTNAME}} {{ $uAsigned->LASTNAME }} </td>
	                                               
	                                                <td> Super Administrador </td>
	                                                <td>
	                                                	@if($uAsigned->TYPEID != 1)
		                                                	<a href="javascript:userEdit(2,{{ $uAsigned->ASIGID}});" id="edit-btn" class="btn btn-xs btn-default"><i class="fa fa-edit"></i>Editar</a> 
		                                                	<form id="form-badge" method="post" action="{{url('administracion/usuarios/gafete')}}" target="_blank">
			                                                		{{ csrf_field() }}
			                                                		<input type="hidden" id="allUsersBadge" name="allUsersBadge" value="1">
			                                                		<input type="hidden" name="userBId" id="userBId" value="{{$uAsigned->ID}}">
			                                                		<input type="hidden" name="type" value="user">
			                                                		
			                                                	<button type="submit" id="getQr2" class="btn btn-xs btn-default getQr"><i class="fa fa-list-alt"></i> Actualizar Badge</button>
			                                                	</form> 
		                                                	<!--<button id="sweet-8" class="btn btn-xs btn-default sweet-8"><i class="fa fa-trash"></i> Eliminar</button>-->
		                                                @endif

		                                                <form id="form-qr" method="post" action="{{url('admin/qrs/generate')}}" target="_blank">
		                                                		{{ csrf_field() }}
		                                                		<input type="hidden" name="id" value="{{$uAsigned->ASIGID}}">
		                                                		<input type="hidden" name="type" value="user">
		                                                	<button type="submit" id="getQr2" class="btn btn-xs btn-default getQr"><i class="fa fa-qrcode"></i> Generar QR</button>
		                                                </form>

		                                                @if($uAsigned->TYPEID != 1)

		                                                	<form id="form-pass" method="post" action="{{url('admin/qrs/generate')}}" target="_blank">
		                                                		{{ csrf_field() }}
		                                                		<input type="hidden" name="id" value="{{$uAsigned->ASIGID}}">
		                                                		<input type="hidden" name="type" value="user">
		                                                		<a href="javascript:resetPassword({{$uAsigned->ID}});" type="submit" id="getQr2" class="btn btn-xs btn-default getQr"><i class="fa fa-key"></i> Reestablecer Contraseña</a>
		                                                	</form> 
	                                                	@endif
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

	    <div class="modal fade bs-modal-lg create-modal" id="large" tabindex="-1" role="dialog" aria-hidden="true">
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
			                                		
			                                		
			                                		<div class="form-group custom-form-group">
								                        <label class="col-md-3 control-label" for="userFirstName">Nombre <span class="required" aria-required="true"> * </span></label>
								                        <div class="col-md-9">
								                           <input id="userFirstName" name="userFirstName" type="text"  class="form-control" placeholder="Nombres del usuario" required maxlength="50" />
								                        </div>
								                    </div>

								                     <div class="form-group custom-form-group">
								                        <label class="col-md-3 control-label" for="userLastName">Apellido <span class="required" aria-required="true"> * </span></label>
								                        <div class="col-md-9">
								                           <input id="userLastName" name="userLastName" type="text"  class="form-control" placeholder="Apellidos del usuario" required maxlength="50"/>
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
								                        <label class="col-md-3 control-label" for="userMail">Email <span class="required" aria-required="true"> * </span></label>
								                        <div class="col-md-9">
								                           <input id="userMail" name="userMail" type="text"  class="form-control" placeholder="user@mymail.com" required maxlength="100"/>
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
								                        <label class="col-md-3 control-label" for="userAddress">Dirección <span class="required">  </span></label>
								                        <div class="col-md-9">
								                           <input id="userAddress" name="userAddress" type="text"  class="form-control" placeholder="" maxlength="150"/>
								                        </div>
								                    </div>

								                    <div class="form-group custom-form-group">
								                        <label class="col-md-3 control-label" for="userPhoneCode">Teléfono <span class="required" ></span></label>
								                        <div class="col-md-3">
								                        	<input type="text" name="userPhoneCode" id="userPhoneCode" class="form-control" maxlength="10" placeholder="Páis Ej: +502" value="+502">
								                        </div>
								                        <div class="col-md-6">
								                           <input id="userPhone" name="userPhone" type="text"  class="form-control" placeholder="50504040" maxlength="15" />
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
								                    <button id="btn-create-user" type="submit" class="btn green pull-right" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Registrando Usuario...">Registrar Usuario</button>                            	
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
			                       
			                           <input id="userAsignedFirstName" name="userAsignedFirstName" type="text"  class="form-control form-control-show" placeholder="Nombres del usuario" maxlength="50" style="background-color: lightgray" />
			                        
			                    </div>

			                    <div class="form-group custom-form-group">
				                        <label class="control-label" for="userAsignedLastName">Apellidos <span class="required" aria-required="true"> * </span></label>
			                        
			                           <input id="userAsignedLastName" name="userAsignedLastName" type="text"  class="form-control form-control-show" placeholder="Nombres del usuario"  maxlength="50" style="background-color: lightgray" />
			                        
			                    </div>

			                    <div class="form-group custom-form-group">
			                        <label class="control-label" for="userAsignedEmail">Correo Electrónico <span class="required" aria-required="true"> * </span></label>
			                       
			                           <input id="userAsignedEmail" name="userAsignedEmail" type="text"  class="form-control form-control-show" placeholder="Email del usuario" maxlength="100" style="background-color: lightgray" />
			                       
			                    </div>
		                    
		                	</div>

		                	<div class="form-group custom-form-group">
		                    	<div class="col-md-4">
			                        <label class="control-label" for="userAsignedPhoneCode">Código País <span class="required" ></span></label>
			                        
			                        <input type="text" name="userAsignedPhoneCode" id="userAsignedPhoneCode" class="form-control" maxlength="10" placeholder="Páis Ej: +502" value="+502" style="margin-top: -15px;">
		                        </div>
		                        <div class="col-md-8">
		                        	 <label class="control-label" for="userAsignedPhoneCode">Teléfono <span class="required" ></span></label>
		                           <input id="userAsignedPhone" name="userAsignedPhone" type="text"  class="form-control" placeholder="50504040" maxlength="15" style="margin-top: -15px;" />
		                        </div>
		                    </div>

		                    <hr>
		                    <h4>
		                    <div class="form-group custom-form-group">
		                    	<h4>Datos para el evento</h4>
		                    </div>
		                    
		                    <br><br>
	                         <button id="btn-assign-user" type="submit" class="btn green pull-right" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Agregando Usuario...">Agregar Al Evento</button>                            	
			                                		<button type="button" class="btn dark btn-outline pull-right" style="margin-right: 10px" data-dismiss="modal">Cerrar</button>
                    	</form>
                    </div> <!--End modal body -->
                    
					  </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>  
 <!-- /.modal-fade end --> 
 		   <!-- QR MODAL -->
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
@endsection
@section('scripts')
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
<!-- Datatable 
<script>
    
jQuery(document).ready( function($) {
 myTable =   $('#asigned-users').DataTable( {
        
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
</script> -->

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
	    	
	    	$('#userAsignedFirstName').val(uData.uFName);
	    	$('#userAsignedLastName').val(uData.uLName);

	    	$('#userAsignedEmail').val(uData.uMail);
	    	$('#userMail').val(uData.uMail);
	    	$('#userAsignedId').val(uData.uId);
		    
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


        $('#userPhone').keypress(function(event){
            /*console.log(event.which);*/
        if((event.which != 8 && isNaN(String.fromCharCode(event.which))) || event.which ==32){
            event.preventDefault();
        }});
</script>



<!-- BEGIN CREATE NEW USER (FORM) -->
<script>
	jQuery(document).ready( function($) {
		$( "#form-user-create" ).submit(function( event ) {
			event.preventDefault();
			var $btnc = $('#btn-create-user');
			$btnc.button('loading');
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
	          
	            /*var safunction = "'_gaq.push(['_trackEvent', 'exit', 'footer', 'Lipis']);'";*/
	            var btn3='<button class="btn btn-xs btn-default sweet-8"><i class="fa fa-trash"></i> Eliminar</button>';
	            
	            
	            if(action == 1)
				{

					if(uData.status=='success')
					{
				    var img = "{{url('/')}}/"+uData.uPic;
					var itoken = '{{ csrf_field() }}';
					var btn = "<form id='form-badge' method='post' action='{{url('administracion/usuarios/gafete')}}' target='_blank'>"+itoken+"<input type='hidden' id='allUsersBadge' name='allUsersBadge' value='1'><input type='hidden' name='userBId' id='userBId' value='" + uData.uId + "'><input type='hidden' name='type' value='user'><input type='hidden' name='eventBId' id='eventBId' value=''><button type='submit' id='getQr2' class='btn btn-xs btn-default getQr'><i class='fa fa-list-alt'></i> Actualizar Badge</button></form>";
				   

	                $('#asigned-users tbody').append("<tr><td class='id"+uData.uId+"' style='display:none'>" + uData.uId + "</td>6<td><img  src='"+ img +"' width='50'></td><td>"+ uData.uMail +"</td><td> "+ uData.uName +" </td><td>"+uData.uCompany+"</td><td>"+uData.uPermission+"</td><td><a href='javascript:userEdit(2,"+uData.uId+");' id='edit-btn' class='btn btn-xs btn-default'><i class='fa fa-edit'></i>Editar</a> "+ btn + "<form id='form-qr' method='post' action='{{url('admin/qrs/generate')}}' target='_blank'>"+ itoken +" <input type='hidden' name='id' value='"+ uData.uId +"'> <input type='hidden' name='type' value='user'> <button type='submit' id='getQr2' class='btn btn-xs btn-default getQr'><i class='fa fa-qrcode'></i> Generar QR</button> </form><form id='form-pass' method='post' action='{{url('admin/qrs/generate')}}' target='_blank'>"+itoken +"<input type='hidden' name='id' value='"+ uData.uId +"'><input type='hidden' name='type' value='user'><a href='javascript:resetPassword("+ uData.uId +");' type='submit' id='getQr2' class='btn btn-xs btn-default getQr'><i class='fa fa-key'></i> Reestablecer Contraseña</a></form></td></tr>"); //test


	                var rId = uData.uId;
	               
	             /*   $( rowNode ).find('td').eq(0).addClass(""+rId);*/

	                setTimeout(function(){
							$('#page-overlay').fadeOut('slow');
							$('#large').modal('hide');
							 $btnc.button('reset');
							Command: toastr["success"]("Se ha registrado correctamente el usuario!", "Mensaje");

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
					if(uData.status=='exists'){
						$('#overlay-msg').text(uData.msg);
					    $('#userAsignedFirstName').val(uData.uFName);
					    $('#userAsignedLastName').val(uData.uLName);
					    $('#userAsignedEmail').val(uData.uMail);
					    $('#userAsignedId').val(uData.uId);
					    $('#userAsignedPhoneCode').val(uData.uPhoneCode);
					    $('#userAsignedPhone').val(uData.uLPhone);
					    
					    $('#userAsignedId').val(uData.uId);
			    		
		    			$('#userPicAss').attr('src',"{{url('')}}/"+uData.uPic);
		    			$('#userAsignedCompany').val(0);
		    			$('#userAsignedEventType').val('');

				    	console.log(uData);
				    	$('#large').modal('hide');
				    	 $btnc.button('reset');
						$('#asign-user').modal('show');
					}

					if(uData.status=='ueexists'){
						$('#page-overlay').fadeOut('slow');
						$('#large').modal('hide');
						 $btnc.button('reset');
						swal({
						  title: "Alerta",
						  text: "El correo que intenta registrar ya se encuentra en este evento",
						  type: "warning",
						  showCancelButton: true,
						  cancelButtonText: "Cerrar",
						  confirmButtonClass: "btn-danger",
						  confirmButtonText: "Ver usuario",
						  closeOnConfirm: true,

							},  function(isConfirm){
								if (isConfirm) {
									$('input[type=search]').val(uData.uMail).trigger($.Event("keypress", { keyCode: 13 }));
									$('input[type=search]').select();
								}
						});
					}


					
				}
				else{
					row = $('#tableRow').val();
					var newRow = ++row;
					var img = "{{url('/')}}/"+uData.uPic;
					$('#asigned-users tr:eq('+newRow+') td').eq(0).text(uData.uId);
					$('#asigned-users tr:eq('+newRow+') td').eq(1).html("<img  src='"+ img +"' width='50'>");
					$('#asigned-users tr:eq('+newRow+') td').eq(2).text(uData.uMail);
					$('#asigned-users tr:eq('+newRow+') td').eq(3).text(uData.uName);
					$('#asigned-users tr:eq('+newRow+') td').eq(4).text(uData.uCompany);
					$('#asigned-users tr:eq('+newRow+') td').eq(5).text(uData.uPermission);
					
					


					//alert(row);
					$('#asigned-users tr:eq('+newRow+')').addClass('table-row-editing');
					$('#overlay-msg').text('Usuario editado con éxito');
					  setTimeout(function(){
							$('#page-overlay').fadeOut('slow');
							$('#large').modal('hide');
							 $btnc.button('reset');
							 $('#asigned-users tr:eq('+newRow+')').addClass('table-row-editing');
							Command: toastr["success"]("Se ha editado correctamente el usuario!", "Mensaje");

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

			 	   
	          	
	          },
	           error: function(XMLHttpRequest, textStatus, errorThrown) { 
	        	/*alert("Status: " + textStatus); alert("Error: " + errorThrown);*/ 

	        	setTimeout(function(){
							$('#page-overlay').fadeOut('slow');
							$('#large').modal('hide');
							 $btnc.button('reset');
							Command: toastr["success"](textStatus + ' ' + errorThrown , "Error");

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


	        });
		});	


		$("#form-user-assign" ).submit(function( event ) {
				event.preventDefault();
				var data = new FormData($(this)[0]);
				/*alert (data);*/
				var $btna = $('#btn-assign-user');
				$btna.button('loading');
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
		      		/*	var t = $('#asigned-users').DataTable();
		      			var img = "{{url('/')}}/"+uData.uPic;
		      			var btn='<button class="btn btn-xs btn-default sweet-8"><i class="fa fa-trash"></i> Eliminar</button>';
		                var rowNode = t.row.add( [
		                    uData.uId,
		                    "<img  src='"+ img +"' width='50'>",
		                    uData.uMail,
		                    uData.uName,
		                    uData.uCompany,
		                    uData.uPermission,
		                    "<a href='javascript:userEdit(2,"+uData.uId+");' id='edit-btn' class='btn btn-xs btn-default'><i class='fa fa-edit'></i>Editar</a> "+ btn + "<a href='javascript:generateQr(" + uData.uId + ");' id='edit-btn' class='btn btn-xs btn-default'><i class='fa fa-qrcode'></i> Generar QR</a>" 
		                ] ).draw().node(); */

		             /*   $('#asigned-users tbody').append("<tr><td class='id"+uData.uId+"' style='display:none'>" + uData.uId + "</td>6<td><img  src='"+ img +"' width='50'></td><td>"+ uData.uMail +"</td><td> "+ uData.uName +" </td><td>"+uData.uCompany+"</td><td>"+uData.uPermission+"</td><td><a href='javascript:userEdit(2,"+uData.uId+");' id='edit-btn' class='btn btn-xs btn-default'><i class='fa fa-edit'></i>Editar</a> "+ btn + "<form id='form-qr' method='post' action='{{url('admin/qrs/generate')}}' target='_blank'>"+ itoken +" <input type='hidden' name='id' value='"+ uData.uId +"'> <input type='hidden' name='type' value='user'> <button type='submit' id='getQr2' class='btn btn-xs btn-default getQr'><i class='fa fa-qrcode'></i> Generar QR</button> </form><form id='form-pass' method='post' action='{{url('admin/qrs/generate')}}' target='_blank'>"+itoken +"<input type='hidden' name='id' value='"+ uData.uId +"'><input type='hidden' name='type' value='user'><a href='javascript:resetPassword("+ uData.uId +");' type='submit' id='getQr2' class='btn btn-xs btn-default getQr'><i class='fa fa-key'></i> Reestablecer Contraseña</a></form></td></tr>");
*/



		      			
		      			 setTimeout(function(){
								$('#page-overlay').fadeOut('slow');
								$('#asign-user').modal('hide');
								 $btna.button('reset');
								Command: toastr["success"]("Se ha registrado correctamente el usuario en el evento!", "Mensaje");

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
		      		},
		      		error: function(XMLHttpRequest, textStatus, errorThrown) { 
		        		alert("Status: " + textStatus); alert("Error: " + errorThrown); 
				 		setTimeout(function(){
				  		$('#page-overlay').fadeOut('slow');
						}, 1000);  
		    		}   
		    	}); 
		});

	});
</script>
<!-- END CREATE NEW USER (FORM) -->

<!-- LOAD PICTURE -->
<script>
	
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



<!-- BEGIN EDIT USER (FORM) -->
<script>
 
function userEdit(act, uId){

	
	/*$('#page-overlay').fadeIn('slow');*/
    $('#form-user-create').trigger("reset");
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
	    	
	    	$('#userFirstName').val(uData.uFName);
	    	$('#userLastName').val(uData.uLName);

	    	$('#userDob').val(uData.uDob);
	    	$('#userMail').val(uData.uMail);
	    	$('#userAddress').val(uData.uAddress);
	    	$('#userPhone').val(uData.uPhone);
	    	$('#userPhoneCode').val(uData.cCode);
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

</script>
<!-- END EDIT USER (FORM) -->

<!-- DELETE USER -->
 <script type="text/javascript">
 	$("body").on("click", ".sweet-8", function() {

 		
 		var tablebody = $("#asigned-users tbody");
		var uId = $(this).closest('tr').children('td.id').text();
		
		var t = $('#asigned-users').DataTable();
		var row = t.row($(this).parents('tr'));

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
			        		console.log(response.status);
				        	row.remove().draw(false);
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

 <!-- Print QR CODE -->
<script>
function generateQr(id){
	var type = "users";
	
	
	
 	$.ajax({
        url: "{{url('admin/qrs/generate')}}",
        type: 'POST', // replaced from put
        dataType: "JSON",
        data: {
            "id": id,
            "type": type, // method and token not needed in data
        },
        success: function (response)
        {
        	
        	 $(".qrcode").html(response.html); 

        	var content = $('.qrcode').html();
			var mywindow = window.open('', 'Print', 'height=800,width=1200');

		    mywindow.document.write('<html><head><title>Print</title>');
		    mywindow.document.write('</head><body >');
		    mywindow.document.write(content);
		    mywindow.document.write('</body></html>');

		    mywindow.document.close();
		    mywindow.focus()
		    mywindow.print();
		    mywindow.close();
			 
        	/* $('#modal-qr').modal('show');*/
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
}


 </script>	


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
				    
		
</script>	 	    	
<script>
function testAnim(x) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog  ' + x + '  animated');
};
$('#large').on('show.bs.modal', function (e) {
  var anim = 'bounceIn';
      testAnim(anim);
})
$('.create-modal').on('hide.bs.modal', function (e) {
  var anim = 'bounceOut';
      testAnim(anim);
})
</script>-->
<script>
	function resetPassword(uId){


	    swal({
		  title: "Advertencia",
		  text: "Está seguro de Reestablecer la contraseña?",
		  type: "info",
		  confirmButtonText: "Si, reestablecer!",
		  cancelButtonText: "Cancelar",
		  showCancelButton: true,
		  closeOnConfirm: false,
		  showLoaderOnConfirm: true
		}, function () {

		$.ajax({
	        url: "{{url('admin/visitors/password/reset')}}",
	        type: 'POST', // replaced from put
	        dataType: "JSON",
	        data: {
	            "id": uId,
	        	},
	        success: function (response)
	        {
	        	console.log(response);
	          setTimeout(function () {
			    swal("Se reestableció la contraseña a Net@1234");
			  }, 1000);
	        }, /*end success*/
	         error: function(xhr) {
		         console.log(xhr.responseText); // this line will save you tons of hours while debugging
		        // do something here because of error
		        setTimeout(function () {
			    swal({
			     title: "Error",
			     text: "Ha ocurrido un error al intentar reestablecer la contraseña, por favor inténtelo de nuevo.",
			     type: "warning",
			     showCancelButton: false,
			     });
			  }, 1000);
	       }/*end error*/
	      });

		 
		});

	}

</script>
@endsection