<div class="row">
	<div class="col-md-12">
		<div class="portlet light bordered">
	        <div class="portlet-title">
	            <div class="caption font-green-haze">
	                <i class="icon-settings font-green-haze"></i>
	                <span class="caption-subject bold uppercase"> Notificaciones</span>
	            </div>
	            <div class="actions">
	                <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
	            </div>
	        </div>
	        <div class="portlet-body form">
	        	<div class="row">
                    <div class="col-md-3 col-sm-3 col-xs-3">
                        <ul class="nav nav-tabs tabs-left">
                            <li class="">
                                <a href="#tab_6_1" data-toggle="tab" aria-expanded="false"> Crear </a>
                            </li>
                            <li class="">
                                <a href="#tab_6_2" data-toggle="tab" aria-expanded="false"> Enviadas </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-9">
                        <div class="tab-content">
                            <div class="tab-pane active in" id="tab_6_1">
                                <div class="col-md-12">
                                	<form role="form" class="form-horizontal">
						                <div class="form-body">
						                	<div class="form-group custom-form-group">
						                        <label class="col-md-1 control-label" for="form_control_1">Para</label>
						                        <div class="col-md-11">
						                            <div class="input-icon">
						                				<select id="mailDest" class="mailDest form-control" style="width:500px;" name="mailDest"></select>
						                			<div class="form-control-focus"> </div>
						                                
						                            </div>
						                        </div>
						                    </div>

						                    <div class="form-group custom-form-group">
						                        <label class="col-md-1 control-label" for="form_control_1">Mensaje</label>
						                        <div class="col-md-11">
						                            <div class="input-icon">
						                			<div class="form-control-focus"> </div>
						                    			<textarea class="form-control form-control-notify-text" id="notifyText" name="notifyText"></textarea>            
						                            </div>
						                        </div>
						                    </div>
						                    <button class="btn grey-cascade pull-right"><i class="fa fa-paper-plane"> </i> Enviar</button>
						                </div>
	                    					
						                
                                </div>

                            </div>
                            <div class="tab-pane fade" id="tab_6_2">
                                <div class="col-xl-12 col-md-12 col-sm-12 message-list ">
                                	<table id="message-sent" class="table table-hover">
                                		<thead>
                                			<tr>
                                            	<!--<th>Id</th>-->
                                            	<th>Mensaje</th>
                                            <tr>
                                		</thead>
                                		<tbody>
                                			<tr>
                                				<td>
                                					<div class="col-md-12" style="margin:0; padding:0">
                                						<div class="col-md-8 message-body-prev">
                                							<p>Este es un mensaje enviado desde la aplicación networkingapp</p>
                                						</div>
                                						<div class="col-md-4 message-date-prev">
                                							20/11/2017
                                						</div>
                                					</div>
                                				</td>
                                			</tr>
                                		</tbody>
                                	</table>
                                </div>

                                <div class="col-xl-12 col-sm-12 col-xs-12 message-body">


                                </div>
                            </div>
                        </div>
                    </div>
                </div>

	        </div> <!-- End portlet-body -->
	    </div> <!-- End portlet -->
	</div> <!-- End col-md-12 -->
</div> <!-- End row -->


<script>
 jQuery(document).ready( function($) {	
	$('#mailDest').select2({
	    multiple: true,
	    placeholder: 'Buscar número de teléfono, nombre o correo electrónico',
	    ajax: {
	      url: "{{ url('/admin/users/assearch') }}",
	      dataType: 'json',
	      delay: 250,
	      processResults: function (data) {
	        return {
	          results:  $.map(data, function (item) {
	          
	                return {
	                    text: item.userEmail,
	                    id: item.id
	                }
	            })
	        };
	      },
	      cache: true
	    }
	});
});
</script>