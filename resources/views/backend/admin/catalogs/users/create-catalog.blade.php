@extends('layouts.expositor.app')

@section('content')

<div class="page-title">
    <h3><!--<i class="fa fa-list"></i> -->Catálogo para registro de usuarios</h3>
</div>

<div class="page-bar">
	<ul class="page-breadcrumb">
	    <li>
	        <a href="{{ url('admin/home')}}">Inicio</a>
	        <i class="fa fa-angle-right"></i>
	    </li>
	    <li>
            <a href="{{ url('admin/home')}}">{{$eventName}}</a>
            <i class="fa fa-circle"></i>
        </li>
	    <li>
	        <a href="#">Catálogos</a>
            <i class="fa fa-angle-right"></i>
	    </li>
        <li>
            <span>Usuarios</span>
            
        </li>
	    
	</ul>
	
</div>
	
	<!-- BEGIN ROW PP -->
	<div class="row" style="margin-top: -5px;">
		
		
		<div class="col-md-12">
		<div class="portlet light">
           <div class="portlet-title">
                <div class="caption caption-md">
                    <i class="icon-bar-chart theme-font hide"></i>
                    <span class="caption-subject font-black bold">Catálogos registrados</span>
                    <span class="caption-helper hide">weekly stats...</span>
                </div>
                
            </div>
                <div class="portlet-body form">
                  @if($eventAdminStatus == 1)
                    <div class="table-toolbar">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="btn-group">
                                    <a  href="javascript:catalogEdit(1,1);" id="sample_editable_1_new" class="btn sbold green"> Crear Catálogo
                                        <i class="fa fa-plus"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                         <div class="col-md-12 p-0" style="margin-top: 20px;">
                            <div class="alert alert-danger">
                                <strong>Evento cerrado!</strong> No se pueden crear catálogos en este evento.
                            </div>
                        </div>
                    @endif
            	<!-- BEGIN SAMPLE TABLE PORTLET-->                
                    <table id="user-catalogs" class="table table-striped table-bordered table-hover table-checkable order-column" style="width: 100%;">
                        <thead>
                            <tr>
                            	<th style="display: none" class="hidden"> ID</th>
                                <th> Nombre </th>
                                <th> Descripción </th>
                                <th> Tipo de Usuario </th>
                                <th> Opciones </th>
                               <!-- <th> Opciones </th> -->
                            </tr>
                        </thead>
                        <tbody>
                        	@foreach($catalogs as $catalog)
                                <tr class="odd gradeX">
                                	<td class="id {{$catalog->ID}}" style="display: none">{{$catalog->ID}}</td>
                                    <td>{{$catalog->NAME}}</td>
                                    <td>{{$catalog->DESCRIPTION}}</td>
                                    <td>{{$catalog->TYPE}}</td>
                                    <td> 
                                    	<form id="form-qr" method="post" action="{{route('user-catalog-add-fields')}}">
                                    		{{ csrf_field() }}
                                    		<input type="hidden" name="formId" value="{{$catalog->ID}}">
                                    		<input type="hidden" name="type" value="user">
                                    		<input type="hidden" name="eventId" value="{{$eventId}}">
                                    	<button type="submit" id="getQr2" class="btn btn-xs btn-default getQr"><i class="fa fa-edit"></i> Administrar Campos</button>
                                      
                                    	</form> 
                                    </td>
                                  
                                </tr>
                            @endforeach
                         </tbody>
                    </table>

                </div>
            </div>
        </div>
				
	</div> <!--End row -->




<div class="modal fade bs-modal-lg create-modal" id="large" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 id="user-modal-title" class="modal-title">Crear Nueva Marca</h4>
            </div>
            <div class="modal-body"> 

            	<form id="form-catalog-create" class="form-horizontal" method="POST" role="form" action="{{route('store-user-catalog')}}">
                	<!-- BEGIN FORM BODY -->
                	<div class="form-body">
                		 {{ csrf_field() }}
                		<input id="action" name="action" type="hidden" class="form-control">
                		<input id="eventId" name="eventId" type="hidden" value="{{$eventId}}">
               
                		<div class="form-group custom-form-group">
	                        <label class="control-label" for="eventFacebookLink">Nombre <span class="required" aria-required="true"> * </span></label>
	                        
	                           <input id="formName" name="formName" type="text"  class="form-control" placeholder="Nombre del catálogo" required maxlength="50" />
	                        
	                    </div>

	                    <div class="form-group custom-form-group">
	                        <label class="control-label" for="eventFacebookLink">Tipo de Usuario para el formuliario <span class="required" aria-required="true"> * </span></label>
	                        
	                         <select id="formType" name="formType" class="form-control" required>
	                         	<option value="">Seleccionar el tipo de usuario</option>
	                         	<option value="3">Representante</option>
	                         	<option value="4">Conferencista</option>
	                         	<option value="5">Visitante</option>
	                         	<option value="6">Personal de Montaje</option>

	                         </select>
	                        
	                    </div>

	                     <div class="form-group custom-form-group">
	                        <label class="control-label" for="formDescription">Descripción <span class="required" aria-required="true"> * </span></label>
	                        
	                           <textarea id="formDescription" name="formDescription" rows="5"  class="form-control" placeholder="Ingrese una breve descripción del catálogo" required maxlength="255" /></textarea>
	                       
	                    </div>

	                    <button id="form-submit" class="btn btn-primary green pull-right ladda-button" data-style="slide-up" data-size="l"><span class="ladda-label">Crear Catálogo</span></button>                 	
                		<button type="button" class="btn dark btn-outline pull-right" style="margin-right: 10px" data-dismiss="modal">Cerrar</button>
                	</div> 
                	<!-- END FORM BODY -->  
                	<br><br>
					
                </form>

            </div>
            <div class="modal-footer">
                                                
			</div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>  
 <!-- /.modal-fade end --> 

@endsection

@section('scripts')
<!-- Datatable -->
<script>
    
jQuery(document).ready( function($) {
 myTable =   $('#user-catalogs').DataTable( {
         /*responsive: true,*/
         "createdRow": function ( row, data, index ) {
                        $('td', row).eq(0).addClass("hidden");
                         $('td', row).eq(0).addClass("id");
                       
                    },
         "language": {
            "lengthMenu": "Mostrar _MENU_ catálogos por página",
            "zeroRecords": "Nothing found - sorry",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "No se encontraror registros",
            "search": "Buscar",
            "infoEmpty": "No hay registros disponibles",
            "zeroRecords": "No se han encontrado catálogos en el evento",
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


<!-- BEGIN EDIT USER (FORM) -->
<script>
 
function catalogEdit(act, uId){


	if(act==1){

		$('#user-modal-title').text('Crear Nuevo Catálogo');
	}
	else if(act==2){

		$('#user-modal-title').text('Editar Catálogo');
	}
  $('#form-catalog-create')[0].reset();
	$('#large').modal('show');
}	

</script>
<!-- END EDIT USER (FORM) -->




<!--Save catalog -->
<script>
	$('#form-catalog-create').submit(function( event ) {
		event.preventDefault();
		
		
    var btn = $('#form-submit');
    var l = Ladda.create(btn[0]);
		var form = $(this);
		var data = new FormData($(this)[0]);
        var stmessage='Se ha registrado correctamente el catálogo';
        var alertType = 'success';
		$.ajax({
      	type: "POST",
      	url: form.attr( "action" ),
      	data: data,
      	async: false,
      	cache: false,
      	contentType: false,
      	processData: false,
        beforeSend: function(){
                
          l.start();
          },
      		success: function (data) {

      		},

      		error: function(XMLHttpRequest, textStatus, errorThrown){
          		console.log(textStatus + ' ' + errorThrown);
        	},

        	statusCode: {
                401: function() { 
                    window.location.href = 'login'; //or what ever is your login URI 
                }
            }
        }).done(function(data){

          var uData = jQuery.parseJSON(data);

            if(uData.status == 'success'){
              
            }
            else if(uData.status =='exists'){
              
       
            } 
            else if(uData.status =='error'){


            }

            stmessage = uData.message;

            alertType = uData.alertType;

            Command: toastr[alertType](stmessage, "Mensaje");

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


            var t = $('#user-catalogs').DataTable();
                
             
                var rowNode = t.row.add( [
                    uData.catId,
                    
                    uData.catName,
                    uData.catDescription,
                    uData.catType,
                    '<form id="form-qr" method="post" action="{{route('user-catalog-add-fields')}}">' +
                        '{{ csrf_field() }}'+
                        '<input type="hidden" name="formId" value="'+ uData.catId +'">' +
                        '<input type="hidden" name="type" value="user">'+
                        '<input type="hidden" name="eventId" value="{{$eventId}}">' +
                        '<button type="submit" id="getQr2" class="btn btn-xs btn-default getQr"><i class="fa fa-edit"></i> Administrar Campos</button>' +
                                      
                    '</form>'

                   
                   /* "<a href='javascript:userEdit(2,"+uData.bId+");' id='edit-btn' class='btn btn-xs btn-default'><i class='fa fa-edit'></i>Editar</a> "+ btn */
                ] ).draw().node();

                var rId = uData.bId;
               
                $( rowNode ).find('td').eq(0).addClass(""+rId);

            setTimeout(function(){
              l.stop(); 
              $('#large').modal('hide');
            }, 1000);

        });

        

	});

</script>

@endsection