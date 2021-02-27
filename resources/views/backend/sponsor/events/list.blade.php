@extends('layouts.expositor.app')

@section('content')
<div class="page-bar">
	<ul class="page-breadcrumb">
	    <li>
	        <a href="{{ route('home-expositor')}}">Inicio</a>
	        <i class="fa fa-circle"></i>
	    </li>
	    <li>
	        <a href="#">Expositor</a>
	        <i class="fa fa-circle"></i>
	    </li>
	    <li>
	        <span>Mis Eventos</span>
	        
	    </li>
	</ul>
	<div class="page-toolbar">
	    <div class="btn-group pull-right">
	        <button type="button" class="btn green btn-sm btn-outline dropdown-toggle" data-toggle="dropdown"> Actions
	            <i class="fa fa-angle-down"></i>
	        </button>
	        <ul class="dropdown-menu pull-right" role="menu">
	            <li>
	                <a href="#">
	                    <i class="icon-bell"></i> Action</a>
	            </li>
	            <li>
	                <a href="#">
	                    <i class="icon-shield"></i> Another action</a>
	            </li>
	            <li>
	                <a href="#">
	                    <i class="icon-user"></i> Something else here</a>
	            </li>
	            <li class="divider"> </li>
	            <li>
	                <a href="#">
	                    <i class="icon-bag"></i> Separated link</a>
	            </li>
	        </ul>
	    </div>
	</div>
	</div>
	<h1> Listado de Eventos Creados </h1>
	<!-- BEGIN ROW PP -->
	<div class="row">

		<!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject bold uppercase">Mis Eventos</span>
                </div>
                <div class="tools"> </div>
            </div>
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="sample_1">
                    <thead>
                        <tr>
                            <th class="all">Fecha</th>
                            <th class="min-phone-l">Nombre</th>
                            <th class="min-tablet">Descripción del Evento</th>
                            <th class="none">Lugar</th>
                            <th class="none">Estado</th>
                            <th class="none">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    	@foreach($events as $evs)
                        <tr>
                            <td>{{$evs->eventStart}}</td>
                            <td>{{$evs->eventName}}</td>
                            <td>{{$evs->eventDescription}}</td>
                            <td>{{$evs->eventLocationName}}</td>
                            <td>@if($evs->event_status_id == 1) Activo @else Expirado @endif</td>
                            <td>


                            	<a href="{{ url('/sponsor/events/check-event')}}/{{$evs->id}}" class="btn btn-xs orange-btn"> Ver Evento &nbsp<i class="glyphicon glyphicon-calendar"> </i></a>
                            	<a href="{{ url('/sponsor/events/check-event')}}/{{$evs->id}}" class="btn btn-xs green"> Editar &nbsp<i class="glyphicon glyphicon-edit"> </i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
	</div>
	<!-- END ROW PP -->

@endsection