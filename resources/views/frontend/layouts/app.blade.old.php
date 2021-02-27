<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>

	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="SemiColonWeb" />

	<!-- Stylesheets
	============================================= -->
	<link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
	<link href="{{ asset('cnvs/css/bootstrap.css') }}" rel="stylesheet">
	<link href="{{ asset('cnvs/css/style.css') }}" rel="stylesheet">
	<link href="{{ asset('cnvs/css/swiper.css') }}" rel="stylesheet">
	<link href="{{ asset('cnvs/css/dark.css') }}" rel="stylesheet">
	<link href="{{ asset('cnvs/css/font-icons.css') }}" rel="stylesheet">
	<link href="{{ asset('cnvs/css/animate.css') }}" rel="stylesheet">
	<link href="{{ asset('cnvs/css/magnific-popup.css') }}" rel="stylesheet">

	<link href="{{ asset('cnvs/css/responsive.css') }}" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<link href="{{ asset('cnvs/css/custom-style.css') }}" rel="stylesheet">
	<link href="{{ asset('css/cards.css') }}" rel="stylesheet">


	<link rel="stylesheet" type="text/css" href="{{ asset('css/jssocials.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/jssocials-theme-flat.css') }}" />

  <!-- Demo styles -->
  <style>
     .swiper-container {
      width: 100%;
      height: 100%;
    }
    .swiper-slide {
      text-align: center;
      font-size: 18px;
      background: #fff;
      /* Center slide text vertically */
      display: -webkit-box;
      display: -ms-flexbox;
      display: -webkit-flex;
      display: flex;
      -webkit-box-pack: center;
      -ms-flex-pack: center;
      -webkit-justify-content: center;
      justify-content: center;
      -webkit-box-align: center;
      -ms-flex-align: center;
      -webkit-align-items: center;
      align-items: center;
    }
  </style>

  @yield('css')
	<!-- Document Title
	============================================= -->

	@if(isset($eventTitle))
	<title>{{$eventTitle}} | NetWorkingApp</title>
	@else
		<title> NetWorkingApp</title>
	@endif
</head>

<body class="stretched">

	<!-- Document Wrapper
	============================================= -->
	<div id="wrapper" class="clearfix">

		<!-- Header
		============================================= -->
		<div id="header-background">
		<header id="header" class="full-header">

			<div id="header-wrap">

				<div class="container clearfix">

					<div id="primary-menu-trigger"><i class="icon-reorder"></i></div>

					<!-- Logo
					============================================= -->
					<div id="logo">
						<a href="{{url('/')}}" class="standard-logo" data-dark-logo="images/logo-dark.png"><img src="{{url('images/icons/nw-icon.svg')}}" alt="nwapp Logo"></a>
						<a href="{{url('/')}}" class="retina-logo" data-dark-logo="images/logo-dark@2x.png"><img src="{{url('images/icons/nw-icon.svg')}}" alt="nwapp Logo"></a>
					</div><!-- #logo end -->
					<div id="top-account" class="dropdown">
						<a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icon-user"></i><i class="icon-angle-down"></i></a>
						<ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
							<li><a href="{{url('/visitantes/miperfil')}}">Mi resumen</a></li>
							<li><a href="{{url('/visitantes/miperfil')}}">Mi Pefil</a></li>
							<li><a href="#">Mis Eventos <span class="badge">5</span></a></li>
							<!-- <li><a href="#"></a></li> -->
							<li role="separator" class="divider"></li>
							<li><a href="{{route('logout')}}">Salir <i class="icon-signout"></i></a></li>
						</ul>
					</div>

					<!-- Primary Navigation
					============================================= -->
					<nav id="primary-menu" class="style-5">

						<ul>
							<li><a href="{{url('/')}}"><div><i class="icon-home2"></i>Inicio</div></a>
							
							</li>
							<li class="current"><a href="#"><div><i class="icon-calendar"></i>Eventos</div></a>
							</li>
							<li class="mega-menu"><a href="#"><div><i class="icon-file-alt"></i>Nosotros</div></a>
								
							</li>
							<li class="mega-menu"><a href="{{url('login')}}"><div><i class="icon-user"></i>Cuenta</div></a>
								<div class="mega-menu-content style-2">
										<ul class="mega-menu-column col-md-12 nomargin nopadding" style="">
										<li class="mega-menu-title sub-menu col-md-6"><a href="#" class="sf-with-ul"><div>Introduction</div></a></li>
										<li class="mega-menu-title sub-menu col-md-6"><a href="#" class="sf-with-ul"><div>Introduction</div></a></li>
									</ul>
								</div>
								
							</li>
							<li class="mega-menu"><a href="#"><div><i class="icon-book"></i>Contacto</div></a>
							</li>
						</ul>

						<!-- Top Cart
						============================================= 
						<div id="top-cart">
							<a href="#" id="top-cart-trigger"><i class="icon-shopping-cart"></i><span>5</span></a>
							<div class="top-cart-content">
								<div class="top-cart-title">
									<h4>Shopping Cart</h4>
								</div>
								<div class="top-cart-items">
									<div class="top-cart-item clearfix">
										<div class="top-cart-item-image">
											<a href="#"><img src="images/shop/small/1.jpg" alt="Blue Round-Neck Tshirt" /></a>
										</div>
										<div class="top-cart-item-desc">
											<a href="#">Blue Round-Neck Tshirt</a>
											<span class="top-cart-item-price">$19.99</span>
											<span class="top-cart-item-quantity">x 2</span>
										</div>
									</div>
									<div class="top-cart-item clearfix">
										<div class="top-cart-item-image">
											<a href="#"><img src="images/shop/small/6.jpg" alt="Light Blue Denim Dress" /></a>
										</div>
										<div class="top-cart-item-desc">
											<a href="#">Light Blue Denim Dress</a>
											<span class="top-cart-item-price">$24.99</span>
											<span class="top-cart-item-quantity">x 3</span>
										</div>
									</div>
								</div>
								<div class="top-cart-action clearfix">
									<span class="fleft top-checkout-price">$114.95</span>
									<button class="button button-3d button-small nomargin fright">View Cart</button>
								</div>
							</div>
						</div> #top-cart end -->

						<!-- Top Search
						============================================= -->
						<div id="top-search">
							<a href="#" id="top-search-trigger"><i class="icon-search3"></i><i class="icon-line-cross"></i></a>
							<form action="search.html" method="get">
								<input type="text" name="q" class="form-control" value="" placeholder="Buscar...">
							</form>
						</div><!-- #top-search end -->

					</nav><!-- #primary-menu end -->
					
				</div>
				
			</div>

		</header><!-- #header end -->
		<div id="page-menu" class="">

			<div id="page-menu-wrap">

				<div class="container clearfix">

					<!--<div class="menu-title">Contact <span>Options</span></div>-->

					<nav>
						<ul>
							<li class="current"><a href="#"><div>Empresariales</div></a></li>
							<li><a href="#"><div>Culturales</div></a></li>
							<li><a href="#"><div>Deportivos</div></a></li>
							<li><a href="#"><div>Conciertos</div></a></li>
							<li><a href="#"><div>Talleres  &amp; Conferencias</div></a></li>
							<li><a href="#"><div>Tecnología</div></a></li>
							<li><a href="#"><div>Sociales</div></a></li>
							<li><a href="{{ route('logout') }}"><div>Turismo</div></a></li>
						</ul>
					</nav>

					<div id="page-submenu-trigger"><i class="icon-reorder"></i></div>

				</div>

			</div>

		</div>
		</div>
		

		@yield('slider')
		
		@yield('title')

		<!-- Content
		============================================= -->
		<section id="content">

			<div class="content-wrap">

				

					@yield('content')


			</div>

		</section><!-- #content end -->

		<!-- Footer
		============================================= -->
		<footer id="footer" class="dark">

		<!--	<div class="container">

				<!-- Footer Widgets
				============================================= -->
			<!--	<div class="footer-widgets-wrap clearfix">

					<div class="col_two_third">

						<div class="col_one_third">

							<div class="widget clearfix">

								<img src="images/footer-widget-logo.png" alt="" class="footer-logo">

								<p>We believe in <strong>Simple</strong>, <strong>Creative</strong> &amp; <strong>Flexible</strong> Design Standards.</p>

								<div style="background: url('images/world-map.png') no-repeat center center; background-size: 100%;">
									<address>
										<strong>Headquarters:</strong><br>
										795 Folsom Ave, Suite 600<br>
										San Francisco, CA 94107<br>
									</address>
									<abbr title="Phone Number"><strong>Phone:</strong></abbr> (91) 8547 632521<br>
									<abbr title="Fax"><strong>Fax:</strong></abbr> (91) 11 4752 1433<br>
									<abbr title="Email Address"><strong>Email:</strong></abbr> info@canvas.com
								</div>

							</div>

						</div>

						<div class="col_one_third">

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

						</div>

						<div class="col_one_third col_last">

							<div class="widget clearfix">
								<h4>Recent Posts</h4>

								<div id="post-list-footer">
									<div class="spost clearfix">
										<div class="entry-c">
											<div class="entry-title">
												<h4><a href="#">Lorem ipsum dolor sit amet, consectetur</a></h4>
											</div>
											<ul class="entry-meta">
												<li>10th July 2014</li>
											</ul>
										</div>
									</div>

									<div class="spost clearfix">
										<div class="entry-c">
											<div class="entry-title">
												<h4><a href="#">Elit Assumenda vel amet dolorum quasi</a></h4>
											</div>
											<ul class="entry-meta">
												<li>10th July 2014</li>
											</ul>
										</div>
									</div>

									<div class="spost clearfix">
										<div class="entry-c">
											<div class="entry-title">
												<h4><a href="#">Debitis nihil placeat, illum est nisi</a></h4>
											</div>
											<ul class="entry-meta">
												<li>10th July 2014</li>
											</ul>
										</div>
									</div>
								</div>
							</div>

						</div>

					</div>

					<div class="col_one_third col_last">

						<div class="widget clearfix" style="margin-bottom: -20px;">

							<div class="row">

								<div class="col-md-6 bottommargin-sm">
									<div class="counter counter-small"><span data-from="50" data-to="15065421" data-refresh-interval="80" data-speed="3000" data-comma="true"></span></div>
									<h5 class="nobottommargin">Total Downloads</h5>
								</div>

								<div class="col-md-6 bottommargin-sm">
									<div class="counter counter-small"><span data-from="100" data-to="18465" data-refresh-interval="50" data-speed="2000" data-comma="true"></span></div>
									<h5 class="nobottommargin">Clients</h5>
								</div>

							</div>

						</div>

						<div class="widget subscribe-widget clearfix">
							<h5><strong>Subscribe</strong> to Our Newsletter to get Important News, Amazing Offers &amp; Inside Scoops:</h5>
							<div class="widget-subscribe-form-result"></div>
							<form id="widget-subscribe-form" action="include/subscribe.php" role="form" method="post" class="nobottommargin">
								<div class="input-group divcenter">
									<span class="input-group-addon"><i class="icon-email2"></i></span>
									<input type="email" id="widget-subscribe-form-email" name="widget-subscribe-form-email" class="form-control required email" placeholder="Enter your Email">
									<span class="input-group-btn">
										<button class="btn btn-success" type="submit">Subscribe</button>
									</span>
								</div>
							</form>
						</div>

						<div class="widget clearfix" style="margin-bottom: -20px;">

							<div class="row">

								<div class="col-md-6 clearfix bottommargin-sm">
									<a href="#" class="social-icon si-dark si-colored si-facebook nobottommargin" style="margin-right: 10px;">
										<i class="icon-facebook"></i>
										<i class="icon-facebook"></i>
									</a>
									<a href="#"><small style="display: block; margin-top: 3px;"><strong>Like us</strong><br>on Facebook</small></a>
								</div>
								<div class="col-md-6 clearfix">
									<a href="#" class="social-icon si-dark si-colored si-rss nobottommargin" style="margin-right: 10px;">
										<i class="icon-rss"></i>
										<i class="icon-rss"></i>
									</a>
									<a href="#"><small style="display: block; margin-top: 3px;"><strong>Subscribe</strong><br>to RSS Feeds</small></a>
								</div>

							</div>

						</div>

					</div>

				</div> --><!-- .footer-widgets-wrap end -->

			<!--</div> -->

			<!-- Copyrights
			============================================= -->
			
			<div id="copyrights">

				<div class="container clearfix">

					<div class="col_half">
						Copyrights &copy; 2017 Todos los derechos reservados por NetWorkingApp.<br>
						<div class="copyright-links"><a href="#">Términos de Uso</a> <!--/ <a href="#">Privacy Policy</a>--></div>
					</div>

					<div class="col_half col_last tright">
						<div class="fright clearfix">
							<a href="#" class="social-icon si-small si-borderless si-facebook">
								<i class="icon-facebook"></i>
								<i class="icon-facebook"></i>
							</a>

							<a href="#" class="social-icon si-small si-borderless si-twitter">
								<i class="icon-twitter"></i>
								<i class="icon-twitter"></i>
							</a>

							<a href="#" class="social-icon si-small si-borderless si-gplus">
								<i class="icon-gplus"></i>
								<i class="icon-gplus"></i>
							</a>

							<!--<a href="#" class="social-icon si-small si-borderless si-pinterest">
								<i class="icon-pinterest"></i>
								<i class="icon-pinterest"></i>
							</a>

							<a href="#" class="social-icon si-small si-borderless si-vimeo">
								<i class="icon-vimeo"></i>
								<i class="icon-vimeo"></i>
							</a>

							<a href="#" class="social-icon si-small si-borderless si-github">
								<i class="icon-github"></i>
								<i class="icon-github"></i>
							</a>

							<a href="#" class="social-icon si-small si-borderless si-yahoo">
								<i class="icon-yahoo"></i>
								<i class="icon-yahoo"></i>
							</a>

							<a href="#" class="social-icon si-small si-borderless si-linkedin">
								<i class="icon-linkedin"></i>
								<i class="icon-linkedin"></i>
							</a> -->
						</div>

						<div class="clear"></div>

						<i class="icon-envelope2"></i> Actualizando... <span class="middot">&middot;</span> <i class="icon-headphones"></i> Actualizando... <span class="middot">&middot;</span> <!--<i class="icon-skype2"></i> CanvasOnSkype -->
					</div>

				</div>

			</div><!-- #copyrights end -->

		</footer><!-- #footer end -->

	</div><!-- #wrapper end -->

	<!-- Go To Top
	============================================= -->
	<div id="gotoTop" class="icon-angle-up"></div>

	<!-- External JavaScripts
	============================================= -->
	<script src="{{ asset('cnvs/js/jquery.js') }}"></script>
	<script src="{{ asset('cnvs/js/plugins.js') }}"></script>

	<script src="{{ asset('cnvs/js/functions.js') }}"></script>

	<!-- Footer Scripts
	============================================= -->
	<script src="{{ asset('cnvs/js/swiper.js') }}"></script>

	<script src="{{ asset('js/jssocials.js') }}"></script>


    @yield('scripts')
</body>
</html>