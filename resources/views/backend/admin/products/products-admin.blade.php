<div class="row">
	<div class="col-md-12">
		
		<div class="portlet light bordered">
	        <div class="portlet-title">
	            <div class="caption font-black">
	                <i class="fa fa-dropbox"></i>
	                <span class="caption-subject bold "> Productos</span>
	            </div>
	            <div class="actions">
	            	<a href="javascript:productEdit(1,1);"  class="btn green pull-right"><i class="fa fa-plus"></i> Crear producto</a>
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
			        <div class="col-md-12 col-sm-12" style="margin-top: 15px;">
			        	<div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Productos del evento</h3>
                            </div>
                            <div class="panel-body"> 

                            	<!-- BEGIN SAMPLE TABLE PORTLET-->
                                
                                <div class="table-scrollable">
                                    <table id="asigned-products" class="table table-bordered table-hover dt-responsive" style="width: 100% !important">
                                        <thead>
                                            <tr>
                                            	<!--<th style="display: none" class="hidden"> ID</th>-->
                                            	<th> Imagen </th>
                                                <th> Producto </th>
                                                <th class="none"> Descripción </th>
                                                <th> Marca </th>
                                                <th> Usuario </th>
                                                <th> Empresa </th>
                                                <th> Precio </th>
                                                <th> Acciones </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	@foreach($products as $product)
	                                            <tr>
	                                            	<!--<td class="id" style="display: none">{{$product->PRODUCTID}}</td>-->
	                                                <td> <img  src="{{url('/')}}/{{$product->productPicturePath}}{{$product->productPicture}}" width="65"></td>
	                                                <td> {{$product->productName}}</td>
	                                                <td> {{$product->productDescription}} </td>
	                                                <td> {{$product->BRAND}} </td>
	                                                <td> {{$product->USER}} </td>
	                                                <td> {{$product->COMPANY }}</td>
	                                                <td align="right"> {{$product->currencySymbol}} {{$product->productPrice}}</td>
	                                                <td class="{{$product->PRODUCTID}}"> 
	                                                	<a href="javascript:productEdit(2,{{$product->PRODUCTID}});" id="edit-btn" class="btn btn-xs btn-default"><i class="fa fa-edit"></i> Editar</a> 
	                                                	<button id="sweet-8" class="btn btn-xs btn-default sweet-8"><i class="fa fa-trash"></i> Eliminar</button>
	                                                	<form id="form-qr" method="post" action="{{url('admin/qrs/generate')}}" target="_blank">
	                                                		{{ csrf_field() }}
	                                                		<input type="hidden" name="id" value="{{$product->PRODUCTID}}">
	                                                		<input type="hidden" name="type" value="product">
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

	    <div class="modal fade bs-modal-lg in" id="large" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" id="modal-content-product">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 id="user-modal-title" class="modal-title">Editar Producto</h4>
                        <p id="user-modal-tip">Ingresa los datos para el nuevo producto.</p>
                    </div>
                    <div class="modal-body"> 

                    	<form id="form-user-create" class="form-horizontal" method="POST" role="form" action="{{ route('event-product-store') }}">
                        	<!-- BEGIN FORM BODY -->
                        	<div class="form-body">
                        		 {{ csrf_field() }}
                        		<input id="action" name="action" type="hidden" class="form-control">
                        		<input id="productId" name="productId" type="hidden" class="form-control"> 
                        		<input id="tableRow" name="tableRow" type="hidden" class="form-control"> 
                        		<input id="eventId" name="eventId" type="hidden" value="{{$eventId}}" class="form-control"> 

                        		<div class="col-sm-12 col-md-4 text-center">
				          			<label for="productPicture" class="custom-file-upload-product" >
									    <i class="fa fa-cloud-upload"></i> Seleccionar Imagen para el producto
									</label>
				                    <input id="productPicture" name="productPicture" type="file" class="product-picture-hidden" style="display: none" onchange="loadPicture(event)">
						        </div>
						        <div class="col-sm-12 col-md-8">
		                        	<div class="col-md-12" style="padding: 10px 0px 0px 0px">
		                        		<label for="productName">Nombre</label>
		                            	 <input id="productName" name="productName" type="text"  class="form-control" placeholder="Nombre del producto" required maxlength="50" />
		                           	</div> 
		                           	<div class="col-md-12" style="padding: 10px 0px 0px 0px">
		                           		<label for="productDescription">Descripción del Producto</label>
		                            	  <textarea id="productDescription" name="productDescription" class="form-control form-control-inline input-medium" size="16" rows="5" type="text" value="" style="width: 100% !important"  required maxlength="255"></textarea>
		                        	</div>


		                        </div>
                        										                  
		                        <div class="col-md-12"></div>
			                    	<div class="col-md-12" >
			                        	<div class="col-md-10 col-sm-10" style="padding: 10px 0px 0px 0px">
			                           		<label for="productDescription">Marca</label>
			                            	  <select id="productBrand" name="productBrand" class="form-control">
				                         	        <option value="">Sin marca</option>
					                           		@foreach($brands as $brand)
					                           			<option value="{{$brand->id}}">{{$brand->brandName}}</option>
					                           		@endforeach
					                           </select> 
			                        	</div>

			                        	<div class="col-md-2 col-sm-2" style="padding-left: 0;">
			                            	<button id="createBrand" class="btn btn-default btn-orange" tabindex="-1" style="margin-top: 35px;"><i class="fa fa-plus"></i> Nueva</button>
			                            </div>
			                        </div>

			                 <!--   <div class="form-group custom-form-group">
				                        <label class="col-md-3 control-label" for="eventFacebookLink">Modelo <span class="required" aria-required="true"> * </span></label>
			                        <div class="col-md-9">
			                           <input id="productModel" name="productModel" type="text"  class="form-control" placeholder="Modelo del Producto"/>
			                        </div>
			                    </div> -->

			                    <div class="col-md-12" >
				                  	<div class="col-md-12" style="padding: 10px 0px 0px 0px">
				                        <label  for="eventFacebookLink">Precio <span class="required" aria-required="true"> * </span></label>
				                        <input id="productPrice" name="productPrice" type="number"  class="form-control" placeholder="150.00" maxlength="10" required />
				                        
				                    </div>
				                </div>

				                 <div class="col-md-12" >
			                   		<div class="col-md-12" style="padding: 10px 0px 20px 0px">
				                        <label for="eventFacebookLink">Moneda<span class="required" aria-required="true"> * </span></label>
			                           	<select id="productCurrency" name="productCurrency" class="form-control" required >
			                           		@foreach($currencies as $currency)
			                           			<option value="{{$currency->id}}">{{$currency->currencyName}} {{$currency->currencySymbol}}</option>
			                           		@endforeach
			                           	</select> 
			                        
			                    	</div>
			                    </div>

			                   <!-- <div class="form-group custom-form-group">
			                        <label class="col-md-3 control-label" for="eventFacebookLink">Imágen<span class="required" aria-required="true">  </span></label>
			                        <div class="col-md-5">
			                        	<input id="productPicture" name="productPicture" type="file" class="form-control" placeholder="Imagen de Producto" accept="image/*" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])" multiple="false">
			                        </div>
			                        <div class="col-md-4" style="border: 1px dotted grey; height: 105px; text-align: center; vertical-align: middle;">
			                        	<img id="blah" alt="imagen del producto" height="100" style="" />
			                        </div>
			                    </div> -->
			                    
			                   	
                        		

			                    <button type="submit" id="btn-create-product" class="btn green pull-right" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Registrando Producto...">Guardar Cambios</button>                            	
                        		<button type="button" class="btn dark btn-outline btn-default pull-right" style="margin-right: 10px" data-dismiss="modal">Cerrar</button>
                        	</div> 
                        	<!-- END FORM BODY -->  
                        	<br><br>
    						
                        </form>

                    </div>
                    <div class="modal-footer" style="border-top: 0px">
                                                        
					</div>
                </div>
                <!-- /.modal-content -->


                <div class="modal-content" id="modal-content-brand" style="display: none;">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 id="user-modal-title" class="modal-title">Crear Marca</h4>
                        <p id="user-modal-tip">Ingresa los datos de la marca.</p>
                    </div>
                    <div class="modal-body">
                    	<form id="form-brand-create" class="form-horizontal" method="POST" role="form" action="{{ route('event-brand-store') }}">
                        	<!-- BEGIN FORM BODY -->
                        	<div class="form-body">
                        		 {{ csrf_field() }}
                        		<input id="action" name="action" type="hidden" class="form-control" value="1">
                        		<input id="tableRow" name="tableRow" type="hidden" class="form-control">
                        		<input id="eventId" name="eventId" type="hidden" value="{{$eventId}}">
                        		<input id="brandId" name="brandId" type="hidden" >
                        		<div class="form-group custom-form-group">
			                        <label class="control-label" for="eventFacebookLink">Marca <span class="required" aria-required="true"> * </span></label>
			                        
			                           <input id="brandName" name="brandName" type="text"  class="form-control" placeholder="Nombre de la marca" required maxlength="50" />
			                        
			                    </div>

			                     <div class="form-group custom-form-group">
			                        <label class="control-label" for="userLastName">Descripción <span class="required" aria-required="true"> * </span></label>
			                        
			                           <textarea id="brandDescription" name="brandDescription" rows="5"  class="form-control" placeholder="Ingrese una breve descripción de la marca" required maxlength="255" />
			                       
			                    </div>

			                    <button id="btn-create-brand" type="submit" class="btn green pull-right" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Registrando Marca...">Guardar</button>                            	
                        		<button id="btnCloseBrandForm" type="button" class="btn dark btn-outline btn-default pull-right" style="margin-right: 10px">Cancelar</button>
                        	</div> 
                        	<!-- END FORM BODY -->  
                        	<br><br>
    						
                        </form>




                    </div><!-- end:: modal-body -->
                </div> <!--end:: modal-content-brand -->
            </div>
            <!-- /.modal-dialog -->
        </div>  
        <!-- /.modal-fade end -->
<div id="editor"></div><div class="qrcode" id="printer">
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
		  $('#productName').focus();
		});
		</script>

<script>



$('#productBrand').select2({
	width: '100%',
	dropdownParent: $('#large'),
  	ajax: {
	    url: "{{url('admin/events/brands')}}/" + "{{$eventId}}",
	    dataType: 'json',
	    // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
	    processResults: function (data) {
	      // Tranforms the top-level key of the response object from 'items' to 'results'
	      return {
	        results: data
	      };
	    }
	}
});



$('#createBrand').click(function(event){
	event.preventDefault();


	$('#modal-content-product').css('display', 'none');
	$('#modal-content-brand').css('display', 'block');
	$('#companyName').select();


    	/*$.ajax({
          type: "POST",
          url: "-",
          data: data,
          async: false,
          cache: false,
          contentType: false,
          processData: false,
          success: function (data) {    
          }
      }).done(function(data){



      });*/
  });	

$('#btnCloseBrandForm').click(function(event){

	$('#form-user-create').trigger("reset");
	$('#modal-content-brand').css('display', 'none');
	$('#modal-content-product').css('display', 'block');



});





</script>



<!-- Datatable -->
<script>
    
jQuery(document).ready( function($) {

var e=$("#asigned-products");
e.DataTable({
buttons:[{extend:"print",className:"btn dark btn-outline"}],responsive:{details:{}},order:[[0,"asc"]],
"language": {
            "lengthMenu": "Mostrar _MENU_ productos por página",
            "zeroRecords": "Nothing found - sorry",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "No se encontraror registros",
            "search": "Buscar",
            "infoEmpty": "No hay registros disponibles",
            "zeroRecords": "No se han encontrado productos",
            "infoFiltered": "(filtrados de _MAX_ registros)",
            paginate:{previous:"Anterior",next:"Siguiente",
            last:"Útlima",first:"Primera"}
        },
 /*"createdRow": function ( row, data, index ) {
                        $('td', row).eq(0).addClass("hidden");
                         $('td', row).eq(0).addClass("id");
                       
                    },*/
	});



 myTable =   $('#asigned-products2').dataTable( {
        responsive:{details:{}},order:[[0,"asc"]],lengthMenu:[[5,10,15,20,-1],[5,10,15,20,"All"]],
         "createdRow": function ( row, data, index ) {
                        $('td', row).eq(0).addClass("hidden");
                         $('td', row).eq(0).addClass("id");
                       
                    },
         "language": {
            "lengthMenu": "Mostrar _MENU_ productos por página",
            "zeroRecords": "Nothing found - sorry",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "No se encontraror registros",
            "search": "Buscar",
            "infoEmpty": "No hay registros disponibles",
            "zeroRecords": "No se han encontrado productos",
            "infoFiltered": "(filtrados de _MAX_ registros)",
            paginate:{previous:"Anterior",next:"Siguiente",
            last:"Útlima",first:"Primera"}
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



<!-- BEGIN CREATE NEW USER (FORM) -->
<script>
	$( "#form-user-create" ).submit(function( event ) {
		event.preventDefault();
		var $btnc = $('#btn-create-product');
		
		var action = $('#action').val();
		var tablebody = $("#asigned-products tbody");
		
		
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
					$('#overlay-msg').text('Creando y Asignando Usuario');
				}
				else{
					$('#overlay-msg').text('Editando Usuario');
				}
				/*$('#large').modal('hide');*/
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
						swal({
							type: "warning",
							title: "Alerta",
							text: "Se ha ha producido un error durante el proceso.",
							timer: 3000,
							 showCancelButton: false,
						});
					}, 1000);

          }
        })
        .done(function(data){
        	var uData = jQuery.parseJSON(data);
            console.log(uData);
            var safunction = "'_gaq.push(['_trackEvent', 'exit', 'footer', 'Lipis']);'";
            var btn='<button class="btn btn-xs btn-default sweet-8"><i class="fa fa-trash"></i> Eliminar</button>';
            
            
            if(action == 1)
			{
				
 				var itoken = '{{ csrf_field() }}';
				if(uData.status=='success')
				{

				var pPicture = uData.pPicture;

				$('#overlay-msg').text(uData.msg);

				

				var t = $('#asigned-products').DataTable();
				var rowsnum = t.rows( '.selected' ).count();

				var row = t.row.add( [
			            "<img  src='"+ pPicture +"' width='65'>",
			            uData.pName,
			            uData.pDescription,
			            uData.brandName,
			            uData.userName,
			            uData.companyName,
			            uData.pPrice,
			            "<a href='javascript:productEdit(2,"+uData.pId+");' id='edit-btn' class='btn btn-xs btn-default'><i class='fa fa-edit'></i> Editar</a> "+ btn +" <form id='form-qr' method='post' action='{{url('admin/qrs/generate')}}' target='_blank'>"+ itoken +" <input type='hidden' name='id' value='" + uData.pId + "'> <input type='hidden' name='type' value='product'> <button type='submit' id='getQr2' class='btn btn-xs btn-default getQr'><i class='fa fa-qrcode'></i> Generar QR</button> </form>"


			        ] ).draw().node();

				$( row ).find('td').eq(7).addClass(""+ uData.pId +"");

				

				 setTimeout(function(){
						$('#page-overlay').fadeOut('slow');
						$('#large').modal('hide');
						 $btnc.button('reset');
						swal({
							type: "success",
							title: "Mensaje",
							text: "Se ha registrado el producto con éxito!",
							timer: 3000,
							showCancelButton: false,
						});
					}, 1000);
				}
				if(uData.status=='exists')
				$('#overlay-msg').text(uData.msg);
				
			}
			else{
				$('#overlay-msg').text('Producto editado con éxito');
				row = $('#tableRow').val();
				var newRow = ++row;
				var img = uData.pPicture;
				$('#asigned-products tr:eq('+newRow+')').addClass('table-row-editing');
				$('#asigned-products tr:eq('+newRow+') td').eq(0).html("<img src='"+ img +"' width='65'>");
				$('#asigned-products tr:eq('+newRow+') td').eq(1).text(uData.pName);
				$('#asigned-products tr:eq('+newRow+') td').eq(2).text(uData.pDescription);
				$('#asigned-products tr:eq('+newRow+') td').eq(3).text(uData.brandName);
				$('#asigned-products tr:eq('+newRow+') td').eq(4).text(uData.userName);
				$('#asigned-products tr:eq('+newRow+') td').eq(5).text(uData.companyName);
				$('#asigned-products tr:eq('+newRow+') td').eq(6).text(uData.pPrice);
				

				 setTimeout(function(){
						$('#page-overlay').fadeOut('slow');
						$('#large').modal('hide');
						$btnc.button('reset');
						Command: toastr["success"]("Se ha editado correctamente el producto!", "Mensaje");

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
						};

						$('#asigned-products tr:eq('+newRow+')').removeClass('table-row-editing');
					}, 2000);
			}

		 	setTimeout(function(){
		  		$('#page-overlay').fadeOut('slow');
			}, 1000); 


        });
	});	


</script>
<!-- END CREATE NEW BRAND (FORM) -->



<!-- BEGIN CREATE NEW BRAND (FORM) -->
<script>
	$( "#form-brand-create" ).submit(function( event ) {
		event.preventDefault();
		var $btnc = $('#btn-create-brand');
		
		var action = $('#action').val();
		var tablebody = $("#asigned-users tbody");
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
					$('#overlay-msg').text('Creando y Asignando Marca');
				}
				else{
					$('#overlay-msg').text('Editando Usuario');
				}
				/*$('#large').modal('hide');*/
				$('#page-overlay').fadeIn('slow');
	        },
          success: function (data) {

		 	   
          	
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


        })
        .done(function(data){


            var uData = jQuery.parseJSON(data);
          
            /*var safunction = "'_gaq.push(['_trackEvent', 'exit', 'footer', 'Lipis']);'";*/
            var btn='<button class="btn btn-xs btn-default sweet-8"><i class="fa fa-trash"></i> Eliminar</button>';
            
            
            if(action == 1)
			{

				if(uData.status=='success')
				{
			    var img = "{{url('/')}}/"+uData.uPic;    

			    $('#form-brand-create').trigger("reset");
				$('#modal-content-brand').css('display', 'none');
				$('#modal-content-product').css('display', 'block');

                setTimeout(function(){
						$('#page-overlay').fadeOut('slow');
						$btnc.button('reset');
						
						Command: toastr["success"]("Se ha registrado correctamente la marca!", "Mensaje");

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
				    $('#uEventId').val(uData.eventId);
				    $('#userAsignedId').val(uData.uId);
		    		$('#uEventId').val(uData.eventId);
	    			$('#userPicAss').attr('src',"{{url('')}}/"+uData.uPic);
	    			$('#userAsignedCompany').val(0);
	    			$('#userAsignedEventType').val('');

			    	console.log(uData);
			    	
			    	 $btnc.button('reset');
					$('#asign-user').modal('show');
				}

				if(uData.status=='ueexists'){
					$('#page-overlay').fadeOut('slow');
					
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

        });
	});	
</script>
<!-- END CREATE NEW BRAND (FORM) -->




<!-- BEGIN EDIT USER (FORM) -->
<script>
function productEdit(act, pId){
	$('#modal-content-brand').css('display', 'none');
	$('#modal-content-product').css('display', 'block');
	
	/*$('#page-overlay').fadeIn('slow');*/

	$('#form-user-create').trigger("reset");
	$('.custom-file-upload-product').css('background', 'url(../../images/events/webpage/products/noProductPicture.png) center center no-repeat');	
	

   var row = $('.'+pId).closest('tr').index();	
    
    $('#action').val(act);
    $('#productId').val(pId);
    $('#tableRow').val(row);




    if(act == 1)
    {
    	
    	$("#productBrand option[value='']").attr("selected", true);
    	$('#form-schedule-create').trigger("reset");
    	$('#user-modal-title').text('Crear Nuevo Producto');
    	$('#user-modal-tip').text('	Ingresa los datos para el producto.');
    	$("#productBrand").append("<option value='' selected>Sin Especificar</option>");
    	$('#productBrand').val('').trigger('change');
    	
    }
    if(act == 2)
    {
    	//alert(pId);
    	
    	url= "{{ url('admin/event/products/geteditdata')}}"+"/"+pId;
	    $.get(url, function(data){
	    	var uData = jQuery.parseJSON(data);
	    	console.log(uData);
	    	
	    	$('#user-modal-title').text('Editar Producto');
	    	$('#user-modal-tip').text('Modifica los datos del producto.');
	    	$('#productId').val(uData.pId);
	    	$('#productName').val(uData.pName);
	    	$('#productDescription').val(uData.pDescription);
	    	$('#productPrice').val(uData.pPrice);
	    	
	    	
	    	var picUrl = "{{url('')}}/" + uData.pPicture;


    	    $('.custom-file-upload-product').css('background', "url('"+picUrl+"') center center no-repeat");
    	
    		
    	    if(uData.pBrand != null){
    			$("#productBrand option[value='"+uData.pBrand+"']").attr("selected", true);
		    			
		    	$('#productBrand').val(uData.pBrand).trigger('change');

    		}
    		else{
    			$("#productBrand option[value='']").attr("selected", true);	

    			$("#productBrand").append("<option value='' selected>Sin Especificar</option>");
    			$('#productBrand').val('').trigger('change');

    			

		    			
    		}
	    	$("#productCurrency option[value='"+uData.pCurrency+"']").attr("selected", true);
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
 		var tablebody = $("#asigned-products tbody");
		var pId = $(this).closest('tr').children('td.id').text();;
        swal({
		  title: "Confirmar",
		  text: "Está seguro de eliminar el producto seleccionado?",
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
			        url: "{{url('admin/event/products/delete')}}/"+pId,
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
			        statusCode: {
		                401: function() { 
		                    window.location.href = 'login'; //or what ever is your login URI 
		                },
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

 <!-- Print QR CODE -->
<script>
$("body").on("click", ".getQr", function(e) {
	var type = "product";
	var row = $(this).parent().parent();
	var tablebody = $("#asigned-products tbody");
	var companyId = $(this).closest('tr').children('td.id').text();
	var printDoc = new jsPDF();
	
	

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
        	
        /*	 $("#large").html(response.html);*/ 

        	 
        	 console.log(response);
        	window.open(response);
            
			
			

			


			/*
			var content = $('.qrcode').html();
		    var mywindow = window.open('', '', 'left=0,top=0,width=1200,height=800,toolbar=1,scrollbars=1,status=0');

		    mywindow.document.write('<html><head><title></title>');
		    mywindow.document.write('</head><body style="font-family:verdana; font-size:14px;width: 20cm;height: 29.7cm;">');
		    mywindow.document.write(content);
		    mywindow.document.write('</body></html>');

		   
		    mywindow.print();  */
			
						            
        },
         statusCode: {
		                401: function() { 
		                    window.location.href = 'login'; //or what ever is your login URI 
		                },
		            },
        error: function(xhr) {
         console.log(xhr.responseText); // this line will save you tons of hours while debugging
        // do something here because of error
       }
    });	
});


 </script>	

 <!--- Load picture -->
<script>
function loadPicture(event){
var selectedFile = event.target.files[0];
	var inputLength = $("#productPicture").size();

    if(inputLength > 0){
    	//$('#pictureChanged').val(1);
    	
    	$('.custom-file-upload-product').css('background', 'url('+ window.URL.createObjectURL(selectedFile) +') center center no-repeat');
    	 $('.custom-file-upload-product').css('background-size', '100% auto');

    }
    else{
    	$('#pictureChanged').val(0);	
    	$('.custom-file-upload-product').css('background', 'url(../../images/icons/companyAvatar.png) center center no-repeat');
    	 $('.custom-file-upload-product').css('background-size', '100% auto');


    }

    if(!inputLength){
    	$('.custom-file-upload-product').css('background', 'url(../../images/icons/companyAvatar.png) center center no-repeat');
    	 $('.custom-file-upload-product').css('background-size', '100% auto');
    }
	
}
</script>
