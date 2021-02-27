<div class="row" style="padding-top: 20px">
    <div class="col-md-12">
    	<table class="table table-striped  table-hover  order-column" id="sample_1">
            <thead>
                <tr>
                    <!--<th>
                        <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                            <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" />
                            <span></span>
                        </label>
                    </th>-->
                    <th >Id</th>
                    <th> Nombre del Campo </th>
                    <th> Tipo de Campo</th>
                    <th> Tipo de Dato </th>
                    <th> Sección </th>
                    <th> Acción </th> 
                   
                </tr>
            </thead>
            <tbody>
                 @foreach($fields as $field)

                <tr class="odd gradeX">
                  <!--  <td>
                        <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                            <input type="checkbox" class="checkboxes" value="1" />
                            <span></span>
                        </label>
                    </td> -->
                    <td>{{$field->ID}}</td>
                    <td class="font-weight-bold" > <strong>{{$field->NAME}}</strong> </td>
                    <td>
                        {{$field->CONTROL}}
                    </td>
                    <td>
                       {{$field->DATATYPE}}
                    </td>
                    <td class="center"> {{$field->SECTION}} </td>
                    <td>
                        <button class="btn btn-xs btn-default sweet-8"><i class="fa fa-trash"></i> Eliminar</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>


    </div> <!--end col-md-12  -->
</div> <!--end row  -->



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
            "lengthMenu": "Mostrar _MENU_ campos por página",
            "zeroRecords": "Nothing found - sorry",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "No records available",
            "search": "Buscar",
            "infoEmpty": "No hay registros disponibles",
            "zeroRecords": "No existen campos creados para este tipo de usuario",
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