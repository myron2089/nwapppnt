@extends('frontend.layouts.app')
@section('css')
<link rel="stylesheet" href="{{ asset('metronic/css/select2/css/select2.min.css')}}" type="text/css" />
<link rel="stylesheet" href="{{ asset('metronic/css/select2/css/select2-bootstrap.min.css')}}" type="text/css" />
<link rel="stylesheet" href="{{ asset('css/cards.css')}}" type="text/css" />

@endsection

@section('title')
<section id="page-title">

			<div class="container clearfix">
				<h1>Generar Badge</h1>
				<!--<span>650+ Retina Icons with unlimited customizations</span> -->
				<ol class="breadcrumb">
					<li><a href="#">Inicio</a></li>
					<li class="active"><a href="#">Mis Eventos</a></li>
					
					
				</ol>
			</div>

		</section>
@endsection
@section('content')

<div class="container clearfix">
	<div class="row">
		@foreach($events as $event)

		<div class="event-container col-xl-2 col-md-6 col-sm-12">
			<div class="event-wrapper col-md-12">
				<?php $evimg = '/'.$event->eventPicturePath . '/' . $event->eventPicture; ?>
			
				<div class="img-cover" style="background: url('{{url('/')}}{{$evimg}}') center / cover no-repeat;"></div>
				<div class="img-overlay" style="background: url('{{url('../images/grid.png')}}') center / cover no-repeat; opacity: 0"></div>
				<div class="header">
					<div class="date">
			          	<span class="day">{{ date_format(new DateTime($event->eventStart), 'd/m/Y') }}</span>
			          	
			        </div>
				</div>
				 <div class="data">
			        	<div class="content">
				          <span class="author">{{$event->userFirstName}} {{$event->userLastName}}</span>
				          <h1 class="title"><a href="{{ url('/admin/events/codescan')}}/{{$event->event_id}}">{{$event->eventName}}</a></h1>
				          <p class="text">{{$event->eventDescription}}</p>
				          <a href="{{ url('/admin/events/codescan')}}/{{$event->event_id}}" class="button-more">Ver Evento</a>
			        	</div>
			      </div>
			</div>
		</div>
		@endforeach
		
	</div>



	


</div>



@endsection
@section('scripts')
<script>
	jQuery(document).ready( function($) {  
		$('.card').fadeIn('slow');
	});

</script>

@endsection