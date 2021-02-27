<div class="row">
	<div class="col-md-12">
	 <!-- BEGIN SAMPLE FORM PORTLET-->
	    <div class="portlet light bordered">
	        <div class="portlet-title">
	            <div class="caption font-black">
	                <i class="fa fa-globe"></i>
	                <span class="caption-subject bold"> Datos página web</span>
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
	        	<div class="tabbable-line tabs-below">
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_17_1">
				            <form id="form-page-create" method="POST" action="{{ route('store-page')}}" role="form" class="form-horizontal">
				                <div class="form-body">
				                	
				                	<input type="hidden" id="evId" name="evId" value="{{$eventId}}">
				                	{{ csrf_field() }}
				                     
				                	 <h3 class="page-header" style="margin-top:-15px"><i class="icon-social-dribbble font-red" ></i> Datos del Evento</h3>
			                         <div class="form-group custom-form-group">
			                            <label class="control-label col-md-2"> Subtítulo  <span class="required"> * </span></label>
			                            <div class="col-md-10">
			                                <div class="input-icon right">
			                                	<i class="fa fa-exclamation tooltips" data-original-title="please write a valid email"></i>
			                                	<input id="eventSubTitle" name="eventSubTitle" type="text" class="form-control" placeholder="Subtítulo del Evento" autofocus value="{{$subtitle}}" /> 
			                                </div>
			                            </div>
			                        </div>

			                        <div class="form-group custom-form-group">
				                        <label class="col-md-2 control-label" for="form_control_1">Descripción <span class="required"> * </span></label>
				                        <div class="col-md-10">
				                            <textarea id="eventDescription" name="eventDescription" class="form-control" rows="4" placeholder="Escriba una breve descripción del evento">{{$description}}</textarea>
				                        </div>
				                    </div>	

				                    <div class="form-group custom-form-group">
				                        <label class="col-md-2 control-label" for="form_control_1">Sobre nosotros <span class="required"> * </span></label>
				                        <div class="col-md-10">
				                            <textarea id="eventAboutUs" name="eventAboutUs" class="form-control" rows="4" placeholder="Escriba acerca de su empresa" >{{$about}}</textarea>
				                        </div>
				                    </div>		


									<div class="form-group custom-form-group">
				                        <label class="col-md-2 control-label" for="eventPhoneNumber">Teléfono de contacto</label>
				                        <div class="col-md-10">
				                           <div class="input-group">
				                            	<span class="input-group-addon"><i class="fa fa-phone"></i></span>
				                                <input id="eventPhoneNumber" name="eventPhoneNumber"  class="form-control" placeholder="Número de teléfono para el evento" type="phone"  value="{{$phone}}">

				                            </div>
				                        </div>
				                    </div>	

				                    <div class="form-group custom-form-group">
				                        <label class="col-md-2 control-label" for="eventWebSite">E-mail de contacto</label>
				                        <div class="col-md-10">
				                           <div class="input-group">
				                            	<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
				                                <input id="eventEmail" name="eventEmail"  class="form-control" placeholder="E-mail de contacto para el evento" type="email" value="{{$mail}}">

				                            </div>
				                        </div>
				                    </div>	

				                    <div class="form-group custom-form-group">
				                        <label class="col-md-2 control-label" for="eventWebSite">Link del sitio web</label>
				                        <div class="col-md-10">
				                           <div class="input-group">
				                            	<span class="input-group-addon"><i class="fa fa-link"></i></span>
				                                <input id="eventWebSite" name="eventWebSite"  class="form-control" placeholder="Link del sitio web" type="url" pattern="https?://.+" value="{{$wslink}}">

				                            </div>
				                        </div>
				                    </div>		                	     
			                                     
			                        <h3 class="page-header"><i class="icon-social-dribbble font-red"></i> Redes sociales</h3>
			                        <div class="form-group custom-form-group">
				                        <label class="col-md-2 control-label" for="eventFacebookLink">Link facebook</label>
				                        <div class="col-md-10">
				                           <div class="input-group">
				                            	<span class="input-group-addon"><i class="fa fa-facebook"></i></span>
				                                <input id="eventFacebookLink" name="eventFacebookLink"  class="form-control" placeholder="Facebook link" type="url" pattern="https?://.+" value="{{$flink}}">

				                            </div>
				                        </div>
				                    </div>

				                    <div class="form-group custom-form-group">
				                        <label class="col-md-2 control-label" for="eventTwiterLink">Link twitter</label>
				                        <div class="col-md-10">
				                            <div class="input-group">
				                            	<span class="input-group-addon"><i class="fa fa-twitter"></i></span>
				                                <input id="eventTwiterLink" name="eventTwiterLink" class="form-control" placeholder="Twitter link" type="url" pattern="https?://.+" value="{{$tlink}}">
				                                
				                            </div>
				                        </div>
				                    </div>
				                </div>
				                <div class="form-actions margin-top-10">
				                    <div class="row">
				                        <div class="col-md-offset-2 col-md-10">
				                            <!--<button type="button" class="btn default">Cancelar</button>-->
				                            <button id="btnSavePage" type="submit" class="btn blue btn-orange" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Guardando cambios..."><i class="fa fa-check"></i> Guardar cambios</button>
				                        </div>
				                    </div>
				                </div>
				            </form>
                        </div> <!-- END TAB -->
                        <div class="tab-pane" id="tab_17_2">
                           	<h3 class="page-header"><i class="fa fa-file-image-o font-red"></i> Imagen para Banner</h3>
                           	<span>Esta imagen se mostrará en la parte superior de su página web.</span>
                           		
				                <div class="form-body">
				                	<div class="row">
				                		<input type="hidden" id="action" name="action" value="1">
					                     <div class="form-group custom-form-group">
				                            <div id="elements-container2" style="max-width: 98%">
				                            	@foreach($bannerimgs as $image)
		                                           <div class="draggable-element draggablePic1" name="draggable-pic-1" id="{{$image->ID}}">
		                                               <div class="img-container">
		                                               <a href="{{ url('') }}/{{$image->PATH}}" class="fancybox-button" data-rel="fancybox-button">
		                                                  <img class="img-responsive" src="{{ url('') }}/{{$image->PATH}}" alt="">
		                                                </a>

		                                              </div>
		                                              <div class="elements-drag-area deg45">
		                                                <a href="javascript:ImgRemove({{$image->ID}}, 1);" class="btn btn-xs red img-remove" style="position: absolute; margin-top: 10px; right: 8px">
		                                                  Eliminar <i class="fa fa-remove"></i>
		                                                </a>
		                                              </div>
		                                           </div>
		                                        @endforeach
				                            </div>
				                            <div class="col-md-12">
				                            	<form action="{{ url('admin/pages/image-gallery')}}/{{$eventId}}/1" class="dropzone" id="dropzone-banner">

				                            		{{ csrf_field()  }}
				                            	</form>
				                            </div>
				                        </div>
			                        	

			                        <!--<h3 style="margin-top: 200px" class="page-header"><i class="fa fa-image font-red"></i> Imágenes para Galería</h3>
			                        	<span>Estas serán las imágenes que se mostrarán como una galería en su página web.</span>
				                        <div class="form-group custom-form-group">
				                         	<div id="gallery-container" class="col-md-12">

				                         	</div>

				                         	<div id="elements-container" style="max-width: 98%">
				                         		@foreach($galleryimgs as $image)
		                                           <div class="draggable-element draggablePic1" name="draggable-pic-1" id="{{$image->ID}}">
		                                               <div class="img-container">
		                                               <a href="{{ url('') }}/{{$image->PATH}}" class="fancybox-button" data-rel="fancybox-button">
		                                                  <img class="img-responsive" src="{{ url('') }}/{{$image->PATH}}" alt="">
		                                                </a>

		                                              </div>
		                                              <div class="elements-drag-area deg45">
		                                                <a href="javascript:ImgRemove({{$image->ID}}, 2);" class="btn btn-xs red img-remove" style="position: absolute; margin-top: 10px; right: 8px">
		                                                  Eliminar <i class="fa fa-remove"></i>
		                                                </a>
		                                              </div>
		                                           </div>
	                                            @endforeach
	                                         </div>

				                            <div class="col-md-10">
				                            	<form action="{{ url('admin/pages/image-gallery')}}/{{$eventId}}/2" class="dropzone" id="dropzone">
				                            		{{ csrf_field()  }}
				                            		
				                            	</form>
				                            </div>
				                        </div> -->
			                    	</div>
			                    </div>
			                    

                           
                        </div>

                        <div class="tab-pane" id="tab_17_3">
                           	<h3 class="page-header"><i class="fa fa-file-image-o font-red"></i> Imagen para Formulario de Registro</h3>
                           	<span>Esta imagen se mostrará en la parte superior del formulario.</span><br>
                           	<span>Tamaño (500 x 279 px).</span>
                           		
				                <div class="form-body">
				                	<form id="form-register-image" action="{{url('admin/pages/image-form')}}/{{$eventId}}" method="POST" role="form">
				                		{{ csrf_field() }}
					                	<div class="row">
					                		<div class="col-sm-4 text-center">
							          			<label for="companyLogo" class="custom-file-upload-event-form-register-image" style="background: url('{{url('/')}}/{{$registerFormImage}}') center center no-repeat;" >
												    <i class="fa fa-cloud-upload"></i> Seleccionar Imagen
												</label>
							                    <input id="companyLogo" name="companyLogo" type="file" onchange="loadPicture(event)">
									        </div>
				                    	</div>
				                    	 <div class="row">
					                        <div class="col-md-12">
					                            <!--<button type="button" class="btn default">Cancelar</button>-->
					                            <button id="btnSaveFormImage" type="submit" class="btn blue btn-orange" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Guardando cambios..."><i class="fa fa-check"></i> Actualizar Imagen</button>
					                        </div>
					                    </div>
					                </form>
			                    </div>
			                    

                           
                        </div>
                    </div>
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#tab_17_1" data-toggle="tab"> Datos principales de la página</a>
                        </li>
                        <li>
                            <a id="admin-page-imgs" href="#tab_17_2" data-toggle="tab"> Imágenes </a>
                        </li>

                        <li>
                            <a id="admin-page-imgs" href="#tab_17_3" data-toggle="tab"> Imagen Formulario de Registro </a>
                        </li>
                        
                    </ul>
                </div>
	        </div>
	    </div>
	    <!-- END SAMPLE FORM PORTLET-->
    </div> <!-- END col-md-12  -->
</div>

<script type="text/javascript" src="{{ URL::asset('metronic/scripts/bootstrap-daterangepicker/daterangepicker.min.js')}}"></script>
<script type="text/javascript" src="{{ URL::asset('metronic/scripts/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
<script type="text/javascript" src="{{ URL::asset('metronic/scripts/bootstrap-timepicker/js/bootstrap-timepicker.min.js')}}"></script>
<script type="text/javascript" src="{{ URL::asset('metronic/scripts/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js')}}"></script>
<script type="text/javascript" src="{{ URL::asset('metronic/scripts/clockface/js/clockface.js')}}"></script>
<script type="text/javascript" src="{{ URL::asset('metronic/scripts/components-date-time-pickers.min.js')}}"></script>
<script type="text/javascript" src="{{ URL::asset('metronic/scripts/ui-buttons-spinners.min.js')}}"></script>
<script type="text/javascript" src="{{ URL::asset('metronic/scripts/components-bootstrap-select.min.js')}}"></script>
<script type="text/javascript" src="{{ URL::asset('metronic/scripts/dropzone.js')}}"></script>


<script>
		jQuery(document).ready( function($) {
			$('.datepicker').datepicker({
				    format: 'dd/mm/yyyy',
				    startDate: '-3d',
				    dayNames: [ 'Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado' ],
				    dayNamesMin: [ 'Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa' ],
				});

			
		});
		</script>
<!-- BEGIN CREATE/EDIT PAGE (FORM) -->
<script>
	 $.ajaxSetup({
           headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
        });
jQuery(document).ready( function($) {
	$( "#form-page-create" ).submit(function( event ) {
		event.preventDefault();
		//$('#page-overlay-msg').text('Guardando Página');
		/*$('#page-overlay').fadeIn('slow');*/
		var $btnc = $('#btnSavePage');
		
		var data = new FormData($(this)[0]);
		var form = $(this);
		$.ajax({
          type: "POST",
          url: form.attr( "action" ),
          data: data,
          /*async: false,*/
          cache: false,
          contentType: false,
          processData: false,
          beforeSend:function(xhr){
          		$btnc.button('loading');
          		$('#page-overlay-msg').text('Guardando Página...');
          		$('#page-overlay').fadeIn('slow');

          	},
          success: function (data) {
            /*var uData = jQuery.parseJSON(data);
            console.log(data);
            if(uData.status == 'success')
			{

				$('#overlay-msg').text('Página creada con éxito');
				swal({
					  title: uData.message,
					  text: "Desea agregar imágenes a su página?",
					  type: "success",
					  showCancelButton: true,
					  confirmButtonClass: "btn green-sharp",
					  confirmButtonText: "Si",
					  cancelButtonText: "En otro momento",
					  closeOnConfirm: true,
					  closeOnCancel: true
					},
					function(isConfirm) {
					  if (isConfirm) {
					      $('#admin-page-imgs').click();
					  } else {
					    $('#home-page').click();
					  }
					});
				
			}
			else{
				$('#overlay-msg').text('Página editada con éxito');
			}

		 	setTimeout(function(){
		  		$('#page-overlay').fadeOut('slow');
			}, 1500);   */   
          }
        }).done(function(data) {

        	 var uData = jQuery.parseJSON(data);
            console.log(data);
            if(uData.status == 'success')
			{

				$('#overlay-msg').text('Página creada con éxito');
				 $btnc.button('reset');
				swal({
					  title: uData.message,
					  text: "Desea agregar imágenes a su página?",
					  type: "success",
					  showCancelButton: true,
					  confirmButtonClass: "btn green-sharp",
					  confirmButtonText: "Si",
					  cancelButtonText: "Cerrar",
					  closeOnConfirm: true,
					  closeOnCancel: true
					},
					function(isConfirm) {
					  if (isConfirm) {
					      $('#admin-page-imgs').click();
					  } else {
					   // $('#home-page').click();
					  }
					});
				
			}
			else{
				$('#overlay-msg').text('Página editada con éxito');
			}

		 	setTimeout(function(){
		  		$('#page-overlay').fadeOut('slow');
			}, 1500); 


        });




		$('#eventTitle').tooltip('show');
		 
	});
});
</script>

<!-- INITIALIZE DRAGABLE -->
<script type="text/javascript" src="{{ URL::asset('metronic/scripts/drag-arrange.js')}}"></script>

<script type="text/javascript">
    $(function() {
        $('.draggable-element').arrangeable();
        $('li').arrangeable({dragSelector: '.drag-area'});
      });
</script>
<!-- END INITIALIZE DRAGABLE -->



<!-- UPLOAD IMAGES -->
<script>
	$.ajaxSetup({
		   headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
		});
jQuery(document).ready( function($) {
	$('#dropzone').dropzone({
		addRemoveLinks: true,
		maxFileSize: 8192,
		dictResponseError: 'Ha ocurrido un error con el servidor',
		acceptedFiles: 'image/*,.jpeg,.jpg,.png,.gif,.JPEG,.JPG,.PNG,.GIF',
		dictRemoveFile: 'Eliminar archivo',
		dictDefaultMessage: 'Arrastra y suelta imágnes aquí.',
		dictFallbackText: 'fallbacktext',
		dictFallbackMessage: 'dictFallbackMessage',
		dictFileTooBig: 'dictFileTooBig',
		dictCancelUpload: 'Eliminar Archivo',
		complete: function(file){
			if(file.status == 'success'){
				
			}
		},
		success: function(file, response){	
		myDropzone = this;

		var appendDiv = '<div class="draggable-element draggablePic1" name="draggable-pic-1" id="1"><div class="img-container"><a href="'+ response.imgsrc+'" class="fancybox-button" data-rel="fancybox-button"><img class="img-responsive" src="'+ response.imgsrc+'" alt=""></a></div><div class="elements-drag-area deg45"><a href="javascript:ImgRemove("'+ response.imgId+'", 1);" class="btn btn-xs red img-remove" style="position: absolute; margin-top: 10px; right: 8px"> Eliminar <i class="fa fa-remove"></i></a></div></div>';


		
			setTimeout(function(){
		  			myDropzone.removeFile(file);
			}, 1500);   
 			$('#elements-container').append(appendDiv);
 			$('.draggable-element').arrangeable();
		},
		error: function(file){
				alert(file.status);
		},
		removedFile: function(file, serverFileName){
			var name = file.name;

			$.ajax({
				type: 'POST',
				url: "{{ url('admin/pages/image-gallery-delete')}} ",
				data: "filename="+name,
				success: function(data){
					var json = JOSON.parse(data);
					if(json.res ==true)
					{
						var element;
						(element = file.previewElement) != null ?
						element.parentNode.removeChild(file.previewElement) :
						false;
						alert("El elemento ha sido eliminado: " + name);
					}
				}
			})
		}
	});


	$('#dropzone-banner').dropzone({
		addRemoveLinks: true,
		maxFileSize: 8192,
		dictResponseError: 'Ha ocurrido un error con el servidor',
		acceptedFiles: 'image/*,.jpeg,.jpg,.png,.gif,.JPEG,.JPG,.PNG,.GIF',
		dictRemoveFile: 'Eliminar archivo',
		dictDefaultMessage: 'Arrastra y suelta imágnes aquí.',
		dictFallbackText: 'fallbacktext',
		dictFallbackMessage: 'dictFallbackMessage',
		dictFileTooBig: 'dictFileTooBig',
		dictCancelUpload: 'Eliminar Archivo',
		complete: function(file){
			if(file.status == 'success'){
				
			}
		},
		success: function(file, response){	
		myDropzone = this;

		var appendDiv = '<div class="draggable-element draggablePic1" name="draggable-pic-1" id="1"><div class="img-container"><a href="'+ response.imgsrc+'" class="fancybox-button" data-rel="fancybox-button"><img class="img-responsive" src="'+ response.imgsrc+'" alt=""></a></div><div class="elements-drag-area deg45"><a href="javascript:ImgRemove("'+ response.imgId+'", 2);" class="btn btn-xs red img-remove" style="position: absolute; margin-top: 10px; right: 8px"> Eliminar <i class="fa fa-remove"></i></a></div></div>';


		
			setTimeout(function(){
		  			myDropzone.removeFile(file);
			}, 1500);   
 			$('#elements-container2').append(appendDiv);
 			$('.draggable-element').arrangeable();
		},
		error: function(file){
				alert(file.status);
		},
		removedFile: function(file, serverFileName){
			var name = file.name;

			$.ajax({
				type: 'POST',
				url: "{{ url('admin/pages/image-gallery-delete')}} ",
				data: "filename="+name,
				success: function(data){
					var json = JOSON.parse(data);
					if(json.res ==true)
					{
						var element;
						(element = file.previewElement) != null ?
						element.parentNode.removeChild(file.previewElement) :
						false;
						alert("El elemento ha sido eliminado: " + name);
					}
				}
			})
		}
	});

});


</script>
<!-- END UPLOAD IMAGES -->

<!-- img remove -->
<script>
	function ImgRemove(imgId, ubication){

		swal({
		  title: "Confirmar",
		  text: "Está seguro de eliminar la imagen seleccionada?",
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
			        url: "{{ url('admin/pages/image-gallery/delete')}}/"+imgId+"/"+ubication,
			        type: 'delete', // replaced from put
			        dataType: "JSON",
			        data: {
			            "id": imgId // method and token not needed in data
			        },
			        success: function (response)
			        {
			        	if(response.status == 'success'){
				        	$('#'+imgId).fadeOut('slow');
				            swal("Eliminado!", response.message, "success");
				            if (tablebody.children().length == 0) {
							    tablebody.html("<tr class='table-empty'><td colspan='6' class='text-center'>No existen usuarios asignados al evento!</td></tr>");
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
	}

</script>



<!--- Load picture -->
<script>
function loadPicture(event){
var selectedFile = event.target.files[0];
	var inputLength = $("#companyLogo").size();

    if(inputLength > 0){
    	//$('#pictureChanged').val(1);
    	
    	$('.custom-file-upload-event-form-register-image').css('background', 'url('+ window.URL.createObjectURL(selectedFile) +') center center no-repeat');
    	 $('.custom-file-upload-event-form-register-image').css('background-size', '100% auto');
    }
    else{
    	$('#pictureChanged').val(0);	
    	$('.custom-file-upload-event-form-register-image').css('background', 'url(../../images/icons/companyAvatar.png) center center no-repeat');
    	$('.custom-file-upload-event-form-register-image').css('background-size', '100% auto');
    }

    if(!inputLength){
    	$('.custom-file-upload-event-form-register-image').css('background', 'url(../../images/icons/companyAvatar.png) center center no-repeat');
    	$('.custom-file-upload-event-form-register-image').css('background-size', '100% auto');
    }
	
}
</script>


<script>
jQuery(document).ready( function($) {
	$("#form-register-image").submit(function( event ) {
		event.preventDefault();
		//$('#page-overlay-msg').text('Guardando Página');
		/*$('#page-overlay').fadeIn('slow');*/
		var $btnc = $('#btnSaveFormImage');
		
		var data = new FormData($(this)[0]);
		var form = $(this);
		
		$.ajax({
	        type: "POST",
	        url: form.attr( "action" ),
	        data: data,
	        /*async: false,*/
	        cache: false,
	        contentType: false,
	        processData: false,
	        beforeSend:function(xhr){
          		$btnc.button('loading');
          		$('#page-overlay-msg').text('Guardando imagen de registro...');
          		$('#page-overlay').fadeIn('slow');
          	},
	       
	        success: function (response){

	        },
	    }).done(function(response){

	    	$('#overlay-msg').text('Imagen actualizada con éxito!');
	    	$('#page-overlay').fadeOut('slow');
		    $btnc.button('reset');

	    });

	});
});

</script>