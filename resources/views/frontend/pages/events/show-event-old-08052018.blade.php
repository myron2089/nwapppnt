@extends('frontend.layouts.app')

@section('css')
@endsection


@section('content')


@foreach($eventData as $event)
		<div class="row nopadding common-height ohidden" style="margin-top: -80px;">
			<div class="col-lg-6 col-padding" style="background: url('{{url('images/events/previews')}}/{{$event->eventPicture}}') center center / cover no-repeat; height: 587px;">
				<div>&nbsp;</div>
			</div>
			<div class="col-lg-6 col-padding" style="height: 587px;">

				<div>
					<div class="entry-title">
					<h2><a href="#">{{$event->eventName}}</a></h2>
					<h3><a><i class="icon-folder-open" style="color: #EE7F22"></i>{{$event->TYPE}}</a></h3>
				</div>

					<div class="row">
						<div class="col-md-9 nopadding topmargin-sm clearfix">

							<div class="feature-box fbox-outline fbox-light fbox-effect fadeIn animated" data-animate="fadeIn">
								<div class="fbox-icon">
									<a href="#"><i class="icon-line-monitor"></i></a>
								</div>
								<h3>Responsive Layout</h3>
								<p>Powerful Layout with Responsive functionality that can be adapted to any screen size.</p>
							</div>

							<div class="feature-box fbox-outline fbox-light fbox-effect topmargin fadeIn animated" data-animate="fadeIn" data-delay="200">
								<div class="fbox-icon">
									<a href="#"><i class="icon-line-eye"></i></a>
								</div>
								<h3>Retina Ready Graphics</h3>
								<p>Looks beautiful &amp; ultra-sharp on Retina Displays with Retina Icons, Fonts &amp; Images.</p>
							</div>

							<div class="feature-box fbox-outline fbox-light fbox-effect topmargin fadeIn animated" data-animate="fadeIn" data-delay="400">
								<div class="fbox-icon">
									<a href="#"><i class="icon-line-layers"></i></a>
								</div>
								<h3>Powerful Performance</h3>
								<p>Optimized code that are completely customizable and deliver unmatched fast performance.</p>
							</div>

						</div>
					</div>
				</div>

			</div>
		</div>
		@endforeach



<div class="container clearfix" style="margin-top: -60px">
	
		



	<div class="postcontent nobottommargin clearfix" >
			<div class="row">
				<div class="col-md-8 nopadding nomargin">
					<div class="entry-overlay nopadding">
						<span class="d-none d-md-block"></span><div id="event-countdown" class="countdown"></div>
					</div>

				</div>

				<div class="col-md-4 nopadding nomargin">
					<a class="btn btn-register">REGISTRARSE</a>
				</div>
				<div class="col-md-4 col-sm-12" style="position: absolute; z-index: 99;">
					<div class="event-date-starts" data-animate="swing">
						<div class="event-starts-title"><a>INICIA</a></div>
						<div class="event-starts-date">
							<div class="event-starts-day">
								<a>{{$dateDayNumber}}</a>
							</div>
							<div class="event-starts-month">
								{{$dateMonthName}}
							</div>
							<div class="event-starts-year">
								{{$dateYearNumber}}
								
							</div>
							<div class="event-start-time">
								<i class="icon-clock"></i> <a>{{$eventHourStart}}</a>
							</div>
						</div>
					</div>
					<div class="event-date-ends" data-animate="swing">
						<div class="event-starts-title"><a>FINALIZA</a></div>
						<div class="event-ends-date">
							<div class="event-ends-day">
								<a>{{$dateDayNumberEnds}}</a>
							</div>
							<div class="event-ends-month">
								{{ $dateMonthNameFinish}}
							</div>
							<div class="event-ends-year">
								{{$dateYearNumberFinish}}
								
							</div>
							<div class="event-end-time">
								<i class="icon-clock"></i> <a>{{$eventHourFinish}}</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		
@foreach($eventData as $event)
			<div class="entry-image">
					<a href="{{url('images/events/previews')}}/{{$event->eventPicture}}" data-lightbox="image"><img class="image_fade" src="{{url('images/events/previews')}}/{{$event->eventPicture}}" alt="Standard Post with Image"></a>
					
				</div>

		<div id="posts"  style="padding: 20px; background: #fff; margin-top: -30px;">
			

			<div class="entry clearfix" style="padding: 20px">
				
				
				
				<div class="entry-title">
					<h2><a href="#">{{$event->eventName}}</a></h2>
					<h3><a><i class="icon-folder-open" style="color: #EE7F22"></i> {{$event->TYPE}}</a></h3>
				</div>
				
				<div class="si-share clearfix" style="margin-top: -20px">
					<div class="row" style="float: left; width: 100%">
						
						<div class="col-md-12" style="float: right; right: 0">
							<div>
								<a href="#" class="social-icon si-borderless si-facebook">
									<i class="icon-facebook"></i>
									<i class="icon-facebook"></i>
								</a>
								<a href="#" class="social-icon si-borderless si-twitter">
									<i class="icon-twitter"></i>
									<i class="icon-twitter"></i>
								</a>
								<a href="#" class="social-icon si-borderless si-gplus">
									<i class="icon-gplus"></i>
									<i class="icon-gplus"></i>
								</a>
								
							</div>
						</div>
					</div>
				</div>
					
					
					<div class="entry-content">
						<div class="col_one_third">
								<div class="feature-box fbox-small fbox-plain">
									<div class="fbox-icon">
										<a href="#"><i class="icon-phone"></i></a>
									</div>
									<h3>Teléfono</h3>
									<p>{{$eventPhone}}</p>
								</div>
							</div>

							<div class="col_one_third">
								<div class="feature-box fbox-small fbox-plain">
									<div class="fbox-icon">
										<a href="#"><i class="icon-money"></i></a>
									</div>
									<h3>Precio</h3>
									@if($eventAdmision>0)
									<p>{{$eventAdmisionCurrency}} {{$eventAdmision}}
									</p>
									@else
									<p>Gratuito</p>
									@endif

									<!--<div class="counter counter-large counter-lined"><span data-from="100" data-to="345" data-refresh-interval="20" data-speed="2000">345</span></div>-->
								</div>
							</div>

							<div class="col_one_third col_last">
								<div class="feature-box fbox-small fbox-plain">
									<div class="fbox-icon">
										<a href="#"><i class="icon-map"></i></a>
									</div>
									<h3>Ubicación</h3>
									<p>{{$eventLocation}}</p>
								</div>
							</div>
						<p>{{$event->DESCRIPTION}}</p>
						<!--<a href="blog-single.html" class="more-link">Read More</a>-->
						  


						<div class="entry-information">

							


						</div>

						@if($eventAboutUs != null)
						<div class="col-lg-12 col-md-12 col-sm-12 dark col-padding ohidden" style="background-color: rgb(41, 177, 197); height: auto; padding: 30px !important; margin-bottom: 10px">
							<div>
								<h3 class="uppercase" style="font-weight: 600;">Sobre Nosotros</h3>
								<p style="line-height: 1.8;">{{$eventAboutUs}}</p>
								<!--<a href="#" class="button button-border button-light button-rounded uppercase nomargin">Read More</a>-->
								<i class="icon-info bgicon"></i>
							</div>
						</div>
						@endif
						<div class="clear" style="height: 20px"></div>

						<div class="masonry-thumbs grid-3" data-big="1" data-lightbox="gallery">
							@foreach($eventGallery as $pic)
							<a href="{{url('')}}/{{$pic->PICTURE}}" data-lightbox="gallery-item"><img class="image_fade" src="{{url('')}}/{{$pic->PICTURE}}" alt="Gallery Thumb 1"></a>
							@endforeach
						</div>


						<!-- #end gallery -->


						<div class="clear" style="height: 50px"></div>
						
						@if($eventActivities != null)
						<!-- #begin activities -->
						<div class="heading-block">
							<h2>Actividades</h2>
							
						</div>

						{!! $eventActivities !!}
						@endif
						<!-- #end activities -->


						<div class="clear" style="height: 20px"></div>


						

						<div class="clear" style="height: 20px"></div>


						<div class="promo promo-light bottommargin">
							<h3>Regístrate en el evento {{$event->eventName}}</h3>
							<span>Pre regístrate para obtener más beneficios dentro del evento.</span>
							<a href="#" class="button button-xlarge button-rounded">Registrarse</a>
						</div>
						

					</div>
				
			</div>
			@endforeach
		</div> <!-- #end posts -->

		<!-- #begin speakers -->
		<!-- if(speakersCount > 0) -->

		<!--<div class="nopadding-blue-bg">
			<div class="heading-block">
				<h2>Conferencistas ({{$speakersCount}})</h2>
			</div>
				<div id="oc-team" class="owl-carousel team-carousel bottommargin carousel-widget owl-carousel-custom-speakers" data-margin="30" data-pagi="false" data-items-sm="1" data-items-md="2" data-items-xl="3" data-animate="fadeInDown">
					@foreach($eventSpeakers as $speaker)
						<div class="oc-item">
							<div class="team">
								<div class="team-image">
									<img src="{{url('')}}/{{$speaker->PICTURE}}" alt="{{$speaker->FULLNAME}}">
								</div>
								<div class="team-desc team-desc-custom">
									<div class="team-title team-title-custom"><h4>{{$speaker->FULLNAME}}</h4></div>
									
								</div>
							</div>
						</div>
					@endforeach
				</div>
		</div> <#end nopadding-bluegb -->
		<!--@endif -->

		<!-- #end speakers -->

    </div> <!--#end postcontent -->

    <div class="sidebar nobottommargin col_last">

		@include('frontend.layouts.sidebar')

	</div> <!-- #end sidebar rh -->
    
</div> <!-- #end container clearfix -->



@endsection


@section('scripts')
<!-- jquery countdown es-loc -->
	<script src="{{ asset('js/jquery.countdown-es.js') }}"></script>

<script>
	jQuery(document).ready( function($) {
		$(".slide").css("display", "flex");
		$(".slide").css("height", "100%");
	});
</script>

<script>
	
jQuery(document).ready( function($) {
$("#myModssal1").removeClass("mfp-hide");

});

</script>

<script>
    $(function() {
    	 var url = "http://nwapp.nuntechnologies.com/events/show/2108692359/0";
    	 var text = "Some text to share";
    	 $("#shareInPopup").jsSocials({
            url: url,
            text: text,
            shareIn: "popup",
            showCount: "inside",
            shares: ["twitter", "facebook", "googleplus", "linkedin", "pinterest", "stumbleupon"]
        });
    	});
</script>


<script>

		jQuery(document).ready(function($) {

			var year = {!!  $dateYearNumber !!};
			var day = {!!  $dateDayNumber !!};
			var month = {!!  $dateMonthNumber !!};

			
			var eventStartDate = new Date(year, day, month);
			$('#event-countdown').countdown({until: eventStartDate});

		});

		jQuery('#event-location').gMap({

			address: 'Ibiza, Spain',
			maptype: 'ROADMAP',
			zoom: 15,
			markers: [
				{
					address: "Ibiza, Spain"
				}
			],
			doubleclickzoom: false,
			controls: {
				panControl: true,
				zoomControl: true,
				mapTypeControl: true,
				scaleControl: false,
				streetViewControl: false,
				overviewMapControl: false
			}

		});

	</script>

@endsection