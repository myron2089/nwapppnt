@extends('layouts.expositor.app')
@section('css')
<link rel="stylesheet" href="{{ asset('metronic/css/select2/css/select2.min.css')}}" type="text/css" />
<link rel="stylesheet" href="{{ asset('metronic/css/select2/css/select2-bootstrap.min.css')}}" type="text/css" />

@endsection
@section('content')

<div class="row" style="margin-left: -20px; margin-right: -20px; margin-top: -25px; overflow: hidden">

<!-- BEGIN IMAGE EVENT -->
<div class="event-image-container" id="event-image-container">
    <div class="blur-event-image" style="background: url('{{url('')}}/{{$background}}') center center no-repeat; background-repeat: no-repeat; background-size: cover;"></div>
    <img id="event-image" src="{{url('')}}/{{$background}}" height="100%">
    <div class="event-image-overlay">
        <div class="event-title">
        <h1>{{ $eventName }}</h1>
        <h3>{{ $eventDate }} {{ $eventTime }}  -  {{ $eventDateFinish }}  {{ $eventTimeFinish }} </h3>
    </div>
    </div>
</div>
<!-- END IMAGE EVENT -->
<section class="menu-section">
 @if($permissions!=5)
 <nav id='cssmenu'>
    <div class="logo"><a href="#" style="font-size: 15px"><i class="fa fa-user"></i> {{$typeName}}  @if($permissions != 1) <span style="font-size: 15px; display: block;"> {{$myCompany}}  @endif </span></a></div>
    <div id="head-mobile"></div>
    <div class="button"></div>
    <ul  id="nv-tabs">
         <li class="active"><a id="home-page" class="getHtml"  href="#" data-url="{{url('admin/event/homepage')}}/{{$eventId}}">Inicio</a><div class="bottom-line first"></div></li>


        @if($permissions==1)<li><a class="getHtml" id="btn-get-edit-data" href="#" data-url="{{url('admin/event/edit-data')}}/{{$eventId}}">Datos Evento</a><div class="bottom-line"></div></li>@endif


        @if($permissions==1) <li><a class="getHtml" href="#" data-url="{{url('admin/event/companies')}}/{{$eventId}}">Empresas</a><div class="bottom-line"></div></li> @endif
        @if($permissions==2) <li><a class="getHtml" href="#" data-url="{{url('admin/event/companies')}}/{{$eventId}}">Mi Empresa</a><div class="bottom-line"></div></li> @endif
        <!--@if($permissions==1) <li><a class="getHtml" href="#" data-url="{{url('admin/event/inventories')}}/{{$eventId}}">Inventario</a><div class="bottom-line"></div></li> @endif -->
        @if($permissions==1) <li><a class="getHtml" id="btn-get-webpage" href="#" data-url="{{url('admin/create/page')}}/{{$eventId}}">Página Web</a><div class="bottom-line"></div></li>@endif
        @if($permissions==1)<li><a class="getHtml" href="#" id="btn-get-sponsors" data-url="{{url('admin/events/sponsors')}}/{{$eventId}}">Patrocinadores</a><div class="bottom-line"></div></li> @endif
        @if($permissions == 1) <li><a class="getHtml" href="#" id="btn-get-sessions" data-url="{{url('admin/event/session')}}/{{$eventId}}">Actividades</a><div class="bottom-line"></div></li> @endif
       <!-- @if($permissions == 1 || $permissions == 2 )<li><a class="getHtml" href='#' id="btn-get-users" data-url="{{url('sponsor/admin/users')}}/{{$eventId}}">Usuarios</a><div class="bottom-line"></div></li> @endif -->
        @if($permissions == 1 || $permissions == 2 || $permissions == 3 )
        <li><a class="getHtml" href='#' data-url="{{url('admin/event/brands')}}/{{$eventId}}">Marcas</a><div class="bottom-line"></div></li>
        <li><a class="getHtml" href='#' id="btn-get-products" data-url="{{url('admin/event/products')}}/{{$eventId}}">Productos</a><div class="bottom-line"></div></li>
        @endif
        @if($permissions == 1 || $permissions == 2 || $permissions == 3 )<li><a class="getHtml" href='#' id="btn-get-offers" data-url="{{url('admin/event/offers')}}/{{$eventId}}">Ofertas</a><div class="bottom-line"></div></li>@endif
      <!--  @if($permissions == 1)<li><a class="getHtml" href='#' id="btn-get-visitors" data-url="{{url('admin/event/visitors')}}/{{$eventId}}">Visitantes</a><div class="bottom-line"></div></li>@endif-->
        <!--@if($permissions == 1)<li><a class="getHtml" href='#' data-url="{{url('all/mail')}}/{{$eventId}}">Correos</a><div class="bottom-line"></div></li>@endif -->
     <!--   @if($permissions == 1)<li><a class="getHtml" href='#' data-url="{{url('admin/notifications')}}">Notificaciones</a><div class="bottom-line last"></div></li>@endif -->
    </ul>

</nav>
@else
<div style="width: 100%; height: 100%; position: absolute; display: table;padding-left: 20px;">
 <p style="margin-left: 10px; margin-top: 30px; font-size: 16px; color: #c1c1c1; display: table-cell; vertical-align: middle;"><i class="fa fa-user"></i> {{$typeName}}</p>
</div>
 @endif
</section>
 <!-- BEGIN TAB PORTLET-->
<div id="event-info-container" class="portlet light bordered custom-sub-menu event-options-content" style="margin-top: 0px; position: relative;">

        <!--<div id="content-overlay" class="blockUI blockOverlay" style="z-index: 1000; border: none; margin: 0px; padding: 0px; width: 100%; height: 100%; top: 0px; left: 0px;     background: radial-gradient(at center center, rgba(0, 0, 0, 0.0) 0%, rgba(20, 20, 20, 0.4) 100%); opacity: 0.8; cursor: default; position: absolute; display: block; filter: blur(0em); ">
        </div> -->
        <div id="load-animation" class="blockUI blockMsg blockPage" style="z-index: 1011; position: absolute; display: none; padding: 0px; margin: 0px; width: 30%; top: 250px; left: 35%; text-align: center; color: rgb(0, 0, 0); border: 0px; cursor: default; opacity: 1; "><div class="loading-message loading-message-boxed" style="background: transparent; border: 0;"><img style=" border-radius: 100% !important; background-color: rgb(40, 40, 40);background-size: 100%;  width: 50px;height: 50px; position: relative; " src="{{url('metronic/images/loader.gif')}}" align=""><!--<span id="content-overlay-msg" style="padding-left: 10px; padding-right: 10px;   ">&nbsp;&nbsp;</span>--></div></div>




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

        <div class="portlet-body" style="margin-top: 0px;">
            <div class="tab-content">
                <div class="tab-pane active" id="portlet_tab1">

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

        getContent("{{url('admin/event/homepage')}}/{{$eventId}}");

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

            getContent(url);

        });


        function getContent(url){
            var eventId = <?php echo $eventId;   ?>;
            Pace.restart();
            var filterVal = 'blur(5px) grayscale(70%)';
            $('#content-overlay').fadeIn('slow');
            $('#load-animation').fadeIn('slow');
            $('#event-info-container').css('filter',filterVal)
                                      .css('webkitFilter',filterVal)
                                      .css('mozFilter',filterVal)
                                      .css('oFilter',filterVal)
                                      .css('msFilter',filterVal);

             $.ajax({
                url : url,

                success: function(data){
                $("#portlet_tab1").html(data);
                var url2 = "{{url('admin/events/getUserEvent')}}/"+"{{$eventId}}";
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
                statusCode: {
                        401: function() {
                            window.location.href = 'login'; //or what ever is your login URI
                        },
                    },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                alert("Status: " + textStatus); alert("Error: " + errorThrown);
                }

            });

             setTimeout(function(){
            $('#load-animation').fadeOut('slow');
             $('#content-overlay').fadeOut('slow');
             filterVal = 'blur(0em) grayscale(0%)';
             $('#event-info-container').css('filter',filterVal)
                                      .css('webkitFilter',filterVal)
                                      .css('mozFilter',filterVal)
                                      .css('oFilter',filterVal)
                                      .css('msFilter',filterVal);
            }, 1000);

        } /* End function getContent*/


    });


</script>


<script>
jQuery(document).ready( function($) {

    $('#nv-tabs li:last-child div').addClass('last');
});
</script>

<!-- Get the image average -->
<script>
    var rgb = getAverageRGB(document.getElementById('event-image'));
    back = document.getElementById('event-image-container');
    back.style.backgroundColor = 'rgb('+rgb.r+','+rgb.g+','+rgb.b+')';
    console.log(rgb);

function getAverageRGB(imgEl) {

    var blockSize = 5, // only visit every 5 pixels
        defaultRGB = {r:0,g:0,b:0}, // for non-supporting envs
        canvas = document.createElement('canvas'),
        context = canvas.getContext && canvas.getContext('2d'),
        data, width, height,
        i = -4,
        length,
        rgb = {r:0,g:0,b:0},
        count = 0;

    if (!context) {
        return defaultRGB;
    }

    height = canvas.height = imgEl.naturalHeight || imgEl.offsetHeight || imgEl.height;
    width = canvas.width = imgEl.naturalWidth || imgEl.offsetWidth || imgEl.width;

    context.drawImage(imgEl, 0, 0);

    try {
        data = context.getImageData(0, 0, width, height);
    } catch(e) {
        /* security error, img on diff domain */ //alert('x');
        return defaultRGB;
    }

    length = data.data.length;

    while ( (i += blockSize * 4) < length ) {
        ++count;
        rgb.r += data.data[i];
        rgb.g += data.data[i+1];
        rgb.b += data.data[i+2];
    }

    // ~~ used to floor values
    rgb.r = ~~(rgb.r/count);
    rgb.g = ~~(rgb.g/count);
    rgb.b = ~~(rgb.b/count);

    return rgb;

}


</script>



@endsection
