@extends('layouts.expositor.app')

@section('content')
<div class="page-title">
        <h3><!--<i class="fa fa-list"></i>--> Mi Gafete</h3>
    </div>
<div class="page-bar">
	<ul class="page-breadcrumb">
	    <li>
	        <a href="#">Inicio</a>
	        <i class="fa fa-angle-right"></i>
	    </li>
	    <li>
	        <a href="{{url('administracion/eventos/')}}/{{$eventId}}">{{$eventName}}</a>
            <i class="fa fa-angle-right"></i>
	    </li>
        <li>
             <span>Mi Gafete</span>
            
        </li>
	    
	</ul>
	
</div>
	
	<!-- BEGIN ROW PP -->
	<div class="row" style="margin-top: -5px;">
		<div class="col-md-12" style="margin-top:30px;">

			<div class="profile-sidebar custom-sidebar-portlet">
                <!-- PORTLET MAIN -->
                <div class="portlet light profile-sidebar-portlet ">
                    <!-- SIDEBAR USERPIC -->
                    <div class="profile-userpic">
                        <img id="badge-img" src="{{url('')}}/{{$userPic}}" class="img-responsive" alt=""> 

                         <div class="profile-usertitle">
                        <div class="profile-usertitle-name"> {{$firstName}} {{$lastName}} </div>
                        <div class="profile-usertitle-job"> {{$userType}} </div>
                    </div>
                   </div>
                    <!-- END SIDEBAR USERPIC -->
                    <!-- SIDEBAR USER TITLE -->
                   
                    <!-- END SIDEBAR USER TITLE -->
                    <!-- SIDEBAR BUTTONS -->
                    <div class="profile-userbuttons">
                     <!--   <button type="button" class="btn btn-circle green btn-sm">Ver Badge</button>
                        <button type="button" class="btn btn-circle blue btn-sm">Cambiar Imagen de Perfil</button> -->
                    </div>
                    <!-- END SIDEBAR BUTTONS -->
                    <!-- SIDEBAR MENU -->
                    <div class="profile-usermenu custom-profile-usermenu">
                        <ul class="nav">
                            <!--<li>
                                <a href="page_user_profile_1.html">
                                    <i class="icon-home"></i> Overview </a>
                            </li> -->
                            <li class="active">
                                <a onclick="changeView('data');" href="#">
                                    <i class="icon-home"></i> Datos del Badge </a>
                            </li>
                            
                            <li>
                                <a onclick="changeView('avatar');" href="#">
                                    <i class="icon-eye"></i> Imagen perfil gafete</a>
                            </li>

                            <li>
                                <a onclick="changeView('preview');" href="#">
                                    <i class="icon-eye"></i> Vista Previa </a>
                            </li>
                            
                            
                            
                            <li>
                                <a href="{{url('administracion/eventos/')}}/{{$eventId}}" class="btn btn-default left"><i class="fa fa-angle-left"></i> Regresar a {{$eventName}} </a>
                            </li>
                        </ul>
                    </div>
                    <!-- END MENU -->
                </div>
               
                <!-- END PORTLET MAIN -->
                
                <!-- END PORTLET MAIN -->
            </div>

            <div class="profile-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet light ">
                            <div class="portlet-title tabbable-line">
                                <!--<div class="caption caption-md">
                                    <i class="icon-globe theme-font hide"></i>
                                    <span class="caption-subject font-black bold"> Mi gatefe | {{$eventName}} </span>
                                </div> -->
                                <ul class="nav nav-tabs">
                                    
                                    <li class="active">
                                        <a id="btn-user-data" href="#tab_1_1" data-toggle="tab">Datos personales</a>
                                    </li>
                                    
                                    <li>
                                        <a id="btn-user-avatar" href="#tab_1_2" data-toggle="tab">Imagen perfil gafete</a>
                                    </li>

                                    <li>
                                        <a id="btn-myqr" href="#tab_1_3" data-toggle="tab">Vista Previa de Mi QR</a>
                                    </li>
                                   
                                </ul>
                            </div>
                            <div class="portlet-body">
                                <div class="tab-content">
                                    <!-- PERSONAL INFO TAB -->
                                    <div class="tab-pane active" id="tab_1_1">
                                        <form id="store-badge" method="POST" role="form" action="{{url('users/my-badge/store')}}">
                                            {{ csrf_field() }}
                                            <input type="hidden" id="badgeId" name="badgeId" value="{{$badgeId}}">
                                            <input type="hidden" id="eventId" name="eventId" value="{{$eventId}}">
                                            <input type="hidden" name="userId" name="userId" value="{{$userId}}">
                                            <div class="form-group col-md-6">
                                                <label class="control-label">Nombres</label>
                                                <input id="userFirstName" name="userFirstName" type="text" value="{{$firstName}}" class="form-control" required maxlength="100"> </div>
                                            <div class="form-group col-md-6">
                                                <label class="control-label">Apellidos</label>
                                                <input id="userLastName" name="userLastName" type="text" value="{{$lastName}}" class="form-control" required maxlength="100"> </div>
                                            <div class="form-group col-md-6">
                                                <label class="control-label">Correo Electrónico</label>
                                                <input id="userEmail" name="userEmail" type="email" value="{{$userEmail}}" class="form-control" required maxlength="100"> </div>
                                            <div class="form-group col-md-6">
                                                <label class="control-label">Dirección</label>
                                                <input id="userAddress" name="userAddress" type="text" value="{{$userAddress}}" class="form-control" maxlength="150"> </div>
                                                <div class="form-group col-md-6">
                                                <label class="control-label">Código País</label>
                                                <input id="userPhoneCode" name="userPhoneCode" type="text" placeholder="EJ: +502" value="{{$userPhoneCode}}" class="form-control" maxlength="15"> </div>
                                            <div class="form-group col-md-6">
                                                <label class="control-label">Número de Teléfono</label>
                                                <input id="userPhone" name="userPhone" type="text" value="{{$userPhone}}" class="form-control" maxlength="20"> </div>
                                            <div class="form-group col-md-6">
                                                <label class="control-label">Título que Posee</label>
                                                <input id="userTitle" name="userTitle" type="text" value="{{$userTitle}}" class="form-control"> </div>
                                            <div class="form-group col-md-6">
                                                <label class="control-label">Ocupación</label>
                                                <input id="userOccupation" name="userOccupation" type="text" value="{{$userOccupation}}" class="form-control" maxlength="50"> </div>
                                            <div class="form-group col-md-6">
                                                <label class="control-label">Empresa</label>
                                                <input id="userCompany" name="userCompany" class="form-control" rows="3" value="{{$userCompany}}" maxlength="50">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="control-label">Puesto en la Empresa</label>
                                                <input id="userPosition" name="userPosition" type="text" value="{{$userPosition}}" class="form-control" maxlength="50"> </div>
                                                <hr>
                                            <div class="form-group col-md-6">
                                                <label class="control-label">Link perfil de Facebook</label>
                                                <input id="userFacebookLink" name="userFacebookLink" type="text" value="{{$userFacebookLink}}" class="form-control" maxlength="255"> </div>
                                                <div class="form-group col-md-6">
                                                <label class="control-label">Link perfil de Twitter</label>
                                                <input id="userTwitterLink" name="userTwitterLink" type="text" value="{{$userTwitterLink}}" class="form-control" maxlength="255"> </div>
                                              
                                            <div class="form-group col-md-12">
                                                
                                                @if($eventAdminStatus == 1)
                                                    <button id="btn-save-data"  class="btn green" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Guardando información..."><i class="fa fa-check"></i>  Guardar Cambios </button>
                                                @endif
                                                
                                            </div>
                                        </form>

                                         @if($eventAdminStatus == 0)
                                            <div class="row">
                                                <div class="col-md-12" style="margin-top: 0px; margin-bottom: 0px;">
                                                  <div class="alert alert-danger">
                                                    <strong>Evento cerrado!</strong> No puedes actualizar tu gafete para este evento.
                                                  </div>
                                                </div>
                                            </div>
                                         @endif

                                    </div>
                                    <!-- END PERSONAL INFO TAB -->
                                   

                                    <!-- AVATAR TAB -->
                                    <div class="tab-pane" id="tab_1_2">
                                       <div class="row">
                                            <form id="update-avatar-form" method="post" action="{{route('update-badge-avatar')}}">
                                                <input type="hidden" id="bgId" name="bgId" value="{{$badgeId}}">
                                               <div class="col-md-12">
                                                    <div class="col-md-8 col-sm-12">
                                                        <label for="companyLogo" class="custom-file-upload-user-avatar" style="background: url('{{url('')}}/{{$userPic}}') center center no-repeat;">
                                                            <i class="fa fa-cloud-upload"></i> Seleccionar Imagen
                                                        </label>
                                                        <input id="companyLogo" name="companyLogo" type="file" onchange="loadPicture(event)" accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|images/*">
                                                    </div>   

                                                     <div class="col-md-12">
                                                    
                                                        @if($eventAdminStatus == 1)
                                                            <button id="btn-save-avatar"  class="btn green" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Actualizando imagen..."><i class="fa fa-save"></i>  Actualizar imagen </button>
                                                        @endif
                                                        
                                                    </div>
                                                </div>                                    
                                            </form>
                                       </div>
                                    </div>
                                    <!-- END AVATAR TAB -->

                                   
                                    <!-- PREVIEW TAB -->
                                    <div class="tab-pane" id="tab_1_3">
                                       <div class="row">
                                            <div class="col-md-12 text-center" style="padding-bottom: 0px">
                                                {!! $myQr !!}
                                            </div>
                                            <div class="col-md-12 text-center" style="padding-top: 0px; margin-top: -50px">
                                                <hr>
                                                <h4>{{$eventName}}</h4>
                                                <h3>{{$userType}}</h3>
                                            </div>
                                            <div class="col-md-12 text-center">
                                                <form id="form-qr" method="post" action="{{url('admin/qrs/generate')}}" target="_blank">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="id" value="{{$userEventId}}">
                                                    <input type="hidden" name="type" value="user">
                                                   
                                                    <button type="submit"  id="getQr2" class="btn green" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Guardando información..."><i class="fa fa-qrcode"></i>  Imprimir QR </button>
                                                </form>
                                            </div>

                                        

                                       </div>
                                    </div>
                                    <!-- END CHANGE PASSWORD TAB -->
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end:: profile-content -->


		</div> <!-- end col-md-12 -->
	</div> <!-- end row -->

@endsection

@section('scripts')
<!-- SAVE BADGE DATA -->
<script>
    $("#store-badge").submit(function( event ) {
        event.preventDefault();



        var $btnc = $('#btn-save-data');
       
        var data = new FormData($(this)[0]);
        
        var form = $(this);
        $.ajax({
          type: "POST",
          url: form.attr( "action" ),
          data: data,
          //async: false,
          cache: false,
          contentType: false,
          processData: false,
          beforeSend:function(xhr){
            $btnc.button('loading');
            $('#overlay-msg').text('Guardando Información...');
            $('#page-overlay').fadeIn('slow');

          },
          success: function (data) {
            
          }
        }).done(function(data){

            var uData = jQuery.parseJSON(data);
            console.log(uData);
            $('#badgeId').val(uData.badgeId);
             setTimeout(function(){
                        
                        
                    $btnc.button('reset');
                    Command: toastr["success"]("Se ha guardado exitosamente la información del gafete!", "Mensaje");

                    toastr.options = {
                      "closeButton": false,
                      "debug": false,
                      "newestOnTop": false,
                      "progressBar": false,
                      "positionClass":  "toast-bottom-right",
                      "preventDuplicates": false,
                      "onclick": null,
                      "showDuration": "4300",
                      "hideDuration": "1000",
                      "timeOut": "8000",
                      "extendedTimeOut": "1000",
                      "showEasing": "swing",
                      "hideEasing": "linear",
                      "showMethod": "fadeIn",
                      "hideMethod": "fadeOut"
                    };
                    $('#page-overlay').fadeOut('slow');
                }, 2000);

        });



    });
</script>
<script type="text/javascript" src="{{ URL::asset('metronic/scripts/dropzone.js')}}"></script>
<script>
jQuery(document).ready( function($) {
  
  $('#dropzone').dropzone({
        addRemoveLinks: true,
        maxFileSize: 8192,
        maxFiles:1,
        
        dictResponseError: 'Ha ocurrido un error con el servidor',
        acceptedFiles: 'image/*,.jpeg,.jpg,.png,.gif,.JPEG,.JPG,.PNG,.GIF',
        dictRemoveFile: 'Eliminar archivo',
        dictDefaultMessage: 'Arrastra y suelta imágnes aquí.',
        dictFallbackText: 'fallbacktext',
        dictFallbackMessage: 'dictFallbackMessage',
        dictFileTooBig: 'dictFileTooBig',
        dictCancelUpload: 'Eliminar Archivo',
        init: function() {
        this.on("addedfile", function (file) {

                if (this.files.length > 1) {
                    alert("You can Select upto 1 Pictures for Venue Profile.", "error");
                    this.removeFile(file);
                }

            });
        },
        complete: function(file){
          alert("dsfadsf");
        },
        
    });
});
</script>

<script>
function changeView(type){

    if(type=='preview')
        {
            document.getElementById('btn-myqr').click();
        }

    if(type=='data')
        {
            document.getElementById('btn-user-data').click();
        }

     if(type=='avatar')
        {
            document.getElementById('btn-user-avatar').click();
        }

}

</script>

<script>
    $('#userPhone').keypress(function(event){
            /*console.log(event.which);*/
        if((event.which != 8 && isNaN(String.fromCharCode(event.which))) || event.which ==32){
            event.preventDefault();
        }});

</script>



<!--- Load picture -->
<script>
function loadPicture(event){
var selectedFile = event.target.files[0];
    var inputLength = $("#companyLogo").size();

    if(inputLength > 0){
        //$('#pictureChanged').val(1);
        
        $('.custom-file-upload-user-avatar').css('background', 'url('+ window.URL.createObjectURL(selectedFile) +') center center no-repeat');
         $('.custom-file-upload-user-avatar').css('background-size', '100% auto');
    }
    else{
        $('#pictureChanged').val(0);    
        $('.custom-file-upload-user-avatar').css('background', 'url(../../images/icons/companyAvatar.png) center center no-repeat');
        $('.custom-file-upload-user-avatar').css('background-size', '100% auto');
    }

    if(!inputLength){
        $('.custom-file-upload-user-avatar').css('background', 'url(../../images/icons/companyAvatar.png) center center no-repeat');
        $('.custom-file-upload-user-avatar').css('background-size', '100% auto');
    }
    
}
</script>

<!-- Picture -->
<script>
    $("#update-avatar-form").submit(function(event){
        event.preventDefault();
        var $btnc = $("#btn-save-avatar");

        var data = new FormData($(this)[0]);

        var image = $("#companyLogo").val();

        if(image== ''){

            $btnc.button('reset');
                    Command: toastr["warning"]("No se ha seleccionado una nueva imagen!", "Mensaje");

                    toastr.options = {
                      "closeButton": false,
                      "debug": false,
                      "newestOnTop": false,
                      "progressBar": false,
                      "positionClass":  "toast-bottom-right",
                      "preventDuplicates": false,
                      "onclick": null,
                      "showDuration": "4300",
                      "hideDuration": "1000",
                      "timeOut": "8000",
                      "extendedTimeOut": "1000",
                      "showEasing": "swing",
                      "hideEasing": "linear",
                      "showMethod": "fadeIn",
                      "hideMethod": "fadeOut"
                    };

                    return;

        }

        console.log(image);
        $.ajax({
          type: "POST",
          url: "{{route('update-badge-avatar')}}",
          data: data,
          //async: false,
          cache: false,
          contentType: false,
          processData: false,
          beforeSend:function(xhr){
            $btnc.button('loading');
            $('#overlay-msg').text('Guardando Información...');
            $('#page-overlay').fadeIn('slow');

          },
          success: function (data) {
            
          }
        }).done(function(data){
            var uData = jQuery.parseJSON(data);
            console.log(data);

            if(uData.changed==1){

                $('#badge-img').attr("src","{{url('images/users/badge')}}/" + uData.img);

            }

            $("#companyLogo").val('');
             setTimeout(function(){
                        
                        
                    $btnc.button('reset');
                    Command: toastr["success"]("Se ha actualizado exitosamente la imagen de gafete!", "Mensaje");

                    toastr.options = {
                      "closeButton": false,
                      "debug": false,
                      "newestOnTop": false,
                      "progressBar": false,
                      "positionClass":  "toast-bottom-right",
                      "preventDuplicates": false,
                      "onclick": null,
                      "showDuration": "4300",
                      "hideDuration": "1000",
                      "timeOut": "8000",
                      "extendedTimeOut": "1000",
                      "showEasing": "swing",
                      "hideEasing": "linear",
                      "showMethod": "fadeIn",
                      "hideMethod": "fadeOut"
                    };
                    $('#page-overlay').fadeOut('slow');
                }, 2000);
        }).complete(function(){

            $btnc.button('reset');

        });


         
         



    });
    

</script>
@endsection