@php
set_time_limit(0);
ini_set("memory_limit",-1);
ini_set('max_execution_time', 0);
@endphp

<!DOCTYPE html>
<html>
<head>
	<title>Report</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<style type="text/css">
		body{

			font-family: "Open Sans",sans-serif;
		}

		.document-header{

			width: 100%;
			border: 0px solid red;
			text-align: center;
		}

		.document-title{

			text-transform: uppercase;
			width: 100%;
			position: relative;
			margin: 0 auto;
			line-height: 1;	

		}

		.document-subtitle{
			margin-top: 1px;
			position: relative;
			line-height: 1.5;	

		}
		.scan-container{
			width: 100%;
			padding: 10px;
			
			height: auto;
		}	

		.company-data{


		}

		.gray-back{

			background-color: #efefef;
		}

		.company-name{

			font-size: 14px;
			font-weight: 600;
			text-transform: uppercase;

			line-height: 1;
			border: 1px solid black;
		}

		.company-user-name{

			border: 0px solid black;
			position: relative;
			font-size: 16px;
			width: 100%;
			font-weight: 500;
			 margin-top: -15px;
			 border-bottom: 0px solid gray;
		}


		.scan-detail{
			width: 100%;
			height: auto;
			position: relative;
			margin-top: -15px;
			background: #444444;
			padding-top: 0px;
			padding-bottom: 3px;

		}

		.scan-detail-title{
			color: #fff;
			text-align: center;
			font-size: 14px;
			padding: 5px 5px 3px 0;
		}

		.scan-detail-body{
 			width: 100%;
 			height: auto;
 			

		}

		.user-scans{

			width: 100%;
			position: relative;
			display: block;
			font-size: 14px;
			padding-left: 10px;
			margin-top: 10px;
			border-bottom: 1px solid gray;
		}

		.user-company-scan-user-container{

			padding-left: 20px;
			height: auto;
			width: 100%;
			position: relative;
			display: block;
			border: 0px solid gray;
		}

		.user-company-scan-user{

			padding-left: 0px;
			padding: 5px;
			height: auto;
			width: 100%;
			position: relative;
			display: block;
			border: 1px solid gray;
			margin-top: -1px;
		}

		.user-scaned-data{
			padding-left: 0px;
			width: 100%;
			position: relative;
			display: block;
			font-size: 15px;
			
		}

		.red{

			background-color: red !important;
		}

		.page-title{

			text-transform: uppercase;
			width: 100%;
			margin: 0 auto;
			text-align: center;
		}

		.scan-number{
			width: 70px;
			position: relative;
			display: inline-block;
			float: right;
			margin-top: 20px;
			margin-right: 10px;
			background: transparent;
			border: 0;
			padding-left: 10px;
			padding-right: 30px;
			text-align: center;
			
		}

	</style>
</head>
<body>
	<table class="document-header">
		<tr><td colspan="2" align="center" class="document-title" style="color: red; text-align: center;">NetWorkingApp</td></tr>
		<tr><td  colspan="2" align="center" class="document-subtitle">Reporte de Scans {{ date('d-m-Y') }}</td></tr>
		<tr><td  colspan="2" align="center" class="document-subtitle" style="margin-top: -20px">{{$type}}</td></tr>
	</table>
	<div><div> 
		{!! $data !!}


</body>
</html>