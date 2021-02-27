@extends('layouts.admin.app')


@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{ route('home-expositor')}}">Inicio</a>
           
    </ul>
</div>
<div class="row" style="margin-top: 10px">
    <div class="col-md-8">
        <div class="col-md-4">
            <div class="mt-widget-3 border-grey-salt">
                <div class="mt-head bg-blue-hoki">
                    <div class="mt-head-icon">
                        <i class="fa fa-folder-open"></i>
                    </div>
                    <div class="mt-head-desc"> <h3>Eventos</h3> </div>
                    <span class="mt-head-date"> <h2>{{ count($allevents)}}</h2> </span>
                    <div class="mt-head-button">
                        <a href="{{url('admin/events/list')}}/all" class="btn btn-circle btn-outline white btn-sm">Ver todos</a>
                    </div>
                </div>
                <div class="mt-body-actions-icons">
                    <div class="btn-group btn-group btn-group-justified">
                        <a href="{{url('admin/events/list')}}/actives" class="btn ">
                            <span class="mt-icon">
                                <i class="fa fa-calendar-check-o"></i>
                            </span>ACTIVOS</a>
                        <a href="{{url('admin/events/list')}}/finished" class="btn ">
                            <span class="mt-icon">
                                <i class="fa fa-calendar-times-o"></i>
                            </span>FINALIZADOS</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
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
        </div>
        <div class="col-md-4">
            <div class="mt-widget-3 border-grey-salt">
                <div class="mt-head bg-green">
                    <div class="mt-head-icon">
                        <i class="fa fa-list-alt"></i>
                    </div>
                    <div class="mt-head-desc"><h3>CATÁLOGOS</h3></div>
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
        </div>
        <div class="col-lg-12 col-xs-12 col-sm-12" style="margin-top: 25px">
            <div class="portlet light border-grey-salt" style="border: 1px solid">
                <div class="portlet-title">
                    <div class="caption caption-md">
                        <i class="icon-bar-chart font-dark hide"></i>
                        <span class="caption-subject font-dark bold uppercase">Últimos eventos registrados</span>
                        <!--<span class="caption-helper"> weekly stats...</span>-->
                    </div>
                </div>
                <div class="portlet-body">
                    
                    <div class="table-scrollable table-scrollable-borderless">
                        <table class="table table-hover table-light">
                            <thead>
                                <tr class="uppercase">
                                    <th colspan="2"> Evento </th>
                                    <th> Creador</th>
                                    <th><i class="fa fa-calendar"></i> Fecha de registro </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($lastevents as $lastevent)
                                <tr>
                                    <td class="fit">
                                        <img class="user-pic rounded" src="{{url('')}}/{{$lastevent->PICTURE}}"> </td>
                                    <td>
                                        <a href="{{url('/sponsor/events/check-event/')}}/{{$lastevent->EVENTID}}" class="primary-link">{{ $lastevent->ENAME }}</a>
                                    </td>
                                    <td> {{$lastevent->SPONSOR}} </td>
                                    <td><span class="pull-right"> {{ $lastevent->CREATED}}</span></td>
                                </tr>
                                @endforeach
                        </tbody></table>
                    </div><br>
                    <a href="javascript:;" class="btn btn-circle dark btn-outline">Ver todos</a>
                </div>
            </div>
        </div> <!-- end last events col-md-6 -->
    </div> <!-- end col-md-8 -->
    <div class="col-md-4">
        <div class="admin-rpanel">

        </div> <!-- end admin-rpanel -->
    </div> <!-- end col-md-4 -->
</div> <!-- end row -->

                           
@endsection