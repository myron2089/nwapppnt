@extends('layouts.expositor.app')


@section('content')
<div class="page-title">
    <h3><!--<i class="fa fa-user"></i>--> Mi Perfil </h3>
  </div>
<div class="page-bar">
      <ul class="page-breadcrumb">
          <li>
              <a href="index.html">Inicio</a>
              <i class="fa fa-angle-right"></i>
          </li>
          <li>
              <span>Mi perfil</span>
          </li>
      </ul>
  </div>
  


  <div class="row" style="margin-top: -5px;">
    <div class="col-md-12  field-content" style="margin-top:10px; padding: 20px;  background: transparent;">

  
    <div class="profile-sidebar">
      
      @include('frontend.users.partials.user-actions')

    </div> <!-- end col-md/sm-12 -->
  
    <div class="profile-content">
      <div class="portlet light" id="user-profile-data">

       
         @if($type=='profile')
          <div class="portlet-title">
            <div class="caption caption-md">
                <i class="icon-bar-chart theme-font hide"></i>
                <span class="caption-subject font-black bold">Datos Personales</span>
                <span class="caption-helper hide">weekly stats...</span>
            </div>
            
        </div>
            <form role="form" action="{{url('admin/user/profile/update')}}" id="form-user-update">
                {{ csrf_field() }}
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
                    <button type="submit" id="btn-save-data" class="btn green" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Guardando Información..."><i class="fa fa-check"></i> Actualizar Datos </button>
                    <!--<a href="javascript:;" class="btn default"> Cancel </a>-->
                </div>
                @endforeach 
            </form>
        @elseif($type=='account')
         <div class="portlet-title">
            <div class="caption caption-md">
                <i class="icon-bar-chart theme-font hide"></i>
                <span class="caption-subject font-black bold ">Actualizar datos de inicio de sesión</span>
                <span class="caption-helper hide">weekly stats...</span>
            </div>
            
        </div>
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

                  <div class="portlet solid grey-silver p-2">
                    <div class="portlet-body" style="color: #000">
                      <strong>Importante!</strong><br> La contraseña debe de tener al menos <br>
                      - Ocho o más caracteres<br>
                      - Un número<br>
                      - Letras mayúsculas y minúsculas<br>
                    </div>
                </div>
              <div class="margin-top-10">
                  <button id="btn-password-change" type="submit" href="javascript:;" class="btn green"><i class="fa fa-check"></i> Cambiar contraseña </button>
                  
              </div>


          </form>
        @elseif($type=='events')
        @section('css')
          <link rel="stylesheet" href="{{ asset('css/cards.css')}}" type="text/css" />
        @endsection
           <div class="portlet-title">
            <div class="caption caption-md">
                <i class="icon-bar-chart theme-font hide"></i>
                <span class="caption-subject font-black bold">Mis Eventos</span>
                <span class="caption-helper hide">weekly stats...</span>
            </div>

            <div class="actions">
                <div class="btn-group btn-group-devided">
                    
                        <a href="{{url('administracion/eventos')}}" class="btn btn-circle green btn-sm"><i class="fa fa-arrow-right"></i> Ver todos </a>
                </div>
            </div>
            
        </div>
          <div id="post-list-footer" style="margin-bottom: 50px;">
            <div class="row">
            @foreach($events as $event)
           
                  <div class="card-container card-mini">
                            <div class="card">
                                <div class="wrapper" >
                                    <?php $evimg = $event->PICTUREPATH; ?>
                                   
                                    <div class="img-cover" style="background: url('{{url('/')}}/{{$evimg}}') center / cover no-repeat;"></div>
                                    <div class="img-overlay" style="background: url('{{url('../images/grid.png')}}') center / cover no-repeat; opacity: 0"></div>
                                    <div class="header">
                                        <div class="date">
                                            <span class="day">{{ date_format(new DateTime($event->EVENTSTART), 'd/m/Y') }}</span> 
                                            <span class="day"> </span>
                                        </div>
                                       <!--<ul class="menu-content" style="float: right;">
                                            <li><a href="#" class="fa fa-bookmark-o"></a></li>
                                            <li><a href="#" class="fa fa-heart-o"><span>18</span></a></li>
                                            <li><a href="#" class="fa fa-comment-o"><span>3</span></a></li>
                                        </ul>--> 
                                    </div>
                                     <div class="data">
                                            <div class="content">
                                             <!-- <span class="author">{{$event->userFirstName}} {{$event->userLastName}}</span>-->
                                              <h1 class="title"><a href="{{ url('/administracion/eventos')}}/{{$event->ID}}">{{$event->NAME}}</a></h1>
                                              <p class="text">{{$event->DESCRIPTION}}</p>
                                              <a href="{{ url('/administracion/eventos')}}/{{$event->ID}}" class="button-more">Ver Evento</a>
                                            </div>
                                      </div>
                                </div>
                            </div>
                        </div>
            @endforeach
              </div>
          </div>

        @endif
      </div>
    </div>
    
    <div class="clear"></div>

    
    </div>
  </div> <!-- end row clearfix -->

@endsection

@section('scripts')
<script type="text/javascript" src="{{ URL::asset('js/jquery.blockUI.js')}}"></script>

<script>
    $('#form-user-update').submit(function( event ) {
        event.preventDefault();
         $('body.page-header-fixed').block({ 
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
        var $btnc = $('#btn-save-data');
        
        var data = new FormData($(this)[0]);
        var form = $(this);

      
        
        $.ajax({
          type: "POST",
          url: form.attr( "action" ),
          data: data,
        /*  async: false,*/
          cache: false,
          contentType: false,
          processData: false,
            beforeSend:function(xhr){
            $btnc.button('loading');
            $('#overlay-msg').text('Editando información...');
            $('#page-overlay').fadeIn();


          },
          success: function (data) {
            

          },
          error: function(xhr) {
                     console.log(xhr.responseText); // this line will save you tons of hours while debugging
                    // do something here because of error
                    $btnc.button('reset');
                   }

        }).done(function(data){


          var uData = jQuery.parseJSON(data);
            console.log(uData);
            if(uData.status=='success'){

                setTimeout(function(){
                        $('#page-overlay').fadeOut();
                        $('#large').modal('hide');
                         $btnc.button('reset');
                         $('body.page-header-fixed').unblock();
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
                         $('body.page-header-fixed').unblock();
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
                         $('body.page-header-fixed').unblock();
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


            $btnc.button('reset');
        });

        

       
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
       
            

            $.ajax({
              type: "POST",
              url: form.attr( "action" ),
              data: data,
            /*  async: false,*/
              cache: false,
              contentType: false,
              processData: false,
              beforeSend:function(xhr){
                $btnc.button('loading');
                $('#overlay-msg').text('Actualizando Contraseña...');
                $('#page-overlay').fadeIn();


              },
              success: function (data) {
              
              },
              error: function(xhr) {
                         console.log(xhr.responseText); // this line will save you tons of hours while debugging
                        // do something here because of error
                        $btnc.button('reset');
                       }

            }).done(function(data){

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

                 $btnc.button('reset');

            });
        }
        else{

            alert('Las contraseñas no coinciden');
        }
       

       
    });    


</script>
<script>
    jQuery(document).ready( function($) {  
        $('.card-container').fadeIn('slow');
    });

</script>

@endsection