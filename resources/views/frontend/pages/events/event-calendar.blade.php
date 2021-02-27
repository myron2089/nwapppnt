@extends('frontend.layouts.app')

@section('css')
<!-- Modern Blog Demo Specific Stylesheet -->
	<!--<link href="{{ asset('cnvs/demos/modern-blog/modern-blog.css') }}" rel="stylesheet">-->
	<link href="{{ asset('cnvs/demos/modern-blog/css/fonts.css') }}" rel="stylesheet">

	<link href="{{ asset('cnvs/css/__codepen_io_andytran_pen.css') }}" rel="stylesheet">

    <link href="{{ asset('cnvs/css/front-cards.css') }}" rel="stylesheet">

    <link href="{{ asset('cnvs/css/custom-swiper.css') }}" rel="stylesheet">

   	<link href=" https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.4.2/css/swiper.min.css" rel="stylesheet">

@endsection

@section('content')

<div class="container clearfix">

	<!-- Posts
	============================================= -->
	<!--<div class="row grid-container infinity-wrapper clearfix">-->
	<div class="row">


		 <!-- Swiper -->
		  <div class="swiper-container">
		    <div class="swiper-wrapper">
		      @foreach($evDays as $a => $day)
		    
			      <div class="swiper-slide">
			      	<div class="swiper-day">
			      		<a class="swiper-day-name">
			      			{{$day->dayName}} {{$day->dayNumber}}
			      			<div class="swiper-month-name">
			      				{{$day->monthName}}
			      			</div>
			      		</a>
			      	</div>
			      	<div class="swiper-content">


			      		@foreach($events as $event)
			      			@if($day->eventStart== $event->eventStart)
			      				<div class="swiper-event-container">
				      				<div class="swiper-image-container">
				      			 		<img class="swiper-content-image" src="{{url('images/events/previews')}}/{{$event->eventPicture}}"}"/>
				      			 	</div>
				      			 	<div class="swiper-event-title">
				      			 		{{$event->eventName}}
				      			 	</div>
				      			 	<div class="push popover__content">
								    	<p class="popover__message"><span class="propover__message__title">Lugar</span> {{$event->eventAddress}}</p>
								    	<p class="popover__message"><span class="propover__message__title">Fecha</span> {{$event->eventStart}}</p>
								    	<p class="popover__message"><span class="propover__message__title">Hora</span> {{$event->eventTimeStart}}</p>
								    	
								    	<a href="#" class="button button-3d button-mini button-rounded button-dirtygreen">Ver Detalles</a>
								  	</div>
				      			</div>
			      				
			      			@endif	
			      		@endforeach

			      	</div>
			      </div>
			    
		      @endforeach
		    </div>
		    <!-- Add Pagination -->
		    <div class="swiper-pagination"></div>
		  </div>


	</div>
	<!--end:: row -->
</div>
<!--end:: postcontent-->

@endsection

@section('scripts')
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.4.2/js/swiper.min.js"></script>

	<!-- Initialize Swiper -->
	  <script>
	    var swiper = new Swiper('.swiper-container', {
	      slidesPerView: 5,
	      spaceBetween: 0,
	      // init: false,
	      pagination: {
	        el: '.swiper-pagination',
	        clickable: true,
	      },
	      breakpoints: {
	        1024: {
	          slidesPerView: 4,
	          spaceBetween: 40,
	        },
	        768: {
	          slidesPerView: 3,
	          spaceBetween: 30,
	        },
	        640: {
	          slidesPerView: 2,
	          spaceBetween: 20,
	        },
	        320: {
	          slidesPerView: 1,
	          spaceBetween: 10,
	        }
	      }
	    });
	  </script>
@endsection