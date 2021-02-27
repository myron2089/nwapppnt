@extends('layouts.expositor.app')
@section('css')
<link rel="stylesheet" href="{{ asset('css/cards.css')}}" type="text/css" />
@endsection
@section('content')
<div class="page-title">
	<h3><!--<i class="fa fa-edit"></i>--> Mis Eventos </h3>
</div>

<div class="page-bar">
	<ul class="page-breadcrumb">
	    <li>
	        <a href="{{ route('admin-home')}}">Inicio</a>
	        <i class="fa fa-angle-right"></i>
	    </li>
	    <li>
	        <a href="{{ route('admin-home')}}">Eventos</a>
	        <i class="fa fa-angle-right"></i>
	    </li>
	    <li>
	        <span>Mis Eventos</span>

	    </li>
	    
	</ul>
</div>
	<!-- BEGIN ROW PP -->
	<div class="row">
		@if($type!="advanced")
		<div class="col-md-12 text-right">
			@if($roleAuth < 3)
				<div class="col-md-12 col-sm-12">
	        	
		            <a href="{{url('administracion/eventos/avanzado')}}"  class="btn btn-sm green pull-right"><i class="fa fa-plus"></i> Opciones Avanzadas</a>
		             
	        	</div>
	        @endif
	    @endif

	        
		</div>
		@if($countEvents ==0)

		<div class="note note-warning">
	        <h4 class="block">Alerta!</h4>
	        <p> No existen para la consulta especificada.</p> <br><a class="btn yellow-gold btn-outline btn-circle btn-sm" href="{{ route('admin-home')}}">Regresar...</a>
	    </div>

		@else

			@if($type=="cards")
				@foreach($myEvents as $event)
	                <a href="{{ url('/administracion/eventos')}}/{{$event->ID}}">
	                    <div class="card-container card-mini">
	                        <div class="card">
	                            <div class="wrapper" >
	                                <?php $evimg = $event->PICTUREPATH; ?>
	                               
	                                <div class="img-cover" style="background: url('{{url('/')}}/{{$evimg}}') center / cover no-repeat;"></div>
	                                <div class="img-overlay" style="background: url('{{url('../images/grid.png')}}') center / cover no-repeat; opacity: 0"></div>
	                                <div class="header">
	                                    <div class="date">
	                                        <span class="day">{{ date_format(new DateTime($event->EVENTSTART), 'd/m/Y') }}</span> 
	                                        <span class="day">  @if($roleEvent != 5) | Visitantes {{$event->VISITORS}} @endif</span>
	                                    </div>
	                                   <!--<ul class="menu-content" style="float: right;">
	                                        <li><a href="#" class="fa fa-bookmark-o"></a></li>
	                                        <li><a href="#" class="fa fa-heart-o"><span>18</span></a></li>
	                                        <li><a href="#" class="fa fa-comment-o"><span>3</span></a></li>
	                                    </ul>--> 
	                                </div>
	                                 <div class="data">
	                                        <div class="content">
	                                         <!-- <span class="author">{{$event->userFirstName}} {{$event->userLastName}}</span>-->
	                                          <h1 class="title"><a href="{{ url('/administracion/eventos')}}/{{$event->ID}}">{{$event->NAME}}</a></h1>
	                                          <!--<p class="text">{{$event->DESCRIPTION}}</p>-->
	                                          <a href="{{ url('/administracion/eventos')}}/{{$event->ID}}" class="button-more">Editar Evento</a>
	                                        </div>
	                                  </div>
	                            </div>
	                        </div>
	                    </div>
	                </a>
	            @endforeach
	        @elseif($type=="advanced")
	        	<table id="event-list" class="table table-striped  table-bordered table-hover  order-column" style="width: 100%; border: 2px solid #e7ecf1;">
                    <thead>
                        <tr>
                        	<th> Fecha de Inicio </th>
                            <th> Nombre del Evento </th>
                            <th> Estado Portal Público </th>
                            <th> Estado Administración </th>
                            <th> Opciones </th>
                           
                           <!-- <th> Teléfono </th>-->
                            
                        </tr>
                    </thead>
                    <tbody>
                    	@foreach($myEvents as $event)
                    	<tr>
                    		<td>{{ Carbon\Carbon::parse($event->EVENTSTART)->format('d/m/Y') }}</td>
                    		<td>{{$event->NAME}}</td>
                    		<td> 
                    			@if($event->eventStatus==1) <p id="t{{$event->ID}}" style="width: 60px; margin: 0; float: left;">Activo</p> @elseif($event->eventStatus==2) <p id="t{{$event->ID}}" style="width: 60px; margin: 0; float: left;">Inactivo</p>  @endif
                    			<a id="{{$event->ID}}"  href="javascript:changeEventStatus({{$event->ID}}, {{$event->eventStatus}});" type="submit" id="getQr2" class="btn btn-xs btn-default"><i class="fa @if($event->eventStatus==1) fa-lock @elseif($event->eventStatus==2) fa-unlock  @endif"></i> @if($event->eventStatus==1) Desactivar @elseif($event->eventStatus==2) Activar  @endif</a>
                    		</td>

                    		<td> 
                    			@if($event->adminStatus==1) <p id="as{{$event->ID}}" style="width: 60px; margin: 0; float: left;">Abierto</p> @elseif($event->adminStatus==0) <p id="as{{$event->ID}}" style="width: 60px; margin: 0; float: left;">Cerrado</p>  @endif
                    			<a id="ias{{$event->ID}}"  href="javascript:changeEventAdminStatus({{$event->ID}}, {{$event->adminStatus}});" type="submit" id="getQr2" class="btn btn-xs btn-default"><i class="fa @if($event->adminStatus==1) fa-lock @elseif($event->adminStatus==0) fa-unlock  @endif"></i> @if($event->adminStatus==1) Cerrar @elseif($event->adminStatus==0) Abrir  @endif</a>
                    		</td>
                    		<td>
                    			<a href="{{ url('/administracion/eventos')}}/{{$event->ID}}" type="submit" id="getQr2" class="btn btn-xs btn-default"><i class="fa fa-edit"></i> Editar</a>
                    			
                    			
                    		</td>
                    	</tr>
                    	@endforeach
                    </tbody>
			        	
		        </table>

	        @endif

			
		@endif
		
	</div>
	<!-- END ROW PP -->

{{ $myEvents->links() }}
@endsection


@section('scripts')
<script type="text/javascript" src="{{ URL::asset('metronic/scripts/ui-buttons-spinners.min.js')}}"></script>
<script type="text/javascript" src="{{ URL::asset('metronic/scripts/components-bootstrap-select.min.js')}}"></script>

<script>
	jQuery(document).ready( function($) {  
		$('.card-container').fadeIn('slow');
	});

</script>


<script>
	function changeEventStatus(id, status){


		
		
		var form = $(this);
		$.ajax({
          type: "POST",
          url: "{{url('event/status/change')}}",
          data: {eventId: id, eventStatus: status},
          /*async: false,*/
          cache: false,
          
         
          beforeSend:function(xhr){
          		$('#overlay-msg').text('Actualizando estado del evento...');
          		$('#page-overlay').fadeIn('slow');
          	},
          success: function (data) {
            
          }
        }).done(function(data) {

        	var statusIcon = "fa-lock";
        	var statusNameBtn =" Desactivar ";
        	var textMessage = "Este evento no será visible en el listado de eventos de networkingapp.";
        	var statusName = "Activo";

        	var uData = jQuery.parseJSON(data);
           
            if(uData.status == 'success')
			{

				$('#overlay-msg').text("El evento ha cambiado a " + uData.newStatusText);
				

				if(uData.newStatusId==2){
					statusIcon = "fa-unlock";
					statusNameBtn =" Activar ";
					textMessage ="El evento será visible en networkingapp desde este momento.";
					statusName="Inactivo";


				}

				swal({
					  title: uData.message,
					  text: textMessage,
					  type: "success",
					  showCancelButton: false,
					  confirmButtonClass: "btn green-sharp",
					  confirmButtonText: "Listo",
					  cancelButtonText: "En otro momento",
					  closeOnConfirm: true,
					  closeOnCancel: true
					});

				$("#"+id).html('<i class="fa '+ statusIcon +'">' + statusNameBtn);
				$("#t"+id).html(statusName);
				$("#"+id).attr("href", "javascript:changeEventStatus("+id+","+ uData.newStatusId +");");
				
			}
			else{
				$('#overlay-msg').text('El evento ha cambiado a ' + uData.newStatus);	
			}

		 	setTimeout(function(){
		  		$('#page-overlay').fadeOut('slow');
			}, 1500); 


        });

	}
</script>

<script>
	/*Admin status*/
	function changeEventAdminStatus(id, status){

		var infoMessage = "Algunas funciones de administración quedarán deshailitadas!";
		if(status==0){
			infoMessage = "Se habilitarán funciones de administración del evento.";
		}



		 swal({
	        title: "Está seguro de continuar?",
	        text: infoMessage,
	        type: "warning",
	        showCancelButton: true,
	        cancelButtonText: "Cancelar",
	        confirmButtonColor: "#DD6B55",
	        confirmButtonText: "Si, deseo continuar!",
	        closeOnConfirm: false
	    }, function (isConfirm) {
	        if (!isConfirm) return;
	        $.ajax({
	            url: "{{url('event/adminstatus/change')}}",
	            type: "POST",
	            data: {
	                eventId: id,
	                eventStatus: status
	            },
	            dataType: "html",
	            success: function (data) {
	            	var statusIcon = "fa-lock";
		        	var statusNameBtn =" Cerrar ";
		        	var textMessage = "Algunas de las funciones de administración se deshabilitaron desde este momento.";
		        	var statusName = "Abierto";

	            	

	            	var uData = jQuery.parseJSON(data);

	            	if(uData.newStatusId==0){
						statusIcon = "fa-unlock";
						statusNameBtn =" Abrir ";
						textMessage ="El evento se encuentra abierto para su administración.";
						statusName="Cerrado";
					}

	            	$("#ias"+id).html('<i class="fa '+ statusIcon +'">' + statusNameBtn);
	            	$("#ias"+id).attr("href", "javascript:changeEventAdminStatus("+id+","+ uData.newStatusId +");");
	            	$("#as"+id).html(statusName);
	                swal("Completado!", textMessage, "success");
	            },
	            error: function (xhr, ajaxOptions, thrownError) {
	                swal("Error en la operación!", "Por favor intente de nuevo en otro momento", "error");
	            }
	        });
	    });




	}

</script>

<!--Datatable -->
<script>
    
jQuery(document).ready( function($) {
 myTable =   $('#event-list').DataTable( {
        
         "createdRow": function ( row, data, index ) {
                        /*$('td', row).eq(0).addClass("hidden");
                         $('td', row).eq(0).addClass("id");*/
                       
                    },
         "language": {
            "lengthMenu": "Mostrar _MENU_ eventos por página",
            "zeroRecords": "Nothing found - sorry",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "No se encontraror registros",
            "search": "Buscar",
            "infoEmpty": "No hay registros disponibles",
            "zeroRecords": "No se han encontrado usuarios",
            "infoFiltered": "(filtrados de _MAX_ registros)",
            paginate:{previous:"Anterior",next:"Next",
            last:"Last",first:"First"}
        }
    } );
});
</script> 





@endsection