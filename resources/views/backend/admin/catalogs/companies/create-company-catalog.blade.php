@extends('layouts.expositor.app')

@section('content')

<div class="page-title">
	<h3><!--<i class="fa fa-list"></i>--> Campos para usuarios {{$eventName}}</h3>
</div>

<div class="page-bar">
	<ul class="page-breadcrumb">
	    <li>
	        <a href="{{ route('home-expositor')}}">Inicio</a>
	        <i class="fa fa-angle-right"></i>
	    </li>
	    <li>
	        <a href="#">{{$eventName}}</a>
            <i class="fa fa-angle-right"></i>
	    </li>
	    <li>
	        <a href="#">Catálogos</a>
            <i class="fa fa-angle-right"></i>
	    </li>
        <li>
            <span>Usuarios</span>
            
        </li>
	    
	</ul>
	
</div>
	
	<!-- BEGIN ROW PP -->
	<div class="row" style="margin-top: -5px;">
		<div class="col-md-12" style="margin-top:0px;">
			<div class="portlet light">
				@if($eventAdminStatus == 1)
				<div class="portlet-title">
	                <div class="caption caption-md">
	                    <i class="icon-bar-chart theme-font hide"></i>
	                    <span class="caption-subject font-black bold ">Opciones de campo</span>
	                    <span class="caption-helper hide">weekly stats...</span>
	                </div>
	                
	            </div>
				
				<form class="form-horizontal" method="POST" action="">
					<input type="hidden" name="actionId" id="actionId" value="1">
					<input type="hidden" name="fieldId" id="fieldId" value="null">
					<input type="hidden" name="eventId" id="eventId" value="{{$eventId}}">
					<input type="hidden" name="formId" id="formId" value="{{$formId}}">
					<div class="form-body">
						<div class="form-group custom-form-group">
							<div class="col-md-6">
								<label for="controlType">Selecciona el tipo de control</label>
								<select id="controlType" name="controlType" class="form-control">
									<option value="0">Seleccionar</option>
									@foreach($controls as $control)
										@if($control->id != 3 && $control->id != 4)
											<option value="{{$control->id}}">{{$control->controlName}}</option>
										@endif
									@endforeach
								</select>
							</div>

							<div class="col-md-6">
								<label for="dataType">Selecciona el tipo de dato</label>
								<select id="dataType" name="dataType" class="form-control">
									<option value="0">Seleccionar</option>
									@foreach($controls as $control)
										<option value="{{$control->id}}">{{$control->controlName}}</option>
									@endforeach
								</select>
							</div>
						</div>

						<div class="form-group custom-form-group">
							<div class="col-md-12">
								<label for="fieldName">Nombre del Campo</label>
								<input type="text" id="fieldName" name="fieldName" placeholder="Nombre del Campo" class="form-control">
							</div>

							<!--<div class="col-md-6">
								<label for="fieldLabel">Etiqueta del Campo</label>
								<input type="text" id="fieldLabel" name="fieldLabel" placeholder="Etiqueta del Campo" class="form-control">
							</div> -->
						</div>

						<div class="form-group custom-form-group">
							<div class="col-md-6">
								<label for="fieldPlaceHolder">Texto de ayuda</label>
								<input type="text" id="fieldPlaceHolder" name="fieldPlaceHolder" placeholder="De esta forma se mostrará el texto de ayuda" class="form-control">
							</div>

							<div class="col-md-3">
	                            <label for="fieldRequired">Es obligatorio?</label>
								<select id="fieldRequired" name="fieldRequired" class="form-control">
									<option value="0">No</option>
									<option value="1">Si</option>
								</select>
	                        </div>	

	                        <div class="col-md-3">
	                        	<label for="fieldMaxLength">Longitud Máxima</label>
								<input type="text" id="fieldMaxLength" name="fieldMaxLength" placeholder="Ej: 10, 50, 100, 255" class="form-control" onkeypress="return isNumberKey(event)" maxlength="3">
	                        </div>		
						</div>

						
						<div class="form-group custom-form-group" style="display: none;" id="control-list">
							
								
								<div class="col-md-12">
									<label for="dataType">Ingresa el listado de opciones para el control <small> (Ingresa el texto y presiona <strong>Agregar</strong>)</small></label>
									<div class="col-md-10" style="margin:0; padding:0"><input id="setOption" name="setOption" class="form-control" /></div><div class="col-md-2"><button class="btn pull-left" id="btn-add-option">Agregar</button></div>
								</div>

								<div class="col-md-12" style="margin-top: 20px;"> 
									 <select size="5" class="form-control" id="fieldList" name="fieldList" multiple="true">
									 	<option value="0">Selecciona</option>
	                                 </select>
	                            </div>
								<!--<select size="10" class="form-control" id="fieldList" name="fieldList">
									 <option value="Sin seleccionar">Sin seleccionar</option>
	                                 
								</select>-->
							
								


							
						</div>
						<hr>
						<div class="col-md-12" style="margin-left: 0; margin-right: 0">
							<button class="btn btn-success pull-right" id="btn-save-field"><i class="fa fa-check"></i> Crear Campo</button>
							
						</div>
					</div>
				</form>

				<br><br><br>
				@else
				<div class="col-md-12 p-0" style="margin-top: 20px;">
	                <div class="alert alert-danger">
	                    <strong>Evento cerrado!</strong> No se pueden administar campos adicionales para este evento.
	                </div>
	            </div>

			@endif
			</div>

			<div class="portlet light">
				<div class="portlet-title">
	                <div class="caption caption-md">
	                    <i class="icon-bar-chart theme-font hide"></i>
	                    <span class="caption-subject font-black bold">Campos Registrados</span>
	                    <span class="caption-helper hide">weekly stats...</span>
	                </div>
	                
	            </div>

            	<div class="portlet-body">
				
			    	<table class="table table-striped  table-bordered table-hover  order-column" id="sample_1">
			            <thead>
			                <tr>
			                    <!--<th>
			                        <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
			                            <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" />
			                            <span></span>
			                        </label>
			                    </th>-->
			                    <th >Id</th>
			                    <th> Nombre del Campo </th>
			                    <th> Tipo de Campo</th>
			                    <th> Tipo de Dato </th>
			                    <th> Longitud </th>
			                    <th> Opciones </th> 
			                   
			                </tr>
			            </thead>
			            <tbody>
			                 @foreach($fields as $field)

			                <tr class="odd gradeX">
			                  <!--  <td>
			                        <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
			                            <input type="checkbox" class="checkboxes" value="1" />
			                            <span></span>
			                        </label>
			                    </td> -->
			                    <td>{{$field->ID}}</td>
			                    <td class="font-weight-bold" > <strong>{{$field->TAG}}</strong> </td>
			                    <td>
			                        {{$field->CONTROLNAME}}
			                    </td>
			                    <td>
			                       {{$field->TYPENAME}}
			                    </td>
			                    <td class="center"> {{$field->MAXLENGHT}} </td>
			                    <td>
			                    	<button onclick="editField({{$field->ID}});" class="btn btn-xs btn-default sweet-8 @if($eventAdminStatus == 0) disabled @endif"><i class="fa fa-edit"></i> Editar</button>
			                        <button onclick="disableField({{$field->ID}});" class="btn btn-xs btn-default sweet-8 @if($eventAdminStatus == 0) disabled @endif"><i class="fa fa-trash"></i> Desabilitar</button>
			                    </td>
			                </tr>
			                @endforeach
			            </tbody>
			        </table>

				</div> <!-- end portlet-body -->
			</div> <!-- end portlet-ligth -->
		</div> <!-- end col-md-12 -->
	</div> <!--End row -->
@endsection

@section('scripts')
<script type="text/javascript" src="{{ URL::asset('js/jquery.blockUI.js')}}"></script>
<script>
jQuery(document).ready( function($) {
	$( "#event" ).change(function() {
		getUserCatalogs($(this).val(), $("#userType").val()  );

		
  // Check input( $( this ).val() ) for validity here
	});

	$( "#userType" ).change(function() {
		getUserCatalogs($("#event").val(), $(this).val());
  // Check input( $( this ).val() ) for validity here
	});


	function getUserCatalogs(evId, typeId){
		if(evId!=0 && typeId!=0){
			var url = "{{url('admin/catalogs/usercatalogs')}}/" + evId +"/"+ typeId;
			
			Pace.restart();
	            $('#content-overlay').fadeIn('slow');
	             $.ajax({
	             	type: 'post',
	                url : url,

	                
	                success: function(data){  
	                	$("#user-catalog-container").html(data); 
	                /*window.history.pushState('page2', 'Title', url);*/
	                },
	                error: function(XMLHttpRequest, textStatus, errorThrown) { 
	                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
	                } 

	            });
            
            $('#content-overlay').fadeOut('slow');  
        }
	}
});



function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}
</script>

<script>
jQuery(document).ready( function($) {
	$( "#controlType" ).change(function() {

		var controlType = $(this).val();
		$.ajax({
         	type: 'post',
            url: "{{ url('get/datatypes')}}/"+controlType,
            success: function(data){  
            	console.log(data);

            	$('#dataType').empty();
			    //$('#select2-dd-state-container').text('Select City');
			    var options = '';
			   // options += '<option value="0">Seleccionar tipo de dato</option>';
			    for (var x = 0; x < data.length; x++) {
			        options += '<option value="' + data[x]['id'] + '">' + data[x]['dataTypeName'] + '</option>';
			        }



			    $('#dataType').html(options);

			    if($("#controlType").val()== 2 || $("#controlType").val() == 3  || $("#controlType").val() == 4){
					$("#control-list").fadeIn('slow');
					$("#fieldMaxLength").prop( "disabled", true );
				}
				else{
					$("#control-list").fadeOut('slow');
		            /*window.history.pushState('page2', 'Title', url);*/
				}

				if($("#controlType").val()== 1 || $("#controlType").val() == 5){
					$("#fieldMaxLength").prop( "disabled", false);
				}
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
            alert("Status: " + textStatus); alert("Error: " + errorThrown); 
            } 

        });
	});
});
</script>

<!-- Create/Edit Field -->
<script>
jQuery(document).ready( function($) {	
	$('#btn-save-field').click(function(event){
    	event.preventDefault();
    	var actionId = $('#actionId').val();
    	var messageLoad = 'Registrando nuevo campo....';
    	if(actionId==2){
    		messageLoad = 'Actualizando información del campo....';
    	}

    	$('body.page-header-fixed').block({ 
                message: '<div class="spinner"><div class="dot1"></div><div class="dot2"></div></div><h4 style="color:#fff">'+ messageLoad +'</h4>', 
                 css: { 
                    border: 'none', 
                    padding: '0px', 
                    backgroundColor: '#000', 
                    '-webkit-border-radius': '4px', 
                    '-moz-border-radius': '4px', 
                    opacity: .6, 
                    color: '#fff' 
                } 
            }); 
    	
    	var evId = $("#eventId").val();
    	var formId = $("#formId").val();
    	var typeId = 0;

    	var fieldName = $("#fieldName").val();
    	var fieldRequired = $("#fieldRequired").val();
    	var fieldMaxLength = $("#fieldMaxLength").val();
    	var fieldPlaceHolder= $("#fieldPlaceHolder").val();
    	var fieldControlType= $("#controlType").val();
    	var fieldDataType = $("#dataType").val();
    	var fieldListOptions = $('#fieldList').val();
    	var fieldSection = $('#userType').val();
    	var eventId = $('#eventId').val();
    	
    	var fieldId = $('#fieldId').val();

    	var options = {};

		$('#fieldList option').each(function(){
		    options[$(this).text()] = $(this).val();
		});


    	console.log(options);

    	var url = "{{url('admin/catalogs/store/usercatalog')}}/"+evId +"/"+ typeId;
    	$.ajax({
         	type: 'post',
            url: url,
            data:{fieldName: fieldName, fieldRequired: fieldRequired, fieldPlaceHolder: fieldPlaceHolder, fieldControlType: fieldControlType, fieldMaxLength: fieldMaxLength, fieldList: options, fieldDataType: fieldDataType, fieldSection: fieldSection, eventId: eventId, formId: formId, actionId: actionId, fieldId: fieldId},
            success: function(data){ 
            	var uData = jQuery.parseJSON(data);

            	if(uData.status == 'success'){
            		Command: toastr["success"](uData.message, "Mensaje");
            	}
            	else{
            		Command: toastr["error"](uData.message, "Error");
            	}

            	
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
            console.log("Status: " + textStatus); console.log("Error: " + errorThrown); 
            }
        });  

        setTimeout(function(){
		  	$('body.page-header-fixed').unblock();
		  }, 1000);

    });
});    
</script>



<script>
jQuery(document).ready( function($) {
	$('#btn-add-option').click(function(event){
		event.preventDefault();
		var id = $("#fieldList option").length + 1;
		var text = $("#setOption").val();
		if(text.length > 0){
			$("#fieldList").append('<option value='+id+'>'+text+'</option>');
			$("#setOption").val('');
		}
		else{
			$("#setOption").focus();
		}
	});
});
</script>


<script>
    
jQuery(document).ready( function($) {
 myTable =   $('#sample_1').DataTable( {
         responsive: true,
         
         "language": {
            "lengthMenu": "Mostrar _MENU_ campos por página",
            "zeroRecords": "Nothing found - sorry",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "No records available",
            "search": "Buscar",
            "infoEmpty": "No hay registros disponibles",
            "zeroRecords": "No existen campos creados para este tipo de usuario",
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
            }, { "bVisible": false, "aTargets": [ 0 ] }
            
        ]
    } );
});
</script>

<!-- Edit button table -->
<script>
	function editField(id){

      	$('body.page-header-fixed').block({ 
                message: '<div class="spinner"><div class="dot1"></div><div class="dot2"></div></div><h4 style="color:#fff">Obteniendo informacion</h4>', 
                 css: { 
                    border: 'none', 
                    padding: '0px', 
                    backgroundColor: '#000', 
                    '-webkit-border-radius': '4px', 
                    '-moz-border-radius': '4px', 
                    opacity: .6, 
                    color: '#fff' 
                } 
            }); 

		//Get field data for set on form
		var url = "{{url('catalogos/editar')}}/"+id;
		$.ajax({
         	type: 'get',
            url: url,
            data:{eventId: "{{$eventId}}"},
            success: function(data){ 
            	var uData = jQuery.parseJSON(data);

            	if(uData.status == 'OK')
            	{
            		$('#btn-save-field').text('Actualizar Campo');
	            	$('#fieldName').val(uData.fieldName);
	            	$('#controlType').val(uData.fieldControlId).change();
	            	$('#dataType').val(uData.dataTypeId).change();
	            	$('#fieldPlaceHolder').val(uData.fieldPlaceHolder);
	            	$('#fieldRequired').val(uData.fieldRequired);
	            	$('#fieldMaxLength').val(uData.fieldMaxLenght).change();

	            	$('#dataType').val(uData.dataTypeId).change();
	            	$('#actionId').val(2);
	            	$('#fieldId').val(id);

	            	if(uData.multipleOptions == true){

	            		$('#fieldList').empty();
					    //$('#select2-dd-state-container').text('Select City');
					    var options = '';
					   // options += '<option value="0">Seleccionar tipo de dato</option>';
					    for (var x = 0; x < uData.fieldOptions.length; x++) {
					        options += '<option value="' + uData.fieldOptions[x]['value'] + '">' + uData.fieldOptions[x]['name'] + '</option>';
					        }



					    $('#fieldList').html(options);
	            	}

            	}
            	else{
            		Command: toastr["error"]("Ha ocurrido un error, póngase en contacto con el administrador del sitio", "Alerta");
            		
            	}


            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
            alert("Status: " + textStatus); alert("Error: " + errorThrown); 

            }
        });  

		  setTimeout(function(){
		  	$('body.page-header-fixed').unblock();
		  }, 1000);
	}



	function disableField(fieldId){

		

		$.ajax({
         	type: 'post',
            url: "{{url('admin/catalogs/status/change/')}}/"+fieldId,
            data:{fieldId: fieldId},
	        async: false,
	      	cache: false,
	      	contentType: false,
	      	processData: false,
            beforeSend: function(){
            	$('body.page-header-fixed').block({ 
                message: '<div class="spinner"><div class="dot1"></div><div class="dot2"></div></div><h4 style="color:#fff">Obteniendo informacion</h4>', 
                 css: { 
                    border: 'none', 
                    padding: '0px', 
                    backgroundColor: '#000', 
                    '-webkit-border-radius': '4px', 
                    '-moz-border-radius': '4px', 
                    opacity: .6, 
                    color: '#fff' 
                } 
            }); 

            },
            success: function(data){ 

            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
           /* alert("Status: " + textStatus); alert("Error: " + errorThrown);*/ 
            Command: toastr["error"](errorThrown, "Error");
            setTimeout(function(){
				  	$('body.page-header-fixed').unblock();
				  }, 1000);

            }
        }).done(function(data){

        	var uData = jQuery.parseJSON(data);

            	if(uData.status == 'success')
            	{
            		Command: toastr["success"](uData.message, "Alerta");
	            	

            	}
            	else{
            		Command: toastr["error"]("Ha ocurrido un error, póngase en contacto con el administrador del sitio", "Alerta");
            		
            	}

            	setTimeout(function(){
				  	$('body.page-header-fixed').unblock();
				  }, 1000);


        }); 
	}
</script>
@endsection