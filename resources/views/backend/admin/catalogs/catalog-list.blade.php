@extends('layouts.expositor.app')

@section('content')
    <div class="page-title">
        <h3><!--<i class="fa fa-user"></i>--> Catálogos  </h3>
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
	<!-- BEGIN ROW PP -->
	<div class="row" style="margin-top: -5px;">

		<!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="fa fa-search font-dark"></i>
                    <span class="caption-subject bold uppercase">Buscar</span>
                </div>
                <div class="tools"> <div class="btn-group pull-right">
	        		<a href="{{url('admin/catalogs/create')}}" class="btn green btn-sm btn-outline" > Crear Nuevo
	            <i class="fa fa-plus"></i></a>
	        </div>
			</div>
            </div>
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="sample_1">
                    <thead>
                        <tr>
                            <th class="all">Nombre</th>
                            <th class="min-phone-l">Descripción</th>
                            <th class="min-tablet">Asignado a </th>
                            <th class="none">Creado</th>
                            <th class="none">Estado</th>
                            <th class="none">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Datos Generales</td>
                            <td>Datos generales de los usuarios registrados como dueños de eventos...</td>
                            <td>Administrador de Eventos</td>
                            <td>30/11/2017</td>
                            <td>Activo</td>
                            <td><a href="javascript:userEdit(2,2);" id="edit-btn" class="btn btn-xs btn-default"><i class="fa fa-edit"></i>Editar</a> <a href="javascript:userEdit(2,2);" id="edit-btn" class="btn btn-xs btn-default"><i class="fa fa-edit"></i>Deshabilitar</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
	</div>
	<!-- END ROW PP -->

@endsection