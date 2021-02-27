@extends('layouts.expositor.app')

@section('content')
<div class="page-bar">
	<ul class="page-breadcrumb">
	    <li>
	        <a href="{{ route('home-expositor')}}">Inicio</a>
	        <i class="fa fa-circle"></i>
	    </li>
        <li>
            <a href="{{ route('home-expositor')}}">{{$eventName}}</a>
            <i class="fa fa-circle"></i>
        </li>
	    <li>
	        <a href="#">Catálogos</a>
            
	    </li>
        
	    
	</ul>
	
</div>
	<div class="page-title">
		<h3><i class="fa fa-list"></i> Administración de Catálogos </h3>
	</div>
	<!-- BEGIN ROW PP -->
	<div class="row" style="margin-top: -5px;">

        <div class="col-md-12" style="margin-top:30px;">
            <div class="col-md-4">
                <div class="mt-widget-3 border-grey-salt">
                    <div class="mt-head bg-blue-soft" style="background: #004f80 !important;">
                        <div class="mt-head-icon">
                            <i class="fa fa-users"></i>
                        </div>
                        <div class="mt-head-desc"><h3>Para Usuarios</h3></div>
                       <!-- <span class="mt-head-date"> <h2>2</h2> </span>-->
                       <!-- <div class="mt-head-button">
                            <a href="{{ url('admin/catalogs/list')}}" class="btn btn-circle btn-outline white btn-sm">Administrar</a>
                        </div>-->
                    </div>
                    <div class="mt-body-actions-icons p-2" style="padding: 20px;">
                        <div class="btn-group btn-group btn-group-justified">
                            <!--<a href="{{route('user-catalogs-list')}}" class="btn ">
                                <span class="mt-icon">
                                    <i class="fa fa-list"></i>
                                </span>VER LISTADO </a> -->
                            <!--<a href="{{route('user-catalog-add-fields')}}" class="btn ">
                                <span class="mt-icon">
                                    <i class="fa fa-edit"></i>
                                </span>CREAR NUEVO</a>-->

                                <a onclick="event.preventDefault();
                                                     document.getElementById('user-catalog-form').submit();" class="btn btn-sm orange-btn " style="padding: 10px; font-size: 16px;">
                               
                                    <i class="fa fa-list"></i> Administrar</a>

                                <form id="user-catalog-form" action="{{ route('user-catalog-create-new') }}" method="POST" style="display: none;">
                                          {{ csrf_field() }}
                                          <input type="hidden" id="allUsersBadge" name="allUsersBadge" value="0">
                                          <input type="hidden" name="eventId" value="{{$eventId}}">
                                    </form>
                            
                           
                        </div>
                    </div>
                </div>
            </div> <!-- end col-md-4 -->
            
            <div class="col-md-4">
                <div class="mt-widget-3 border-grey-salt">
                    <div class="mt-head bg-blue" style="background: #004f80 !important;">
                        <div class="mt-head-icon">
                            <i class="fa fa-list-alt"></i>
                        </div>
                        <div class="mt-head-desc"><h3>Para Empresas</h3></div>
                        <!--<span class="mt-head-date"> <h2>2</h2> </span>-->
                       
                    </div>
                    <div class="mt-body-actions-icons" style="padding: 20px;">
                        <div class="btn-group btn-group btn-group-justified">
                            <!--<a href="route('user-catalogs-list')" class="btn ">
                                <span class="mt-icon">
                                    <i class="fa fa-list"></i>
                                </span>VER LISTADO </a> -->
                            <a onclick="event.preventDefault();
                                                     document.getElementById('company-catalog-form').submit();" class="btn btn-sm orange-btn" style="padding: 10px; font-size: 16px;">
                                
                                    <i class="fa fa-edit"></i>
                                Crear</a>

                                 <form id="company-catalog-form" action="{{ route('company-catalog-create-new') }}" method="POST" style="display: none;">
                                          {{ csrf_field() }}
                                          <input type="hidden" id="allUsersBadge" name="allUsersBadge" value="0">
                                          <input type="hidden" name="eventId" value="{{$eventId}}">
                                    </form>
                            
                           
                        </div>
                    </div>
                </div>
            </div> <!-- end col-md-4 -->


        </div> <!-- end col-md-12 -->



		
	</div>
	<!-- END ROW PP -->


@endsection

@section('scripts')
<script>
    function fieldConfig(type){

        
        $('#large').modal('show');
    }
</script>

<script>
jQuery(document).ready( function($) {
   $('#controlValues').select2({
                    multiple: true,
                    placeholder: 'Escriba el nombre del valor, luego presione Enter para agregar',
                });
 
});    
</script>

@endsection