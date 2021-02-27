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
            <i class="fa fa-circle"></i>
	    </li>
        <li>
            <a href="{{ route('home-expositor')}}">Empresas</a>
            
        </li>
	    
	</ul>
	
</div>
	<div class="page-title">
		<h3><i class="fa fa-list"></i> Catálogo para registro de Empresas</h3>
	</div>
	<!-- BEGIN ROW PP -->
	<div class="row" style="margin-top: -5px;">

		@if($catalogData->count()>0)

			{{$catalogData}}

		@else

			<div class="note note-info">
                <h4 class="block">Información!</h4>
                <p> No existe formulario para empresas en el evento {{$eventName}} </p>
            </div>

		@endif
		
	</div> <!--End row -->
@endsection
