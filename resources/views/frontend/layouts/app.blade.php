<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>

	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="SemiColonWeb" />
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<!-- Stylesheets
	============================================= -->
	<link href="https://fonts.googleapis.com/css?family=Lora:400,400i|Roboto:300,400,500,700|Rubik:400,600" rel="stylesheet">
	<link href="{{ asset('cnvs/css/bootstrap.css') }}" rel="stylesheet">
	<link href="{{ asset('cnvs/css/style.css') }}" rel="stylesheet">
	<link href="{{ asset('cnvs/css/dark.css') }}" rel="stylesheet">

	<!-- Real Estate Demo Specific Stylesheet -->
	<link href="{{ asset('cnvs/demos/real-estate/real-estate.css') }}" rel="stylesheet">
	<link href="{{ asset('cnvs/demos/real-estate/css/font-icons.css') }}" rel="stylesheet">

	<link rel="stylesheet" href="{{ asset('metronic/css/font-awesome/font-awesome.min.css')}}" type="text/css" />
	 <link rel="stylesheet" href="{{ asset('metronic/css/simple-line-icons/simple-line-icons.min.css')}}" type="text/css" />
	<!-- / -->

	<link href="{{ asset('cnvs/css/font-icons.css') }}" rel="stylesheet">
	<link href="{{ asset('cnvs/css/animate.css') }}" rel="stylesheet">
	<link href="{{ asset('cnvs/css/magnific-popup.css') }}" rel="stylesheet">

	<link href="{{ asset('cnvs/demos/real-estate/fonts.css') }}" rel="stylesheet">

	<!-- Bootstrap Select CSS -->
	<link href="{{ asset('cnvs/css/components/bs-select.css') }}" rel="stylesheet">

	<!-- Bootstrap Switch CSS -->
	<link href="{{ asset('cnvs/css/components/bs-switches.css') }}" rel="stylesheet">

	<!-- Range Slider CSS -->
	<link href="{{ asset('cnvs/css/components/ion.rangeslider.css') }}" rel="stylesheet">

	<link href="{{ asset('cnvs/css/responsive.css') }}" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<!--[if lt IE 9]>
		<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
	<![endif]-->



	<link href="{{ asset('cnvs/css/colors.php?color=2C3E50') }}" rel="stylesheet">

	
 	<link rel="shortcut icon" href="{{url('images/icons/nwapp_logo_only.png')}}">


	@yield('css')
	<!-- Custom Style -->
	<link href="{{ asset('cnvs/css/my-style.css') }}" rel="stylesheet">
	@yield('meta')
	<!-- Document Title
	============================================= -->
	@if(isset($eventTitle))
	<title>{{$eventTitle}} | NetworkingApp</title>
	@else
		<title> NetworkingApp</title>
	@endif

</head>

<body class="stretched device-xl">

	<div id="side-panel">

		<div id="side-panel-trigger-close" class="side-panel-trigger"><a href="#"><i class="icon-line-cross"></i></a></div>

		<div class="side-panel-wrap">

			<div class="widget clearfix">

				<h4 class="t400">Login with Social Profiles</h4>

				<a href="#" class="button button-rounded t400 btn-block center si-colored noleftmargin si-facebook">Facebook</a>
				<a href="#" class="button button-rounded t400 btn-block center si-colored noleftmargin si-gplus">Google</a>

				<div class="line"></div>

				<h4 class="t400">Existing Account?</h4>

				<form id="login-form" name="login-form" class="nobottommargin" action="#" method="post">

					<div class="col_full">
						<label for="login-form-username" class="t400">Username:</label>
						<input type="text" id="login-form-username" name="login-form-username" value="" class="form-control" />
					</div>

					<div class="col_full">
						<label for="login-form-password" class="t400">Password:</label>
						<input type="password" id="login-form-password" name="login-form-password" value="" class="form-control" />
					</div>

					<div class="col_full nobottommargin">
						<button class="button button-rounded t400 nomargin" id="login-form-submit" name="login-form-submit" value="login">Login</button>
						<a href="#" class="fright">Forgot Password?</a>
					</div>

				</form>


			</div>

		</div>

	</div>

	<!-- Document Wrapper
	============================================= -->
	<div id="wrapper" class="clearfix">

		<!-- Top Bar
		============================================= -->
		<div id="top-bar" class="transparent-topbar top-bar-blue">

			<div class="container clearfix" >

				<div class="col_half nobottommargin">

					<!-- Top Links
					============================================= -->
					@if(isset($eventTypes))
					<!--<div class="top-links">
						<ul>
							<li><a href="#">Categorías <!--<i class="fa fa-angle-down"></i>--><!--</a>
								<ul class="top-sub-menu">
									@foreach($eventTypes as $type)
										<li><a href="{{url('/eventos/categorias')}}/{{mb_strtolower($type->eventTypeName,'UTF-8')}}">{{$type->eventTypeName}}</a></li>
									@endforeach
								</ul>
							</li>
						</ul>
					</div>--><!-- .top-links end -->
					@endif
				</div>

				<div class="col_half fright col_last clearfix nobottommargin">

					<!-- Top Links
					============================================= -->
					<div class="top-links">
						<ul>
							<!--<li class="d-md-none d-lg-block"><a href="#"><i class="icon-call"></i> +1800-123-7890</a></li>-->
							<!--<li><a href="#"><i class="icon-download-alt"></i> Descargar App</a></li> -->
							<li id="get-apps"><a href="#apps"><i class="fa fa-download"></i> Descargar App</a>
							</li>

							<!--<div class="top-link-section" style="font-size: 14px; text-align: center;">
									<a href="https://play.google.com/store/apps/details?id=net.Networkingapp" style="width: 120px; height: 36px; float: left; margin: 0 auto; background: url('{{ url('images/icons/playStore.png')}}') center center no-repeat; background-size: cover; "></a>

									<a href="https://itunes.apple.com/gt/app/networkingapp-net/id1207597316?mt=8" style="width: 120px; height: 36px; float: left; background: url('{{ url('images/icons/appStore.png')}}') center center no-repeat; background-size: cover; "></a>

								</div> -->
							@if (Auth::guest())
								<li><a href="{{url('visitantes/registro')}}">Registrarse</a></li>
								<li><a href="{{url('login')}}?from=public">Iniciar Sesión</a></li>
							@else
								<li><a href="#"><i class="icon-user"></i> {{Auth::user()->userFirstName}} <!--<i class="fa fa-angle-down"></i>--></a>
									<ul class="top-sub-menu right">
										<li><a href="{{ url('/admin/home') }}"><i class="glyphicon glyphicon-share-alt"></i>
		                                Mi Cuenta
		                                </a></li>
										<li><a href="{{ url('/perfil') }}"><i class="icon-user"></i>
		                                Mi Perfil
		                                </a></li>
										<li><a href="{{ route('logout') }}"
		                                onclick="event.preventDefault();
		                                         document.getElementById('logout-form').submit();"><i class="icon-key"></i>
		                                Cerrar Sesión
		                                </a></li>
									</ul>
								</li>


	                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
	                                    {{ csrf_field() }}
	                                </form>
							@endif
						</ul>
					</div><!-- .top-links end class="side-panel-trigger" -->

				</div>

			</div>

		</div><!-- #top-bar end -->

		<!-- Header
		============================================= transparent-header #004573 -->
		<header id="header" class="static-sticky" data-responsive-class="not-dark">

	    <!--<header id="header" class="static-sticky  dark transparent-header" data-responsive-class="not-dark"> -->

			<div id="header-wrap">

				<div class="container clearfix">

					<div id="primary-menu-trigger"><i class="icon-reorder"></i></div>

					<!-- Logo
					============================================= -->
					<div id="logo">
						<a href="{{url('/')}}" class="standard-logo" data-dark-logo="{{url('images/logos/nwapp_logo_text.svg')}}"><img src="{{url('images/logos/nwapp_logo_text.svg')}}" alt="NWApp Logo"></a>
						<!--<a href="{{url('/')}}" class="retina-logo" data-dark-logo="{{url('images/logos/nwapp_logo_text.svg')}}"><img src="{{url('images/logos/nwapp_logo_text.svg')}}" alt="NWApp Logo"></a>-->
					</div><!-- #logo end -->

					<!-- Primary Navigation
					============================================= -->
					<nav id="primary-menu" class="with-arrows">

					<!--<nav id="primary-menu" class="with-arrows"> -->

						<ul>
							<li class="current"><a href="{{url('')}}" class="link link--surinami"><div data-letters-l="Ini" data-letters-r="cio"><!--<i class="icon-home2"></i>-->Inicio</div></a></li>
							<!--<li><a href="{{url('eventos/calendario')}}" class="link link--surinami"><div data-letters-l="Calen" data-letters-r="dario"><i class="icon-calendar"></i>Calendario</div></a></li>-->
							<li><a href="#" class="link link--surinami"><div data-letters-l="Even" data-letters-r="tos">Eventos</div></a>
								<ul>
									<li><a href="{{url('visitantes/mis-eventos')}}"><div>Todos los eventos</div></a></li>



									@if (Auth::check())
	                                    <form id="create-event" action="{{ route('create-event') }}" method="GET" style="display: none;">
	                                          {{ csrf_field() }}
	                                          <input type="hidden" name="eventRegister" value="1">
	                                    </form>
	                                   	<li><a href="{{url('administracion/eventos')}}"><div>Mis Eventos</div></a></li>
                                    @else
                                    	<form id="create-event" action="{{ route('login') }}" method="GET" style="display: none;">
                                          {{ csrf_field() }}
                                          <input type="hidden" name="eventRegister" value="1">
                                    	</form>
                                    @endif

                                    <li><a href="javascript:;" onclick="event.preventDefault(); document.getElementById('create-event').submit();"><div>Crear Evento</div></a></li>

								<!--	<li><a href="{{url('eventos/calendario')}}"><div data-letters-l="Calen" data-letters-r="dario"><i class="icon-calendar"></i>Calendario</div></a></li> -->

								</ul>
							</li>
							@if(isset($eventTypes))
								<li><a href="#" class="link link--surinami"><div data-letters-l="Categ" data-letters-r="orías">Categorías</div></a>
									<ul>
										@foreach($eventTypes as $type)
											<li><a href="{{url('/eventos/categorias')}}/{{mb_strtolower($type->eventTypeName,'UTF-8')}}">{{$type->eventTypeName}}</a></li>
										@endforeach
									</ul>
								</li>
							@endif
							<!--<li><a href="demos/real-estate/services.html"><div>Services</div></a></li>
							<li><a href="demos/real-estate/listing.html"><div>Listing</div></a></li>
							<li><a href="demos/real-estate/contact.html"><div>Contact</div></a></li>-->
						</ul>

					</nav><!-- #primary-menu end -->

				</div>

			</div>

		</header><!-- #header end -->

		@yield('slider')

		<!-- Slider
		============================================= -->
	<!-- #slider end -->
		<section id="page-title" class="page-title-mini" data-animate="fadeIn">

			<div class="container clearfix">

				<!--<span>Our Latest News</span>-->
				<h1><i class="fa fa-calendar"></i> {{$pageTitle}}</h1>
				<!--<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{url('')}}">Inicio</a><i class="icon-angle-right"></i></li>
					<li class="breadcrumb-item active" aria-current="page">Eventos</li>
				</ol>-->

			</div>

		</section>

		<!-- Page Sub Menu
		============================================= -->
		@if(Auth::check())
		<div id="page-menu">

			<div id="page-menu-wrap" style="background-color: #7d8586;">

				<div class="container clearfix">

					<div class="menu-title">Visitante</div>

					<nav>
						<ul>
							<li class="current"><a href="#"><div><i class="icon-user"></i> Eventos</div></a>
								<ul style="background-color: #ff9045;min-width: 200px;">
									<li><a href="{{url('administracion/eventos')}}"><div>Mis Eventos</div></a></li>
									<li><a href="#"><div>Actividades Favoritas</div></a></li>
								</ul>
							</li>
							@if(isset($register) && $register==1)
								<li><a href="#" onclick="event.preventDefault();
                                                     document.getElementById('my-badge-form').submit();"><div>Mi Gafete</div></a></li>

								 <form id="my-badge-form" action="{{ url('admininstracion/mi-gafete') }}" method="POST" style="display: none;">
	                                  {{ csrf_field() }}
	                                  <input type="hidden" id="allUsersBadge" name="allUsersBadge" value="0">
	                                  <input type="hidden" name="eventId" value="{{$eventId}}">
	                                  <input type="hidden" name="userType" id="userType" value="visitor">
                            	</form>
							@endif
							<!--<li><a href="#"><div>Reviews</div></a>
								<ul>
									<li><a href="#"><div>Expert Reviews</div></a></li>
									<li><a href="#"><div>User Reviews</div></a></li>
								</ul>
							</li> -->

						</ul>
					</nav>

					<div id="page-submenu-trigger"><i class="icon-reorder"></i></div>

				</div>

			</div>

		</div><!-- #page-menu end -->

		@endif

		<!-- Content
		============================================= -->
		<section id="content" class="bg-light bg-custom">

			<div class="content-wrap">

				@yield('content')

			</div> <!-- #content wrap end -->


			<!--<div class="section footer-stick" id="apps" style="text-align: center; padding-bottom: 80px;">

					<h4 class="uppercase center">Descarga la aplicación de NetWorkingApp</h4>

					<a href="https://itunes.apple.com/gt/app/networkingapp-net/id1207597316?mt=8" target="_blank"><img class="store-app-link" width="150" src="{{url('images/logos/app-store.png')}}"></a>
					<a href="https://play.google.com/store/apps/details?id=net.Networkingapp" target="_blank"><img class="store-app-link" width="200" src="{{url('images/logos/play-store.png')}}"></a>

			</div> -->



		</section><!-- #content end -->

		<!-- Footer
		============================================= -->
		<footer id="footer" class="dark">

			<div class="container">
			<!-- Footer Widgets
				============================================= -->
				<div class="footer-widgets-wrap clearfix">

					<div class="col_one_third">



							<div class="widget clearfix">
								<a href="https://www.grupoalitec.com/" target="_blank">
									<img src="{{url('images/logos/alitec_logo.svg')}}" alt="" class="footer-logo">
								</a>
								<p><strong>ALITEC</strong>, un ERP eficaz y poderoso que se adapta a la pequeña y mediana empresa, ubica toda la información clave de su empresa en orden y en un mismo lugar para el control y crecimiento de su negocio.  Es de seguro acceso con actualizaciones en tiempo real.</p>

								<p><a href="{{url('politica-de-privacidad')}}" class="link_underline">Políticas de Privacidad</a></p>
								<!--<p>© Next Level Strategy 2018 All rights reserved</p>-->
								<!--<div style="/*background: url('{{url('images/logos/alitec_logo.svg')}}') no-repeat center center; background-size: 100%;*/">
									<address>
										<strong>Headquarters:</strong><br>
										795 Folsom Ave, Suite 600<br>
										San Francisco, CA 94107<br>
									</address>
									<abbr title="Phone Number"><strong>Phone:</strong></abbr> (91) 8547 632521<br>
									<abbr title="Fax"><strong>Fax:</strong></abbr> (91) 11 4752 1433<br>
									<abbr title="Email Address"><strong>Email:</strong></abbr> info@canvas.com
								</div>-->



						</div>

						<!--<div class="col_one_third">

							<div class="widget widget_links clearfix">

								<h4>Blogroll</h4>

								<ul>
									<li><a href="http://codex.wordpress.org/">Documentation</a></li>
									<li><a href="http://wordpress.org/support/forum/requests-and-feedback">Feedback</a></li>
									<li><a href="http://wordpress.org/extend/plugins/">Plugins</a></li>
									<li><a href="http://wordpress.org/support/">Support Forums</a></li>
									<li><a href="http://wordpress.org/extend/themes/">Themes</a></li>
									<li><a href="http://wordpress.org/news/">WordPress Blog</a></li>
									<li><a href="http://planet.wordpress.org/">WordPress Planet</a></li>
								</ul>

							</div>

						</div> -->
					</div>

					<div class="col_one_third col_contact">

							<div class="widget clearfix" style="display: block;">
								<h4 style="text-transform: capitalize;">Contacto</h4>

								<div class="fleft clearfix" style="width: 100%;">
									<a href="https://www.facebook.com/Networkingappgt/?epa=SEARCH_BOX" target="_blank" class="social-icon social-icon-footer si-small si-borderless nobottommargin si-facebook">
										<i class="icon-facebook"></i>
										<i class="icon-facebook"></i>
									</a>

									<a href="#" class="social-icon  social-icon-footer si-small si-borderless nobottommargin si-twitter">
										<i class="icon-twitter"></i>
										<i class="icon-twitter"></i>
									</a>

									<a href="#" class="social-icon  social-icon-footer si-small si-borderless nobottommargin si-gplus">
										<i class="icon-gplus"></i>
										<i class="icon-gplus"></i>
									</a>

									<a href="#" class="social-icon  social-icon-footer si-small si-borderless nobottommargin si-linkedin">
										<i class="icon-linkedin"></i>
										<i class="icon-linkedin"></i>
									</a>
								</div>
								<div class="col-md-12" style="top: 20px;  padding-left: 0;">
									<address>
										<span>Dirección:</span><br>
										17 Avenida 8-80, zona 14<br>
									</address>
									<abbr title="Phone Number"><span style="font-weight: normal !important">Teléfono:</span></abbr> +(502) 2269 2574<br>

									<abbr title="Email Address"><span>Email:</span></abbr> info@networkingapp.net
								</div>

							</div>
							<div class="col-md-12 mt-4 pl-0 pt-4">
								<a href="#" class="link_underline">FAQ's</a>
							</div>

					</div>



					<div class="col_one_third col_last">

						<div id="getAppLinks" class="widget clearfix" style="margin-bottom: -20px;">
							<h4>Descarga NetworkingApp </h4>
							<div class="row">

								<div class="col-lg-6 clearfix mt-2">
									<a href="https://itunes.apple.com/gt/app/networkingapp-net/id1207597316?mt=8" target="_blank"><img class="store-app-link" width="200" src="{{url('images/logos/app-store.png')}}"></a>

								</div>
								<div class="col-lg-6 clearfix mt-2">
									<a href="https://play.google.com/store/apps/details?id=net.Networkingapp" target="_blank"><img class="store-app-link" width="200"  src="{{url('images/logos/play-store.png')}}"></a>
								</div>

							</div>

						</div>

					</div>

				</div><!-- .footer-widgets-wrap end -->

			</div>

			<!-- Copyrights
			============================================= -->
			<div id="copyrights">

				<div class="container clearfix">

					<div class="col_md-12 center">

						© Next Level Strategy 2018 All rights reserved
					</div>


				</div>

			</div><!-- #copyrights end -->

		</footer><!-- #footer end -->

	</div><!-- #wrapper end -->

	<!-- Go To Top
	============================================= -->
	<div id="gotoTop" class="fa fa-angle-up"></div>

	<!-- External JavaScripts
	============================================= -->
	<script src="{{ asset('cnvs/js/jquery.js') }}"></script>
	<script src="{{ asset('cnvs/js/plugins.js') }}"></script>

	<!-- Google Map JavaScripts
	============================================= -->
	<script src="https://maps.google.com/maps/api/js?key=AIzaSyAO2BYvn4xyrdisvP8feA4AS_PGZFxJDp4"></script>
	<script src="{{ asset('cnvs/js/jquery.gmap.js') }}"></script>

	<!-- Bootstrap Select Plugin -->
	<script src="{{ asset('cnvs/js/components/bs-select.js') }}"></script>

	<!-- Bootstrap Switch Plugin -->
	<script src="{{ asset('cnvs/js/components/bs-switches.js') }}"></script>

	<!-- Range Slider Plugin -->
	<script src="{{ asset('cnvs/js/components/rangeslider.min.js') }}"></script>

	<!-- Footer Scripts
	============================================= -->
	<script src="{{ asset('cnvs/js/functions.js') }}"></script>
	<script type="text/javascript">
		$.ajaxSetup({
		  headers: {
		    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		  }
		});
	</script>

	<!-- get apps scroll -->
	<script>

		$("#get-apps").click(function() {
		    $('html, body').animate({
		        scrollTop: $("#getAppLinks").offset().top
		    }, 1500);
		});

	</script>


	<!-- Ajax load content -->
         <script type="text/javascript" src="{{ URL::asset('js/jquery.pjax.js') }}"></script>






	@yield('scripts')
</body>
</html>
