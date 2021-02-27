@extends('layouts.expositor.app')
@section('css')
<link rel="stylesheet" href="{{ asset('css/cards.css')}}" type="text/css" />
@endsection
@section('content')







@if($permissions == 1)
<div class="page-title">
    <h3> Mi Cuenta  </h3>
  </div>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{ route('admin-home')}}">Inicio</a>
             <i class="fa fa-angle-right"></i>
        </li>

        <li>
            <span>Mi Cuenta</span>
        </li>

    </ul>
</div>

@else


<div id="home-welcome-container">

    <div class="home-welcome-message">
      <?php
        $firstName =explode(' ',trim(Auth::user()->userFirstName));
       ?>


        <h4>¡Hola, {{ $firstName[0] }}!</h4>
        <span>Bienvenid@ a NetworkingApp</span>

        <div class="event-resume-container">
            <span><a href="{{ route('sponsor-events')}}">Actualmente estás registrado a {{$countEvents}} evento(s)</a></span>
        </div>

    </div>

</div>

@endif




<div class="row" style="margin-top: 30px">
    <div class="col-md-12">







            @if($permissions == 1)
            <div class="col-md-12">
                <div class="mt-widget-3 " style="box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 1px 5px 0 rgba(0, 0, 0, 0.12), 0 3px 1px -2px rgba(0, 0, 0, 0.2);
    }

    ">              <div class="dash-card-header">
                        <div class="dash-card-header-title">
                            <h4 class="dash-card-title">Resumen</h4>

                          </div>

                    </div>
                    <div class="mt-head bg-blue-hoki mt-custom-head">
                        <div class="col-md-4 nomargin nopadding mt-left-buttons-container" >
                            <div class="col-md-12 nopadding nomargin mt-left-button">
                                <a href="{{url('administracion/eventos/mis-eventos/')}}/activos" class="btn no-border">
                                    <span class="mt-icon">
                                        <i class="fa fa-calendar-check-o"></i>
                                    </span>ACTIVOS <span class="event-count">{{$eventsActives}}</span></a>
                            </div>
                            <div class="col-md-12 nopadding nomargin mt-left-button">
                                <a href="{{url('administracion/eventos/mis-eventos/')}}/finalizados" class="btn no-border">
                                    <span class="mt-icon">
                                        <i class="fa fa-calendar-times-o"></i>
                                    </span>FINALIZADOS <span class="event-count">{{$finishedEvents}}</span></a>
                            </div>

                            <div class="col-md-12 nopadding nomargin mt-left-button">
                                <a href="{{url('administracion/eventos/mis-eventos/')}}/todos" class="btn no-border">
                                    <span class="mt-icon">
                                        <i class="fa fa-calendar-times-o"></i>
                                    </span>TODOS <span class="event-count">{{$eventsAll}}</span></a>
                            </div>
                        </div>



                        <div class="mt-head-icon">
                            <i class="fa fa-folder-open" style="color: #666;"></i>
                        </div>

                        <span class="mt-head-date"> <h2 style="color: #666;">Opciones</h2> </span>
                        <div class="mt-head-button">
                            <a href="{{url('administracion/eventos/crear_nuevo')}}" class="btn btn-circle btn-outline white btn-sm btn-orange"  onclick="return true;">Crear Nuevo Evento</a>

                        </div>
                    </div>

                </div>
            </div>
            @endif
       <!-- <div class="col-md-4">
            <div class="mt-widget-3 border-grey-salt">
                <div class="mt-head bg-red">
                    <div class="mt-head-icon">
                        <i class="fa fa-users"></i>
                    </div>
                    <div class="mt-head-desc"><h3>Usuarios</h3> </div>
                    <span class="mt-head-date"><h2> 20 </h2> </span>
                    <div class="mt-head-button">
                        <a href="{{ url('admin/users/list')}}" class="btn btn-circle btn-outline white btn-sm">Ver Todos</a>
                    </div>
                </div>
                <div class="mt-body-actions-icons">
                    <div class="btn-group btn-group btn-group-justified">
                        <a href="{{ url('admin/users/create')}}" class="btn ">
                            <span class="mt-icon">
                                <i class="fa fa-plus"></i>
                            </span>CREAR </a>
                        <a href="url('admin/users/premissions')}}" class="btn ">
                            <span class="mt-icon">
                                <i class="fa fa-lock"></i>
                            </span>PERMISOS</a>

                    </div>
                </div>
            </div>
        </div> -->
        @if(count($myEvents) > 0)
        <div class="row">
            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12 " style="margin-top: 25px; padding-bottom: 30px; background: #fff; padding-top: 30px">
                <div class="portlet light portlet-fit bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-directions font-green hide"></i>
                            <span class="caption-subject bold font-dark">   @if($roleEvent != 5)Mis Eventos @else Mis Eventos @endif</span>
                            <span class="caption-helper"></span>
                        </div>
                        @if($roleEvent != 5)
                            <div class="actions">
                                <div class="btn-group">
                                    <a href="{{ route('sponsor-events')}}" class="btn blue-soft btn-outline btn-circle btn-sm" href="javascript:;" > Ver todos...
                                        <!--<i class="fa fa-angle-down"></i>-->
                                    </a>
                                </div>
                            </div>
                        @endif
                        </div>
                    <div class="portlet-body">
                        <div class="row">
                        @foreach($myEvents as $event)
                            <a href="{{ url('/administracion/eventos')}}/{{$event->ID}}">
                                <div class="card-container card-mini">
                                    <div class="card">
                                        <div class="wrapper" >
                                            <?php $evimg = $event->PICTUREPATH; ?>

                                            <div class="img-cover" style="background: url('{{url('/')}}/{{$evimg}}') center / cover no-repeat;"></div>
                                            <div class="img-overlay" style="background: url('{{url('../images/grid.png')}}') center / cover no-repeat; opacity: 0"></div>
                                            <div class="header">
                                                <div class="date">
                                                    <span class="day">{{ date_format(new DateTime($event->EVENTSTART), 'd/m/Y') }}</span>
                                                    <span class="day">  @if($roleEvent != 5) | Visitantes {{$event->VISITORS}} @endif</span>
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
                                                      <!--<p class="text">{{$event->DESCRIPTION}}</p>-->
                                                      <a href="{{ url('/administracion/eventos')}}/{{$event->ID}}" class="button-more">Ver más</a>
                                                    </div>
                                              </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                        </div>
                    </div>
                </div> <!-- end portlet -->
            </div> <!-- end last events col-md-6 -->
        </div>
        @elseif(count($allEvents)>0)

            <div class="row">
                <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12 " style="margin-top: 25px; padding-bottom: 30px; background: #fff; padding-top: 30px">
                    <div class="portlet light portlet-fit bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-directions font-green hide"></i>
                                <span class="caption-subject bold font-dark">  Puedes registrarte a estos eventos</span>
                                <span class="caption-helper"></span>
                            </div>
                            @if($roleEvent != 5)
                                <div class="actions">
                                    <div class="btn-group">
                                        <a href="{{ url('/')}}" class="btn blue-soft btn-outline btn-circle btn-sm" href="javascript:;" > Ver todos...
                                            <!--<i class="fa fa-angle-down"></i>-->
                                        </a>
                                    </div>
                                </div>
                            @endif
                            </div>
                        <div class="portlet-body">
                            <div class="row">
                            @foreach($allEvents as $event)
                                <a href="{{ url('/eventos')}}/{{$event->eventType}}/{{$event->eventUrl}}">
                                    <div class="card-container card-mini">
                                        <div class="card">
                                            <div class="wrapper" >
                                                <?php $evimg = $event->PICTUREPATH; ?>

                                                <div class="img-cover" style="background: url('{{url('/')}}/{{$evimg}}') center / cover no-repeat;"></div>
                                                <div class="img-overlay" style="background: url('{{url('../images/grid.png')}}') center / cover no-repeat; opacity: 0"></div>
                                                <div class="header">
                                                    <div class="date">
                                                        <span class="day">{{ date_format(new DateTime($event->EVENTSTART), 'd/m/Y') }}</span>
                                                        <span class="day">  @if($roleEvent != 5) | Visitantes {{$event->VISITORS}} @endif</span>
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
                                                          <!--<p class="text">{{$event->DESCRIPTION}}</p>-->
                                                          <a href="{{ url('/eventos')}}/{{$event->eventType}}/{{$event->eventUrl}}" class="button-more">Ver más</a>
                                                        </div>
                                                  </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                            </div>
                        </div>
                    </div> <!-- end portlet -->
                </div> <!-- end last events col-md-6 -->
            </div>



        @endif


        <!--if($isNewUser==1 && $fromEvent == true)-->
        @if($roleAuth == 3 && count($myEvents) > 0)
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 text-center center-block">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="profile-complete-message text-center">
                        <span><i class="fa fa-info"></i>  Completa tu  <a href="" onclick="event.preventDefault();
                                                     document.getElementById('my-badge-form').submit();"> Perfil Electrónico</a> de <span>{{$lastEventName}}</span> para una mejor experiencia de NetworkingApp</span>
                    </div> <!-- end:: profile-complete-message -->

                    <form id="my-badge-form" action="{{ route('my-badge-view') }}" method="POST" style="display: none;">
                          {{ csrf_field() }}
                          <input type="hidden" id="allUsersBadge" name="allUsersBadge" value="0">
                          <input type="hidden" name="eventId" value="{{$lastEventId}}">
                          <input type="hidden" name="userType" id="userType" value="admin">
                    </form>


                    <div class="get-app" style="margin-top: 50px;">

                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <img src="{{url('images/backgrounds/welcome-get-app.png')}}">
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12 text-left">
                           <h2 class="download-app-text">Descarga el App Móvil</h2>
                           <p class="download-app-text-info">Para hacer Networking y poder obtener</p>
                           <h3 class="download-app-text-offers">Ofertas Exclusivas</h3>
                           <div class="row" style="margin-top: 40px;">

                                <div class="col-lg-4 col-md-6 col-sm-6 clearfix mt-2">
                                    <a href="https://itunes.apple.com/gt/app/networkingapp-net/id1207597316?mt=8" target="_blank"><img class="store-app-link" width="200" src="{{url('images/logos/app-store.png')}}"></a>

                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-6 clearfix mt-2">
                                    <a href="https://play.google.com/store/apps/details?id=net.Networkingapp" target="_blank"><img class="store-app-link" width="200" src="{{url('images/logos/play-store.png')}}"></a>
                                </div>

                            </div>
                        </div>

                    </div>

                </div> <!-- end col-lg-12  -->
            </div> <!-- end:: get app mobil -->
        </div>
        @endif

        <!--@if($roleAuth == 3)

            <div class="row">

                <div class="col-lg-12 col-md-12 col-sm-12 text-center center-block">

                    <div class="portlet light portlet-fit bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-directions font-green hide"></i>
                                <span class="caption-subject bold font-dark">   Otros eventos de NetworkingApp</span>
                                <span class="caption-helper"></span>
                            </div>
                            @if($roleEvent != 5)
                                <div class="actions">
                                    <div class="btn-group">
                                        <a href="{{ route('sponsor-events')}}" class="btn blue-soft btn-outline btn-circle btn-sm" href="javascript:;" > Ver todos...
                                          
                                        </a>
                                    </div>
                                </div>
                            @endif
                            </div>
                        <div class="portlet-body">
                            <div class="row">
                            </div>
                        </div>
                    </div>


                </div> 

            </div> 

        @endif -->

        <!--<div class="col-md-4">
            <div class="mt-widget-3 border-grey-salt">
                <div class="mt-head bg-green">
                    <div class="mt-head-icon">
                        <i class="fa fa-list-alt"></i>
                    </div>
                    <div class="mt-head-desc"><h3>Visitantes</h3></div>
                    <span class="mt-head-date"> <h2>2</h2> </span>
                    <div class="mt-head-button">
                        <a href="{{ url('admin/catalogs/list')}}" class="btn btn-circle btn-outline white btn-sm">Administrar</a>
                    </div>
                </div>
                <div class="mt-body-actions-icons">
                    <div class="btn-group btn-group btn-group-justified">
                        <a href="javascript:;" class="btn ">
                            <span class="mt-icon">
                                <i class="fa fa-folder-open"></i>
                            </span>PARA EVENTOS </a>
                        <a href="javascript:;" class="btn ">
                            <span class="mt-icon">
                                <i class="fa fa-users"></i>
                            </span>PARA USUARIOS</a>


                    </div>
                </div>
            </div>
        </div> -->
    </div> <!-- end col-md-8 -->
    <div class="col-md-4">
        <div class="admin-rpanel">

        </div> <!-- end admin-rpanel -->
    </div> <!-- end col-md-4 -->
</div> <!-- end row -->


@endsection

@section('scripts')
<script>
    jQuery(document).ready( function($) {
        $('.card-container').fadeIn('slow');
    });

</script>

@endsection
