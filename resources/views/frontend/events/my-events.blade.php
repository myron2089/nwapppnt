@extends('frontend.layouts.app')

@section('css')
<!-- Modern Blog Demo Specific Stylesheet -->
	<!--<link href="{{ asset('cnvs/demos/modern-blog/modern-blog.css') }}" rel="stylesheet">-->
	<link href="{{ asset('cnvs/demos/modern-blog/css/fonts.css') }}" rel="stylesheet">

	<link href="{{ asset('cnvs/css/__codepen_io_andytran_pen.css') }}" rel="stylesheet">

    <link href="{{ asset('cnvs/css/front-cards.css') }}" rel="stylesheet">
@endsection

@section('content')



<div class="container clearfix">
	<div class="postcontent nobottommargin" style="margin-right: -5px;">


		

		<!-- Posts
		============================================= -->
		<!--<div class="row grid-container infinity-wrapper clearfix">-->
			<div class="row">
			<!-- EVENTS -->
			<?php $i = 1; ?>
			@foreach($events as $event)
				

			<!-- Normal Demo-->
				<div @if($i==1) class="col-xl-8 col-md-8 col-sm-12 p-2" @else class="col-md-4 p-2" @endif data-animate="fadeIn">
				  <div class="card-column">
				    
				    <!-- Post-->
				    <div class="post-module">
				      <!-- Thumbnail-->
				      <div class="thumbnail">
				      	<div class="card-category">
				      		{{$event->TYPE}}
				      	</div>
				        <!--<div class="date">
				          <div class="day">{{$event->dayNumber}}</div>
				          <div class="month">{{$event->monthName}}</div>
				        </div> -->
				        <img src="{{url('images/events/previews')}}/{{$event->eventPicture}}"/>
				      </div>
				      <!-- Post Content-->
				      <div class="post-content">
				        <div class="category"><i class="icon-calendar3"></i> {{$event->dayNumber}} {{$event->monthName}} {{$event->yearNumber}} | <i class="icon-clock"></i> {{$event->eventTimeStart}}</div>
				        <h1 class="title">{{$event->eventName}}</h1>
				        <!--<h2 class="sub_title">The city that never sleeps.</h2>-->
				        <p class="description">{{$event->DESCRIPTION}}...</p>
				        <div class="post-meta"><a href="{{url('eventos')}}/{{$event->TYPE}}/{{$event->URL}}">Ver Más &rarr;</a><!--<span class="timestamp"><i class="fa fa-clock-">o</i> 6 mins ago</span><span class="comments"><i class="fa fa-comments"></i><a href="#"> 39 comments</a></span>--></div>
				      </div>
				    </div>
				  </div>

				</div>
				<?php $i++; ?>
			@endforeach

		</div>
		<!--</div> <!-- #end grid-container --> 


		


	</div> <!-- #end postcontent -->

	<div class="sidebar nobottommargin col_last">

		@include('frontend.layouts.sidebar')

	</div> <!-- #end sidebar rh -->





</div> <!-- #end container clearfix -->


@endsection


@section('scripts')

<script>
    var swiper = new Swiper('.swiper-container', {
      effect: 'coverflow',
      grabCursor: true,
      centeredSlides: true,
      slidesPerView: 4,
      coverflowEffect: {
        rotate: 50,
        stretch: 0,
        depth: 100,
        modifier: 1,
        slideShadows : true,
      },
      pagination: {
        el: '.swiper-pagination',
      },
    });
 </script>




 <!-- ADD-ONS JS FILES -->
	<script>

		/* Infinity Scroll
		jQuery(window).on( 'load', function(){

			var $container = $('.infinity-wrapper');

			$container.infiniteScroll({
				path: '.load-next-posts',
				history: false,
				status: '.page-load-status',
			});

			$container.on( 'load.infiniteScroll', function( event, response, path ) {
				var $items = $( response ).find('.infinity-loader');
				// append items after images loaded
				$items.imagesLoaded( function() {
					$container.append( $items );
					$container.isotope( 'insert', $items );
					setTimeout( function(){
						SEMICOLON.initialize.resizeVideos();
						SEMICOLON.initialize.lightbox();
						SEMICOLON.widget.loadFlexSlider();
					}, 1000 );
				});
			});

		});
 */
	</script>

	<script>
		jQuery(document).ready(function(){
		  $('.post-module').hover(function() {
		    $(this).find('.description').stop().animate({
		      height: "toggle",
		      opacity: "toggle"
		    }, 300);
		  });
		});
	</script>
@endsection