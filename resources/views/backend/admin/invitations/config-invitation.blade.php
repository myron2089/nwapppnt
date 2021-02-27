@extends('layouts.expositor.app')
@section('css')
<link rel="stylesheet" href="{{ asset('css/cards.css')}}" type="text/css" />
<link rel="stylesheet" href="{{ asset('metronic/css/tagsinput.css')}}" type="text/css" />
<link rel="stylesheet" href="{{ asset('metronic/css/select2/css/select2.min.css')}}" type="text/css" />
<link rel="stylesheet" href="{{ asset('metronic/css/select2/css/select2-bootstrap.min.css')}}" type="text/css" />
 <link rel="stylesheet" href="{{ asset('metronic/global/plugins/bootstrap-fileinput/css/fileinput.css')}}" type="text/css" />
@endsection
@section('content')
<div class="page-title">
        <h3><!--<i class="fa fa-list"></i>--> Configurar Tikcet de Invitación</h3>
    </div>
<div class="page-bar">
	<ul class="page-breadcrumb">
	    <li>
	        <a href="#">Inicio</a>
	        <i class="fa fa-circle"></i>
	    </li>
	    <li>
	        <a href="{{url('administracion/eventos/')}}/{{$eventId}}">{{$eventName}}</a>
            <i class="fa fa-circle"></i>
	    </li>
        <li>
            <a href="#">Ticket</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="#">Configurar</a>
            
        </li>
	    
	</ul>
	
</div>

<!--<div class="page-title">
	<h3><i class="fa fa-send-o"></i> Enviar invitaciones</h3>
</div> -->
<!-- BEGIN ROW PP -->
<div class="row" style="margin-top: 5px;" >
	<div class="col-md-12" style="background: #fff">
		<div class="portlet" >
		    <div class="portlet-title">
		        <div class="caption">
		            <i class="fa fa-cog"></i>Configurar ticket {{$eventAdminStatus}}</div>
		    </div>
		    <div class="portlet-body"> 
          
          @if($eventAdminStatus == 1)
            <ul class="list-unstyled margin-top-10 margin-bottom-10">
              <li>
                  <i class="fa fa-check"></i> Utilice la plantilla para diseñar su fondo personalizado.</li>
              <li>
                  <i class="fa fa-check"></i> Las dimensiones de la imágen deben ser 775px x 1280px.</li>
              <li>
                  <i class="fa fa-check"></i> El número de ticket se mostrará en el lugar que se indica en la plantilla.</li>
              <li>
                  <i class="fa fa-check"></i> Puede colocar todo el tipo de información del evento en los espacios especificados. </li>

              <li>
                  <i class="fa fa-check"></i> Descarga la plantilla  <a href="{{ asset('images/events/invitations/templates/ticket-template.jpg') }}" download="plantilla" target="_blank">Aquí</a></li>
            </ul>
          @else
           <div class="col-md-12" style="margin-top: 20px;">
              <div class="alert alert-danger">
                  <strong>Evento cerrado!</strong> No se puede configurar la invitación para este evento!.
              </div>
          </div>

          @endif
          

          @if($logoExists == 0)

          <div class="alert alert-danger">
              <strong>Alerta!</strong> La plantilla para el envío de ticket de {{$eventName}} no ha sido configurada.

          </div>


          @endif

       
  		    	
               <div id="elements-container" style="max-width: 98%">
                
                       
                          <img class="img-responsive" src="{{url('')}}/{{$logo}}" style="width: 775px; height: 1280px; margin: 0 auto; min-width: 775px;" alt="">
                      
                          <div id="invitation-reference-code" style="position: absolute; margin-top: -525px; left: 38%; width: 775px;"><span style="font-size: 32px; color: coral; margin: 0 auto;">CODIGO-XXXXXXXXXX</span></div>
                     
               </div>
              @if($eventAdminStatus == 1)
                <form action="{{ url('admininstracion/eventos/invitaciones/guardar')}}/{{$eventId}}" class="dropzone" id="dropzone">
                  {{ csrf_field()  }}
                </form>
              @endif
		    </div>
		</div>	
    <br>
    <br>
    

  </div>
	
</div>
@endsection


@section('scripts')

<script type="text/javascript" src="{{ URL::asset('metronic/scripts/tagsinput.js')}}"></script>
<script type="text/javascript" src="{{ URL::asset('metronic/scripts/dropzone.js')}}"></script>
<!-- Datatable -->
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
    dictDefaultMessage: 'Arrastra imágnes hacia aquí.',
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
    if(response.status == 'success'){
      var appendDiv = '<img class="img-responsive" src="'+ response.imgsrc+'" alt="" style="width: 775px; height: auto; margin: 0 auto;"> <div id="invitation-reference-code" style="position: absolute; margin-top: -525px; left: 38%; width: 775px;"><span style="font-size: 32px; color: coral; margin: 0 auto;">CODIGO-XXXXXXXXXX</span></div>';
      $('#elements-container').empty();
      $('#elements-container').append(appendDiv);
    }
    else if(response.status == 'sizeerror'){

      Command: toastr["warning"]("El tamaño de la imagen seleccionada no es el correcto (775 x 1280px)", "Alerta");

                        toastr.options = {
                          "closeButton": false,
                          "debug": false,
                          "newestOnTop": false,
                          "progressBar": false,
                          "positionClass":  "toast-bottom-center",
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
    }

    
      setTimeout(function(){
            myDropzone.removeFile(file);
      }, 1500);   
      
      
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


@endsection