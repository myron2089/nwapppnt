@extends('layouts.expositor.app')
@section('css')
<link rel="stylesheet" href="{{ asset('css/cards.css')}}" type="text/css" />
<link rel="stylesheet" href="{{ asset('metronic/css/tagsinput.css')}}" type="text/css" />
<link rel="stylesheet" href="{{ asset('metronic/css/select2/css/select2.min.css')}}" type="text/css" />
<link rel="stylesheet" href="{{ asset('metronic/css/select2/css/select2-bootstrap.min.css')}}" type="text/css" />
@endsection
@section('content')
<div class="page-title">
        <h3><!--<i class="fa fa-list"></i>--> Recepción de invitaciones</h3>
    </div>
<div class="page-bar">
	<ul class="page-breadcrumb">
	    <li>
	        <a href="#">Inicio</a>
	        <i class="fa fa-circle"></i>
	    </li>
	    <li>
	        <a href="{{url('administracion/eventos/')}}/{{$eventId}}">{{$eventName}}</a>
            <i class="fa fa-circle"></i>
	    </li>
        <li>
            <a href="#">Recepción de invitaciones</a>
            
        </li>
	    
	</ul>
	
</div>

<!--<div class="page-title">
	<h3><i class="fa fa-send-o"></i> Enviar invitaciones</h3>
</div> -->
<!-- BEGIN ROW PP -->
<div class="row" style="margin-top: 5px;" >
	<div class="col-md-12" style="background: #fff">
		<div class="portlet" >
		    <div class="portlet-title">
		        <div class="caption">
		            <i class="fa fa-send-o"></i>Buscar Invitación para recepción </div>
		    </div>
		    <div class="portlet-body"> 
           @if($eventAdminStatus == 1)
  		    	<form role="form" method="POST" action="{{route('ticket-reception')}}">
              {{ csrf_field() }}
    		    		<input type="hidden" name="eventId" id="eventId" value="{{$eventId}}">
    		    		
                <label for="searchParams">Ingrese Número de ticket o correo electrónico</label>
                <input class="form-control" id="searchParams" name="searchParams"><br>

    					<button id="btn-send-invitations" type="submit" class="btn blue-soft btn-md pull-right" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Enviado ticket(s)...">Buscar Ticket</button><br>
  				  </form>
          @else
            <div class="row">
              <div class="col-md-12" style="margin-top: 20px; margin-bottom: 0px;">
                <div class="alert alert-danger">
                  <strong>Evento cerrado!</strong> No se pueden recibir invitaciones para este evento!.
                </div>
              </div>
            </div>

          @endif
		    </div>

		</div>	
    <br>
    <br>
    <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Ticket Enviadas</h3>
                            </div>
                            <div class="panel-body"> 

                              <!-- BEGIN SAMPLE TABLE PORTLET-->
                                
                                <div class="table-scrollable">
                                    <table id="tickes-table" class="table table-striped  table-hover  order-column" style="width: 100%">
                                        <thead>
                                            <tr>
                                              <th style="display: none" class="hidden"> ID</th>
                                              <th> Fecha de Envío</th>
                                              <th> Código </th>
                                              <th> Enviado a </th>
                                              <th> Enviado por </th>
                                              <th> Estado </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          @foreach($tickets as $ticket)
                                            <?php  
                                              $date = date_create($ticket->DATE);
                                              $nDate = date_format($date, 'd/m/Y'); 
                                            ?>
                                            <tr>
                                              <td class="id {{$ticket->CODE}}" style="display: none">{{ $ticket->CODE}}</td>
                                              <td>
                                                {{ $nDate }}
                                              </td>
                                              <td>
                                                {{ $ticket->CODE }}
                                              </td>
                                                <td>
                                                {{ $ticket->RECIPIENT }}
                                              </td>
                                                <td>
                                                  
                                                {{ $ticket->FFNAME }} {{ $ticket->FLNAME }}
                                                 
                                              </td>
                                              <td class="tStatus">
                                                @if($ticket->STATUS == 1)
                                                  Enviado
                                                    <a href="javascript:changeTicketStatus({{$ticket->CODE}});" id="sweet-8" class="btn btn-xs btn-default sweet-8  @if($eventAdminStatus == 0) disabled  @endif"><i class="fa fa-times"></i> Marcar como recibido</a>
                                                @elseif($ticket->STATUS == 0)
                                                  Recibido
                                                @endif
                                              </td>
                                            </tr>
                                          @endforeach
                                    
                                         </tbody>
                                    </table>
                                </div>
                                  

                                 @if($countTickets>0) {!!  $tickets->appends(Request::except('page'))->links() !!} @endif
                            </div>
                        </div>

  </div>
	
</div>
@endsection


@section('scripts')

<script type="text/javascript" src="{{ URL::asset('metronic/scripts/tagsinput.js')}}"></script>




<script>
jQuery(document).ready( function($) {

		var regex4 = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;// Email address
			$('#semails').tagsInput({
				width: 'auto',
				pattern: regex4,
				defaultText:'Escriba un correo electrónico...',

			});

     

	});


</script>
<script>
    $("#store-invitation").submit(function( event ) {
        event.preventDefault();



        var emails = $('#emails').val();

        if(emails == null){

           Command: toastr["error"]('Por favor ingrese correos electrónicos válidos' , "Error");

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

            return;

        }
        
        var evId = $('#eventId').val();
       

        var $btnc = $('#btn-send-invitations');
        $btnc.button('loading');
        
        var data = new FormData($(this)[0]);
        $('#overlay-msg').text('Enviando tickets...');
        $('#page-overlay').fadeIn('slow');
        var form = $(this);
        $.ajax({
          type: "POST",
          url: form.attr( "action" ),
          data: {'emails':emails, 'eventId': evId},
          
          success: function (data) {
            var uData = jQuery.parseJSON(data);
            /*console.log(data);
*/
            for (var i = 0; i < uData.length; i++) {
              

              var t = $('#tickes-table').DataTable();
              
              var rowNode = t.row.add( [
                    uData[i].id,
                    uData[i].date,
                    uData[i].id,
                    uData[i].recipient,
                    uData[i].from,
                    'Enviado',
                    
                ] ).draw().node();
            }

           

            $('#emails').empty().trigger("change");
            
             setTimeout(function(){
                        
                        
                        $btnc.button('reset');
                        Command: toastr["success"]("Se han enviado correctamente los ticket", "Mensaje");

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
                        };
                        $('#page-overlay').fadeOut('slow');
                    }, 2000);
          },
          error: function(XMLHttpRequest, textStatus, errorThrown) { 
          /*alert("Status: " + textStatus); alert("Error: " + errorThrown);*/ 

          setTimeout(function(){
            $('#page-overlay').fadeOut('slow');
            
            $btnc.button('reset');
            Command: toastr["error"](textStatus + ' ' + errorThrown + 'Ha ocurrido un error inténtelo de nuevo!' , "Error");

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
          }, 2000);

      
        }
        });
        

    });
</script>
<!-- setup select2 -->
<script>
jQuery(document).ready( function($) {	
	$('#emails').select2({
	 tags: true,
    tokenSeparators: [';', ' '],
    maximumSelectionLength: 3,
    language: 'es-ES',
    language: {
  		// You can find all of the options in the language files provided in the
  		// build. They all must be functions that return the string that should be
  		// displayed.
	  inputTooShort: function () {
	    return "You must enter more characters...";
	  },
	  noResults: function(){
        return ""
    },
    maximumSelected: function( e ){
        var t = "Sólo puedes enviar " + e.maximum + " invitaciones a la vez!";

        return e.maximum == 1 ? t += "m" : t += "", t
    },
	},
    createTag: function(term, data) {
		    var value = term.term;
		    if(validateEmail(value)) {
		        return {
		          id: value,
		          text: value
		        };
		    }
		     if(!validateEmail(value)){
                            return {
                                text: "Escribe un correo electrónico válido...",
                            };
                        }

		    return null;            
		}
	});
});

function validateEmail(email) {
    var re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

</script>


<!-- Change status of ticket -->
<script>

function changeTicketStatus(ticketId){
  $('#overlay-msg').text('Cambiando Estado del Ticket...');
  $('#page-overlay').fadeIn('slow');
  var row = $('.'+ticketId).closest('tr').index();
 
    $.ajax({
          type: "POST",
          url: "{{url('admin/tickets/change-status')}}",
          data: {'ticketId':ticketId},
          
          success: function (data) {
            var uData = jQuery.parseJSON(data);
           

            if(uData.status == 'success'){
              row = row+1;
               
              $('#tickes-table tr').eq(row).find('td').eq(5).html('Recibido');

              setTimeout(function(){       
                Command: toastr["success"]("Se ha realizado la recepción del ticket con éxito.", "Mensaje");

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
                };
                $('#page-overlay').fadeOut('slow');
              }, 1500);
            } 
            else if(uData.status=='error'){
              setTimeout(function(){
                Command: toastr["error"]('Ha ocurrido un error, por favor inténtelo de nuevo!' , "Error");

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
              }, 2000);

            }


          },
          error: function(XMLHttpRequest, textStatus, errorThrown) { 

           }
    });


}

</script>
@endsection