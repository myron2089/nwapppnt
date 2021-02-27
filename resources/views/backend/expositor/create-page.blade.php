<div class="row">
	<div class="col-md-12">
	 <!-- BEGIN SAMPLE FORM PORTLET-->
	    <div class="portlet light bordered">
	        <div class="portlet-title">
	            <div class="caption font-green-haze">
	                <i class="icon-settings font-green-haze"></i>
	                <span class="caption-subject bold uppercase"> Crear Páginas</span>
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
	        	<div class="tabbable-line tabs-below">
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_17_1">
				            <form id="form-page-create" method="POST" action="{{ route('store-page')}}" role="form" class="form-horizontal">
				                <div class="form-body">
				                	<input type="hidden" id="action" name="action" value="1">
				                   

			                       

			                        <div class="form-group custom-form-group">
				                        <label class="col-md-2 control-label" for="form_control_1">Descripción del evento <span class="required"> * </span></label>
				                        <div class="col-md-10">
				                            <textarea id="eventDescription" name="eventDescription" class="form-control" rows="4" placeholder="Escriba una breve descripción dl evento"></textarea>
				                        </div>
				                    </div>


									<h3 class="page-header"><i class="fa fa-map-o font-red"></i> Ubicación y horarios</h3>

				                           
			                        <h3 class="page-header"><i class="icon-social-dribbble font-red"></i> Redes Sociales</h3>
			                        <div class="form-group custom-form-group">
				                        <label class="col-md-2 control-label" for="eventFacebookLink">Link Facebook</label>
				                        <div class="col-md-10">
				                           <div class="input-group">
				                            	<span class="input-group-addon"><i class="fa fa-facebook"></i></span>
				                                <input id="eventFacebookLink" name="eventFacebookLink"  class="form-control" placeholder="Facebook link" type="url" pattern="https?://.+">

				                            </div>
				                        </div>
				                    </div>

				                    <div class="form-group custom-form-group">
				                        <label class="col-md-2 control-label" for="eventTwiterLink">Link Twitter</label>
				                        <div class="col-md-10">
				                            <div class="input-group">
				                            	<span class="input-group-addon"><i class="fa fa-twitter"></i></span>
				                                <input id="eventTwiterLink" name="eventTwiterLink" class="form-control" placeholder="Twitter link" type="url" pattern="https?://.+">
				                                
				                            </div>
				                        </div>
				                    </div>





				                </div>
				                <div class="form-actions margin-top-10">
				                    <div class="row">
				                        <div class="col-md-offset-2 col-md-10">
				                            <button type="button" class="btn default">Cancelar</button>
				                            <button type="submit" class="btn blue">Guardar Cambios</button>
				                        </div>
				                    </div>
				                </div>
				            </form>
                        </div> <!-- END TAB -->
                        <div class="tab-pane" id="tab_17_2">
                           	<h3 class="page-header"><i class="icon-social-dribbble font-red"></i> Imagen para Banner</h3>
                           		
				                <div class="form-body">
				                	<div class="row">
				                		<input type="hidden" id="action" name="action" value="1">
					                     <div class="form-group custom-form-group">
				                            
				                            <div class="col-md-12">
				                            	<form action="{{ url('admin/pages/image-gallery')}}" class="dropzone" id="dropzone-banner">
				                            		{{ csrf_field()  }}
				                            	</form>
				                            </div>
				                        </div>
			                        	<h3 style="margin-top: 200px" class="page-header"><i class="icon-social-dribbble font-red"></i> Imágenes para Galería</h3>
				                        <div class="form-group custom-form-group">
				                         	<div id="gallery-container" class="col-md-12">

				                         	</div>

				                         	<div id="elements-container" style="max-width: 98%">
	                                           <div class="draggable-element draggablePic1" name="draggable-pic-1" id="1">
	                                               <div class="img-container">
	                                               <a href="{{ url('images/86830697.jpg') }}" class="fancybox-button" data-rel="fancybox-button">
	                                                  <img class="img-responsive" src="{{ url('images/86830697.jpg') }}" alt="">
	                                                </a>

	                                              </div>
	                                              <div class="elements-drag-area deg45">
	                                                <a href="javascript:ImgRemove(1, 2);" class="btn btn-xs red img-remove" style="position: absolute; margin-top: 10px; right: 8px">
	                                                  Eliminar <i class="fa fa-remove"></i>
	                                                </a>
	                                              </div>
	                                           </div>
	                                         </div>

				                            <div class="col-md-10">
				                            	<form action="{{ url('admin/pages/image-gallery')}}" class="dropzone" id="dropzone">
				                            		{{ csrf_field()  }}
				                            		
				                            	</form>
				                            </div>
				                        </div>
			                    	</div>
			                    </div>
			                    

                           
                        </div>
                    </div>
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#tab_17_1" data-toggle="tab"> Datos Principales de la Página</a>
                        </li>
                        <li>
                            <a href="#tab_17_2" data-toggle="tab"> Multimedia </a>
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
		$('#page-overlay-msg').text('Guardando Página');
		$('#page-overlay').fadeIn('slow');

		var data = new FormData($(this)[0]);
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
            console.log(data);
            if(action == 1)
			{
				$('#overlay-msg').text('Página creada con éxito');
				
			}
			else{
				$('#overlay-msg').text('Página editada con éxito');
			}

		 	setTimeout(function(){
		  		$('#page-overlay').fadeOut('slow');
			}, 1500);      
          }
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

		var appendDiv = '<div class="draggable-element draggablePic1" name="draggable-pic-1" id="1"><div class="img-container"><a href="'+ response.imgsrc+'" class="fancybox-button" data-rel="fancybox-button"><img class="img-responsive" src="'+ response.imgsrc+'" alt=""></a></div><div class="elements-drag-area deg45"><a href="javascript:ImgRemove(1, 2);" class="btn btn-xs red img-remove" style="position: absolute; margin-top: 10px; right: 8px"> Eliminar<i class="fa fa-remove"></i></a></div></div>';


		
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

		var appendDiv = '<div class="draggable-element draggablePic1" name="draggable-pic-1" id="1"><div class="img-container"><a href="'+ response.imgsrc+'" class="fancybox-button" data-rel="fancybox-button"><img class="img-responsive" src="'+ response.imgsrc+'" alt=""></a></div><div class="elements-drag-area deg45"><a href="javascript:ImgRemove(1, 2);" class="btn btn-xs red img-remove" style="position: absolute; margin-top: 10px; right: 8px"> Eliminar<i class="fa fa-remove"></i></a></div></div>';


		
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

});


</script>
<!-- END UPLOAD IMAGES -->
