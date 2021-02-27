@extends('layouts.expositor.app')
@section('css')
<link rel="stylesheet" href="{{ asset('css/cards.css')}}" type="text/css" />
<link rel="stylesheet" href="{{ asset('metronic/css/tagsinput.css')}}" type="text/css" />
<link rel="stylesheet" href="{{ asset('metronic/css/select2/css/select2.min.css')}}" type="text/css" />
<link rel="stylesheet" href="{{ asset('metronic/css/select2/css/select2-bootstrap.min.css')}}" type="text/css" />
@endsection
@section('content')
<div class="page-title">
        <h3><!--<i class="fa fa-list"></i>--> Enviar invitaciones</h3>
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
            <a href="#">Invitaciones</a>
            
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
		            <i class="fa fa-send-o"></i>Enviar Ticket </div>
		    </div>
		    <div class="portlet-body"> 
          @if($eventAdminStatus == 1)
            @if($invitationConfigured==1)
              <div class="alert alert-warning alert-dismissable">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                  <strong>Alerta!</strong> No se ha configurado la plantilla para el ticket del evento.<br>
                  No podrá enviar invtaciones sin previamente configurarla.
                  <br>
                  Puede <a onclick="event.preventDefault(); document.getElementById('invitation-config-form').submit();"> Configurar invitación</a>
                   <form id="invitation-config-form" action="{{ route('config-invitation') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                        <input type="hidden" name="eventId" value="{{$eventId}}">
                  </form>
              </div>
            @endif


  		    	<form id="store-invitation" method="POST" action="{{url('admin/invitations/store')}}">
    		    		<input type="hidden" name="eventId" id="eventId" value="{{$eventId}}">
    		    		<p><label>Escriba uno o varios correos electrónicos. (3 como máximo)</label>
    					<!--<input id='emails' type='text' class='tags' placeholder="Escriba un correo electrónico..." max-tags="3" enforce-max-tags></p>-->
    					<select class="form-control emails-container" multiple="multiple" id="emails">
    					  
    					</select><br>


            <!--  <input id="emails" name="emails" value="">-->

            <br>

    					<button id="btn-send-invitations" type="submit" class="btn blue-soft btn-md pull-right" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Enviado ticket(s)...">Enviar ticket</button><br>
  				  </form>
            @else
              <div class="row">
                <div class="col-md-12" style="margin-top: 20px; margin-bottom: 0px;">
                  <div class="alert alert-danger">
                    <strong>Evento cerrado!</strong> No se pueden enviar invitaciones para este evento!.
                  </div>
                </div>
              </div>
            @endif
		    </div>
		</div>	
    <br>
    
    <div class="panel panel-default">
      <div class="panel-heading">
          <h3 class="panel-title">Invitaciones Enviadas</h3>
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
                  
                    @foreach($invitations as $invitation)
                        <tr>
                            <td class="id {{$invitation->CODE}}" style="display: none">{{$invitation->CODE}}</td>

                           <?php  
                              $date = date_create($invitation->DATE);
                              $nDate = date_format($date, 'd/m/Y'); ?>
                            <td> {{  $nDate }}</td>
                            <td> {{ $invitation->CODE }}</td>
                            <td> {{ $invitation->RECIPIENT}}</td>
                            <td> {{ $invitation->FFNAME}} {{ $invitation->FLNAME}} </td>
                            <td> @if($invitation->STATUS == 1) Enviado   @elseif($invitation->STATUS==2 || $invitation->STATUS==0) Utilizado  @endif </td>
                           
                        </tr>
                      @endforeach
                   </tbody>
              </table>
          </div>
            


        </div>
    </div>

  </div>
	
</div>
@endsection


@section('scripts')

<script type="text/javascript" src="{{ URL::asset('metronic/scripts/tagsinput.js')}}"></script>

<!-- Datatable -->
<script>
    
jQuery(document).ready( function($) {
 myTable =   $('#tickes-table').DataTable( {
        
         "createdRow": function ( row, data, index ) {
                        $('td', row).eq(0).addClass("hidden");
                         $('td', row).eq(0).addClass("id");
                       
                    },
         "language": {
            "lengthMenu": "Mostrar _MENU_ tickets por página",
            "zeroRecords": "Nothing found - sorry",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "No se encontraror registros",
            "search": "Buscar",
            "infoEmpty": "No hay registros disponibles",
            "zeroRecords": "No existen tickets enviados",
            "infoFiltered": "(filtrados de _MAX_ registros)",
            paginate:{previous:"Anterior",next:"Siguiente",
            last:"Última",first:"Primera"}
        },
        columnDefs: [ {
            targets: 2,
            render: function ( data, type, row ) {
                return data.length > 50 ?
                    data.substr( 0, 50 ) +'…' :
                    data;
                }
            }, 
            
        ]
    } );
});
</script>


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
       
        
        var data = new FormData($(this)[0]);
        $('#overlay-msg').text('Enviando tickets...');
        $('#page-overlay').fadeIn('slow');
        var form = $(this);
        $.ajax({
          type: "POST",
          url: form.attr( "action" ),
          data: {'emails':emails, 'eventId': evId},
          beforeSend: function(){
             $btnc.button('loading');
          },
          
          success: function (data) {
           
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
        }).done(function(data){
           var uData = jQuery.parseJSON(data);
            //console.log(uData.status);
         

            if(uData.status=='success'){
             
                

                var t = $('#tickes-table').DataTable();
                
                var rowNode = t.row.add( [
                      uData.id,
                      uData.date,
                      uData.id,
                      uData.recipient,
                      uData.from,
                      'Enviado',
                      
                  ] ).draw().node();
              

             

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
            } 
            else if(uData.status=='no_configure'){
              setTimeout(function(){
                $('#page-overlay').fadeOut('slow');
              
                $btnc.button('reset');
                Command: toastr["error"]('La plantilla de invitación aún no ha sido configurada.' , "Error");

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
@endsection