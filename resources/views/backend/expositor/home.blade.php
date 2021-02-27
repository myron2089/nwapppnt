@extends('layouts.expositor.app')


@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{ route('home-expositor')}}">Inicio</a>
           
    </ul>
</div>
<div class="row" style="margin-top: 10px">
    <div class="col-md-12">
        <div class="col-xl-4 col-md-4 col-sm-12">
            <div class="mt-widget-3 border-grey-salt">
                <div class="mt-head bg-blue-hoki">
                    <div class="mt-head-icon">
                        <i class="fa fa-folder-open"></i>
                    </div>
                    <div class="mt-head-desc"> <h3>Mis Eventos</h3> </div>
                    <span class="mt-head-date"> <h2>{{ $cevents}}</h2> </span>
                    <div class="mt-head-button">
                        <a href="{{url('admin/events/my-events')}}" class="btn btn-circle btn-outline white btn-sm">Ver todos</a>
                    </div>
                </div>
                <div class="mt-body-actions-icons">
                    <div class="btn-group btn-group btn-group-justified">
                        <a href="{{url('admin/events/my-events')}}" class="btn ">
                            <span class="mt-icon">
                                <i class="fa fa-calendar-check-o"></i>
                            </span>ACTIVOS</a>
                        <a href="{{url('admin/events/my-events')}}" class="btn ">
                            <span class="mt-icon">
                                <i class="fa fa-calendar-times-o"></i>
                            </span>FINALIZADOS</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-4 col-sm-12">
            <div class="mt-widget-3 border-grey-salt">
                <div class="mt-head bg-red">
                    <div class="mt-head-icon">
                        <i class="fa fa-users"></i>
                    </div>
                    <div class="mt-head-desc"><h3>Usuarios</h3> </div>
                    <span class="mt-head-date"><h2> 20 </h2> </span>
                    <div class="mt-head-button">
                        <a href="#" class="btn btn-circle btn-outline white btn-sm">Ver Todos</a>
                    </div>
                </div>
                <div class="mt-body-actions-icons">
                    <div class="btn-group btn-group btn-group-justified">
                        <a href="#" class="btn ">
                            <span class="mt-icon">
                                <i class="fa fa-plus"></i>
                            </span>CREAR </a>
                        <a href="#" class="btn ">
                            <span class="mt-icon">
                                <i class="fa fa-lock"></i>
                            </span>PERMISOS</a>
                       
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-4 col-sm-12">
            <div class="mt-widget-3 border-grey-salt">
                <div class="mt-head bg-green">
                    <div class="mt-head-icon">
                        <i class="fa fa-list-alt"></i>
                    </div>
                    <div class="mt-head-desc"><h3>Productos</h3></div>
                    <span class="mt-head-date"> <h2>2</h2> </span>
                    <div class="mt-head-button">
                        <a href="#" class="btn btn-circle btn-outline white btn-sm">Administrar</a>
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
    </div>
</div>
<!--<div class="row" style="margin-top: 10px">
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <a class="dashboard-stat dashboard-stat-v2 blue" href="{{ route('sponsor-events')}}">
                                    <div class="visual">
                                        <i class="fa fa-comments"></i>
                                    </div>
                                    <div class="details">
                                        <div class="number">
                                            <span data-counter="counterup" data-value="1349">1</span>
                                        </div>
                                        <div class="desc"> Mis Eventos </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <a class="dashboard-stat dashboard-stat-v2 red" href="#">
                                    <div class="visual">
                                        <i class="fa fa-bar-chart-o"></i>
                                    </div>
                                    <div class="details">
                                        <div class="number">
                                            <span data-counter="counterup" data-value="12,5">14</span> </div>
                                        <div class="desc"> Usuarios Registrados a los eventos </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <a class="dashboard-stat dashboard-stat-v2 green" href="#">
                                    <div class="visual">
                                        <i class="fa fa-shopping-cart"></i>
                                    </div>
                                    <div class="details">
                                        <div class="number">
                                            <span data-counter="counterup" data-value="549">15</span>
                                        </div>
                                        <div class="desc"> Productos </div>
                                    </div>
                                </a>
                            </div>
                          --> 
@endsection