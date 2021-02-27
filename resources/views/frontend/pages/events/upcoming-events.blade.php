@extends('frontend.layouts.app')

@section('title')
<section id="page-title">

			<div class="container clearfix">
				<h1>{{ $page_title }}</h1>
				<!--<span>650+ Retina Icons with unlimited customizations</span> -->
				<!--<ol class="breadcrumb">
					<li><a href="#">Inicio</a></li>
					<li ><a href="#">Mis Eventos</a></li>
					<li class="active"><a href="#">Escanear Codigo QR</a></li>
					
					
				</ol>-->
			</div>

		</section>
@endsection
@section('content')

<div class="section home-events">

	<div class="calendar-container element-scaled">
		<!-- Swiper -->
		  <div class="swiper-container">
		    <div class="swiper-wrapper">

		    	@foreach($events as $event)
		      	<div class="swiper-slide one-event-slide">
		      		<div class="card">
						<div class="wrapper" >
							<?php $evimg = '/'.$event->eventPicturePath . '/' . $event->eventPicture; ?>
						
							<div class="img-cover" style="background: url('{{url('/')}}/{{$event->PICTURE}}') center / cover no-repeat;"></div>
							<div class="img-overlay" style="background: url('{{url('../images/grid.png')}}') center / cover no-repeat; opacity: 0"></div>
							<div class="header">
								<div class="date">
						          	<span class="day">{{ date_format(new DateTime($event->eventStart), 'd/m/Y') }}</span>
						          	
						        </div>
						       <!-- <ul class="menu-content">
						          	<li><a href="#" class="fa fa-bookmark-o"></a></li>
						          	<li><a href="#" class="fa fa-heart-o"><span>18</span></a></li>
						          	<li><a href="#" class="fa fa-comment-o"><span>3</span></a></li>
						        </ul> -->
							</div>
							 <div class="data">
						        	<div class="content">
							          <span class="author">{{$event->userFirstName}} {{$event->userLastName}}</span>
							          <h1 class="title"><a href="{{url('events/show')}}/{{$event->EVENTID}}/0">{{$event->NAME}}</a></h1>
							          <div class="text">{{$event->DESCRIPTION}}</div>
							          <a href="{{url('events/show')}}/{{$event->EVENTID}}/0" class="button-more">Ver Evento</a>
						        	</div>
						      </div>
						</div>
					</div>







			      	<!--<div class="row nomargin calendar-days">
			      		
			      		<div class="day">
			      			<div class="day-content-date">
			      				<span class="day-mounth">{{ date_format(new DateTime($event->EVENTSTART), 'd/m/Y') }}</span>
			      				<a class="day-name">{{ $event->DAY}}</a>
			      		    </div>

			      		    <div class="day-content event-description">
			      		    	

			      		    	<ul class="event-data">
			      		    		<li class="image"><div class="image-container" style="background-image: url('{{url('')}}/{{$event->PICTURE}}'); " /></li>
			      		    		<li class="title"><a class="middle" href="{{url('events/show')}}/{{$event->EVENTID}}/0">{{$event->NAME}} {{ $event->TYPE}}</a></li>
			      		    		
			      		    		<li class="description"><a class="middle"> {{ $event->DESCRIPTION }}</a></li>
			      		    		<li><a><i class="glyphicon glyphicon-map-marker"></i>{{$event->LOCATION}}</a></li>
			      		    		<li></li>
			      		    		<li></li>
			      		    	</ul>
			      		    </div>
			      		</div>
			        </div> -->
			    </div>    
		 		@endforeach
		    </div>
		     <!-- Add Pagination -->
		   <!-- <div class="swiper-pagination swiper-pagination-white"></div> -->
		    <!-- Navigation -->
		    <div class="swiper-button-next swiper-button-white"></div>
		    <div class="swiper-button-prev swiper-button-white"></div>
		  </div> <!-- End Swiper -->
	</div>

</div>









@endsection


@section('scripts')

<!-- Initialize Swiper -->
 <script>
    var swiper = new Swiper('.swiper-container', {
      slidesPerView: 5,
      spaceBetween: 10,
      height: 540,
      // init: false,
      centeredSlides: true,
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      breakpoints: {
        1024: {
          slidesPerView: 4,
          spaceBetween: 10,
        },
        768: {
          slidesPerView: 2,
          spaceBetween: 10,
        },
        640: {
          slidesPerView: 2,
          spaceBetween: 10,
        },
        320: {
          slidesPerView: 1,
          spaceBetween: 10,
        }
      },
      lazy: false,
     
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });
  </script>

  <script>
        jQuery(document).ready( function($) {
            $('.calendar-container').addClass('element-scaled-100');
    
      });
    </script>
@endsection