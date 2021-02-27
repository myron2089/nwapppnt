@extends('layouts.expositor.app')
@section('css')
<link rel="stylesheet" href="{{ asset('css/cards.css')}}" type="text/css" />
<link rel="stylesheet" href="{{ asset('metronic/css/tagsinput.css')}}" type="text/css" />
<link rel="stylesheet" href="{{ asset('metronic/css/select2/css/select2.min.css')}}" type="text/css" />
<link rel="stylesheet" href="{{ asset('metronic/css/select2/css/select2-bootstrap.min.css')}}" type="text/css" />

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
<div class="page-title">
        <h3><!--<i class="fa fa-list"></i>--> Scans de Empresas</h3>
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
            <a href="#">Scans a Empresas</a>
            
        </li>
	    
	</ul>
	
</div>
<div class="row">
	<div class="col-md-12" style="padding-left: 0px; padding-right: 0px">
		
		<div class="portlet light bordered">
	        <div class="portlet-title">
	            <div class="caption font-green-haze">
	                <i class="fa fa-qrcode font-green-haze"></i>
	                <span class="caption-subject bold uppercase"> Scans de Empresas</span>
	            </div>
	            <div class="actions">
	                <!--<a class="btn btn-circle btn-icon-only blue" href="javascript:;">
	                    <i class="icon-cloud-upload"></i>
	                </a>
	                <a class="btn btn-circle btn-icon-only green" href="javascript:;">
	                    <i class="icon-wrench"></i>
	                </a>
	                <a class="btn btn-circle btn-icon-only red" href="javascript:;">
	                    <i class="icon-trash"></i>
	                </a> -->
	                <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
	            </div>
	        </div>
	        <div class="portlet-body form">
	        	<div class="row">

	        		


	        		

			        <div class="col-md-12 col-sm-12" style="margin-top: 20px">
			        	 <div class="portlet light bordered">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-bar-chart font-dark hide"></i>
                                    <span class="caption-subject font-dark bold uppercase"><i class="fa fa-arrow-circle-up"></i> Listado de Scans</span>
                                    <span class="caption-helper">Scans empresas </span>
                                </div>

                              <!--  <div class="actions">
                                    <div class="btn-group">
                                        <a class="btn green-haze btn-outline btn-circle btn-sm" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" aria-expanded="false"> Exportar
                                            <i class="fa fa-angle-down"></i>
                                        </a>
                                        <ul class="dropdown-menu pull-right">
                                            <li>
                                                <a href="javascript:;"> PDF</a>
                                            </li>
                                            <li class="divider"> </li>
                                            <li>
                                                <a href="javascript:;">Word</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div> -->
                            </div>
                            <div class="portlet-body"> 
                              <!--  <form action="#" class="form-horizontal form-row-seperated">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Basic Auto Complete</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-user"></i>
                                                </span>
                                                <input type="text" id="companies" name="companies" class="form-control" /> </div>
                                            <p class="help-block"> E.g: metronic, keenthemes. </p>
                                        </div>
                                    </div>
                                </form> -->


                            	<!-- BEGIN SAMPLE TABLE PORTLET-->
                                
                                <div class="row">
                                    <a href="{{url('scans/companies/get-report-scans')}}/{{$eventId}}/0/performed" target="_blank" class="btn btn-info btn-md dt-view" style="margin-left:16px;"><span class="fa fa-file-pdf-o" aria-hidden="true"></span> Reporte General de Scans Realizados</a>

                                    @if($eventRoleAuth < 3)
                                      <a href="{{url('scans/companies/get-report-scans')}}/{{$eventId}}/0/received" target="_blank" class="btn btn-info btn-md dt-view" style="margin-left:16px;"><span class="fa fa-file-pdf-o" aria-hidden="true"></span> Reporte General de Scans Recibidos</a>
                                    @endif
                                </div>

                                <div class="row">
                                  
                                </div>

                                <table id="companies-table" class="table table-striped  table-bordered table-hover  order-column" style="width: 100%; border: 2px solid #e7ecf1;">
                                    <thead>
                                        <tr>
                                        	<th> Empresa </th>
                                            <th> Correo electrónico </th>
                                            <th> Teléfono </th>
                                            <th> Dirección </th>
                                            <!--<th> Escaneado </th>-->
                                            
                                            <!-- <th> Fecha Escaneo </th>-->
                                           <!-- <th> Teléfono </th>-->
                                            
                                        </tr>
                                    </thead>
                                   
                                </table>
                              
                                  


                            </div>
                        </div>

			        </div>
			    </div>
	        </div>
	    </div>

	 
	</div>

   

       
</div>
@endsection
@section('scripts')
<script type="text/javascript" src="{{ URL::asset('metronic/scripts/ui-buttons-spinners.min.js')}}"></script>
<script type="text/javascript" src="{{ URL::asset('metronic/scripts/components-bootstrap-select.min.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<!-- Datatables  -->
<script>
	$(document).ready(function() {
	    $('#companies-table').DataTable( {
	    	"bLengthChange": false,
	    	  /*dom: 'Bfrtip',
			 buttons: [
			    'copyHtml5', 'excelHtml5', 'pdfHtml5'
			  ],*/
	    	"pageLength": 10,
	        "processing": true,
	        "serverSide": true,
	        "language": {
                "url": "{{url('metronic/global/plugins/datatables/plugins/bootstrap/latino.json')}}"
            },
	        "ajax": "{{url('companies/get-companies-data')}}/"+"{{$eventId}}",
	        "columns":[
	        	
                {data:'companyName', name:'companyName'},
                {data:'companyEmail', name:'companyEmail'},
                {data:'companyPhone', name:'companyPhone'},
                {data:'companyAddress', name:'companyAddress'},
               /* { title: "Exportar PDF", "data": null, searchable: false, orderable: false }*/
	        	
               
              /*  {data: 'scanDate', name: 'scanDate', searchable: false},*/
	        	

	        ]

            /*,
            columnDefs:[
            {
                width: "25%",
                targets: -1, //-1 es la ultima columna y 0 la primera
                data: 'Exportar',
                title: 'Exportar',
                render: function ( data, type, full, meta ) {
                        return '<div class="btn-group"> <a style="margin-top: 2px; margin-button: 2px; margin-right:4px" href="{{url('scans/companies/get-report-scans')}}/{{$eventId}}/'+data.ID+'/performed" target="_blank" class="btn btn-info btn-sm dt-view" style="margin-right:16px;"><span class="fa fa-file-pdf-o" aria-hidden="true"></span> Scans Realizados </a>  <a style="margin-top: 2px; margin-button: 2px;" href="{{url('scans/companies/get-report-scans')}}/{{$eventId}}/'+data.ID+'/received" target="_blank" class="btn btn-info btn-sm dt-view" style="margin-right:16px;"><span class="fa fa-file-pdf-o" aria-hidden="true"></span> Scans Recibidos </a> </div>';
                        }
                },


            ]*/
	        
	    } );

} );

</script>


<!-- Select for companies -->
<script>
    $('#companies').select2({
        placeholder: 'Select an item',
        ajax: {
          url: "{{url('companies/get-companies-data')}}/"+"{{$eventId}}",
          dataType: 'json',
          delay: 250,
          processResults: function (data) {
            return {
              results:  $.map(data, function (item) {
                    return {
                        text: item.name,
                        id: item.id
                    }
                })
            };
          },
          cache: true
        }
    });


</script>
@endsection