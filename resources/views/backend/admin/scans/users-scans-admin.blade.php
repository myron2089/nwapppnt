@extends('layouts.expositor.app')
@section('css')
<link rel="stylesheet" href="{{ asset('css/cards.css')}}" type="text/css" />
<link rel="stylesheet" href="{{ asset('metronic/css/tagsinput.css')}}" type="text/css" />
<link rel="stylesheet" href="{{ asset('metronic/css/select2/css/select2.min.css')}}" type="text/css" />
<link rel="stylesheet" href="{{ asset('metronic/css/select2/css/select2-bootstrap.min.css')}}" type="text/css" />
@endsection
@section('content')
<div class="page-title">
        <h3><!--<i class="fa fa-list"></i>--> Scans de Usuarios</h3>
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
            <a href="#">Scans de Usuarios</a>
            
        </li>
	    
	</ul>
	
</div>
<div class="row">
	<div class="col-md-12" style="padding-left: 0px; padding-right: 0px">
		
		<div class="portlet light bordered">
	        <!--<div class="portlet-title">
	            <div class="caption font-green-haze">
	                <i class="fa fa-qrcode font-green-haze"></i>
	                <span class="caption-subject bold uppercase"> Scans de Usuarios</span>
	            </div>
	            <div class="actions">
	                
	                <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
	            </div>
	        </div> -->
	        <div class="portlet-body form">
	        	<div class="row">

	        		


	        		

			        <div class="col-md-12 col-sm-12" style="margin-top: 20px">
			        	 <div class="portlet light bordered">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-bar-chart font-dark hide"></i>
                                    <span class="caption-subject font-dark bold uppercase">Scans Realizados</span>
                                    <span class="caption-helper">Listado de usuarios escaneados.<span>
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

                            	<!-- BEGIN SAMPLE TABLE PORTLET-->
                                
                                
                                <table id="performed-scans" class="table table-striped  table-bordered table-hover  order-column" style="width: 100%; border: 2px solid #e7ecf1;">
                                    <thead>
                                        <tr>
                                        	<th> Usuario Escaneado</th>
                                            <th> Email </th>
                                            <th> Teléfono </th>
                                            <th> Empresa </th>
                                            <!--<th> Fecha Escaneo </th>-->
                                           <!-- <th> Teléfono </th>-->
                                            
                                        </tr>
                                    </thead>
                                   
                                </table>
                              
                                  


                            </div>
                        </div>

                        <!-- scans recibidos -->
                        <div class="portlet light bordered">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-bar-chart font-dark hide"></i>
                                    <span class="caption-subject font-dark bold uppercase">Scans Recibidos</span>
                                    <span class="caption-helper">Listado de usuarios que me han escaneado...</span>
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

                            	<!-- BEGIN SAMPLE TABLE PORTLET-->
                                
                                
                                <table id="received-scans" class="table table-striped table-bordered  table-hover  order-column" style="width: 100%;    border: 2px solid #e7ecf1;">
                                    <thead>
                                        <tr>
                                        	<th style="display: none" class="hidden"> ID</th>
                                        	<th> Escaneó </th>
                                            <!--<th> Escaneado </th>-->
                                            <th> Correo </th>
                                            <th> Teléfono </th>
                                            <th> Empresa </th>
                                            
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


<!-- Datatables  -->
<script>
	$(document).ready(function() {
	    $('#performed-scans').DataTable( {
	    	"bLengthChange": false,
	    	 dom: 'Bfrtip',
			  buttons: [
			    'copyHtml5', 'excelHtml5', 'pdfHtml5'
			  ],
	    	"pageLength": 10,
	        "processing": true,
	        "serverSide": true,
	        "language": {
                "url": "{{url('metronic/global/plugins/datatables/plugins/bootstrap/latino.json')}}"
            },
	        "ajax": "{{url('scans/users/get-performed-scans')}}/"+"{{$eventId}}",
	        "columns":[
	        	{data:'fullName', name:'fullName'},
                {data:'userEmail', name:'userEmail'},
	        	{data: 'userPhoneNumber', name: 'userPhoneNumber', searchable: false},
                {data: 'userCompany', name: 'userCompany', searchable: false},
              /*  {data: 'scanDate', name: 'scanDate', searchable: false},*/
	        	

	        ],
	        
	    } );


	    $('#received-scans').DataTable( {
            "bLengthChange": false,
             dom: 'Bfrtip',
              buttons: [
                'copyHtml5', 'excelHtml5', 'pdfHtml5'
              ],
	        "processing": true,
	        "serverSide": true,
	        "language": {
                "url": "{{url('metronic/global/plugins/datatables/plugins/bootstrap/latino.json')}}"
            },
	        "ajax": "{{url('scans/users/get-received-scans')}}/"+"{{$eventId}}",
	        "columns":[
	        	
                {data:'fullName', name:'fullName'},
                /*{data:'fullName', name:'fullName'},*/
	        	{data: 'userEmail', name: 'UEB.userEmail'},
	        	{data: 'userPhoneNumber' , searchable: false},
                {data: 'userCompany', name: 'userCompany', searchable: false},

	        ],
	       
	    } );

} );

</script>
@endsection