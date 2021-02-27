@extends('layouts.expositor.app')
@section('css')
<link rel="stylesheet" href="{{ asset('css/cards.css')}}" type="text/css" />
<link rel="stylesheet" href="{{ asset('metronic/css/tagsinput.css')}}" type="text/css" />
<link rel="stylesheet" href="{{ asset('metronic/css/select2/css/select2.min.css')}}" type="text/css" />
<link rel="stylesheet" href="{{ asset('metronic/css/select2/css/select2-bootstrap.min.css')}}" type="text/css" />
@endsection
@section('content')
<div class="page-title">
        <h3><!--<i class="fa fa-list"></i>--> Scans de Ofertas</h3>
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
            <a href="#">Scans de Ofertas</a>
            
        </li>
	    
	</ul>
	
</div>
<div class="row">
	<div class="col-md-12" style="padding-left: 0px; padding-right: 0px">
		
		<div class="portlet light bordered">
	        <div class="portlet-title">
	            <div class="caption font-green-haze">
	                <i class="fa fa-qrcode font-green-haze"></i>
	                <span class="caption-subject bold uppercase"> Scans de Ofertas</span>
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
                         @if($permission < 3)
			        	 <div class="portlet light bordered">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-bar-chart font-dark hide"></i>
                                    <span class="caption-subject bold uppercase">Scans Recibidos</span>
                                    <span class="caption-helper">Listado de scans recibidos de ofertas...</span>
                                </div>

                               <!-- <div class="actions">
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

                            	<!-- BEGIN SAMPLE TABLE PORTLET-->


                                
                                <div class="row">
                                    <a href="{{url('scans/sales/get-report-scans')}}/{{$eventId}}/0/performed/all" target="_blank" class="btn btn-info btn-md dt-view" style="margin-left:16px;"><span class="fa fa-file-pdf-o" aria-hidden="true"></span> Reporte General de Scans Realizados</a>
                                </div>
                                
                                
                                <table id="received-scans" class="table table-striped  table-bordered table-hover  order-column" style="width: 100%; border: 2px solid #e7ecf1;">
                                    <thead>
                                        <tr>
                                        	<th> Oferta </th>
                                            <th> Producto </th>
                                            <tH> Precio </th>
                                            <th> Opciones </th>
                                           
                                           <!-- <th> Teléfono </th>-->
                                            
                                        </tr>
                                    </thead>
                                   
                                </table>
                              
                                  


                            </div>
                        </div>
                        @endif

                        @if($permission > 1 && $permission < 6)

                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-bar-chart font-dark hide"></i>
                                        <span class="caption-subject bold uppercase">Mis Scans Realizados</span>
                                        <span class="caption-helper">Listado de mis scans realizados a ofertas...</span>
                                    </div>

                                   <!-- <div class="actions">
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

                                    <!-- BEGIN SAMPLE TABLE PORTLET-->


                                    
                                    <div class="row">
                                        <a href="{{url('scans/users/get-report-scans')}}/{{$eventId}}/0/performed" target="_blank" class="btn btn-info btn-md dt-view" style="margin-left:16px;"><span class="fa fa-file-pdf-o" aria-hidden="true"></span> Reporte General de Scans Realizados</a>
                                    </div>
                                    
                                    
                                    <table id="performed-scans" class="table table-striped  table-bordered table-hover  order-column" style="width: 100%; border: 2px solid #e7ecf1;">
                                        <thead>
                                            <tr>
                                                <th> Oferta </th>
                                                <th> Producto </th>
                                                <tH> Precio </th>
                                                <th> Opciones </th>
                                               
                                               <!-- <th> Teléfono </th>-->
                                                
                                            </tr>
                                        </thead>
                                       
                                    </table>
                                  
                                      


                                </div>
                            </div>

                        @endif
                       
			        </div>
			    </div>
	        </div>
	    </div>

	 
	</div>

   
{{$permission}}
       
</div>
@endsection
@section('scripts')
<script type="text/javascript" src="{{ URL::asset('metronic/scripts/ui-buttons-spinners.min.js')}}"></script>
<script type="text/javascript" src="{{ URL::asset('metronic/scripts/components-bootstrap-select.min.js')}}"></script>


<!-- Datatables  -->
@if($permission < 3)
<script>
	$(document).ready(function() {
	    $('#received-scans').DataTable( {
	    	"bLengthChange": false,
	    	 /*dom: 'Bfrtip',
			  buttons: [
			    'copyHtml5', 'excelHtml5', 'pdfHtml5'
			  ],*/
	    	"pageLength": 25,
	        "processing": true,
	        "serverSide": true,
	        "language": {
                "url": "{{url('metronic/global/plugins/datatables/plugins/bootstrap/latino.json')}}"
            },
	        "ajax": "{{url('scans/offers/get-received-scans')}}/"+"{{$eventId}}/{{$permission}}/all",
	        "columns":[
	        	{data:'saleDescription', name:'saleDescription'},
                {data:'productName', name:'productName'},
                {data:'productPrice', name:'productPrice'},
                { title: "Exportar PDF", "data": null, searchable: false, orderable: false }
	        	/*{data: 'scanDate', name: 'scanDate', searchable: false},*/
	        	

	        ],
            columnDefs:[
            {
                targets: 2,
                className: "dt-right",
            },
            {
                width: "20%",
                targets: -1, //-1 es la ultima columna y 0 la primera
                data: 'Opciones',
                title: 'Opciones',
                render: function ( data, type, full, meta ) {
                        return '<div class="btn-group"> <a href="{{url('scans/sales/get-report-scans')}}/{{$eventId}}/'+data.ID+'/performed/all" target="_blank" class="btn btn-info btn-sm dt-view" style="margin-right:16px;"><span class="fa fa-file-pdf-o" aria-hidden="true"></span> Exportar Scans Realizados ('+ data.scansNumber +')  </a> </div>';
                        }
                }


            ],
	        
	    });



} );

</script>
@endif

<!-- Datatables  -->
@if($permission > 1 && $permission < 6)
<script>
    $(document).ready(function() {
        $('#performed-scans').DataTable( {
            "bLengthChange": false,
             /*dom: 'Bfrtip',
              buttons: [
                'copyHtml5', 'excelHtml5', 'pdfHtml5'
              ],*/
            "pageLength": 25,
            "processing": true,
            "serverSide": true,
            "language": {
                "url": "{{url('metronic/global/plugins/datatables/plugins/bootstrap/latino.json')}}"
            },
            "ajax": "{{url('scans/offers/get-received-scans')}}/"+"{{$eventId}}/{{$permission}}/my",
            "columns":[
                {data:'saleDescription', name:'saleDescription'},
                {data:'productName', name:'productName'},
                {data:'productPrice', name:'productPrice'},
                { title: "Exportar PDF", "data": null, searchable: false, orderable: false }
                /*{data: 'scanDate', name: 'scanDate', searchable: false},*/
                

            ],
            columnDefs:[
            {
                targets: 2,
                className: "dt-right",
            },
            {
                width: "20%",
                targets: -1, //-1 es la ultima columna y 0 la primera
                data: 'Opciones',
                title: 'Opciones',
                render: function ( data, type, full, meta ) {
                        return '<div class="btn-group"> <a href="{{url('scans/sales/get-report-scans')}}/{{$eventId}}/'+data.ID+'/performed/my" target="_blank" class="btn btn-info btn-sm dt-view" style="margin-right:16px;"><span class="fa fa-file-pdf-o" aria-hidden="true"></span> Exportar Scans Realizados ('+ data.scansNumber +')  </a> </div>';
                        }
                }


            ],
            
        });



} );

</script>
@endif



@endsection