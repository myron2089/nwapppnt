@extends('frontend.layouts.app')




@section('css')
	<link href="{{ asset('cnvs/css/vmap.css') }}" rel="stylesheet">
@endsection





@section('content')
<div class="container clearfix">
	<div class="row" style="margin-top: -5px;">
		<div class="col-md-12  field-content" style="margin-top:-50px; padding: 20px;  background: #fff;">
			<div class="col-md-12 " style="background: transparent; padding: 0">
				<div class="col_half nobottommargin">
					<div class="error404 center">{{$errorCode}}</div>
				</div>

				<div class="col_half nobottommargin col_last">
					<div class="heading-block nobottomborder" style="margin-top: 50px;">
						<h4>{{$message}}</h4>
						<span>Puedes navegar hacia las siguientes páginas.</span>
					</div>

					<div class="col-md-12 widget_links topmargin nobottommargin" style="top: 20px;">
							<ul>
								<li><a href="{{ URL::previous() }}">Regresar a la página anterior</a></li>
								<li><a href="{{url('/')}}">Inicio</a></li>
								<li><a href="{{url('')}}">Sobre Nosotros</a></li>
								@if(Auth::check())<li><a href="{{url('visitantes/mis-eventos')}}">Mis eventos</a></li>@endif
							</ul>
						</div>




				</div>


				

			</div> <!-- end col-md-12 -->
		</div> <!-- end field content -->
	</div> <!-- end row -->
	 <div class="col-md-12" style="margin-top: 50px;">

		@include('frontend.layouts.sidebar')

	</div> <!-- #end sidebar rh -->
</div> <!-- end container clearfix -->

@endsection




@section('scripts')


@endsection