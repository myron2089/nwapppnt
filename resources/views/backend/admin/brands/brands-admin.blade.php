<div class="row">
	<div class="col-md-12">
		
		<div class="portlet light bordered">
	        <div class="portlet-title">
	            <div class="caption font-black">
	                <i class="icon-settings font-black"></i>
	                <span class="caption-subject bold"> Marcas para productos</span>
	            </div>
	            <div class="actions">
	            	<a href="javascript:userEdit(1,1);"  class="btn green pull-right"><i class="fa fa-plus"></i> Crear marca</a>
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
			        	<div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Marcas registradas en el Evento</h3>
                            </div>
                            <div class="panel-body"> 

                            	<!-- BEGIN SAMPLE TABLE PORTLET-->
                                
                                <div class="table-scrollable">
                                    <table id="asigned-users" class="table table-striped  table-hover  order-column">
                                        <thead>
                                            <tr>
                                            	<th style="display: none" class="hidden"> ID</th>
                                                <th> Marca </th>
                                                <th> Descripción </th>
                                               <!-- <th> Opciones </th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	@foreach($brands as $brand)
	                                            <tr>
	                                            	<td class="id {{$brand->id}}" style="display: none">{{ $brand->id}}</td>
	                                                <td> {{$brand->brandName}}</td>
	                                                <td> {{$brand->brandDescription}}</td>
	                                               <!--  <td> 
	                                               	<a href="javascript:userEdit(2,{{$brand->id}});" id="edit-btn" class="btn btn-xs btn-default"><i class="fa fa-edit"></i>Editar</a> 
	                                                	<button id="sweet-8" class="btn btn-xs btn-default sweet-8"><i class="fa fa-trash"></i> Eliminar</button> 
	                                                </td> -->
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
                        <h4 id="user-modal-title" class="modal-title">Crear Nueva Marca</h4>
                    </div>
                    <div class="modal-body"> 

                    	<form id="form-user-create" class="form-horizontal" method="POST" role="form" action="{{ route('event-brand-store') }}">
                        	<!-- BEGIN FORM BODY -->
                        	<div class="form-body">
                        		 {{ csrf_field() }}
                        		<input id="action" name="action" type="hidden" class="form-control">
                        		<input id="tableRow" name="tableRow" type="hidden" class="form-control">
                        		<input id="eventId" name="eventId" type="hidden" value="{{$eventId}}">
                        		<input id="brandId" name="brandId" type="hidden" >
                        		<div class="form-group custom-form-group">
			                        <label class="control-label" for="brandName">Marca <span class="required" aria-required="true"> * </span></label>
			                        
			                           <input id="brandName" name="brandName" type="text"  class="form-control" placeholder="Nombre de la marca"  required maxlength="50" autocomplete="off" />
			                        
			                    </div>

			                     <div class="form-group custom-form-group">
			                        <label class="control-label" for="brandDescription">Descripción <span class="required" aria-required="true"> * </span></label>
			                        
			                           <textarea id="brandDescription" name="brandDescription" rows="5"  class="form-control" placeholder="Ingrese una breve descripción de la marca" required maxlength="255" />
			                       
			                    </div>

			                    <button id="btn-create-user" type="submit" class="btn green pull-right" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Registrando Marca...">Guardar Marca</button>                            	
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

$('#large').on('shown.bs.modal', function() {
		  $('#brandName').focus();
		});
</script>
<!-- Datatable -->
<script>
    
jQuery(document).ready( function($) {
 myTable =   $('#asigned-users').DataTable( {
         /*responsive: true,*/
         "createdRow": function ( row, data, index ) {
                        $('td', row).eq(0).addClass("hidden");
                         $('td', row).eq(0).addClass("id");
                       
                    },
         "language": {
            "lengthMenu": "Mostrar _MENU_ marcas por página",
            "zeroRecords": "Nothing found - sorry",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "No se encontraror registros",
            "search": "Buscar",
            "infoEmpty": "No hay registros disponibles",
            "zeroRecords": "No se han encontrado marcas en el evento",
            "infoFiltered": "(filtrados de _MAX_ registros)",
            paginate:{previous:"Anterior",next:"Siguiente",
            last:"Última",first:"Primera"}
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




<!-- BEGIN CREATE NEW USER (FORM) -->
<script>
	$( "#form-user-create" ).submit(function( event ) {
		event.preventDefault();
		var $btnc = $('#btn-create-user');
		//$btnc.button('loading');
		var action = $('#action').val();
		var tablebody = $("#asigned-users tbody");
		var row;
		
		var data = new FormData($(this)[0]);

		/*if(action == 1)
		{
			$('#overlay-msg').text('Creando Marca');
		}
		else{
			$('#overlay-msg').text('Editando Marca');
		}
		$('#overlay-msg').css('display', 'none');
		
		$('#page-overlay').fadeIn('slow');
		*/
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
					$('#overlay-msg').text('Creando Marca...');
				}
				else{
					$('#overlay-msg').text('Editando Marca..');
					
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
           error: function(XMLHttpRequest, textStatus, errorThrown) { 
        	/*alert("Status: " + textStatus); alert("Error: " + errorThrown);*/ 

        	setTimeout(function(){
						$('#page-overlay').fadeOut('slow');
						$('#large').modal('hide');
						 $btnc.button('reset');
						Command: toastr["error"](textStatus + ' ' + errorThrown , "Error");

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
          
            /*var safunction = "'_gaq.push(['_trackEvent', 'exit', 'footer', 'Lipis']);'";*/
            var btn='<button class="btn btn-xs btn-default sweet-8"><i class="fa fa-trash"></i> Eliminar</button>';
            
            
            if(action == 1)
			{

				if(uData.status=='success')
				{
			    var img = "{{url('/')}}/"+uData.uPic;
				
				

				var t = $('#asigned-users').DataTable();
                

                var rowNode = t.row.add( [
                    uData.bId,
                    
                    uData.bName,
                    uData.bDesc,
                   
                   /* "<a href='javascript:userEdit(2,"+uData.bId+");' id='edit-btn' class='btn btn-xs btn-default'><i class='fa fa-edit'></i>Editar</a> "+ btn */
                ] ).draw().node();

                var rId = uData.bId;
               
                $( rowNode ).find('td').eq(0).addClass(""+rId);

                setTimeout(function(){
						$('#page-overlay').fadeOut('slow');
						$('#large').modal('hide');
						 $btnc.button('reset');
						swal({
							type: "success",
							title: "Mensaje",
							text: "Se ha registrado la marca con éxito!",
							timer: 3000,
							 showCancelButton: false,
						});
					}, 1000);
				

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
				
				$('#asigned-users tr:eq('+newRow+') td').eq(0).text(uData.bId);
				$('#asigned-users tr:eq('+newRow+') td').eq(1).text(uData.bName);
				$('#asigned-users tr:eq('+newRow+') td').eq(2).text(uData.bDesc);
				
				
				


				//alert(row);
				$('#asigned-users tr:eq('+newRow+')').addClass('table-row-editing');
				$('#overlay-msg').text('Usuario editado con éxito');
				  setTimeout(function(){
						$('#page-overlay').fadeOut('slow');
						$('#large').modal('hide');
						 $btnc.button('reset');
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
				  	$('#asigned-users tr:eq('+newRow+')').removeClass('table-row-editing');

			}


        });
	});	
</script>
<!-- END CREATE NEW USER (FORM) -->

<!-- BEGIN EDIT USER (FORM) -->
<script>
 
function userEdit(act, uId){

	
	/*$('#page-overlay').fadeIn('slow');*/
    $('#form-user-create').trigger("reset");
	var row = $('.'+uId).closest('tr').index();		
    $("#userProfileImage").val(null);
    
    $('#action').val(act);
    
    $('#tableRow').val(row);

    
    if(act == 1)
    {
    	$('#user-modal-title').text('Crear Nueva Marca');
    	
    }
    else 
    {
    	url= "{{ url('admin/event/brands/geteditdata')}}"+"/"+uId;
	    $.get(url, function(data){
	    	var uData = jQuery.parseJSON(data);
	    	console.log(uData);
	    	$('#eventId').val(uData.uEventId);
	    	$('#brandId').val(uData.bId);
	    	$('#brandName').val(uData.bName);
	    	$('#brandDescription').val(uData.bDesc);

	    	
	    });
    	$('#user-modal-title').text('Editar Marca');
    	
    	
    }
    
	$('#large').modal('show');
	$('.modal-backdrop').appendTo('body');  
	$('.modal').appendTo('body'); 

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

 		
 		var tablebody = $("#asigned-users tbody");
		var uId = $(this).closest('tr').children('td.id').text();
		
		var t = $('#asigned-users').DataTable();
		var row = t.row($(this).parents('tr'));

        swal({
		  title: "Confirmar",
		  text: "Está seguro de eliminar la empresa seleccionada?",
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
			        url: "{{ url('admin/event/brands/delete')}}/"+uId,
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

        	
			 
        	 $('#modal-qr').modal('show');
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