@extends('layouts.expositor.app')
@section('css')
<link rel="stylesheet" href="{{ asset('metronic/css/select2/css/select2.min.css')}}" type="text/css" />
<link rel="stylesheet" href="{{ asset('metronic/css/select2/css/select2-bootstrap.min.css')}}" type="text/css" />

@endsection
@section('content')

<div class="row" style="margin-left: -20px; margin-right: -20px; margin-top: -25px;">

<!-- BEGIN IMAGE EVENT -->
<div class="event-image" style="background: url('{{url('images/montanas.jpg')}}') center center no-repeat; background-repeat: no-repeat; background-size: cover;  ">
    
    <div class="event-image-overlay">
        <div class="event-title">
        <h1>{{ $event_name }}</h1>
        <h3>{{ $event_date }} - {{ $event_hour }} | </h3>
    </div>
    </div>
</div>
<!-- END IMAGE EVENT -->

 <!-- BEGIN TAB PORTLET-->
    <div class="portlet light bordered custom-sub-menu" style="margin-top: -10px; position: relative">
        <div id="content-overlay" class="blockUI blockOverlay" style="z-index: 1000; border: none; margin: 0px; padding: 0px; width: 100%; height: 100%; top: 0px; left: 0px; background-color: rgb(52, 52, 52); opacity: 0.8; cursor: default; position: absolute; display: none">
            <div class="blockUI blockMsg blockPage" style="z-index: 1011; position: absolute; padding: 0px; margin: 0px; width: 30%; top: 250px; left: 35%; text-align: center; color: rgb(0, 0, 0); border: 0px; cursor: default; opacity: 0.95;">
                <div class="loading-message loading-message-boxed"><img src="{{url('metronic/images/loading-spinner-grey.gif')}}" align=""><span id="content-overlay-msg" style="padding-left: 10px; padding-right: 10px">&nbsp;&nbsp;Cargando</span>
                </div>
            </div>

            <div id="loader-wrapper">
                <div id="loader"></div>
                <div class="loader-section  section-left"></div>
                <div class="loader-section  section-right"></div>
            </div> <!-- End loader-wrapper -->

        </div>

  <!--      <div id="page-menu" class="no-sticky" style="margin-top:-1px !important">
    <div id="page-menu-wrap" class="parent-menu">
        <div class="container clearfix" style="width: 98% !important; margin: 0 auto !important;">
            <div class="menu-title"> <i class="fa fa-tasks font-dark"></i> MENÚ <span>EVENTO</span></div>
            <nav> <!-- class="custom-filter" 
                <ul data-active-class="current">
                    <li><a href="http://omegafamilygenetics.com/public/searchprofile" data-filter=".pf-icons"></i>Crear Página</a> <div class="bottom-line first"></div></li>
                    <li><a href="http://omegafamilygenetics.com/public/show-favorites"></i>Horarios</a><div class="bottom-line"></div></li>
                    <li><a href="http://omegafamilygenetics.com/public/app/search"></i>Usuarios</a><div class="bottom-line"></div></li>
                    <li><a href="http://omegafamilygenetics.com/public/logout">Productos</a><div class="bottom-line"></div></li>
                    <li><a href="http://omegafamilygenetics.com/public/searchprofile" data-filter=".pf-icons"></i>Ofertas</a> <div class="bottom-line"></div></li>
                    <li><a href="http://omegafamilygenetics.com/public/show-favorites"></i>Visitantes</a><div class="bottom-line"></div></li>
                    <li><a href="http://omegafamilygenetics.com/public/app/search"></i>Correo</a><div class="bottom-line"></div></li>
                    <li><a href="http://omegafamilygenetics.com/public/logout">Notificaciones</a><div class="bottom-line last"></div></li>
                </ul>
            </nav>
            <div id="page-submenu-trigger"><i class="fa fa-reorder"></i></div>
        </div>
    </div>
</div> -->

<section class="menu-section">
<nav id='cssmenu'>
    <div class="logo"><a href="index.html">MENÚ EVENTO</a></div>
    <div id="head-mobile"></div>
    <div class="button"></div>
    <ul  id="nv-tabs">
        <li class="active"><a class="getHtml" href="#portlet_tab8" data-url="{{url('expositor/create/page')}}">Crear Página</a><div class="bottom-line first"></div></li>
        <li><a href="#portlet_tab8" data-url="{{url('expositor/create/schedule')}}">Horarios</a><div class="bottom-line"></div></li>
        <li><a class="getHtml" href='#' data-url="{{url('sponsor/admin/users')}}">Usuariosa</a><div class="bottom-line"></div></li>
        <li><a class="getHtml" href='#' data-url="{{url('expositor/admin/products')}}">Productos</a><div class="bottom-line"></div></li>
        <li><a class="getHtml" href='#'>Ofertas</a><div class="bottom-line"></div></li>
        <li><a class="getHtml" href='#'>Visitantes</a><div class="bottom-line"></div></li>
        <li><a class="getHtml" href='#' data-url="{{url('all/mail')}}">Correos</a><div class="bottom-line"></div></li>
        <li><a class="getHtml" href='#'>Notificaciones</a><div class="bottom-line last"></div></li>
    </ul>
</nav>
</section> 

       <!--  <div class="portlet-title tabbable-line nopadding nomargin" id="tabs" style="margin-top: 10px">
            <div class="caption">
                <i class="fa fa-tasks font-dark"></i>
                <span class="caption-subject font-dark bold uppercase">Menú Evento</span>
            </div>
           <ul id="nav-tabs" class="nav nav-tabs custom-sub-menu-tabs">
                <li class="active">
                    <a href="#portlet_tab8" data-url="{{url('expositor/create/page')}}" data-toggle="tab"> Crear Página </a>
                </li>
                <li class="">
                    <a href="#portlet_tab8" data-url="{{url('expositor/create/schedule')}}" data-toggle="tab"> Horarios</a>
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
                    <a href="#portlet_tab4" data-toggle="tab"> Visitantes </a>
                </li>
                <li >
                    <a href="#portlet_tab3" data-toggle="tab"> Correo </a>
                </li>
                <li >
                    <a href="#portlet_tab2" data-toggle="tab"> Notificaciones </a>
                </li>
            </ul> 
        </div>-->

        <div class="portlet-body" style="margin-top: 65px;">
            <div class="tab-content">
                <div class="tab-pane active" id="portlet_tab1">
                    <div class="row">
                        <div class="col-md-12">
                            
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption font-green-haze">
                                        <i class="icon-settings font-green-haze"></i>
                                        <span class="caption-subject bold uppercase"> Datos del Evento</span>
                                    </div>
                                    <!--<div class="actions">
                                        <a class="btn btn-circle btn-icon-only blue" href="javascript:;">
                                            <i class="icon-cloud-upload"></i>
                                        </a>
                                        <a class="btn btn-circle btn-icon-only green" href="javascript:;">
                                            <i class="icon-wrench"></i>
                                        </a>
                                        <a class="btn btn-circle btn-icon-only red" href="javascript:;">
                                            <i class="icon-trash"></i>
                                        </a> 
                                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
                                    </div>-->
                                </div>
                                <div class="portlet-body form">
                                </div>
                            </div>
                        </div>
                    </div>

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
        $('.getHtml').click(function(event){
            var mainmenu = $('#nv-tabs');
            var mediasize = 1000;
            $( "#nv-tabs" ).find( "li.active" ).removeClass('active');
            $(this).parent().addClass('active');

             if ($(window).width() <= mediasize) {
                $('#cssmenu .button').toggleClass('menu-opened');
                mainmenu.slideToggle().removeClass('open');
             }

            var url = $(this).attr("data-url");
            Pace.restart();
            $('#content-overlay').fadeIn('slow');
             $.ajax({
                url : url, 
                success: function(data){  
                $("#portlet_tab1").html(data); 
                var url2 = "{{url('admin/events/getUserEvent')}}";
                 $('#itemName').select2({
                    multiple: false,
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
             $('#content-overlay').fadeOut('slow');
        });     
    });


</script>





@endsection
