@extends('frontend.layouts.app')


@section('content')
<div class="container clearfix elements-content">
  <div class="row" style="margin-top: -5px;">
    <div class="col-md-12  field-content" style="margin-top:-50px; padding: 20px;  background: transparent;">

	
		<div class="col-md-4 col-sm-12 profile-container">
      
      @include('frontend.users.partials.user-actions')

		</div> <!-- end col-md/sm-12 -->
	
    <div class="col-md-8 col-sm-12 profile-container">
      <div class="user-profile-data" id="user-profile-data">
         @if($type=='profile')
            <form role="form" action="{{url('admin/user/profile/update')}}" id="form-user-update">
                {{ csrf_field() }}

                <h3>Datos de Usuario</h3>
                @foreach($myData as $data)
                <div class="form-group">
                    <label class="control-label">Nombres</label>
                    <input type="text" name="userFirstName" id="userFirstName" class="form-control" value="{{$data->userFirstName}}" required /> </div>
                <div class="form-group">
                    <label class="control-label">Apellidos</label>
                    <input type="text" name="userLastName" id="userLastName" class="form-control" value="{{$data->userLastName}}" required /> </div>
                <div class="form-group" style="min-height: 40px;">
                    <label class="control-label" style="width: 100%;">Número de teléfono</label>
                    <input type="text" name="userCountryCode" id="userCountryCode" class="form-control" style="width: 48%; float: left" placeholder="Código ej +502" value="{{$data->userCountryCode}}" /> <input type="text" name="userPhoneNumber" id="userPhoneNumber" class="form-control" style="width: 48%; float: right; margin-right: 0px" placeholder="Número de teléfono" value="{{$data->userPhoneNumber}}" /> </div><br>
                <div class="form-group">
                    <label class="control-label">Dirección</label>
                    <input type="text" name="userAddress" id="userAddress" class="form-control" value="{{$data->userAddress}}"/> </div>
                <div class="form-group">
                    <label class="control-label">Fecha de Nacimiento</label>
                    <input type="date" name="userDob" id="userDob"  class="form-control" value="{{$data->userBirthDay}}" /> </div>
                
                <div class="margiv-top-10">
                    <button type="submit" id="btn-save-data" class="btn green" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Guardando Información..."> Guardar Cambios </button>
                    <!--<a href="javascript:;" class="btn default"> Cancel </a>-->
                </div>
                @endforeach 
            </form>
        @elseif($type=='account')
         <h3>Actualizar Contraseña</h3>
          <form action="{{url('admin/users/changepassword')}}" method="POST" id="form-update-password">
              <div class="form-group">
                  <label class="control-label">Contraseña Actual</label>
                  <input type="password" name="userCurrentPassword" id="userCurrentPassword" class="form-control" required /> </div>
              <div class="form-group">
                  <label class="control-label">Nueva Contraseña</label>
                  <input type="password" name="userNewPassword" id="userNewPassword" class="form-control" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Debe contener al menos un número, letras mayúsculas y minúsculas, y contenter 8 o más caracteres" /> </div>
              <div class="form-group">
                  <label class="control-label">Ingrese nuevamente la contraseña</label>
                  <input type="password" name="userNewPasswordConfirm" id="userNewPasswordConfirm" class="form-control" required /> </div>

                  <div class="alert alert-info">
                  <strong>Importante!</strong><br> La contraseña debe de tener al menos <br>
                  - Ocho o más caracteres<br>
                  - Un número<br>
                  - Letras mayúsculas y minúsculas<br>

              </div>
              <div class="margin-top-10">
                  <button id="btn-password-change" type="submit" href="javascript:;" class="btn green"> Cambiar contraseña </button>
                  
              </div>


          </form>
        @elseif($type=='events')
           <h3>Mis Eventos <span class="badge badge-secondary">{{count($events)}}</span></h3>
          <div id="post-list-footer" style="margin-bottom: 50px;">
            @foreach($events as $event)

                  <div class="spost clearfix">
                    <div class="entry-image">
                      <a href="#" class="nobg"><img src="{{url('images/events/previews')}}/{{$event->eventPicture}}" alt=""></a>
                    </div>
                    <div class="entry-c">
                      <div class="entry-title">
                        <h4><a href="#">{{$event->eventName}}</a></h4>
                      </div>
                      <ul class="entry-meta">
                        <li>{{$event->dayNumber}} {{$event->monthName}} {{$event->yearNumber}}</li>
                      </ul>
                    </div>
                  </div>

            @endforeach
          </div>

        @endif
      </div>
    </div>
		
    <div class="clear"></div>

		
    </div>
	</div> <!-- end row clearfix -->
</div> <!-- end container clearfix -->
@endsection

@section('scripts')
<script type="text/javascript" src="{{ URL::asset('js/jquery.blockUI.js')}}"></script>

<script>
    $('#form-user-update').submit(function( event ) {
        event.preventDefault();
         $('.content-wrap').block({ 
                message: '<div class="spinner"><div class="dot1"></div><div class="dot2"></div></div><h4 style="color:#fff">Actualizando informacion</h4>', 
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
        var $btnc = $('#btn-password-change');
        $btnc.button('loading');
        var data = new FormData($(this)[0]);
        var form = $(this);

       $('#overlay-msg').text('Editando información...');
        $('#page-overlay').fadeIn();
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
            if(uData.status=='success'){

                setTimeout(function(){
                        $('#page-overlay').fadeOut();
                        $('#large').modal('hide');
                         $btnc.button('reset');
                         $('.content-wrap').unblock();
                        Command: toastr["success"]("Se ha actualizado tu información con éxito!", "Mensaje");

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
                    
                    }, 1000);
               
            }
            else if (uData.status == 'noupdated'){
                setTimeout(function(){
                        $('#page-overlay').fadeOut();
                        $('#large').modal('hide');
                         $btnc.button('reset');
                         $('body.stretched').unblock();
                        Command: toastr["warning"]("No se ha podido actualizar tu información!", "Alerta");

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
                    
                    }, 1000);

            }
            else if(uData.status=='error'){
                setTimeout(function(){
                        $('#page-overlay').fadeOut();
                        $('#large').modal('hide');
                         $btnc.button('reset');
                         $('body.stretched').unblock();
                        Command: toastr["success"](uData.message, "Mensaje");

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
                    
                    }, 1000);
                
            }

          },
          error: function(xhr) {
                     console.log(xhr.responseText); // this line will save you tons of hours while debugging
                    // do something here because of error
                    $btnc.button('reset');
                   }

        });

        $btnc.button('reset');

       
    });


</script>


<!-- Update password -->
<script>
 $('#form-update-password').submit(function( event ) {
        event.preventDefault();
        var $btnc = $('#btn-save-data');
        $btnc.button('loading');
        var data = new FormData($(this)[0]);
        var form = $(this);

        var pwd = $('#userNewPassword').val();
        var pwdc = $('#userNewPasswordConfirm').val();
        console.log(pwd + '  ' + pwdc);
        var stt = '';   
        var msg = '';
        var tmsg = '';
        if(pwd == pwdc){
       
            $('#overlay-msg').text('Actualizando Contraseñas...');
            $('#page-overlay').fadeIn();

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
                if(uData.status=='success'){
                    stt = 'success';
                    msg = 'Se ha actualizado correctamente la contraseña';
                    tmsg = 'Mensaje';
                }
                else if(uData.status=='error'){
                    stt = 'warning';
                    msg = 'No se ha podido actualizar la contraseña';
                    tmsg = 'Alerta';
                }
                $('#form-update-password').trigger("reset");
                setTimeout(function(){
                        $('#page-overlay').fadeOut();
                        
                        $btnc.button('reset');
                        Command: toastr["success"](uData.message, tmsg);

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
                    
                    }, 1000);

              },
              error: function(xhr) {
                         console.log(xhr.responseText); // this line will save you tons of hours while debugging
                        // do something here because of error
                        $btnc.button('reset');
                       }

            });
        }
        else{

            alert('Las contraseñas no coinciden');
        }
        $btnc.button('reset');

       
    });    


</script>


@endsection