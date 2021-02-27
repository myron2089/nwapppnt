<div class="row">
    @if($eventAdminStatus == 0) 
        <div class="col-md-12">
            <div class="alert alert-danger">
                <strong>Evento cerrado!</strong> Algunas de las funcionalidades de este evento se encuentran deshabilidadas.
            </div>
        </div>
    @endif
    <div class="col-xl-4 col-md-5 col-sm-12">
       <div class="portlet light bordered">
            <div class="portlet-title portlet-title-orange">
                <div class="caption">
                    <!--<i class="icon-check font-white-sharp"></i>-->
                    <span class="caption-subject font-white-sharp sbold">@if(isset($hideall) && $hideall == 1) Opciones @else Resumen General del Evento @endif</span>
                </div>

            </div>
            <div class="portlet-body" style="margin-top: -20px;">


                <ul class="feeds event-resume">
                    @if($pageV==1)
                        <li>
                            <a onclick="changeView('webpage');" class="blue-links" >
                            <div class="col1">
                                <div class="cont full">
                                    <div class="cont-col2">
                                        <div class="desc">

                                            <i class="fa fa-arrow-right"></i>
                                            Datos Página web

                                        </div>
                                    </div>
                                </div>
                            </div>
                            </a>
                        </li>
                    @endif
                    @if($activitiesV ==1)
                         <li>
                            <a onclick="changeView('sessions');">
                            <div class="col1">
                                <div class="cont">
                                    <div class="cont-col2">
                                        <div class="desc">

                                            <!--<i class="fa fa-internet-explorer"></i>-->
                                            Actividades

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col2">
                                <div class="date">
                                     {{ $countActivities }}
                                </div>
                            </div>
                            </a>
                        </li>
                    @endif
                    @if($speakersV==1)
                         <li>
                            <a onclick="event.preventDefault();
                                                         document.getElementById('full-users-admin-form-2').submit();">
                            <div class="col1">
                                <div class="cont">
                                    <div class="cont-col2">
                                        <div class="desc">

                                            <!--<i class="fa fa-internet-explorer"></i>-->
                                            Usuarios

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col2">
                                <div class="date">
                                     {{ $countUsers }}
                                </div>
                            </div>

                            </a>
                            <form id="full-users-admin-form-2" action="{{ route('full-users-admin', ['eventId' => $eventId])  }}" method="POST" style="display: none;">
                                  {{ csrf_field() }}
                                  <input type="hidden" name="eventId" value="{{$eventId}}">
                            </form>
                        </li>

                    @endif

                    @if(isset($hideall) && $hideall == 1)
                        <li>
                            <a class="blue-links" onclick="event.preventDefault();
                                                     document.getElementById('my-badge-form-2').submit();">
                            <div class="col1">
                                <div class="cont">
                                    <div class="cont-col2">
                                        <div class="desc">

                                            <!--<i class="fa fa-internet-explorer"></i>-->
                                            <i class="fa fa-arrow-right"></i> Mi Gafete

                                        </div>
                                    </div>
                                </div>
                            </div>
                            </a>
                            <form id="my-badge-form-2" action="{{ route('my-badge-view') }}" method="POST" style="display: none;">
                                  {{ csrf_field() }}
                                  <input type="hidden" id="allUsersBadge" name="allUsersBadge" value="0">
                                  <input type="hidden" name="eventId" value="{{$eventId}}">
                            </form>
                        </li>

                
                    @else
                        <li>
                            <a onclick="changeView('products');">
                            <div class="col1">
                                <div class="cont">
                                    <div class="cont-col2">
                                        <div class="desc">

                                            <!--<i class="fa fa-internet-explorer"></i>-->
                                            Productos

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col2">
                                <div class="date">
                                     {{ $countProducts }}
                                </div>
                            </div>
                            </a>
                        </li>

                        <li>
                            <a onclick="changeView('offers');">
                            <div class="col1">
                                <div class="cont">
                                    <div class="cont-col2">
                                        <div class="desc">

                                            <!--<i class="fa fa-internet-explorer"></i>-->
                                            Ofertas

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col2">
                                <div class="date">
                                     {{ $countOffers }}
                                </div>
                            </div>
                            </a>
                        </li>

                        @if($userEventRoleAuth==1)
                            <li>
                                <a onclick="changeView('sponsors');">
                                <div class="col1">
                                    <div class="cont">
                                        <div class="cont-col2">
                                            <div class="desc">

                                                <!--<i class="fa fa-internet-explorer"></i>-->
                                                Patrocinadores  

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col2">
                                    <div class="date">
                                         {{$countSponsors}}
                                    </div>
                                </div>
                                </a>
                            </li>
                        @endif
                    @endif

                    @if($visitorsV==1)
                        <li class="principal">
                            <a  onclick="event.preventDefault();
                                                         document.getElementById('full-users-admin-form-3').submit();">
                            <div class="col1">
                                <div class="cont">
                                        <div class="cont-col2">
                                            <div class="desc">

                                            <!--<i class="fa fa-internet-explorer"></i>-->
                                            Visitantes
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col2">
                                <div class="date">
                                     
                                </div>
                            </div>
                            </a>
                             <form id="full-users-admin-form-3" action="{{ route('full-visitors-admin') }}" method="POST" style="display: none;">
                                  {{ csrf_field() }}
                                  <input type="hidden" name="eventId" value="{{$eventId}}">
                            </form>

                        </li>

                        <li>

                            <a onclick="event.preventDefault();
                                                         document.getElementById('full-users-admin-form-3').submit();">
                                <div class="col1">
                                    <div class="cont">
                                        <div class="cont-col2">
                                            <div class="desc">
                                                Pre registros
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col2">
                                    <div class="date">
                                         {{$countPreRegisters}}
                                     </div>
                                </div>    

                            </a>

                        </li>

                        <li>

                            <a onclick="event.preventDefault();
                                                         document.getElementById('full-users-admin-form-3').submit();">
                                <div class="col1">
                                    <div class="cont">
                                        <div class="cont-col2">
                                            <div class="desc">
                                                Taquillas
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col2">
                                    <div class="date">
                                        {{$countEventRegisters}}
                                    </div>
                                </div>    

                            </a>

                        </li>

                        <li class="principal">

                            <a onclick="event.preventDefault();
                                                         document.getElementById('full-users-admin-form-3').submit();">
                                <div class="col1">
                                    <div class="cont">
                                        <div class="cont-col2">
                                            <div class="desc">
                                                Total Visitantes
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col2">
                                    <div class="date">
                                        {{$countVisitors}}
                                    </div>
                                </div>    

                            </a>

                        </li>


                    @endif
                </ul>


                <!--
                <table class="table table-hover table-striped table-bordered">
                    <tbody><tr>
                     @if($pageV==1)
                        <td colspan="2">
                            <a onclick="changeView('webpage');">

                                Datos Página web
                            </a>
                        </td>

                    </tr>
                    @endif
                    @if($activitiesV ==1)
                    <tr>

                        <td>
                            <a onclick="changeView('sessions');">

                                Actividades
                            </a>
                        </td>
                        <td style="text-align: right;">{{ $countActivities }}</td>
                    </tr>
                    @endif
                    @if($speakersV==1)
                    <tr>

                        <td colspan="2">
                            <a href="#" onclick="event.preventDefault();
                                                         document.getElementById('full-users-admin-form-2').submit();" >

                                Usuarios
                            </a>

                             <form id="full-users-admin-form-2" action="{{ route('full-users-admin', ['eventId' => $eventId]) }}" method="POST" style="display: none;">
                                  {{ csrf_field() }}
                                  <input type="hidden" name="eventId" value="{{$eventId}}">
                            </form>
                        </td>

                    </tr>
                    @endif
                    @if(isset($hideall) && $hideall == 1)

                    <tr>

                        <td colspan="2">
                               <a href="" onclick="event.preventDefault();
                                                     document.getElementById('my-badge-form-2').submit();" class="nav-link">

                                    <span class="title">My Badge </span>

                                </a>

                            <form id="my-badge-form-2" action="{{ route('my-badge-view') }}" method="POST" style="display: none;">
                                  {{ csrf_field() }}
                                  <input type="hidden" id="allUsersBadge" name="allUsersBadge" value="0">
                                  <input type="hidden" name="eventId" value="{{$eventId}}">
                            </form>
                        </td style="text-align: right;">

                    </tr>
                    <tr>

                        <td colspan="2">
                              <a href="{{route('my-profile')}}"><i class="icon-user"></i> Mi Perfil </a>
                        </td>

                    </tr>


                    @else
                    <tr>

                        <td>
                              <a onclick="changeView('products');">  Productos  </a>
                        </td style="text-align: right;">
                        <td style="text-align: right;">{{ $countProducts }}</td>
                    </tr>
                    <tr>

                        <td>
                              <a onclick="changeView('offers');"> Ofertas </a>
                        </td>
                        <td style="text-align: right;">{{ $countOffers }}</td>
                    </tr>
                    @endif
                    @if($sponsorsV==1)
                    <tr>

                    	<td> <a onclick="changeView('sponsors');">Patrocinadores </a></td>
                        <td style="text-align: right;">{{$countSponsors}} </td>
                    </tr>
                    @endif
                    @if($visitorsV==1)
                    <tr>
                        <td>     <a href=""  disabled="disabled" onclick="event.preventDefault();
                                                         document.getElementById('full-users-admin-form-3').submit();" class="nav-link" >
                                        <i class="fa fa-users"></i>
                                        <span class="title">Visitantes</span>

                                    </a>

                                <form id="full-users-admin-form-3" action="{{ route('full-visitors-admin') }}" method="POST" style="display: none;">
                                      {{ csrf_field() }}
                                      <input type="hidden" name="eventId" value="{{$eventId}}">
                                </form></td>
                        <td style="text-align: right;">{{$countVisitors}}</td>
                    </tr>
                    @endif

                </tbody>
            	</table> -->


            </div>
        </div>
    </div>


    <div class="col-xl-8 col-md-7 col-sm-12">
       <div class="portlet light bordered">
            <div class="portlet-title portlet-title-orange">
                <div class="caption">
                    <!--<i class="icon-check"></i>-->
                    <span class="caption-subject font-green-sharp sbold">Detalles del Evento</span>
                </div>

            </div>
            <div class="portlet-body" style="margin-top: -10px;">
                <table class="table table-hover table-striped  table-bordered-black">
                    <tbody>
                    <!--<tr>
                        <td> Logo </td>
                        <td>
                            <a class="btn btn-outline dark" data-toggle="modal" href="#responsive"> Cambiar </a>
                        </td>
                    </tr>-->
                    <tr>
                        <td><!--<i class="fa fa-desktop"></i>--> <a target="_blank" href="{{url('')}}/eventos/{{$eventType}}/{{$eventUrl}}" class="black-links blue-links"> <i class="fa fa-arrow-right"></i> Ver mas detalles del evento  </a> </td>
                        <!--<td>
                          <a target="_blank" href="{{url('')}}/eventos/{{$eventType}}/{{$eventUrl}}" class="btn btn-outline dark"> Ir a página web <i class="fa fa-angle-right"></i> </a>
                        </td> -->
                    </tr>
                    <tr>
                        <td><!--<i class="fa fa-map"></i>--> Ubicación </td>
                        <td>
                          {{ $eventLocation }}  <!--<a class="btn btn-outline dark" data-target="#stack1" data-toggle="modal"> Actualizar </a>-->
                        </td>
                    </tr>
                    <tr>
                        <td><!--<i class="fa fa-calendar-check-o"></i>--> Fecha de Inicio </td>
                        <td>
                           {{ $eventDateFull }} - {{ $eventHourStart }} <!-- <a class="btn btn-outline dark" id="ajax-demo" data-url="ui_extended_modals_ajax_sample.html" data-toggle="modal"> Actualizar </a> -->
                        </td>
                    </tr>


                    <tr>
                        <td><!--<i class="fa fa-calendar-times-o"></i>--> Fecha de Finalización </td>
                        <td>
                           {{ $eventDateFullFinish }} - {{$eventHourFinish}} <!-- <a class="btn btn-outline dark" id="ajax-demo" data-url="ui_extended_modals_ajax_sample.html" data-toggle="modal"> Actualizar </a> -->
                        </td>
                    </tr>
                    @if(isset($hideall) && $hideall != 1)

                        @if($userEventRoleAuth==1)
                            <tr>
                                <td><!--<i class="fa fa-file-image-o"></i>--> Imagen Principal del evento </td>
                                <td>
                                   @if($eventPic == null) No registrada @else <img src="{{url('')}}/{{$eventPictureUrl}}" width="100">  @endif<!-- <a class="btn btn-outline dark" id="ajax-demo" data-url="ui_extended_modals_ajax_sample.html" data-toggle="modal"> Actualizar </a> -->
                                </td>
                            </tr>

                             <tr>
                                <td><!--<i class="fa fa-file-photo-o"></i>--> Ícono del evento </td>
                                <td>
                                   @if($eventLogo == null) No registrado @else <img src="{{url('')}}/{{$eventLogoUrl}}" width="100">  @endif<!-- <a class="btn btn-outline dark" id="ajax-demo" data-url="ui_extended_modals_ajax_sample.html" data-toggle="modal"> Actualizar </a> -->
                                </td>
                            </tr>


                            <tr>
                                <td><!--<i class="fa fa-file-photo-o"></i>--> Fondo para invitaciones especiales </td>
                                <td>
                                   @if($invitationPicture == null) No registrada <a href="javascript:;" onclick="event.preventDefault();
                                                                             document.getElementById('invitation-config-form').submit();"> Registrar </a>
                                @else
                                    <img src="{{url('images/events/invitations/templates')}}/{{$invitationPicture}}" width="100">
                                    <br>
                                    <a href="javascript:;" onclick="event.preventDefault();
                                                                             document.getElementById('invitation-config-form').submit();"> Actualizar </a>
                                @endif<!-- <a class="btn btn-outline dark" id="ajax-demo" data-url="ui_extended_modals_ajax_sample.html" data-toggle="modal"> Actualizar </a> -->
                                   <form id="invitation-config-form" action="{{ route('config-invitation') }}" method="POST" style="display: none;">
                                          {{ csrf_field() }}
                                          <input type="hidden" name="eventId" value="{{$eventId}}">
                                    </form>
                                </td>
                            </tr>

                             <tr>
                                <td><a href="javascript:;" onclick="changeView('edit-event-data');"><i class="fa fa-edit"></i> Editar Datos</td>


                            </tr>
                            @endif
                      @endif
                </tbody>
            	</table>


            </div>
        </div>
    </div>
</div>


<script>
	 $('.getContent').click(function(event){
		/*$('#home-page').click ();*/
		var url = $(this).attr("data-url");
			goToContent(url);
		});
</script>

<script>
	function goToContent(url){
	 var eventId = <?php echo $eventId;   ?>;
            Pace.restart();
            $('#content-overlay').fadeIn('slow');
             $.ajax({
                url : url,

                success: function(data){
                $("#portlet_tab1").html(data);

                /*window.history.pushState('page2', 'Title', url);*/
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                alert("Status: " + textStatus); alert("Error: " + errorThrown);
                }

            });
             $('#content-overlay').fadeOut('slow');
	}
</script>

<script>
    function changeView(type){

        if(type=='users')
        {
            document.getElementById('btn-get-users').click();
        }
        if(type=='sessions')
        {
            document.getElementById('btn-get-sessions').click();
        }
        if(type=='products')
        {
            document.getElementById('btn-get-products').click();
        }
        if(type=='offers')
        {
            document.getElementById('btn-get-offers').click();
        }
        if(type=='visitors')
        {
            document.getElementById('btn-get-visitors').click();
        }
        if(type=='sponsors')
        {
            document.getElementById('btn-get-sponsors').click();
        }
        if(type=='webpage')
        {
            document.getElementById('btn-get-webpage').click();
        }
        if(type=='edit-event-data'){
            document.getElementById('btn-get-edit-data').click();
        }
    }

</script>
