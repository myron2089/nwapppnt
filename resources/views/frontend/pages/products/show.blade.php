@extends('frontend.layouts.app')




@section('css')
	<link href="{{ asset('cnvs/css/vmap.css') }}" rel="stylesheet">
@endsection





@section('content')

	

	<div class="container clearfix" style="background: #fff; padding-right: 0; padding-left: 0; margin-top:-50px;">
	@foreach($productData as $product)
		@section('meta')
			<meta property="og:url" content="{{url('')}}/{{$evUrlExtended}}">
			<meta property="og:type" content="article" />
	        <meta property="og:site_name" content="{{$product->productName}}">
	        <meta property="og:image" content="{{url('images/events/webpage/products/')}}/{{$product->productPicture}}">
	        <meta property="og:image:secure_url" content="{{url('images/events/webpage/products/')}}/{{$product->productPicture}}">

	        <meta property="og:image:type" content="image/jpg">
	        <meta property="og:image:width" content="1291">
	        <meta property="og:image:height" content="315">
	        <meta property="og:description" content="{{$product->productDescription}}" />
		@endsection
		

		<div class="single-product">

			<div class="product">

				<div class="col_two_fifth">

					<!-- Product Single - Gallery
					============================================= -->
					<div class="product-image">
						<div class="fslider" data-pagi="false" data-arrows="false" data-thumbs="true">
							<div class="flexslider">
								<div class="slider-wrap" data-lightbox="gallery">
									<?php 
										if(file_exists(url('images/events/webpage/products/')."/".$product->productPicture))
											$imgThumb =$product->productPicture;
										else
											$imgThumb = "noProductPicture.png";
									?>
									<div class="slide" data-thumb="{{url('images/events/webpage/products/')}}/{{$imgThumb}}"> <a href="{{url('images/events/webpage/products/')}}/{{$imgThumb}}"  title="{{$product->productName}}" data-lightbox="gallery-item"><img src="{{url('images/events/webpage/products/')}}/{{$product->productPicture}}"" onerror="this.src='{{url('images/events/webpage/products/')}}/noProductPicture.png'" alt="{{$product->productName}}"></a></div>
								</div>
							</div>
						</div>
						@if($saleExists)<div class="sale-flash">Oferta!</div>@endif
					</div><!-- Product Single - Gallery End -->

				</div>

				<div class="col_two_fifth product-desc col_last">


					<!--begin:: Product Name-->
					<!--<div class="product-name"> <h3>{{$product->productName}}</h3>
											   <small>{{$product->brandName}}</small> </div> -->

					<div class="entry-title">
						<h2><a href="#">{{$product->productName}}</a></h2> 
						@if($product->brandName != null)<h3><a><i class="fa fa-check-circle" style="color: #EE7F22; padding-right: 5px;"></i>{{$product->brandName}}</a></h3>@endif
					</div>						   

					<!-- Product Single - Price
					============================================= -->
					<div class="product-price"><!--<del>$39.99</del>--> <ins>{{$product->currencySymbol}} {{$product->productPrice}}</ins></div><!-- Product Single - Price End -->

					<!-- Product Single - Rating
					============================================= -->
					<!--<div class="product-rating">
						<i class="icon-star3"></i>
						<i class="icon-star3"></i>
						<i class="icon-star3"></i>
						<i class="icon-star-half-full"></i>
						<i class="icon-star-empty"></i>
					</div>--><!-- Product Single - Rating End -->

				    <div class="clear"></div>
					<div class="line"></div>

					<!-- Product Single - Quantity & Cart Button
					============================================= -->
					<!--<form class="cart nobottommargin clearfix" method="post" enctype='multipart/form-data'>
						<div class="quantity clearfix">
							<input type="button" value="-" class="minus">
							<input type="text" step="1" min="1"  name="quantity" value="1" title="Qty" class="qty" size="4" />
							<input type="button" value="+" class="plus">
						</div>
						<button type="submit" class="add-to-cart button nomargin">Add to cart</button>
					</form>--><!-- Product Single - Quantity & Cart Button End -->
					@if (Auth::check())
						<button type="submit" class="add-to-cart button nomargin">Agregar a favoritos</button>
						<div class="clear"></div>
						<div class="line"></div>
					@endif
					<!-- Product Single - Short Description
					============================================= -->
					<p>{{$product->productDescription}}</p>

					@if($saleExists)
						<div class="clear"></div>

						<div class="promo promo-dark promo-uppercase bottommargin">
							<h3>Oferta!</h3>
							<span>{{$sale}}</span>
							
						</div>
					@endif

					<!-- Product Single - Meta
					============================================= -->
					

					<!-- Product Single - Share
					============================================= -->
					<div class="si-share noborder clearfix">
						

						<div class="row">
			
								<button class="sharer fb" data-sharer="facebook" data-url="{{url('')}}/{{$evUrlExtended}}"><i class="fa fa-facebook"></i>
								        Compartir en Facebook
								</button>
							
								<button class="sharer tw" data-sharer="twitter" data-url="{{url('')}}/{{$evUrlExtended}}"><i class="fa fa-twitter"></i>
								        Compartir en Twitter
								</button>
							
								<button class="sharer gplus" data-sharer="googleplus" data-url="{{url('')}}/{{$evUrlExtended}}"><i class="fa fa-google-plus"></i>
								        Compartir en Google Plus
								</button>
							
						</div>

					</div><!-- Product Single - Share End -->

				</div>

				

				

			</div>

			

		</div> <!--end: single-product -->

		<div class="clear"></div><div class="line"></div>

			<div class="col_full nobottommargin">

				<h4>Otros productos de {{$eventName}}</h4>

				<div id="oc-product" class="owl-carousel product-carousel carousel-widget" data-margin="30" data-pagi="false" data-autoplay="5000" data-items-xs="1" data-items-md="2" data-items-lg="3" data-items-xl="4">
					@foreach($products as $product)
						<div class="oc-item">
							<div class="product iproduct clearfix">
								<div class="product-image">   
									<a href="{{url('eventos/')}}/{{$eventType}}/{{$eventUrl}}/productos/{{$product->productId}}"><img src="{{url('images/events/webpage/products/')}}/{{$product->productPicture}}" onerror="this.src='{{url('images/events/webpage/products/')}}/noProductPicture.png'" alt="{{$product->productName}}"></a>
									<a href="{{url('eventos/')}}/{{$eventType}}/{{$eventUrl}}/productos/{{$product->productId}}"><img src="{{url('images/events/webpage/products/')}}/{{$product->productPicture}}" onerror="this.src='{{url('images/events/webpage/products/')}}/noProductPicture.png'" alt="{{$product->productName}}"></a>
									<!--<div class="sale-flash">50% Off*</div>-->
									<div class="product-overlay">
										@if (Auth::check())<a href="#" class="add-to-cart"><i class="icon-star"></i><span> Agregar a favoritos</span></a>@endif
										<a href="{{url('eventos/')}}/{{$eventType}}/{{$eventUrl}}/productos/{{$product->productId}}" class="item-quick-view"><i class="icon-zoom-in2"></i><span> Ver</span></a>
									</div>
								</div>
								<div class="product-desc center">
									<div class="product-title"><h3><a href="#">{{$product->productName}}</a></h3></div>
									<div class="product-price" style="width: 100%;"><!--<del>$24.99</del>--> <ins>{{$product->currencySymbol}} {{$product->productPrice}}</ins></div>
									<!--<div class="product-rating">
										<i class="icon-star3"></i>
										<i class="icon-star3"></i>
										<i class="icon-star3"></i>
										<i class="icon-star3"></i>
										<i class="icon-star-half-full"></i>
									</div>-->
								</div>
							</div>
						</div>
					@endforeach
				</div>
			</div><!--end:: col_full -->
	@endforeach
	</div><!--end:: container clearfix -->
@endsection

@section('scripts')
<!-- sharer buttons-->
	<script src="{{ asset('js/sharer.min.js') }}"></script>
@endsection