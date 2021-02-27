<div class="row">

    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="icon-envelope font-dark"></i>
                    <span class="caption-subject bold uppercase"> Administración de Correo Electrónico</span>
                </div>
                <!--<div class="actions">
                    <div class="btn-group btn-group-devided" data-toggle="buttons">
                        <label class="btn btn-transparent dark btn-outline btn-circle btn-sm active">
                            <input type="radio" name="options" class="toggle" id="option1">Actions</label>
                        <label class="btn btn-transparent dark btn-outline btn-circle btn-sm">
                            <input type="radio" name="options" class="toggle" id="option2">Settings</label>
                    </div>
                </div>-->
            </div>
            <div class="portlet-body">
                <div class="create-mail-overlay">
                    <div class="create-mail-container">
                        <div class="create-mail-title">
                             <span> Nuevo Mensaje </span> <button id="btn-close-create-mail" type="button" class="close" aria-hidden="true">X</button>
                        </div>
                        <div class="create-mail-body">
                            <form>
                                {{ csrf_field() }}
                            <div class="mail-to">
                                <select id="mailRecipient" class="form-control form-control-mail" style="width:100%;" name="mailRecipient"></select>
                            </div>
                            <div class="mail-subject">
                             <input id="mailSubject" class="form-control form-control-mail" style="width:100%;" name="mailRecipient" placeholder="Asunto">
                            </div>
                            <div class="col-md-12" style="margin: 0; padding: 0; max-height: 400px">
                                <div name="summernote" id="summernote_2"> </div>
                            </div>
                            <div class="col-md-12">
                                <button id="btn-send-mail" class="btn grey-cascade pull-right">Enviar</button>
                            </div>
                            </form>
                        </div>
                       
                    </div>
                </div>
                <div class="table-toolbar">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="btn-group">
                                <button id="btn-new-mail" class="btn sbold green"> Crear Correo
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                     <!--   <div class="col-md-6">
                            <div class="btn-group pull-right">
                                <button class="btn green  btn-outline dropdown-toggle" data-toggle="dropdown">Tools
                                    <i class="fa fa-angle-down"></i>
                                </button>
                                <ul class="dropdown-menu pull-right">
                                    <li>
                                        <a href="javascript:;">
                                            <i class="fa fa-print"></i> Print </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <i class="fa fa-file-pdf-o"></i> Save as PDF </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <i class="fa fa-file-excel-o"></i> Export to Excel </a>
                                    </li>
                                </ul>
                            </div>
                        </div> -->
                    </div>
                </div>

                <table class="table table-striped  table-hover  order-column" id="sample_1">
                    <thead>
                        <tr>
                            <!--<th>
                                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                    <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" />
                                    <span></span>
                                </label>
                            </th>-->
                            <th  >Id</th>
                            <th > Asunto </th>
                            <th> Destinatario(s) </th>
                            <th> Mensaje </th>
                            <th> Fecha de Envío </th>
                            <th> Acción </th> 
                           
                        </tr>
                    </thead>
                    <tbody>
                         @foreach($mails as $mail)

                        <tr class="odd gradeX">
                          <!--  <td>
                                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                    <input type="checkbox" class="checkboxes" value="1" />
                                    <span></span>
                                </label>
                            </td> -->
                            <td>{{$mail->ID}}</td>
                            <td class="font-weight-bold" > <strong>{{$mail->SUBJECT}}</strong> </td>
                            <td>
                                {{$mail->DESTINATIONS}}
                            </td>
                            <td>
                               {{$mail->BODY}}
                            </td>
                            <td class="center"> {{$mail->DATE}} </td>
                            <td>
                                <button class="btn btn-xs btn-default sweet-8"><i class="fa fa-trash"></i> Eliminar</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>


  <!--  <div class="tabbable-custom nav-justified">
        <ul class="nav nav-tabs nav-justified">
            <li class="">
                <a href="#tab_1_1_1" data-toggle="tab" aria-expanded="false"> Redactar </a>
            </li>
            <li class="active">
                <a href="#tab_1_1_2" data-toggle="tab" aria-expanded="true"> Enviados </a>
            </li>
           
        </ul>
        <div class="tab-content">
            <div class="tab-pane" id="tab_1_1_1">
               <form role="form" class="form-horizontal">
                    <div class="form-body">
                        <div class="form-group form-md-line-input has-danger">
                            <label class="col-md-1 control-label" for="form_control_1">Para</label>
                            <div class="col-md-11">
                                <div class="input-icon">
                                    <select id="mailRecipient" class="form-control form-control-mail" style="width:100%;" name="mailRecipient"></select>
                                <div class="form-control-focus"> </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="form-group form-md-line-input has-danger">
                            <label class="col-md-1 control-label" for="form_control_1">Asunto</label>
                            <div class="col-md-11">
                                <div class="input-icon">
                                    <input id="mailSubject" name="mailSubject" type="text" class="form-control" placeholder="Ingrese el asunto">
                                    <div class="form-control-focus"> </div>
                                    
                                    
                                </div>
                            </div>
                        </div>
                        <div name="summernote" id="summernote_1"> </div>
                        <button class="btn grey-cascade pull-right">Enviar</button>
                    </div>
                </form>


            </div>
            <div class="tab-pane active" id="tab_1_1_2">
                <p> Howdy, I'm in Section 2. </p>
                <p> Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie
                    consequat. Ut wisi enim ad minim veniam, quis nostrud exerci tation. </p>
                <p>
                    <a class="btn green" href="ui_tabs_accordions_navs.html#tab_1_1_2" target="_blank"> Activate this tab via URL </a>
                </p>
            </div>
           
        </div>
    </div>  -->    


</div>
       <script src="{{ URL::asset('metronic/scripts/datatable.js')}}"></script>
       <script src="{{ URL::asset('metronic/global/plugins/datatables/datatables.min.js')}}"></script>
       <script src="{{ URL::asset('metronic/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')}}"></script>
      <!-- <script src="{{ URL::asset('metronic/scripts/table-datatables-managed.min.js')}}"></script> -->

       <script type="text/javascript" src="{{ URL::asset('metronic/scripts/components-editors.min.js')}}"></script>


<script>
    
jQuery(document).ready( function($) {
 myTable =   $('#sample_1').DataTable( {
         responsive: true,
         
         "language": {
            "lengthMenu": "Mostrar _MENU_ correos por página",
            "zeroRecords": "Nothing found - sorry",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "No records available",
            "search": "Buscar",
            "infoEmpty": "No hay registros disponibles",
            "zeroRecords": "No se han encontrado correos",
            "infoFiltered": "(filtrados de _MAX_ registros)",
            paginate:{previous:"Anterior",next:"Next",
            last:"Last",first:"First"}
        },
        columnDefs: [ {
            targets: 2,
            render: function ( data, type, row ) {
                return data.length > 50 ?
                    data.substr( 0, 50 ) +'…' :
                    data;
                }
            }, { "bVisible": false, "aTargets": [ 0 ] }
            
        ]
    } );
});
</script>

<!-- SEARCH ADDRESSEES FOR EMAIL -->

<script>
jQuery(document).ready( function($) {
	 
$('#mailRecipient').select2({
    multiple: true,
    placeholder: 'Destinatario (s)',
    ajax: {
      url: "{{url('admin/events/getUserFromEvent')}}",
      dataType: 'json',
      data: function (params) {
      var query = {
        q: params.term,
        evId: "{{ $eventId }}",
        
      }
       return query;
        },
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
      cache: false
    }
});

$('.select2-container--bootstrap .select2-selection').css('border', '0');

 $('#summernote_2').summernote({
        placeholder: 'Hello stand alone ui',
        tabsize: 2,
        height: 150,
        toolbar: false,
        disableResizeEditor: true,
      });
 $('.panel-default').css({'float':'left', 'width': '100%'});
});	
</script>
<!-- Create mail button -->
<script>
jQuery(document).ready( function($) {
 

  $('#btn-new-mail').click(function(event){  
     $("#mailRecipient").select2("val", "");

    $('.create-mail-overlay').fadeIn();
  
        $('.create-mail-overlay').addClass('create-mail-overlay-unscaled')
   
  });

  /*Close email windows*/

  $('#btn-close-create-mail').click(function(event){ 
     $('.create-mail-overlay').removeClass('create-mail-overlay-unscaled');
     setTimeout(function(){
        $('.create-mail-overlay').fadeOut();
    }, 1);
  });


  /*Send email button*/
   $('#btn-send-mail').click(function(event){
    event.preventDefault();
        var errors = 0;
        var countRec = $("#mailRecipient").select2('data').length;
        var recipients =$("#mailRecipient").select2("val");
        var subject = $("#mailSubject").val();
        var body = $('#summernote_2').summernote('code');
       
        if($("#mailRecipient").select2("val") == null){
            errors = 1;
        }
        if(!$.trim(subject).length) {
             errors =2;
        }
        if(body == null) {
             errors =3;
        }

        //console.log(errors);
        if(errors <= 0){
            $('#content-overlay-msg').text('Enviando Correo...');
            $('#content-overlay').fadeIn('slow');
            
            $.ajax({
              type: "POST",
              url: "{{url('email/send')}}",
              data: {Recipients: recipients , Subject: subject, Body: body},
              success: function (data) {
                //console.log(data);
                var t = $('#sample_1').DataTable();
                t.row.add( [
                    data.notId,
                    data.subject,
                    data.mails,
                    data.message,
                    data.date,
                    '<button class="btn btn-xs btn-default sweet-8"><i class="fa fa-trash"></i> Eliminar</button>'
                ] ).draw( false );
                $('.create-mail-overlay').removeClass('create-mail-overlay-unscaled');
                
                $("#mailRecipient").select2("val", "");
                $("#mailSubject").val("");
                $("#summernote_2").summernote('code', '');
                     setTimeout(function(){
                        $('.create-mail-overlay').fadeOut();
                    }, 1);
              }
            });

        }
       
        
        
        
       



       


        setTimeout(function(){
            $('#content-overlay').fadeOut('slow');
        }, 3000);
   });  


});
</script>

<!-- DELETE EMAIL -->
<script>
jQuery(document).ready( function($) { 
    $("body").on("click", ".sweet-8", function() {
        var row = $(this).parent().parent();
        var sId = myTable.cell(index,0).data();
        var index = $(this).closest('tr').index();


         swal({
          title: "Confirmar",
          text: "Está seguro de eliminar el correo?",
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          confirmButtonClass: "btn-danger",
          confirmButtonText: "Eliminar",
          closeOnConfirm: false,
          showLoaderOnConfirm: true

        }
        ,
        
        function(isConfirm){
            if (isConfirm) {
                
                $.ajax({
                    url: "{{ url('admin/email/delete/')}}/"+sId,
                    type: 'delete', // replaced from put
                    dataType: "JSON",
                    data: {
                        "id": sId // method and token not needed in data
                    },
                    success: function (response)
                    {
                        if(response.status == 'success'){
                            setTimeout(function () {
                                row.remove();
                                swal("Eliminado!", response.message, "success");
                                if (tablebody.children().length == 0) {
                                    tablebody.html("<tr class='table-empty'><td colspan='5' class='text-center'>No existen correos enviados</td></tr>");
                                }
                            }, 1000);
                        }
                        else{
                            console.log(response);
                        }
                                                
                    },
                    error: function(xhr) {
                     console.log(xhr.responseText); // this line will save you tons of hours while debugging
                    // do something here because of error
                   }
                });    
            }
        });
    });
});

</script>
