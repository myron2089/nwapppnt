<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
    	<div class="portlet light bordered">
	        <div class="portlet-title">
	            <div class="caption font-green-haze">
	                <i class="icon-settings font-green-haze"></i>
	                <span class="caption-subject bold uppercase"> Productos</span>
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
	                </a> 
	                <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>-->
	            </div>
	        </div>
	        <div class="portlet-body form">

	        	 <a href="javascript:userEdit(1,1);"  class="btn green"><i class="fa fa-plus"></i> Crear Producto</a><br><br>
								                

	        	<div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Productos del Evento</h3>
                    </div>
                    <div class="panel-body"> 
			        	<!-- BEGIN PRODUCTS TABLE -->
			        	<table class="table table-striped table-bordered table-hover table-checkable order-column table_products" id="sample_1" name="table_products">
				            <thead>
				                <tr>
				                    <th>
				                        <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
				                            <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" />
				                            <span></span>
				                        </label>
				                    </th>
				                    <th> Nombre del Producto </th>
				                    <th> Tipo </th>
				                    <th> Descripción </th>
				                    <th> Precio </th>
				                    <th> Marca </th>
				                </tr>
				            </thead>
				            <tbody>
				                <tr class="odd gradeX">
				                    <td>
				                        <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
				                            <input type="checkbox" class="checkboxes" value="1" />
				                            <span></span>
				                        </label>
				                    </td>
				                    <td> shuxer </td>
				                    <td>
				                        <a href="mailto:shuxer@gmail.com"> Test Producto</a>
				                    </td>
				                    <td>
				                        <span class="label label-sm label-success"> Approved </span>
				                    </td>
				                    <td class="center"> 12 Jan 2012 </td>
				                    <td>
				                        <div class="btn-group">
				                            <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
				                                <i class="fa fa-angle-down"></i>
				                            </button>
				                            <ul class="dropdown-menu pull-left" role="menu">
				                                <li>
				                                    <a href="javascript:;">
				                                        <i class="icon-docs"></i> New Post </a>
				                                </li>
				                                <li>
				                                    <a href="javascript:;">
				                                        <i class="icon-tag"></i> New Comment </a>
				                                </li>
				                                <li>
				                                    <a href="javascript:;">
				                                        <i class="icon-user"></i> New User </a>
				                                </li>
				                                <li class="divider"> </li>
				                                <li>
				                                    <a href="javascript:;">
				                                        <i class="icon-flag"></i> Comments
				                                        <span class="badge badge-success">4</span>
				                                    </a>
				                                </li>
				                            </ul>
				                        </div>
				                    </td>
				                </tr>
				        	</tbody>
						</table>
						<!-- END PRODUCTS TABLE -->
					</div> <!-- BEGIN PORTLET BODY -->
				</div> <!-- END PANEL -->
	        </div>
	    </div>
	    <!-- BEGIN MODAL FADE -->
	    <div class="modal fade bs-modal-lg" id="large" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 id="user-modal-title" class="modal-title">Editar Usuario</h4>
                    </div>
                    <div class="modal-body"> 

                    	<form id="form-user-create" class="form-horizontal" method="POST" role="form" action="{{ route('expositor-user-store') }}">
			                                	<!-- BEGIN FORM BODY -->
			                                	<div class="form-body">
			                                		 {{ csrf_field() }}
			                                		<input id="action" name="action" type="hidden" class="form-control"> 
			                                		<div class="form-group form-md-line-input has-danger">
								                        <label class="col-md-2 control-label" for="form_control_1">Nombre</label>
								                        <div class="col-md-10">
								                            <div class="input-icon">
								                                <input id="pName" name="pName" type="text" class="form-control" placeholder="Inidique el nombre del producto">
								                                <div class="form-control-focus"> </div>
								                                <i class="fa fa-edit"></i>
								                            </div>
								                        </div>
								                    </div>

								                    <div class="form-group form-md-line-input has-danger">
								                        <label class="col-md-2 control-label" for="form_control_1">Correo Electrónico</label>
								                        <div class="col-md-10">
								                            <div class="input-icon">
								                                <input id="uMail" name="uMail" type="text" class="form-control" placeholder="Ingrese correo electrónico del usuario">
								                                <div class="form-control-focus"> </div>
								                                <i class="fa fa-envelope-o"></i>
								                            </div>
								                        </div>
								                    </div>

								                    <div class="form-group form-md-line-input has-danger">
								                        <label class="col-md-2 control-label" for="form_control_1">Empresa</label>
								                        <div class="col-md-10">
								                            <div class="input-icon">
								                                <input id="uBusiness" name="uBusiness" type="text" class="form-control" placeholder="Empresa a la que representa">
								                                <div class="form-control-focus"> </div>
								                                <i class="fa fa-edit"></i>
								                            </div>
								                        </div>
								                    </div>

								                    <div class="form-group form-md-line-input has-danger">
								                        <label class="col-md-2 control-label" for="form_control_1">Teléfono</label>
								                        <div class="col-md-10">
								                            <div class="input-icon">
								                                <input id="uPhone" name="uPhone" type="text" class="form-control" placeholder="Teléfono de contacto con el usuario">
								                                <div class="form-control-focus"> </div>
								                                <i class="fa fa-phone"></i>
								                            </div>
								                        </div>
								                    </div>

								                    <div class="form-group form-md-line-input has-danger">
								                        <label class="col-md-2 control-label" for="form_control_1">Dirección</label>
								                        <div class="col-md-10">
								                            <div class="input-icon">
								                                <input id="uAddress" name="uAddress" type="text" class="form-control" placeholder="Dirección de la empresa">
								                                <div class="form-control-focus"> </div>
								                                <i class="fa fa-map"></i>
								                            </div>
								                        </div>
								                    </div>

								                    <div class="form-group form-md-line-input has-danger">
								                        <label class="col-md-2 control-label" for="form_control_1">Título</label>
								                        <div class="col-md-10">
								                            <div class="input-icon">
								                                <input id="uTitle" name="uTitle" type="text" class="form-control" placeholder="Dirección de la empresa">
								                                <div class="form-control-focus"> </div>
								                                <i class="fa fa-map"></i>
								                            </div>
								                        </div>
								                    </div>

								                    <div class="form-group form-md-line-input has-danger">
								                        <label class="col-md-2 control-label" for="form_control_1">Descripción</label>
								                        <div class="col-md-10">
								                            <div class="input-icon">
								                                <textarea id="uDesc" name="uDesc" cols="3" class="form-control" placeholder="Escriba una breve descripción para el usuario"></textarea>
								                                <div class="form-control-focus"> </div>
								                                <i class="fa fa-edit"></i>
								                            </div>
								                        </div>
								                    </div>

								                    <div class="form-group form-md-line-input has-danger">
								                        <label class="col-md-2 control-label" for="form_control_1">Permisos para el ususario</label>
								                        <div class="col-md-10">
								                            <div class="input-icon">
								                                <input id="uPersmissions" name="uPermissions" type="text" class="form-control" placeholder="Escriba una breve descripción para el usuario">
								                                <div class="form-control-focus"> </div>
								                                <i class="fa fa-edit"></i>
								                            </div>
								                        </div>
								                    </div>
								                    <button type="submit" class="btn green pull-right">Guardar Cambios</button>                            	
			                                		<button type="button" class="btn dark btn-outline pull-right" style="margin-right: 10px" data-dismiss="modal">Close</button>
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
   	</div>
</div>

 <script type="text/javascript" src="{{ URL::asset('metronic/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')}}"></script>
<script type="text/javascript" src="{{ URL::asset('metronic/scripts/table-datatables-managed.min.js')}}"></script>
<!-- BEGIN CREATE/EDIT PRODUCT (FORM) -->
<script>
function userEdit(act, uId, rId){

	
	/*$('#page-overlay').fadeIn('slow');*/

		
    url= "{{ url('expositor/admin/users/edit')}}"+"/"+uId;
    $.get(url, function(data){
    	console.log(data);

    });
    $('#action').val(act);
    if(act == 1)
    {
    	$('#user-modal-title').text('Crear Nuevo Producto');
    	
    }
    else
    {
    	$('#user-modal-title').text('Editar Producto');

    }
	$('#large').modal('show');

	/*$('#myModal').modal('hide');*/	
};	

</script>
<!-- END EDIT USER (FORM) -->