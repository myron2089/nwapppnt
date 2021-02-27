<div class="row">
	<div class="col-md-12">
		
		<div class="portlet light bordered">
	        <div class="portlet-title">
	            <div class="caption font-black">
	                <i class="fa fa-tag"></i>
	                <span class="caption-subject bold"> Administración de ofertas</span>
	            </div>
	            <div class="actions">
	            	 <a href="javascript:userEdit(1,1);"  class="btn green pull-right"><i class="fa fa-plus"></i> Crear oferta</a>
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

			        <div class="col-md-12 col-sm-12" style="margin-top: 10px;">
			        	<div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Lista de Ofertas</h3>
                            </div>
                            <div class="panel-body"> 

                            	<!-- BEGIN SAMPLE TABLE PORTLET-->
                                
                                <div class="table-scrollable">
                                    <table id="assigned-sales" class="table table-bordered table-hover dt-responsive" style="width: 100% !important">
                                        <thead>
                                            <tr>
                                            	<!--<th style="display: none"> ID</th>-->
                                            	<th> Producto </th>
                                            	<th> Marca </th>
                                                <th> Oferta </th>
                                                <th> Usuario </th>
                                                <th> Empresa </th>
                                                <th> Acciones </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	@foreach($offers as $offer)
	                                            <tr>
	                                            	<!-- <td class="id" style="display: none">{{$offer->ID}}</td>-->
	                                            	<td> {{$offer->productName}} </td>
	                                            	<td> {{$offer->BRAND}}</td>
	                                                <td> {{$offer->saleDescription }}</td>
	                                                <td> {{$offer->USER }}</td>
	                                                <td> {{$offer->COMPANY }}</td>
	                                                
	                                                <td class="{{$offer->ID}}"> 
	                                                	<a href="javascript:userEdit(2,{{$offer->ID}});" id="edit-btn" class="btn btn-xs btn-default"><i class="fa fa-edit"></i> Editar</a> 
	                                                	<button id="sweet-8" class="btn btn-xs btn-default sweet-8"><i class="fa fa-trash"></i> Eliminar</button>
	                                                	<form id="form-qr" method="post" action="{{url('admin/qrs/generate')}}" target="_blank">
	                                                		{{ csrf_field() }}
	                                                		<input type="hidden" name="id" value="{{$offer->ID}}">
	                                                		<input type="hidden" name="type" value="sale">
	                                                	<button type="submit" id="getQr2" class="btn btn-xs btn-default getQr"><i class="fa fa-qrcode"></i> Generar QR</button>
	                                                	</form>
	                                                	
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
                        <h4 id="user-modal-title" class="modal-title">Nueva Oferta</h4>
                        <p id="user-modal-tip">Ingresa los datos para la oferta.</p>
                    </div>
                    <div class="modal-body"> 

                    	<form id="form-sale-create" class="form-horizontal" method="POST" role="form" action="{{ route('event-offer-store') }}">
                        	<!-- BEGIN FORM BODY -->
                        	<div class="form-body">
                        		 {{ csrf_field() }}
                        		<input id="action" name="action" type="hidden" class="form-control">
                        		<input id="offerId" name="offerId" type="hidden" class="form-control"> 
                        		<input id="tableRow" name="tableRow" type="hidden" class="form-control"> 
                        		<div class="form-group custom-form-group">
			                         <div class="col-md-12">
			                         	<label for="offerProduct">Producto</label>
		                            	
		                              
			                                	
			                                 
			                                 <select id="offerProduct" name="offerProduct" class="form-control" style="width: 100%" required>
		                                            <option value="0">Seleccionar Producto</option>

			                                    @foreach($products as $product)
			                                    	<option value="{{ $product->id}} ">{{ $product->productName }}</option>
			                                    @endforeach
		                                     </select>

		                            </div>
			                    </div>

			                     <div class="form-group custom-form-group">
			                        <label class="col-md-12 control-label" for="offerDescription" style="text-align: left">Descripción de la Oferta <span class="required" aria-required="true"> * </span></label>
			                        <div class="col-md-12">
			                           <textarea rows="4" id="offerDescription" name="offerDescription" type="text"  class="form-control" placeholder="Ingresa la Descripción de la oferta" required maxlength="255" />
			                       		</textarea>

			                        </div>
			                    </div>

			                    
			                    <input type="hidden" id="userEventType" name="userEventType" value="5">
			                    <button id="btn-create-sale" type="submit" class="btn green pull-right" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Registrando Oferta...">Guardar Cambios</button>                            	
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

		$('#large').on('shown.bs.modal', function() {
		  $('#offerProduct').focus();
		})
		</script>

<!-- Datatable -->
<script>


    
jQuery(document).ready( function($) {

var e=$("#assigned-sales");
e.DataTable({
buttons:[{extend:"print",className:"btn dark btn-outline"}],responsive:{details:{}},order:[[1,"asc"]],
"language": {
            "lengthMenu": "Mostrar _MENU_ ofertas por página",
            "zeroRecords": "Nothing found - sorry",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "No se encontraror registros",
            "search": "Buscar",
            "infoEmpty": "No hay registros disponibles",
            "zeroRecords": "No se han encontrado ofertas",
            "infoFiltered": "(filtrados de _MAX_ registros)",
            paginate:{previous:"Anterior",next:"Siguiente",
            last:"Útlima",first:"Primera"}
        },
        /*"columnDefs": [
            {
                "targets": [ 0 ],
                "visible": false,
                "searchable": false
            }]*/
 /*"createdRow": function ( row, data, index ) {
                        $('td', row).eq(0).addClass("hidden");
                         $('td', row).eq(0).addClass("id");
                       
                    },*/
	});

});

</script>


<!-- BEGIN CREATE NEW USER (FORM) -->
<script>
	$( "#form-sale-create" ).submit(function( event ) {
		event.preventDefault();
		
		var $btnc = $('#btn-create-sale');
		$btnc.button('loading');
		var action = $('#action').val();
		var tablebody = $("#assigned-sales tbody");
		var row;
		
		var offerProduct = $('#offerProduct').val();
		var offerDescription = $('#offerDescription').val();
		
		

		if(offerProduct != 0 && offerDescription.length > 0){
			var data = new FormData($(this)[0]);

			if(action == 1)
			{
				$('#overlay-msg').text('Creando Oferta');
			}
			else{
				$('#overlay-msg').text('Editando Oferta');
				row = $('#tableRow').val();
				var newRow = + row + 1;
				$('#assigned-sales tr:eq('+newRow+')').addClass('table-row-editing');
			}
			
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


						var itoken = '{{ csrf_field() }}';
						setTimeout(function(){
				  			$('#overlay-msg').text(uData.msg);
						}, 2000);

						var t = $('#assigned-sales').DataTable();
						

						var row = t.row.add( [
				           
				            uData.oProduct,
				            uData.brandName,
				            uData.oDescription,
				            uData.userName,
				            uData.companyName,
				            "<a href='javascript:userEdit(2," + uData.oId + ");' id='edit-btn' class='btn btn-xs btn-default'><i class='fa fa-edit'></i> Editar</a> "+ btn +" <form id='form-qr' method='post' action='{{url('admin/qrs/generate')}}' target='_blank'>"+ itoken +" <input type='hidden' name='id' value='"+ uData.oId +"'> <input type='hidden' name='type' value='sale'> <button type='submit' id='getQr2' class='btn btn-xs btn-default getQr'><i class='fa fa-qrcode'></i> Generar QR</button> </form>"


				        ] ).draw().node();

						$( row ).find('td').eq(5).addClass(""+ uData.oId +"");

						console.log(uData);
					
						setTimeout(function(){
							$('#page-overlay').fadeOut('slow');
							$('#large').modal('hide');
							 $btnc.button('reset');
							Command: toastr["success"]("Se ha registrado correctamente la oferta!", "Mensaje");

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
					setTimeout(function(){
			  			$('#overlay-msg').text(uData.msg);
					}, 2000);
					
				}
				else{
					console.log('editando');
					row = $('#tableRow').val();
					var newRow = ++row;
				
					
					
					$('#assigned-sales tr:eq('+newRow+') td').eq(0).text(uData.oProduct);
					$('#assigned-sales tr:eq('+newRow+') td').eq(1).text(uData.brandName);
					$('#assigned-sales tr:eq('+newRow+') td').eq(2).text(uData.oDescription);
					$('#assigned-sales tr:eq('+newRow+') td').eq(3).text(uData.userName);
					$('#assigned-sales tr:eq('+newRow+') td').eq(4).text(uData.companyName);
					
					
					setTimeout(function(){
							$('#page-overlay').fadeOut('slow');
							$('#large').modal('hide');
							 $btnc.button('reset');
							Command: toastr["success"]("Se ha actualizado correctamente la oferta!", "Mensaje");

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

			 	setTimeout(function(){
			  		$('#page-overlay').fadeOut('slow');
			  		$('#assigned-sales tr:eq('+newRow+')').removeClass('table-row-editing');
				}, 1000);    
	          }
	        });
		}
		else{

			alert("Los datos son obligatorios");
		}
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
    $('#form-sale-create').trigger("reset");
    if(act == 1)
    {
    	
    	$('#user-modal-title').text('Crear Nueva Oferta');
    	$('#user-modal-tip').text('	Ingresa los datos para la oferta.');

    	
    }
    if(act == 2)
    {
    	$('#user-modal-title').text('Editar Oferta');
	    $('#user-modal-tip').text('Modifica los datos de la oferta.');
    	url= "{{ url('admin/events/offer/geteditdata')}}"+"/"+uId;
	    $.get(url, function(data){
	    	var uData = data;
	    	//console.log(uData.oProduct);
	    	
	    	$('#offerId').val(uId);
	    	$('#offerDescription').val(uData.oDescription);
	    	
    		
    		$("#offerProduct option ").each(function(){
				var t = $(this);
				var cValue = t.attr("value");
				if(t.attr("selected") =="selected"){
				t.removeAttr("selected");
				}
				//new code
				if(t.attr("value") == uData.oProduct ){
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
 		var tablebody = $("#assigned-sales tbody");
		var uId = $(this).closest('tr').children('td.id').text();
        swal({
		  title: "Se eliminará la oferta",
		  text: "Está seguro de eliminar la oferta?",
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
			        url: "{{ url('admin/events/offer/delete')}}/"+uId,
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
							    tablebody.html("<tr class='table-empty'><td colspan='6' class='text-center'>No existen ofertas en el evento!</td></tr>");
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
	var type = "sales";
	var row = $(this).parent().parent();
	var tablebody = $("#assigned-sales tbody");
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

		    mywindow.document.write('<html><head><title>Print</title>');
		    mywindow.document.write('</head><body >');
		    mywindow.document.write(content);
		    mywindow.document.write('</body></html>');

		 /*   mywindow.document.close();
		    mywindow.focus();*/
		    mywindow.print();
		    /*mywindow.close();*/
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
});


 </script>	