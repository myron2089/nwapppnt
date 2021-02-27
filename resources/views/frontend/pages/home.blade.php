@extends('frontend.layouts.app')

@section('css')
<!-- Modern Blog Demo Specific Stylesheet -->
	<!--<link href="{{ asset('cnvs/demos/modern-blog/modern-blog.css') }}" rel="stylesheet">-->
	<link href="{{ asset('cnvs/demos/modern-blog/css/fonts.css') }}" rel="stylesheet">

	<link href="{{ asset('cnvs/css/__codepen_io_andytran_pen.css') }}" rel="stylesheet">

    <link href="{{ asset('cnvs/css/front-cards.css') }}" rel="stylesheet">


    <link href="{{ asset('cnvs/css/swiper.css') }}" rel="stylesheet">

@endsection




@section('slider')

<section id="slider" class="slider-element slider-parallax swiper_wrapper clearfix">
	<div class="slider-parallax-inner">

		<div class="swiper-container swiper-parent">
			<div class="swiper-wrapper">
				<!--<div class="swiper-slide dark" style="background-image: url('{{url('/images/homebanner/banner.jpg')}}');">
					<div class="container clearfix">
						<div class="slider-caption rigth">
							<h2 data-animate="fadeInUp">Bienvenido a NetworkingApp</h2>
							<p class="d-none d-sm-block" data-animate="fadeInUp" data-delay="200" style="margin-top: 300px;">Bienvenido a <span style="color:#c08000; font-size: 30px; font-weight: 600; text-shadow: 5px 1px 1px rgba(0, 0, 0, 0.9); ">Networking</span><span style="color: #004f80;  font-size: 30px; font-weight: 600; text-shadow: 5px 1px 1px rgba(0, 0, 0, 0.9);">App.net</span></p>
						</div>
					</div>
				</div> -->
				<!--<div class="swiper-slide dark">
					<div class="container clearfix">
						<div class="slider-caption slider-caption-center">
							<h2 data-animate="fadeInUp">Beautifully Flexible</h2>
							<p class="d-none d-sm-block" data-animate="fadeInUp" data-delay="200">Looks beautiful &amp; ultra-sharp on Retina Screen Displays. Powerful Layout with Responsive functionality that can be adapted to any screen size.</p>
						</div>
					</div>
					<div class="video-wrap">
						<video poster="images/videos/explore.jpg" preload="auto" loop autoplay muted>
							<source src='images/videos/explore.mp4' type='video/mp4' />
							<source src='images/videos/explore.webm' type='video/webm' />
						</video>
						<div class="video-overlay" style="background-color: rgba(0,0,0,0.55);"></div>
					</div>
				</div> -->
				<div class="swiper-slide" style="background-image: url('{{url('/images/homebanner/banner_expo_motriz.jpg')}}'); background-position: center top;">
					<div class="container clearfix">
						<div class="slider-caption slider-caption-center">
							<p class="d-none d-sm-block" data-animate="fadeInUp" data-delay="200">Networking is not colleting contacts!</p>
							<!--<p class="d-none d-sm-block" data-animate="fadeInUp" data-delay="200">NetworkingApp, genera oportunidades de negocio</p>-->
							<h2 data-animate="fadeInUp">Networking is about planting relations.</h2>
							@if (!Auth::check())<a data-animate="fadeInUp" class="btn btn-orange mt-2" href="{{url('visitantes/registro')}}">Inscribirse</a>@endif
						</div>
					</div>
				</div>
				<div class="swiper-slide" style="background-image: url('{{url('/images/homebanner/banner_touch.jpg')}}'); background-position: center top;">
					<div class="container clearfix">
						<div class="slider-caption slider-caption-center">
							<!--<p class="d-none d-sm-block" data-animate="fadeInUp" data-delay="200">Networking is about planting relations.</p>-->
							<p class="d-none d-sm-block" data-animate="fadeInUp" data-delay="200">NetworkingApp, genera oportunidades de negocio</p>
							<!--<h2 data-animate="fadeInUp">Networking is not colleting contacts!</h2>-->
							@if (!Auth::check())<a data-animate="fadeInUp" class="btn btn-orange mt-2" href="{{url('visitantes/registro')}}">Inscribirse</a>@endif
						</div>
					</div>
				</div>
				<div class="swiper-slide" style="background-image: url('{{url('/images/homebanner/banner_contact.jpg')}}'); background-position: center top;">
					<div class="container clearfix">
						<div class="slider-caption slider-caption-center">
							<!--<p class="d-none d-sm-block" data-animate="fadeInUp" data-delay="200">Networking is about planting relations.</p>-->
							<p class="d-none d-sm-block" data-animate="fadeInUp" data-delay="200">NetworkingApp, genera oportunidades de negocio</p>
							<!--<h2 data-animate="fadeInUp">Networking is not colleting contacts!</h2>-->
							@if (!Auth::check())<a data-animate="fadeInUp" class="btn btn-orange mt-2" href="{{url('visitantes/registro')}}">Inscribirse</a>@endif
						</div>
					</div>
				</div>
			</div>
			<div class="slider-arrow-left"><i class="icon-angle-left"></i></div>
			<div class="slider-arrow-right"><i class="icon-angle-right"></i></div>
			<!--<div class="slide-number"><div class="slide-number-current"></div><span>/</span><div class="slide-number-total"></div></div>-->
		</div>

	</div>
</section>





@endsection






@section('content')



<div class="container clearfix">
	<!--<div class="postcontent nobottommargin" style="margin-right: -5px;">-->


		

		<!-- Posts
		============================================= -->
		<!--<div class="row grid-container infinity-wrapper clearfix">-->
			<div class="row">
			<!-- EVENTS -->
			<?php $i = 1; $ads=1; ?>
			@foreach($nextEvents as $event)
				

			<!-- Normal Demo-->
				
				<!--<div @if($i==1) class="col-xl-8 col-md-8 col-sm-12 p-2" @else class="col-md-3 p-2" @endif data-animate="fadeIn">-->
				<div class="col-lg-3 col-md-4 col-sm-6 p-2" data-animate="fadeIn">
				  <div class="card-column">
				    
				    <!-- Post-->
				    <div class="post-module">
				      <!-- Thumbnail-->
				      <a href="{{url('eventos')}}/{{$event->TYPE}}/{{$event->URL}}">
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
				      </a>
				      <!-- Post Content-->
				      <div class="post-content">
				       <div class="category"><!--<i class="icon-calendar3"></i>--> <!--{{$event->dayNumber}} {{$event->monthName}} {{$event->yearNumber}}--> {{$event->extendedDate}} | <!--<i class="icon-clock"></i>--> {{$event->eventTimeStart}}</div>
				        <h1 class="title">{{$event->eventName}}</h1>
				       <!-- <h2 class="sub_title">{{$event->dayNumber}} {{$event->monthName}} {{$event->yearNumber}} | {{$event->eventTimeStart}}</h2>-->
				        <p class="description">{{$event->DESCRIPTION}}...</p>
				        <div class="post-meta"><a href="{{url('eventos')}}/{{$event->TYPE}}/{{$event->URL}}">Ver Más &rarr;</a><!--<span class="timestamp"><i class="fa fa-clock-">o</i> 6 mins ago</span><span class="comments"><i class="fa fa-comments"></i><a href="#"> 39 comments</a></span>--></div>
				      </div>
				    </div>
				  </div>

				</div>

			<!--	@if($ads==3)

					<div class="col-lg-3 col-md-4 col-sm-6 p-2" data-animate="fadeIn" >
						<div class="ads" style="background-image: url('{{url('images/ads/ad_bac.jpg')}}');">


						</div>

					</div>

				@endif -->
				
				<?php $i++; $ads++;?>
			@endforeach 

			<!--@if($ads < 4)

				<div class="col-lg-3 col-md-4 col-sm-6 p-2" data-animate="fadeIn" >
					<div class="ads" style="background-image: url('{{url('images/ads/ad_bac.jpg')}}');">


					</div>

				</div>

			@endif -->

		</div>
		<!--</div> <!-- #end grid-container --> 


		


	<!--</div>--> <!-- #end postcontent -->

	<!--<div class="sidebar nobottommargin col_last">-->
	<div class="col-md-12" style="padding: 0; margin-top: 40px;">
		@include('frontend.layouts.sidebar')

	</div> <!-- #end sidebar rh -->





</div> <!-- #end container clearfix -->


@endsection


@section('scripts')




<!--<script>
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
 </script> -->




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