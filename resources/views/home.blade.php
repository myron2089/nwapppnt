@extends('frontend.layouts.app')
@section('css')
<link rel="stylesheet" href="{{ asset('metronic/css/select2/css/select2.min.css')}}" type="text/css" />
<link rel="stylesheet" href="{{ asset('metronic/css/select2/css/select2-bootstrap.min.css')}}" type="text/css" />

@endsection
@section('content')

<div class="row" style="margin-left: -20px; margin-right: -20px; margin-top: -25px;">

<!-- BEGIN IMAGE EVENT -->
<div class="event-image" style="background: url('{{url('images/montanas.jpg')}}') center center no-repeat; background-repeat: no-repeat; background-size: cover;  ">
    <div class="event-title">
        <h1>TÍTUTLO DEL EVENTO</h1>
    </div>
</div>
<!-- END IMAGE EVENT -->
 <!-- BEGIN TAB PORTLET-->
    <div class="portlet light bordered custom-sub-menu" style="margin-top: -10px;">
        <div class="portlet-title tabbable-line nopadding nomargin" id="tabs" style="margin-top: -12px">
            <div class="caption">
                <i class="fa fa-tasks font-dark"></i>
                <span class="caption-subject font-dark bold uppercase">Menú Evento</span>
            </div>
            <ul id="nav-tabs" class="nav nav-tabs custom-sub-menu-tabs">
                <li class="active">
                    <a href="#portlet_tab8" data-url="{{url('expositor/create/page')}}" data-toggle="tab"> Crear Página </a>
                </li>
                <li>
                    <a href="#portlet_tab7" data-url="{{url('expositor/admin/users')}}" data-toggle="tab"> Usuarios </a>
                </li>
                <li >
                    <a href="#portlet_tab6" data-toggle="tab"> Productos </a>
                </li>
                <li >
                    <a href="#portlet_tab5" data-toggle="tab"> Ofertas </a>
                </li>
                <li >
                    <a href="#portlet_tab4" data-toggle="tab"> Volantes </a>
                </li>
                <li >
                    <a href="#portlet_tab3" data-toggle="tab"> Correo </a>
                </li>
                <li >
                    <a href="#portlet_tab2" data-toggle="tab"> Notificaciones </a>
                </li>
                <li >
                    <a href="#portlet_tab1" data-toggle="tab"> Evento </a>
                </li>

            </ul>
        </div>

        <div class="portlet-body">
            <div class="tab-content">
                <div class="tab-pane active" id="portlet_tab1">
                    <p> Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent.
                        </p>
                    <div class="alert alert-warning">
                        <p> There is a known issue where the dropdown menu appears to be a clipping if it placed in tabbed content. By far there is no flaxible fix for this issue as per discussion here:
                            <a target="_blank" href="https://github.com/twitter/bootstrap/issues/3661">
                            https://github.com/twitter/bootstrap/issues/3661 </a>
                        </p>
                        <p> But you can check out the below dropdown menu. Don't worry it won't get chopped out by the tab content. Instead it will be opened as dropup menu </p>
                    </div>
                    <div class="btn-group">
                        <a class="btn purple" href="javascript:;" data-toggle="dropdown">
                            <i class="fa fa-user"></i> Settings
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu bottom-up">
                            <li>
                                <a href="javascript:;">
                                    <i class="fa fa-plus"></i> Add </a>
                            </li>
                            <li>
                                <a href="javascript:;">
                                    <i class="fa fa-trash-o"></i> Edit </a>
                            </li>
                            <li>
                                <a href="javascript:;">
                                    <i class="fa fa-times"></i> Delete </a>
                            </li>
                            <li class="divider"> </li>
                            <li>
                                <a href="javascript:;"> Full Settings </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="tab-pane" id="portlet_tab2">
                    <p> Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et
                        ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore
                        et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo. </p>
                    <p>
                        <a class="btn red" href="ui_tabs_accordions_navs.html#portlet_tab2" target="_blank"> Activate this tab via URL </a>
                    </p>
                </div>
                <div class="tab-pane" id="portlet_tab3">
                    <p> Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie
                        consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. </p>
                    <p>
                        <a class="btn blue" href="ui_tabs_accordions_navs.html#portlet_tab3" target="_blank"> Activate this tab via URL </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- END TAB PORTLET-->
</div>
@endsection
@section('scripts')

<script type="text/javascript" src="{{ URL::asset('metronic/scripts/horizontal-timeline/horizontal-timeline.js')}}"></script>

<script>
    jQuery(document).ready( function($) {
        $('#nav-tabs li a').click(function(event){
            var url = $(this).attr("data-url");
            Pace.restart();
             $.ajax({
                url : url, 
                success: function(data){  
                $("#portlet_tab1").html(data); 
                var url2 = "{{url('admin/events/getUserEvent')}}";
                 $('#itemName').select2({
                    multiple: true,
                 placeholder: 'Buscar correo',
                    ajax: {
                      url: url2,
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
                /*window.history.pushState('page2', 'Title', url);*/
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                } 
            });
        });     
    });


</script>
 <!-- BEGIN PAGE LEVEL SCRIPTS -->




@endsection
