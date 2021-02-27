<div class="row">

	<div class="col-md-12">
		
		<div class="portlet light bordered">
	        <div class="portlet-title">
	            <div class="caption font-black">
	                <i class="fa fa-building font-black"></i>
	                <span class="caption-subject bold "> @if($hideOptions==0) Empresas @else Información de mi Empresa  @endif</span>
	            </div>
	            <div class="actions">

	            	@if($hideOptions==0) 
	            		@if($eventAdminStatus == 1)
	            		<a href="javascript:userEdit(1,1);"  class="btn green pull-right"><i class="fa fa-plus"></i> Crear empresa</a>
	            		@endif
	            	@endif
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
	        	@if($eventAdminStatus == 0)
	        	<div class="col-md-12 p-0" style="margin-top: 20px;">
	                <div class="alert alert-danger">
	                    <strong>Evento cerrado!</strong> No se pueden administar empresas para este evento.
	                </div>
	            </div>
	           	@endif
	        	<div class="row">        

			        <div class="col-md-12 col-sm-12" style="margin-top: 10px;">
			        	<div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">@if($hideOptions==0) Empresas Registradas @else Mi empresa  @endif</h3>
                            </div>
                            <div class="panel-body"> 

                            	<!-- BEGIN SAMPLE TABLE PORTLET-->
                                
                                <div class="table-scrollable">
                                    <table id="assigned-companies" class="table table-hover" style="width: 100% !important">
                                        <thead>
                                            <tr>
                                            	<th style="display: none" class="hidden"> ID</th>
                                            	<th> Logo </th>
                                            	<th> Nombre </th>
                                                <th> Dirección </th>
                                                <th> Teléfono </th>
                                                <th> Acciones </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	@foreach($companies as $company)
	                                            <tr>
	                                            	<td class="id" style="display: none; vertical-align: middle;">{{$company->id}}</td>
	                                            	<td> <img src="{{url('/')}}/images/events/companies/logos/{{$company->companyPicture}}" width="50" > </td>
	                                            	<td> {{$company->companyName}} </td>
	                                                <td> @if($company->companyAddress==null) Sin especificar @else {{$company->companyAddress }} @endif</td>
	                                                <td> {{$company->companyCountryCode }} {{$company->companyPhone }}</td>
	                                                <td class="{{$company->id}}"> 
	                                                	@if($hideOptions!=1)
	                                                	<a href="javascript:userEdit(2,{{$company->id}});" id="edit-btn" class="btn btn-xs btn-default @if($eventAdminStatus == 0) disabled @endif"><i class="fa fa-edit"></i> Editar</a>
	                                                	@endif
	                                                	@if($hideOptions==0) <button id="sweet-8" class="btn btn-xs btn-default sweet-8 @if($eventAdminStatus == 0) disabled @endif"><i class="fa fa-trash"></i> Eliminar</button>@endif
	                                                	<form id="form-qr" method="post" action="{{url('admin/qrs/generate')}}" target="_blank">
	                                                		{{ csrf_field() }}
	                                                		<input type="hidden" name="id" value="{{$company->id}}">
	                                                		<input type="hidden" name="type" value="company">
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

	        </div> <!--end::portled-body -->

	    </div> <!--end::portlet-bordered -->




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
		        <div class="qrcode" id="qrcode" style="width: 400px; height: 400px; border: 0px solid; margin: 0 auto"></div>
		      </div>
		      <div class="modal-footer">
		      	 <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
		        <button type="button" class="btn btn-primary qrPrint">Imprimir</button>
		       
		      </div>
		    </div>
		  </div>
		</div>

	</div> <!--end:: col-md-12 -->

</div> <!--end::row -->

	    <div class="modal fade bs-modal-lg in" id="large" tabindex="1" role="dialog" aria-hidden="true">


            <div class="modal-dialog modal-lg" style="overflow-y: initial !important">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 id="user-modal-title" class="modal-title">Nueva Empresa</h4>
                        <p id="user-modal-tip">Ingresa los datos para la empresa.</p>
                    </div>
                    <div class="modal-body" style="overflow-y: auto;     height: 700px;"> 

                    	<form id="form-company-create" class="form-horizontal" method="POST" role="form" action="{{ route('event-company-store') }}" enctype="multipart/form-data">
                        	<!-- BEGIN FORM BODY -->
                        	<div class="form-body">
                        		 {{ csrf_field() }}
                        		<input id="action" name="action" type="hidden" class="form-control">
                        		<input id="companyId" name="companyId" type="hidden" class="form-control"> 
                        		<input id="tableRow" name="tableRow" type="hidden" class="form-control"> 
                        		<input id="eventId" name="eventId" type="hidden" class="form-control" value="{{$eventId}}">



                        		<div class="form-group custom-form-group">
                        			<div class="col-sm-4 text-center">
					          			<label for="companyLogo" class="custom-file-upload" >
										    <i class="fa fa-cloud-upload"></i> Seleccionar Imagen
										</label>
					                    <input id="companyLogo" name="companyLogo" type="file" onchange="loadPicture(event)">
							        </div>
			                        <div class="col-md-8">
			                        	<div class="col-md-12" style="padding: 10px 0px 0px 0px">
			                        		<label>Nombre de la empresa <span class="required">*</span></label>
			                            	<input id="companyName"" name="companyName" type="text"  class="form-control custom-form-control" placeholder="Ingrese el nombre de la Empresa" required maxlength="100" @if($hideOptions==1) readonly="readonly"  @endif />
			                           	</div> 
			                           	<div class="col-md-12" style="padding: 10px 0px 0px 0px;">
			                           		<label>Descripción de la Empresa</label>
			                            	<textarea rows="4" id="companyDescription" name="companyDescription" type="text"  class="form-control" placeholder="Descripción general de la empresa" maxlength="255" @if($hideOptions==1) readonly="readonly"  @endif /></textarea>
			                        	</div>

			                        	<div class="col-md-12" style="padding: 10px 0px 0px 0px">
			                        		<label for="companyAddress">Dirección <span class="required">*</span></label>
			                           		<input id="companyAddress" name="companyAddress" type="text"  class="form-control custom-form-control" placeholder="Dirección" required maxlength="150" @if($hideOptions==1) readonly="readonly"  @endif  />
			                        	</div>

			                        	<div class="col-md-12" style="padding: 10px 0px 0px 0px">
			                        		
			                        		
			                        			<label for="companyAddress" style="width: 100%">Teléfono <span class="required">*</span></label>
			                        			<input type="text" id="companyCountryCode" name="companyCountryCode" class="form-control custom-form-control" placeholder="País ej:  (+502)" style="width: 28% !important; float: left;" maxlength="10" @if($hideOptions==1) readonly="readonly"  @endif>
			                        		
			                           			<input id="companyPhone" name="companyPhone" type="text"  class="form-control custom-form-control bfh-phone pull-right" placeholder="Número de Teléfono" required style="width: 68% !important" maxlength="15" @if($hideOptions==1) readonly="readonly"  @endif />
			                           		
			                        	</div>
			                        </div>


			                        <div class="col-md-6 col-sm-12" style="padding-top: 10px">
			                        	<label>Correo electrónico </label>
			                            <input id="companyEmail"" name="companyEmail" type="email"  class="form-control custom-form-control" placeholder="Email de la empresa"  maxlength="150" @if($hideOptions==1) readonly="readonly"  @endif />
			                        </div>

			                        <div class="col-md-6 col-sm-12" style="padding-top: 10px;">
			                        	<label>Sitio web </label>
			                            <input id="companyWebSite"" name="companyWebSite" type="text"  class="form-control custom-form-control" placeholder="Sitio web de la empresa"  maxlength="150" @if($hideOptions==1) readonly="readonly"  @endif />
			                        </div>

			                      

			                    </div>
			                    
			                    <input type="hidden" id="countDinamicFields" name="countDinamicFields" value="{{$countDinamicFields}}"> 
			                    
			                   
			                  	@if($countDinamicFields>0)
			                    	{!!$dinamicFields!!}
			                    @endif 
			                
 							
			                    <div class="clear" style="height: 100px; width: 100%"></div>
			                     

			                    
			                    <input type="hidden" id="userEventType" name="userEventType" value="5">
			                    @if($hideOptions!=1)
			                    <button type="submit" id="btn-create-company" class="btn green pull-right" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Registrando Empresa...">Guardar Empresa</button> @endif                           	
                        		<button type="button" class="btn dark btn-outline btn-default pull-right" style="margin-right: 10px" data-dismiss="modal">Cerrar</button>
			                    
                        	</div> 
                        	<!-- END FORM BODY -->  
                        	<br><br>
    						
                        </form>

                    </div>
                    <div class="modal-footer" style="float: left; margin-top: -20px; border-top: 0px;">
                                                        
					</div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>  
        <!-- /.modal-fade end --> 


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

<!-- Datatable -->
<script>
    
jQuery(document).ready( function($) {
 myTable =   $('#assigned-companies').DataTable( {
         responsive: true,
         @if($hideOptions==1)
         "bFilter": false,
          "lengthChange": false,
         @endif
         "createdRow": function ( row, data, index ) {
                        $('td', row).eq(0).addClass("hidden");
                         $('td', row).eq(0).addClass("id");
                       
                    },
         "language": {
            "lengthMenu": "Mostrar _MENU_ empresas por página",
            "zeroRecords": "No se encontraron registros",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "No se encontraror registros",
            "search": "Buscar",
            "infoEmpty": "No hay registros disponibles",
            "zeroRecords": "No se han encontrado empresas",
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


$('#companyPhone').keypress(function(event){
    /*console.log(event.which);*/
if((event.which != 8 && isNaN(String.fromCharCode(event.which))) || event.which ==32){
    event.preventDefault();
}});


$('#large').on('shown.bs.modal', function() {
  $('#companyName').focus();
})
</script>


<!-- BEGIN CREATE NEW USER (FORM) -->
<script>
	$( "#form-company-create" ).submit(function( event ) {
		event.preventDefault();
		var $btnc = $('#btn-create-company');
		
		var action = $('#action').val();
		var tablebody = $("#assigned-companies tbody");
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
						$('#overlay-msg').text('Creando Empresa');
					}
					else{
						$('#overlay-msg').text('Editando Empresa');
						row = $('#tableRow').val();
						var newRow = + row + 1;
						$('#assigned-companies tr:eq('+newRow+')').addClass('table-row-editing');
					}
					$('#page-overlay').appendTo('body');
					$('#page-overlay').css('z-index', '99999999');
					$('#page-overlay').fadeIn('slow');
	        	},
	          success: function (data) {
	            
		      },
	          statusCode: {
                401: function() { 
                    window.location.href = 'login'; //or what ever is your login URI 
                }
              },
	          error: function(){
	          	setTimeout(function(){
					$('#page-overlay').fadeOut('slow');
					/*$('#large').modal('hide');*/
					$btnc.button('reset');
					Command: toastr["warning"]("Ha ocurrido un error!", "Alerta");
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
	            console.log(uData);
	           
	            var btn='<button class="btn btn-xs btn-default sweet-8"><i class="fa fa-trash"></i> Eliminar</button>';
	            
	            
	            if(action == 1)
				{
					if(uData.status=='success')
					{
					
					setTimeout(function(){
			  			$('#overlay-msg').text(uData.msg);
					}, 2000);
					var itoken = '{{ csrf_field() }}';
					var img = uData.cPic;
					var t = $('#assigned-companies').DataTable();
	                
	                var rowNode = t.row.add( [
	                    uData.cId,
	                    "<img  src='"+ img +"' width='50'>",
	                    uData.cName,
	                    uData.cAddress,
	                    uData.cPhone,
	                    "<a href='javascript:userEdit(2,"+uData.cId+");' id='edit-btn' class='btn btn-xs btn-default'><i class='fa fa-edit'></i> Editar</a> "+ btn + "<form id='form-qr' method='post' action='{{url('admin/qrs/generate')}}' target='_blank'>"+ itoken +" <input type='hidden' name='id' value='"+ uData.cId +"'> <input type='hidden' name='type' value='company'> <button type='submit' id='getQr2' class='btn btn-xs btn-default getQr'><i class='fa fa-qrcode'></i> Generar QR</button> </form>" 
	                ] ).draw().node();
					setTimeout(function(){
						$('#page-overlay').fadeOut('slow');
						$('#large').modal('hide');
						 $btnc.button('reset');
						swal({
							type: "success",
							title: "Mensaje",
							text: "Se ha registrado la empresa con éxito!",
							timer: 3000,
							 showCancelButton: false,
						});
					}, 1000);
					}
					if(uData.status=='exists')
					setTimeout(function(){
			  			$('#overlay-msg').text(uData.message);
			  			 $btnc.button('reset');
					}, 2000);
				  console.log(uData);
					
				}
				else{
					var newRow = + row + 1;
					var img = uData.cPic;
					$('#assigned-companies tr:eq('+newRow+') td').eq(0).text(uData.cId);
					$('#assigned-companies tr:eq('+newRow+') td').eq(1).html("<img  src='"+ img +"' width='50'>");
					$('#assigned-companies tr:eq('+newRow+') td').eq(2).text(uData.cName);
					$('#assigned-companies tr:eq('+newRow+') td').eq(3).text(uData.cAddress);
					$('#assigned-companies tr:eq('+newRow+') td').eq(4).text(uData.cPhone);
					
					setTimeout(function(){
			  		$('#overlay-msg').text('Empresa actualizada con éxito');
				}, 2000);
					
					setTimeout(function(){
						$('#page-overlay').fadeOut('slow');
						$('#large').modal('hide');
						 $btnc.button('reset');
						swal({
							type: "success",
							title: "Mensaje",
							text: "Se ha actualizado la empresa con éxito!",
							timer: 3000,
							showCancelButton: false,
						});
					
					}, 1000);
				}
				if(newRow==0){
					newRow =1 ;
				}	
			 	setTimeout(function(){
			  		$('#page-overlay').fadeOut('slow');
			  		$('#assigned-companies tr:eq('+newRow+')').removeClass('table-row-editing');
				}, 1000);    
	          




			});
	        setTimeout(function(){
			  		$('#page-overlay').fadeOut('slow');
			  		 $btnc.button('reset');
				}, 1000); 
		
	});	
</script>
<!-- END CREATE NEW USER (FORM) -->



<!-- BEGIN EDIT USER (FORM) -->
<script>
function userEdit(act, uId){

	$('.custom-file-upload').css('background', 'url(../../images/events/companies/logos/noCompanyPicture.png) center center no-repeat');	
	/*$('#page-overlay').fadeIn('slow');*/

	var row = $('.'+uId).closest('tr').index();	
    
    $('#action').val(act);
    $('#companyId').val(uId);
    $('#tableRow').val(row);
    $('#form-company-create').trigger("reset");

    if(act == 1)
    {
    	
    	$('#user-modal-title').text('Crear Nueva Empresa');
    	$('#user-modal-tip').text('	Ingresa los datos para la empresa.');

    	 $("#btn-create-company").text('Crear Empresa');
    	
    }
    if(act == 2)
    {
    	$("#btn-create-company").text('Guardar Cambios');
    	$('#user-modal-title').text('Editar Empresa');
	    $('#user-modal-tip').text('Modifica los datos de la empresa.');
    	url= "{{ url('admin/events/company/geteditdata')}}"+"/"+uId;
	    $.get(url, function(data){
	    	var uData = data;
	    	/*console.log(uData);*/
	    	
	    	$('#companyId').val(uId);
	    	$('#companyName').val(uData.cName);
	    	$('#companyDescription').val(uData.cDescription);
	    	$('#companyPhone').val(uData.cPhone);
	    	$('#companyAddress').val(uData.cAddress);
	    	$('#companyCountryCode').val(uData.cCode);
	    	$('#companyEmail').val(uData.cEmail);
	    	$('#companyWebSite').val(uData.cWebSite);

	    	var picUrl = uData.cPic;


	    	if(uData.countDinamics > 0){
	    		$.each(uData.dFields , function(index, val) { 
			  		/*console.log(val.IDA + ' ' + val.TAG + ' ' + val.ANSWER);*/

			  		$('#'+val.IDA).val(val.ANSWER);
				});
	    	}



    	    $('.custom-file-upload').css('background', "url('"+picUrl+"') center center no-repeat");

    		
    	});
    }
    document.getElementById("companyName").focus();
     
	$('#large').modal('show');
	$('.modal-backdrop').appendTo('body');  
	$('.modal').appendTo('body'); 

	/*$('#myModal').modal('hide');*/	
};	

</script>
<!-- END EDIT COMPANY (FORM) -->

<!-- DELETE COMPANY -->
 <script type="text/javascript">
 	$("body").on("click", ".sweet-8", function() {
 		var row = $(this).parent().parent();
 		var tablebody = $("#assigned-companies tbody");
		var uId = $(this).closest('tr').children('td.id').text();
		var t = $('#assigned-companies').DataTable();
		var row = t.row($(this).parents('tr'));
        swal({
		  title: "Se eliminará la Empresa",
		  text: "Está seguro de eliminar la Empresa?",
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
			        url: "{{ url('admin/events/company/delete')}}/"+uId,
			        type: 'delete', // replaced from put
			        dataType: "JSON",
			        data: {
			            "id": uId // method and token not needed in data
			        },
			        success: function (response)
			        {
			        	if(response.status == 'success'){
				        	row.remove().draw(false);
				            swal("Eliminado!", 'Se ha eliminado correctamente la empresa', "success");
				            if (tablebody.children().length == 0) {
							    tablebody.html("<tr class='table-empty'><td colspan='6' class='text-center'>No existen empresas registradas en el evento!</td></tr>");
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

	$("body").on("click", ".getQr", function(e) {
	var type = "company";
	var row = $(this).parent().parent();
	var tablebody = $("#assigned-companies tbody");
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

		    /*mywindow.document.close();
		    mywindow.focus()*/
		    mywindow.print();
		  /*  mywindow.close()*/;
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

 <script>
 $('.qrPrinta').on("click", function(e) {
 var printBlock = $('#qrcodea');
  printBlock.hide();
  window.print();
  printBlock.show();
});

 </script>

 <script>
 	
 	$('.qrPrint').on('click', function () {
 		
 		 var printBlock =  $('#qrcode');
		  printBlock.hide();
		  window.print();
		  printBlock.show();

    });

    
 </script>

<!-- <script>
function testAnim(x) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog  modal-lg ' + x + '  animated');
};
$('#large').on('show.bs.modal', function (e) {
  var anim = 'bounceIn';
      testAnim(anim);
})
$('#large').on('hide.bs.modal', function (e) {
  var anim = 'bounceOut';
      testAnim(anim);
})
</script> -->


<!--- Load picture -->
<script>
function loadPicture(event){
var selectedFile = event.target.files[0];
	var inputLength = $("#companyLogo").size();

    if(inputLength > 0){
    	//$('#pictureChanged').val(1);
    	
    	$('.custom-file-upload').css('background', 'url('+ window.URL.createObjectURL(selectedFile) +') center center no-repeat');
    	 $('.custom-file-upload').css('background-size', '100% auto');
    }
    else{
    	$('#pictureChanged').val(0);	
    	$('.custom-file-upload').css('background', 'url(../../images/icons/companyAvatar.png) center center no-repeat');
    	$('.custom-file-upload').css('background-size', '100% auto');
    }

    if(!inputLength){
    	$('.custom-file-upload').css('background', 'url(../../images/icons/companyAvatar.png) center center no-repeat');
    	$('.custom-file-upload').css('background-size', '100% auto');
    }
	
}
</script>



    	
