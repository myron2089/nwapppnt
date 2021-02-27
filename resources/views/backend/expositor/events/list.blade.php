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
                        <tr>
                            <td>10/11/2017</td>
                            <td>Exposición Vehiuculos</td>
                            <td>Exposición Vehiuculos de la marca Audi</td>
                            <td>6A Calle & Av La Castellana, Guatemala</td>
                            <td>Activo</td>
                            <td>

                            	<form method="POST" action="{{ route('display-event2') }}">
								  <input type="hidden" name="ev_name" value="Exposición de Vehículos"/>
								  <input type="hidden" name="date" value="10/12/2017"/>
								  <input type="hidden" name="ev_hour" value="10:00 AM"/>
								  <button class="btn btn-xs orange-btn">Ir al evento</button>
								</form>

                            	<a href="{{ route('display-event') }}/?ev_name=Exposición Vehiuculos&ev_date=10/11/2017&ev_hour=08:00AM" class="btn btn-xs orange-btn"> Ver Evento &nbsp<i class="glyphicon glyphicon-calendar"> </i></a>
                            	<a href="{{ route('display-event') }}/?event_name=Exposición Vehiuculos" class="btn btn-xs green"> Editar &nbsp<i class="glyphicon glyphicon-edit"> </i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
	</div>
	<!-- END ROW PP -->

@endsection