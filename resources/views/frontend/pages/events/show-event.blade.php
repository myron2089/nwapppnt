@extends('frontend.layouts.app')




@section('css')
	<link href="{{ asset('cnvs/css/vmap.css') }}" rel="stylesheet">
@endsection





@section('content')
<script type="text/javascript">
		
	if (!!window.performance && window.performance.navigation.type === 2) {
	// value 2 means "The page was accessed by navigating into the history"
		window.location.reload(); // reload whole page
		
	}
</script>

@foreach($eventData as $event)

@section('meta')
		<meta property="og:url" content="{{url('')}}/{{$evUrlExtended}}">
		<meta property="og:type" content="article" />
        <meta property="og:site_name" content="{{$event->eventName}}">
        <meta property="og:image" content="{{url('images/events/previews')}}/{{$event->eventPicture}}">
        <meta property="og:image:secure_url" content="{{url('images/events/previews')}}/{{$event->eventPicture}}">

        <meta property="og:image:type" content="image/jpg">
        <meta property="og:image:width" content="1291">
        <meta property="og:image:height" content="315">
@endsection

		<!--<div class="row nopadding common-height ohidden" style="margin-top: -80px; background: #ffF;"> -->



		
		<div class="container clearfix" style="background: #fff; padding-right: 0; padding-left: 0; margin-top:-10px;">
			<div class="row">
				<div class="col-lg-9 col-md-9 col-sm-12">
					<div class="entry-title">
						<h2><a href="#">{{$event->eventName}}</a></h2> 
						<h3><a><i class="fa fa-folder" style="color: #EE7F22; padding-right: 5px;"></i>{{$event->TYPE}}</a></h3>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-12 text-right">
					@if($register==0)
						@if (Auth::check())
							<a href="{{url('eventos')}}/{{$eventUrl}}/registro/existente" class="button button-dark button-rounded btn-orange">Registrarse</a>
						@else
							<a href="{{url('eventos')}}/{{$eventUrl}}/registro/nuevo" class="button button-dark button-rounded btn-orange">Registrarse</a>
						@endif
					@else

						<div class="alert alert-success text-left" style="margin-top: 10px">
						  <i class="fa fa-info"></i><strong>Ya te encuentras registrado en este evento.</strong> 
						</div>

						<a href="#" class="button  button-rounded button-aqua" onclick="event.preventDefault();
	                                 document.getElementById('my-badge-form').submit();"><i class="fa fa-refresh"></i>Actualizar Gafete</a>

					@endif



					
				</div>
			</div>

			<div id="event-top-image" class="col-lg-12 no-padding" style="background: url('{{url('')}}/{{$eventTopImg}}') center center / cover no-repeat;">
				<div>&nbsp;</div>
				
			</div>
			<div class="col-lg-12 no-padding" style="height: auto;     padding-top: 20px; padding-left: 0; padding-right: 0;">

				<div>
					
				<div class="si-share clearfix" style="margin-top: -20px">
					<div class="row" style="float: left;">
						
						<div class="col-md-12">
							<div>
								<a href="#" class="social-icon si-borderless si-facebook" data-sharer="facebook" data-title="jojojojojo" data-url="{{url('')}}/{{$evUrlExtended}}">
									<i class="fa fa-facebook"></i>
									<i class="fa fa-facebook"></i>
								</a>
								<a href="#" class="social-icon si-borderless si-twitter" data-sharer="twitter"  data-url="{{url('')}}/{{$evUrlExtended}}">
									<i class="fa fa-twitter"></i>
									<i class="fa fa-twitter"></i>
								</a>
								<a href="#" class="social-icon si-borderless si-gplus" data-sharer="googleplus" data-url="{{url('')}}/{{$evUrlExtended}}">
									<i class="fa fa-google-plus"></i>
									<i class="fa fa-google-plus"></i>
								</a>
								
							</div>
						</div>
					</div>
				</div>

					<div class="row">
						<div class="col-md-6 col-xl-6 col-lg-6 col-sm-12 nopadding topmargin-sm clearfix">
							<p style="font-size: 16px; color: #333; font-family: 'Open Sans',sans-serif;    padding-left: 10px; padding-right: 10px; margin-top: -10px; text-align: justify;">
								@if($fullDescription)
									{{$fullDescription}}
								@else
									{{$event->DESCRIPTION}}
								@endif
							</p>
							

							
						</div>

						<!--<div class="col-md-12 nopadding nomargin" style="height: 67px">
							<div class="entry-overlay nopadding">
								<span class="d-none d-md-block"></span><div id="event-countdown" class="countdown"></div>
							</div>
					 	</div>	-->

							
								<div class="col-md-6 col-xl-6 col-lg-6 col-sm-12 event-info">
									<div class="col-md-12">
										<div class="row event-date">
											<div class="event-date-starts">
												<div class="event-date-container">
													<div class="event-starts-title"><a>Inicia</a></div>
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
															<!--<i class="icon-clock"></i>--> <a>{{$eventHourStart}}</a>
														</div>
													</div>
												</div>

											</div>
											<div class="event-date-ends">
												<div class="event-date-container">
													<div class="event-starts-title"><a>Finaliza</a></div>
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
															<!--<i class="icon-clock"></i>--> <a>{{$eventHourFinish}}</a>
														</div>
													</div>
												</div>
											</div>
										</div> <!-- end::row -->

									</div> <!-- end:: col-md-12 -->

									<div class="clear" style="margin-top: 30px;"></div>

									<div class="col-md-12">
										<div class="row">
											<div class="col_half event-phone">
												<div class="feature-box fbox-small fbox-plain">
													<div class="fbox-icon">
														<a href="#"><i class="icon-phone3"></i></a>
													</div>
													<h3>Teléfono</h3>
													<p>{{$eventPhone}}</p>
												</div>
											</div>

											<div class="col_half col_last event-mail">
												<div class="feature-box fbox-small fbox-plain">
													<div class="fbox-icon">
														<a href="#"><i class="icon-email3"></i></a>
													</div>
													<h3>Correo Electrónico</h3>
													
													<p>{{$eventEmail}}
													</p>
													

													<!--<div class="counter counter-large counter-lined"><span data-from="100" data-to="345" data-refresh-interval="20" data-speed="2000">345</span></div>-->
												</div>
											</div>

											<div class="col_half event-location">
												<div class="feature-box fbox-small fbox-plain">
													<div class="fbox-icon">
														<a href="#"><i class="icon-map-marker"></i></a>
													</div>
													<h3>Ubicación</h3>
													<p>{{$eventLocation}}</p>
												</div>
											</div>

											<div class="col_half col_last event-price">
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

										</div> <!-- end:: row -->
									</div> <!-- end:: col-md-12 -->
								</div>

								
						


						

					</div>
				</div>

			</div>
		</div>
		@endforeach

<div class="container topmargin-sm clearfix">

	@if($eventAboutUs != null)
		<div class="line"></div>
		<div class="row">
			<div class="col-lg-5 col-md-5 col-sm-12 bottommargin topmargin">
				<img data-animate="fadeInLeftBig" src="{{url('')}}/{{$aboutImage}}" alt="Sobre Nosotros" class="center-block fadeInLeftBig animated">
			</div>
			<div class="col-lg-7 col-md-7 col-sm-12 dark col-padding ohidden bottommargin topmargin" style="background-color: rgb(41, 177, 197); background-color: transparent; height: auto; padding: 10px !important; margin-bottom: 10px; text-align: right; margin-top: 20px !important;">
				<div>
					<h2 class="capitalize" style="font-weight: 600; color: #000"><i class="icon-info-sign"></i> Sobre Nosotros</h2>
					<p style="line-height: 1.8; font-size: 16px; color: #333; text-align: justify;">{{$eventAboutUs}}</p>
					<!--<a href="#" class="button button-border button-light button-rounded uppercase nomargin">Read More</a>-->
					<i class="icon-info bgicon"></i>
				</div>
			</div>
		</div>
	@endif

	<div class="line"></div>

</div>


<div class="section nomargin" style="background-color: #fff; padding-top: 0;">
	@if($eventActivities != null)
		<div class="container topmargin-lg clearfix">
			<div class="col_md_12">
				
					<!-- #begin activities -->
					<div class="heading-block">
						<h2><i class="icon-folder"></i> Actividades</h2>		
					</div>

					{!! $eventActivities !!}
				
			</div>
			<div class="clear" style="height: 20px"></div>
			<div class="line"></div>
		</div>
	@endif

	<div class="container topmargin-lg clearfix">
		<div class="col_md_12">
			
			<h2 style="font-weight: : 600px; color: #000;"><i class="icon-map-marker"></i> Ubicación</h2>
			<p>{{$eventLocation}}</p>
			
		</div>

		<div class="clear" style="height: 20px"></div>

		<!-- Eliminado temporalmente 

		<div class="alignleft gmap" id="google-map1" style="width: 100%; height: 400px;"></div>

		-->
		@if(strpos($eventLocation,"Industria") !== false)
			<a href="https://www.google.com/maps/place/Parque+de+la+Industria/@14.6084528,-90.5272231,16z/data=!4m12!1m6!3m5!1s0x8589a3d506898b87:0x83c0af9f5a86c02a!2sParque+de+la+Industria!8m2!3d14.6090134!4d-90.5237147!3m4!1s0x8589a3d506898b87:0x83c0af9f5a86c02a!8m2!3d14.6090134!4d-90.5237147" target="_blank"><div class="ubication-container" style="background: url('{{url('images/events/other/parque_de_la_industria.jpg')}}') center center / cover no-repeat;"></div></a>
		@endif

		<div class="clear" style="height: 20px"></div>

		<div class="line topmargin-lg"></div>

	</div>

<!--
	@if(count($eventGallery) > 0)
	<div class="container topmargin-lg clearfix">

		<div class="col_md_12">
			<h2 class="capitalize" style="font-weight: 600; color: #000"><i class="icon-image"></i> Galería</h2>
			<div class="masonry-thumbs grid-3" data-big="1" data-lightbox="gallery">
				@foreach($eventGallery as $pic)
					<a href="{{url('')}}/{{$pic->PICTURE}}" data-lightbox="gallery-item"><img class="image_fade" src="{{url('')}}/{{$pic->PICTURE}}" alt="Gallery Thumb 1"></a>
				@endforeach
			</div>
		</div>
	</div>
	@endif
-->

	<!-- share buttons -->
		<div class="container topmargin-lg clearfix">
			<div class="col_md_12">
				<div class="row">
					
					<h2 style="font-weight: : 600px; color: #000;"><i class="icon-share"></i> Compartir Evento</h2>
					
				</div>
			</div>
			<div class="si-share clearfix" style="margin-top: -10px">
				<div class="row" style="float: left;">
					
					<div class="col-md-12">
						<div>
							<a href="#" class="social-icon si-borderless si-facebook" data-sharer="facebook" data-title="jojojojojo" data-url="{{url('')}}/{{$evUrlExtended}}">
								<i class="fa fa-facebook"></i>
								<i class="fa fa-facebook"></i>
							</a>
							<a href="#" class="social-icon si-borderless si-twitter" data-sharer="twitter"  data-url="{{url('')}}/{{$evUrlExtended}}">
								<i class="fa fa-twitter"></i>
								<i class="fa fa-twitter"></i>
							</a>
							<a href="#" class="social-icon si-borderless si-gplus" data-sharer="googleplus" data-url="{{url('')}}/{{$evUrlExtended}}">
								<i class="fa fa-google-plus"></i>
								<i class="fa fa-google-plus"></i>
							</a>
							
						</div>
					</div>
				</div>
			</div>
			<!--<div class="row">
			
					<button class="sharer fb" data-sharer="facebook" data-url="{{url('')}}/{{$evUrlExtended}}"><i class="fa fa-facebook"></i>
					        Compartir en Facebook
					</button>
				
					<button class="sharer tw" data-sharer="twitter" data-url="{{url('')}}/{{$evUrlExtended}}"><i class="fa fa-twitter"></i>
					        Compartir en Twitter
					</button>
				
					<button class="sharer gplus" data-sharer="googleplus" data-url="{{url('')}}/{{$evUrlExtended}}"><i class="fa fa-google-plus"></i>
					        Compartir en Google Plus
					</button>
				
			</div> -->



		</div>
	<!-- end share buttons-->

</div>

<!--<div class="section nomargin" style="background-color: #fff; padding-bottom: 80px;">-->
<!-- #begin speakers -->
		

		<!--if($speakersCount > 0) 
		<div class="container topmargin-lg clearfix">
			
				<div class="heading-block">
					<h2 style="font-size: 20px"><i class="icon-users"></i> Conferencistas (speakersCount)</h2>
				</div>
					<div id="oc-team" class="owl-carousel team-carousel bottommargin carousel-widget owl-carousel-custom-speakers" data-margin="30" data-pagi="false" data-items-sm="1" data-items-md="3" data-items-xl="3" data-animate="fadeIn">
						//foreach($eventSpeakers as $speaker)
							<div class="oc-item">
								<div class="team">
									<div class="team-image">
										<img src="PICTURE" alt="FULLNAME">
									</div>
									<div class="team-desc">
										<div class="team-title"><h4>FULLNAME</h4></div>
										
									</div>
								</div>
							</div>
						@edndforeach
					</div>
			
		</div>
		ndif-->


		@if($countSponsors > 0)
			<div class="container topmargin-lg clearfix">	
				<div class="heading-block center">
					<h2 style="font-size: 20px"><i class="icon-users"></i> Patrocinadores</h2>
				</div>
				
				<div id="oc-clients" class="section nobgcolor notopmargin owl-carousel owl-carousel-full image-carousel footer-stick carousel-widget owl-carousel-full-custom-sponsors" data-margin="80" data-loop="true" data-nav="false" data-autoplay="5000" data-pagi="false" data-items-xs="2" data-items-sm="3" data-items-md="4" data-items-lg="5" data-items-xl="6" style="margin-top: -100px !important;">
					
					@foreach($eventSponsors as $sponsor)
						<div class="oc-item"><a href="#"><img src="{{url('')}}/{{$sponsor->PICTURE}}" alt="Patrocinador"></a></div>
					@endforeach

				</div>
			</div>
		@endif

<!-- </div> -->


	

	<div class="container clearfix" style="margin-top: 100px">
		
		



	<div class="postcontent nobottommargin clearfix" >
			

		

    </div> <!--#end postcontent -->

    <div class="col-md-12">

		@include('frontend.layouts.sidebar')

	</div> <!-- #end sidebar rh -->
    
</div> <!-- #end container clearfix -->



@endsection


@section('scripts')


	<!-- sharer buttons-->
	<script src="{{ asset('js/sharer.min.js') }}"></script>
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

			
			var eventStartDate = new Date(year, month, day);
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

		jQuery(document).ready( function($){
			var newDate = new Date(2018, 9, 31);
			$('#countdown-ex1').countdown({until: newDate});
		});

	</script>

	<script src="https://maps.google.com/maps/api/js?key=AIzaSyDMxJ92oBkSnVNHFX3R8XhtYQPEgk1_IiI"></script>
	<script src="{{ asset('cnvs/js/jquery.gmap.js') }}"></script>

	<script>

		$('#google-map1').gMap({

			 address: '{{$eventLocation}}',
			 maptype: 'ROADMAP',
			 zoom: 14,
			 markers: [
				{
					address: "{{$eventLocation}}"
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


	<!-- Add activities to favorites -->
	<script>
		function addFavorite(sesId, evId){

			$.ajax({
	          type: "POST",
	          url: "{{route('add-session-favorite')}}",
	          data: {sessionId: sesId, eventId: evId},
	          async: false,
	          cache: false,
	          
	         
	          success: function (data) {
	          	console.log(data);
	            var uData = jQuery.parseJSON(data);
	            var message='Se ha agregado la actividad a favoritos.';
	            if(uData.status == 'success'){

	            	if(uData.action =='add'){
	            		$('#favorite-'+sesId).text('Eliminar de Favoritos');
	            		$('#icon-'+sesId).removeClass('icon-star').addClass('icon-trash2');
	            	}
	            	else if(uData.action =='remove'){
	            		$('#favorite-'+sesId).text('Agregar a Favoritoss');
	            		$('#icon-'+sesId).removeClass('icon-trash2').addClass('icon-star');
	            		message = 'Se ha eliminado la actividad de favoritos.'
	            	}

	            	Command: toastr["success"](message, "Mensaje");

                        toastr.options = {
                          "closeButton": false,
                          "debug": false,
                          "newestOnTop": false,
                          "progressBar": false,
                          "positionClass":  "toast-bottom-right",
                          "preventDuplicates": false,
                          "onclick": null,
                          "showDuration": "300",
                          "hideDuration": "1000",
                          "timeOut": "8000",
                          "extendedTimeOut": "1000",
                          "showEasing": "swing",
                          "hideEasing": "linear",
                          "showMethod": "fadeIn",
                          "hideMethod": "fadeOut"
                        }
	            }
	            if(uData.status == 'error'){


	            }
	          }

	        }).done(function(data){

	        	console.log(data);
				
				addFavoriteStarClass("span-"+sesId, "star-click-"+sesId, "info-"+sesId);


	        }); //end ajax
			

		}



		function addFavoriteStarClass(spanId, starId, infoId){
			
			if ($('#'+spanId).hasClass("fa-star")) {
						$('#'+starId).removeClass('active')
					setTimeout(function() {
						$('#'+starId).removeClass('active-2')
					}, 30)
						$('#'+starId).removeClass('active-3')
					setTimeout(function() {
						$('#'+spanId).removeClass('fa-star')
						$('#'+spanId).addClass('fa-star-o')
					}, 15)
				} else {
					$('#'+starId).addClass('active')
					$('#'+starId).addClass('active-2')
					setTimeout(function() {
						$('#'+spanId).addClass('fa-star')
						$('#'+spanId).removeClass('fa-star-o')
					}, 150)
					setTimeout(function() {
						$('#'+starId).addClass('active-3')
					}, 150)
					$('#'+infoId).addClass('info-tog')
					setTimeout(function(){
						$('#'+infoId).removeClass('info-tog')
					},1000)
				}

		}
	</script>

	<script type="text/javascript">
	jQuery(document).ready(function($) {	
		$(".mfp-close").css("color", "#ffffff");
	});
	</script>

@endsection