@extends('frontend.layouts.app')
@section('css')
<link rel="stylesheet" href="{{ asset('metronic/css/select2/css/select2.min.css')}}" type="text/css" />
<link rel="stylesheet" href="{{ asset('metronic/css/select2/css/select2-bootstrap.min.css')}}" type="text/css" />
<link rel="stylesheet" href="{{ asset('css/cards.css')}}" type="text/css" />

@endsection

@section('title')
<section id="page-title">

			<div class="container clearfix">
				<h1>Generar Badge</h1>
				<!--<span>650+ Retina Icons with unlimited customizations</span> -->
				<ol class="breadcrumb">
					<li><a href="#">Inicio</a></li>
					<li ><a href="#">Mis Eventos</a></li>
					<li class="active"><a href="#">Escanear Codigo QR</a></li>
					
					
				</ol>
			</div>

		</section>
@endsection
@section('content')

<div class="container clearfix">
	<div class="row">
		<div class="orange-container" >
			<form id="form-scan-qr" method="POST">
				{{ csrf_field() }}
				<input id="eventId" name="eventId" type="hidden" value="{{$eventId}}" class="form-control" />
				<h2>Escanear Código QR</h2>
				<input type="text" id="qrCode" name="qrCode" class="form-control" autofocus>
		    </form>
	   	</div>


	 
 
	<div id="user-data" style="display: none;">
	   	<div class="table-responsive">
			<table class="table table-bordered table-striped">
			  <colgroup>
				<col class="col-xs-1">
				<col class="col-xs-7">
			  </colgroup>
			 
			  <tbody>
			  	<tr>
				  <td>
					<code>Email</code>
				  </td>
				  <td><label id="userEmail" style="text-transform: lowercase;"></label></td>
				</tr>
				<tr>
				  <td>
					<code>Nombre</code>
				  </td>
				  <td><label id="userFirstName"></label></td>
				</tr>
				<tr>
				  <td>
					<code>Apellidos</code>
				  </td>
				  <td><label id="userLastName"></label></td>
				</tr>
				<tr>
				  <td>
					<code>Dirección</code>
				  </td>
				  <td><label id="userAddress"></label></td>
				</tr>
				<tr>
				  <td>
					<code>Teléfono</code>
				  </td>
				  <td><label id="userPhone"></label></td>
				</tr>
				
			  </tbody>
			</table>
		</div>
	</div>

		
	</div>



	


</div>



@endsection
@section('scripts')
<script>
	jQuery(document).ready( function($) {  
		$('.card').fadeIn('slow');
	});

</script>


<script>
jQuery(document).ready( function($) {
	$( "#form-scan-qr" ).submit(function( event ) {
		event.preventDefault();

		var form = $(this);
		var data = new FormData($(this)[0]);
		var qrCode = data.get('qrCode');
		var evId = $('#eventId').val();

		if(qrCode.length > 0){
		$.ajax({
          type: "POST",
          url: "{{url('/admin/events/codescan/getScannedData/')}}/" + qrCode + "/" + evId,
          data: data,
          async: false,
          cache: false,
          contentType: false,
          processData: false,
          success: function (data) {
        	var uData = jQuery.parseJSON(data);
            console.log(data);
            if(uData.status == 'success'){
            	console.log(uData.code);
            		$('#userEmail').html(uData.uEmail);
            		$('#userFirstName').html(uData.uFname);
            		$('#userLastName').html(uData.uLname);
            		$('#userAddress').html(uData.uAddress);
            		$('#userPhone').html(uData.uPhone);
            		$('#user-data').fadeIn('slow');
            		$('#qrCode').select();

			}
			else{

			}
		  }
		});


		}
		

	});
});	

</script>

@endsection