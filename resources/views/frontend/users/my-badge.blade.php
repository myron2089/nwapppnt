@extends('frontend.layouts.app')

@section('content')

<div class="container clearfix" style="background: #fff; padding-right: 0; padding-left: 0; margin-top:-50px;">
            
	<!-- BEGIN ROW PP -->
	<div class="row" style="margin-top: -5px;">
		<div class="col-md-12" style="margin-top:30px;">


<div class="profile-content">
            <div class="row">
                <div class="col-md-12" style="padding: 0 50px;">

                    <h3>Datos de My Badge para {{$eventName}}</h3>
                    <div class="tabs  clearfix" id="tab-2">
                        <ul class="tab-nav clearfix">
                            <li style="border-left: 2px solid #DDD;"><a href="#tabs-5"><i class="fa fa-list-alt"></i> Datos de My Badge</a></li>
                            <li><a href="#tabs-6"><i class="fa fa-print"></i>Imprimir</a></li>
                      
                        </ul>
                        <div class="tab-container">
                            <!-- PERSONAL INFO TAB -->
                           <div class="tab-content clearfix" id="tabs-5">
                                <form id="store-badge" method="POST" role="form" action="{{url('users/my-badge/store')}}">
                                    {{ csrf_field() }}
                                    <input type="hidden" id="badgeId" name="badgeId" value="{{$badgeId}}">
                                    <input type="hidden" id="eventId" name="eventId" value="{{$eventId}}">
                                    <input type="hidden" name="userId" name="userId" value="{{$userId}}">
                                    <div class="col_half">
                                        <label class="control-label">Nombres</label>
                                        <input id="userFirstName" name="userFirstName" type="text" value="{{$firstName}}" class="form-control" required maxlength="100"> </div>
                                    <div class="col_half col_last">
                                        <label class="control-label">Apellidos</label>
                                        <input id="userLastName" name="userLastName" type="text" value="{{$lastName}}" class="form-control" required maxlength="100"> </div>
                                    <div class="col_half">
                                        <label class="control-label">Correo Electrónico</label>
                                        <input id="userEmail" name="userEmail" type="email" value="{{$userEmail}}" class="form-control" required maxlength="100"> </div>
                                    <div class="col_half col_last">
                                        <label class="control-label">Dirección</label>
                                        <input id="userAddress" name="userAddress" type="text" value="{{$userAddress}}" class="form-control" maxlength="150"> </div>
                                        <div class="col_half">
                                        <label class="control-label">Código País</label>
                                        <input id="userPhoneCode" name="userPhoneCode" type="text" placeholder="EJ: +502" value="{{$userPhoneCode}}" class="form-control" maxlength="15"> </div>
                                    <div class="col_half col_last">
                                        <label class="control-label">Número de Teléfono</label>
                                        <input id="userPhone" name="userPhone" type="text" value="{{$userPhone}}" class="form-control" maxlength="20"> </div>
                                    <div class="col_half">
                                        <label class="control-label">Título que Posee</label>
                                        <input id="userTitle" name="userTitle" type="text" value="{{$userTitle}}" class="form-control"> </div>
                                    <div class="col_half col_last">
                                        <label class="control-label">Ocupación</label>
                                        <input id="userOccupation" name="userOccupation" type="text" value="{{$userOccupation}}" class="form-control" maxlength="50"> </div>
                                    <div class="col_half">
                                        <label class="control-label">Empresa</label>
                                        <input id="userCompany" name="userCompany" class="form-control" rows="3" value="{{$userCompany}}" maxlength="50">
                                    </div>
                                    <div class="col_half col_last">
                                        <label class="control-label">Puesto en la Empresa</label>
                                        <input id="userPosition" name="userPosition" type="text" value="{{$userPosition}}" class="form-control" maxlength="50"> </div>
                                        <hr>
                                    <div class="col_half">
                                        <label class="control-label">Link perfil de Facebook</label>
                                        <input id="userFacebookLink" name="userFacebookLink" type="text" value="{{$userFacebookLink}}" class="form-control" maxlength="255"> 
                                    </div>
                                    <div class="col_half col_last">
                                        <label class="control-label">Link perfil de Twitter</label>
                                        <input id="userTwitterLink" name="userTwitterLink" type="text" value="{{$userTwitterLink}}" class="form-control" maxlength="255"> </div>
                                        <div class="clear"><br><br><br><br></div>
                                    <div class="margiv-top-10">
                                        <button id="btn-save-data"  class="button button-3d button-rounded button-aqua"><i class="icon-save"></i> Guardar Cambios </button>
                                        
                                    </div>
                                </form>
                            </div>
                            <!-- END PERSONAL INFO TAB -->
                           
                           
                            <!-- PREVIEW TAB -->
                           <div class="tab-content clearfix" id="tabs-6">
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
                                </div>


		</div> <!-- end col-md-12 -->
	</div> <!-- end row -->
</div>


@endsection

@section('scripts')
<!-- SAVE BADGE DATA -->
 <script type="text/javascript" src="{{ URL::asset('js/jquery.blockUI.js')}}"></script>
<script>
    $("#store-badge").submit(function( event ) {
        event.preventDefault();



        var $btnc = $('#btn-save-data');
        $btnc.button('loading');
        var data = new FormData($(this)[0]);
        $('#overlay-msg').text('Guardando Información...');
        $('#page-overlay').fadeIn('slow');
        var form = $(this);

        $('body.stretched').block({ 
                message: '<div class="spinner"><div class="dot1"></div><div class="dot2"></div></div><h4 style="color:#fff">Actualizando informacion</h4>', 
                 css: { 
                    border: 'none', 
                    padding: '10px', 
                    backgroundColor: '#000', 
                    '-webkit-border-radius': '4px', 
                    '-moz-border-radius': '4px', 
                    opacity: .6, 
                    color: '#fff' 
                } 
            }); 

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
                          "showDuration": "300",
                          "hideDuration": "1000",
                          "timeOut": "8000",
                          "extendedTimeOut": "1000",
                          "showEasing": "swing",
                          "hideEasing": "linear",
                          "showMethod": "fadeIn",
                          "hideMethod": "fadeOut"
                        };
                        $('#page-overlay').fadeOut('slow');

                        $('body.stretched').unblock();
                    }, 2000);
          }
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

}

</script>

<script>
    $('#userPhone').keypress(function(event){
            /*console.log(event.which);*/
        if((event.which != 8 && isNaN(String.fromCharCode(event.which))) || event.which ==32){
            event.preventDefault();
        }});

</script>
@endsection