@extends('layouts.expositor.app')
@section('css')
<link rel="stylesheet" href="{{ asset('css/cards.css')}}" type="text/css" />
<link rel="stylesheet" href="{{ asset('metronic/css/tagsinput.css')}}" type="text/css" />
<link rel="stylesheet" href="{{ asset('metronic/css/select2/css/select2.min.css')}}" type="text/css" />
<link rel="stylesheet" href="{{ asset('metronic/css/select2/css/select2-bootstrap.min.css')}}" type="text/css" />
@endsection
@section('content')
<div class="page-bar">
	<ul class="page-breadcrumb">
	    <li>
	        <a href="#">Inicio</a>
	        <i class="fa fa-circle"></i>
	    </li>
	    <li>
	        <a href="#">Códigos para eventos</a>
            <i class="fa fa-circle"></i>
	    </li>
        <li>
            <a href="#">Generar</a>
            
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
		            <i class="fa fa-send-o"></i>Generar códigos para crear evento </div>
		    </div>
		    <div class="portlet-body"> 
  		    	<form id="store-code" method="POST" action="{{url('admin/codes/store')}}">
    		    		
    		    		<p><label>Escriba el correo electrónico del receptor del código</label>
    					<!--<input id='emails' type='text' class='tags' placeholder="Escriba un correo electrónico..." max-tags="3" enforce-max-tags></p>-->
    					<select class="form-control emails-container" multiple="multiple" id="emails">
    					  
    					</select><br>


            <!--  <input id="emails" name="emails" value="">-->

            <br>

    					<button id="btn-send-invitations" type="submit" class="btn blue-soft btn-md pull-right" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Generando código...">Generar y Enviar Código</button><br>
  				  </form>
		    </div>
		</div>	
    <br>
    <br>
    <div class="panel panel-default">
          <div class="panel-heading">
              <h3 class="panel-title">Códigos generados</h3>
          </div>
          <div class="panel-body"> 

            <!-- BEGIN SAMPLE TABLE PORTLET-->
              
              <div class="table-scrollable">
                  <table id="codes-table" class="table table-striped  table-bordered table-hover  order-column" style="width: 100%; border: 2px solid #e7ecf1;">
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
                      
                        @foreach($codes as $code)
                            <tr>
                                <td class="id {{$code->id}}" style="display: none">{{$code->codeId}}</td>                              
                                <td> {{  $code->codeDate }}</td>
                                <td> {{ $code->code }}</td>
                                <td> {{ $code->codeRecipient}}</td>
                                <td> {{ $code->userFullName}} </td>
                                <td> @if($code->codeStatus == 1) Enviado   @elseif($code->codeStatus==2) Utilizado  @endif </td>
                               
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
  
 myTable =   $('#codes-table').DataTable( {
        "bLengthChange": false,
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

$('#codes-table_filter').addClass('pull-left');
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
    $("#store-code").submit(function( event ) {
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
        $('#overlay-msg').text('Creando y enviando código, por favor espere...');
        $('#page-overlay').fadeIn('slow');
        var form = $(this);
        $.ajax({
          type: "POST",
          url: form.attr( "action" ),
          data: {'emails':emails},
          
          success: function (data) {
            var uData = jQuery.parseJSON(data);
            console.log(data);

            

              var t = $('#codes-table').DataTable();
              
              var rowNode = t.row.add( [
                    uData.codeId,
                    uData.codeDate,
                    uData.codeId,
                    uData.codeRecipient,
                    uData.codeUserName,
                    uData.codeStatus,
                    
                ] ).draw().node();
            

           

            $('#emails').empty().trigger("change");
            
             setTimeout(function(){
                        
                        
                        $btnc.button('reset');
                        Command: toastr["success"]("Se ha generado y enviado correctamente el código.", "Mensaje");

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
    maximumSelectionLength: 1,
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
        var t = "Sólo puedes enviar " + e.maximum + " código a la vez!";

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