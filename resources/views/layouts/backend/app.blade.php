<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.7
Version: 4.7.5
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
Renew Support: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
    	<meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">

	    <!-- CSRF Token -->
        <meta name="_token" content="{!! csrf_token() !!}"/>
	    <title>{{ config('app.name', 'Dashboard') }}</title>
	    
	    <!-- BEGIN PAGE FIRST SCRIPTS -->
        <script type="text/javascript" src="{{ URL::asset('metronic/css/pace/pace.min.js')}}"></script>
        <!-- END PAGE FIRST SCRIPTS -->
        <!-- BEGIN PAGE TOP STYLES -->
        <link rel="stylesheet" href="{{ asset('metronic/css/pace/themes/pace-theme-flash.css')}}" type="text/css" />
        <!-- END PAGE TOP STYLES -->

	    <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="{{ asset('metronic/css/font-awesome/font-awesome.min.css')}}" type="text/css" />
        <link rel="stylesheet" href="{{ asset('metronic/css/simple-line-icons/simple-line-icons.min.css')}}" type="text/css" />
        <link rel="stylesheet" href="{{ asset('metronic/css/bootstrap/css/bootstrap.min.css')}}" type="text/css" />
        <link rel="stylesheet" href="{{ asset('metronic/css/bootstrap-switch/css/bootstrap-switch.min.css')}}" type="text/css" />

      
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->

        <link rel="stylesheet" href="{{ asset('metronic/css/bootstrap-daterangepicker/daterangepicker.min.css')}}" type="text/css" />
        <link rel="stylesheet" href="{{ asset('metronic/css/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" type="text/css" />
        <link rel="stylesheet" href="{{ asset('metronic/css/bootstrap-timepicker/css/bootstrap-timepicker.min.css')}}" type="text/css" />
        <link rel="stylesheet" href="{{ asset('metronic/css/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css')}}" type="text/css" />
        <link rel="stylesheet" href="{{ asset('metronic/css/morris/morris.css')}}" type="text/css" />
        <link rel="stylesheet" href="{{ asset('metronic/css/fullcalendar/fullcalendar.min.css')}}" type="text/css" />
        <link rel="stylesheet" href="{{ asset('metronic/css/jqvmap/jqvmap/jqvmap.css')}}" type="text/css" />
        <link rel="stylesheet" href="{{ asset('metronic/global/plugins/bootstrap-sweetalert/sweetalert.css')}}" type="text/css" />
        <link rel="stylesheet" href="{{ asset('metronic/global/plugins/ladda/ladda-themeless.min.css')}}" type="text/css" />
        
        <link rel="stylesheet" href="{{ asset('metronic/css/dropzone.css')}}" type="text/css" />
        <link rel="stylesheet" href="{{ asset('metronic/css/search.min.css')}}" type="text/css" />

        <link rel="stylesheet" href="{{ asset('metronic/global/plugins/select2/css/select2.min.css')}}" type="text/css" />
        <link rel="stylesheet" href="{{ asset('metronic/global/plugins/select2/css/select2-bootstrap.min.css')}}" type="text/css" />

        <link rel="stylesheet" href="{{ asset('metronic/global/plugins/icheck/skins/all.css')}}" type="text/css" />

        <link rel="stylesheet" href="{{ asset('metronic/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')}}" type="text/css" />
        <link rel="stylesheet" href="{{ asset('metronic/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput-typeahead.css')}}" type="text/css" />

        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <link rel="stylesheet" href="{{ asset('metronic/global/plugins/fancybox/source/jquery.fancybox.css')}}" type="text/css" />

        <link href="{{ asset('metronic/css/draggable.css')}}" rel="stylesheet" type="text/css"/>  

        <link rel="stylesheet" href="{{ asset('metronic/global/plugins/bootstrap-summernote/summernote.css')}}" type="text/css" />
        <link rel="stylesheet" href="{{ asset('metronic/global/plugins/datatables/datatables.min.css')}}" type="text/css" />
        <link rel="stylesheet" href="{{ asset('metronic/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')}}" type="text/css" />

        <link rel="stylesheet" href="{{ asset('metronic/global/plugins/bootstrap-select/css/bootstrap-select.css')}}" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link rel="stylesheet" href="{{ asset('metronic/css/components.min.css')}}" type="text/css" />
        <link rel="stylesheet" href="{{ asset('metronic/css/plugins.min.css')}}" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link rel="stylesheet" href="{{ asset('metronic/css/layout/css/layout.min.css')}}" type="text/css" />
        <link rel="stylesheet" href="{{ asset('metronic/css/layout/css/themes/darkblue.min.css')}}" type="text/css" />
        <link rel="stylesheet" href="{{ asset('metronic/css/layout/css/custom.min.css')}}" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->

        <!-- My style -->
        <link href="{{ asset('metronic/css/custom-style.css') }}"  rel="stylesheet">
        <!-- EVENT SUBMENU STYLE -->
        <link href="{{ asset('metronic/css/submenu-style.css') }}" rel="stylesheet">
        
	    <!-- Styles -->
	    @yield('css')
	</head>
	 <!-- END HEAD -->

    <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">

    	<div id="page-overlay" class="blockUI blockOverlay" style="z-index: 1000; border: none; margin: 0px; padding: 0px; width: 100%; height: 100%; top: 0px; left: 0px; background-color: rgb(52, 52, 52); opacity: 0.8; cursor: default; position: fixed; display: none"><div class="blockUI blockMsg blockPage" style="z-index: 1011; position: fixed; padding: 0px; margin: 0px; width: 30%; top: 40%; left: 35%; text-align: center; color: rgb(0, 0, 0); border: 0px; cursor: default; opacity: 0.95;"><div class="loading-message loading-message-boxed"><img src="{{url('metronic/images/loading-spinner-grey.gif')}}" align=""><span id="overlay-msg" style="padding-left: 10px; padding-right: 10px">&nbsp;&nbsp;Guardando Datos...</span></div></div>
		</div>

        <div class="page-wrapper">
            <!-- BEGIN HEADER -->
            <div class="page-header navbar navbar-fixed-top">
                <!-- BEGIN HEADER INNER -->
                <div class="page-header-inner ">
                    <!-- BEGIN LOGO -->
                    <div class="page-logo">
                        <a href="{{url('expositor/main')}}">
                            <img src="{{ url('images/icons/nw-icon.svg')}}" alt="NWApp Logo" class="logo-default" width="50" style="margin-top: 5px; margin-left: -15px;" /> </a>
                        <div class="menu-toggler sidebar-toggler">
                            <span></span>
                        </div>
                    </div>
                    <!-- END LOGO -->
                    <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                    <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
                        <span></span>
                    </a>
                    <!-- END RESPONSIVE MENU TOGGLER -->
                    <!-- BEGIN TOP NAVIGATION MENU -->
                    <div class="top-menu">
                        <ul class="nav navbar-nav pull-right">
                            <!-- BEGIN NOTIFICATION DROPDOWN -->
                            <!-- DOC: Apply "dropdown-dark" class after "dropdown-extended" to change the dropdown styte -->
                            <!-- DOC: Apply "dropdown-hoverable" class after below "dropdown" and remove data-toggle="dropdown" data-hover="dropdown" data-close-others="true" attributes to enable hover dropdown mode -->
                            <!-- DOC: Remove "dropdown-hoverable" and add data-toggle="dropdown" data-hover="dropdown" data-close-others="true" attributes to the below A element with dropdown-toggle class -->
                          <!--  <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <i class="icon-bell"></i>
                                    <span class="badge badge-default"> 7 </span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="external">
                                        <h3>
                                            <span class="bold">12 pending</span> notifications</h3>
                                        <a href="page_user_profile_1.html">view all</a>
                                    </li>
                                    <li>
                                        <ul class="dropdown-menu-list scroller" style="height: 250px;" data-handle-color="#637283">
                                            <li>
                                                <a href="javascript:;">
                                                    <span class="time">just now</span>
                                                    <span class="details">
                                                        <span class="label label-sm label-icon label-success">
                                                            <i class="fa fa-plus"></i>
                                                        </span> New user registered. </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <span class="time">3 mins</span>
                                                    <span class="details">
                                                        <span class="label label-sm label-icon label-danger">
                                                            <i class="fa fa-bolt"></i>
                                                        </span> Server #12 overloaded. </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <span class="time">10 mins</span>
                                                    <span class="details">
                                                        <span class="label label-sm label-icon label-warning">
                                                            <i class="fa fa-bell-o"></i>
                                                        </span> Server #2 not responding. </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <span class="time">14 hrs</span>
                                                    <span class="details">
                                                        <span class="label label-sm label-icon label-info">
                                                            <i class="fa fa-bullhorn"></i>
                                                        </span> Application error. </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <span class="time">2 days</span>
                                                    <span class="details">
                                                        <span class="label label-sm label-icon label-danger">
                                                            <i class="fa fa-bolt"></i>
                                                        </span> Database overloaded 68%. </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <span class="time">3 days</span>
                                                    <span class="details">
                                                        <span class="label label-sm label-icon label-danger">
                                                            <i class="fa fa-bolt"></i>
                                                        </span> A user IP blocked. </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <span class="time">4 days</span>
                                                    <span class="details">
                                                        <span class="label label-sm label-icon label-warning">
                                                            <i class="fa fa-bell-o"></i>
                                                        </span> Storage Server #4 not responding dfdfdfd. </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <span class="time">5 days</span>
                                                    <span class="details">
                                                        <span class="label label-sm label-icon label-info">
                                                            <i class="fa fa-bullhorn"></i>
                                                        </span> System Error. </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <span class="time">9 days</span>
                                                    <span class="details">
                                                        <span class="label label-sm label-icon label-danger">
                                                            <i class="fa fa-bolt"></i>
                                                        </span> Storage server failed. </span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li> -->
                            <!-- END NOTIFICATION DROPDOWN -->
                            <!-- BEGIN INBOX DROPDOWN -->
                            <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                        <!--    <li class="dropdown dropdown-extended dropdown-inbox" id="header_inbox_bar">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <i class="icon-envelope-open"></i>
                                    <span class="badge badge-default"> 4 </span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="external">
                                        <h3>You have
                                            <span class="bold">7 New</span> Messages</h3>
                                        <a href="app_inbox.html">view all</a>
                                    </li>
                                    <li>
                                        <ul class="dropdown-menu-list scroller" style="height: 275px;" data-handle-color="#637283">
                                            <li>
                                                <a href="#">
                                                    <span class="photo">
                                                        <img src="../assets/layouts/layout3/img/avatar2.jpg" class="img-circle" alt=""> </span>
                                                    <span class="subject">
                                                        <span class="from"> Lisa Wong </span>
                                                        <span class="time">Just Now </span>
                                                    </span>
                                                    <span class="message"> Vivamus sed auctor nibh congue nibh. auctor nibh auctor nibh... </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <span class="photo">
                                                        <img src="../assets/layouts/layout3/img/avatar3.jpg" class="img-circle" alt=""> </span>
                                                    <span class="subject">
                                                        <span class="from"> Richard Doe </span>
                                                        <span class="time">16 mins </span>
                                                    </span>
                                                    <span class="message"> Vivamus sed congue nibh auctor nibh congue nibh. auctor nibh auctor nibh... </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <span class="photo">
                                                        <img src="../assets/layouts/layout3/img/avatar1.jpg" class="img-circle" alt=""> </span>
                                                    <span class="subject">
                                                        <span class="from"> Bob Nilson </span>
                                                        <span class="time">2 hrs </span>
                                                    </span>
                                                    <span class="message"> Vivamus sed nibh auctor nibh congue nibh. auctor nibh auctor nibh... </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <span class="photo">
                                                        <img src="../assets/layouts/layout3/img/avatar2.jpg" class="img-circle" alt=""> </span>
                                                    <span class="subject">
                                                        <span class="from"> Lisa Wong </span>
                                                        <span class="time">40 mins </span>
                                                    </span>
                                                    <span class="message"> Vivamus sed auctor 40% nibh congue nibh... </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <span class="photo">
                                                        <img src="../assets/layouts/layout3/img/avatar3.jpg" class="img-circle" alt=""> </span>
                                                    <span class="subject">
                                                        <span class="from"> Richard Doe </span>
                                                        <span class="time">46 mins </span>
                                                    </span>
                                                    <span class="message"> Vivamus sed congue nibh auctor nibh congue nibh. auctor nibh auctor nibh... </span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li> -->
                            <!-- END INBOX DROPDOWN -->
                            <!-- BEGIN TODO DROPDOWN -->
                            <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                         <!--   <li class="dropdown dropdown-extended dropdown-tasks" id="header_task_bar">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <i class="icon-calendar"></i>
                                    <span class="badge badge-default"> 3 </span>
                                </a>
                                <ul class="dropdown-menu extended tasks">
                                    <li class="external">
                                        <h3>You have
                                            <span class="bold">12 pending</span> tasks</h3>
                                        <a href="app_todo.html">view all</a>
                                    </li>
                                    <li>
                                        <ul class="dropdown-menu-list scroller" style="height: 275px;" data-handle-color="#637283">
                                            <li>
                                                <a href="javascript:;">
                                                    <span class="task">
                                                        <span class="desc">New release v1.2 </span>
                                                        <span class="percent">30%</span>
                                                    </span>
                                                    <span class="progress">
                                                        <span style="width: 40%;" class="progress-bar progress-bar-success" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                                            <span class="sr-only">40% Complete</span>
                                                        </span>
                                                    </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <span class="task">
                                                        <span class="desc">Application deployment</span>
                                                        <span class="percent">65%</span>
                                                    </span>
                                                    <span class="progress">
                                                        <span style="width: 65%;" class="progress-bar progress-bar-danger" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100">
                                                            <span class="sr-only">65% Complete</span>
                                                        </span>
                                                    </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <span class="task">
                                                        <span class="desc">Mobile app release</span>
                                                        <span class="percent">98%</span>
                                                    </span>
                                                    <span class="progress">
                                                        <span style="width: 98%;" class="progress-bar progress-bar-success" aria-valuenow="98" aria-valuemin="0" aria-valuemax="100">
                                                            <span class="sr-only">98% Complete</span>
                                                        </span>
                                                    </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <span class="task">
                                                        <span class="desc">Database migration</span>
                                                        <span class="percent">10%</span>
                                                    </span>
                                                    <span class="progress">
                                                        <span style="width: 10%;" class="progress-bar progress-bar-warning" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">
                                                            <span class="sr-only">10% Complete</span>
                                                        </span>
                                                    </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <span class="task">
                                                        <span class="desc">Web server upgrade</span>
                                                        <span class="percent">58%</span>
                                                    </span>
                                                    <span class="progress">
                                                        <span style="width: 58%;" class="progress-bar progress-bar-info" aria-valuenow="58" aria-valuemin="0" aria-valuemax="100">
                                                            <span class="sr-only">58% Complete</span>
                                                        </span>
                                                    </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <span class="task">
                                                        <span class="desc">Mobile development</span>
                                                        <span class="percent">85%</span>
                                                    </span>
                                                    <span class="progress">
                                                        <span style="width: 85%;" class="progress-bar progress-bar-success" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100">
                                                            <span class="sr-only">85% Complete</span>
                                                        </span>
                                                    </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <span class="task">
                                                        <span class="desc">New UI release</span>
                                                        <span class="percent">38%</span>
                                                    </span>
                                                    <span class="progress progress-striped">
                                                        <span style="width: 38%;" class="progress-bar progress-bar-important" aria-valuenow="18" aria-valuemin="0" aria-valuemax="100">
                                                            <span class="sr-only">38% Complete</span>
                                                        </span>
                                                    </span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li> -->
                            <!-- END TODO DROPDOWN -->
                            <!-- BEGIN USER LOGIN DROPDOWN -->
                            <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                            <li class="dropdown dropdown-user">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <img alt="" class="img-circle" src="../assets/layouts/layout/img/avatar3_small.jpg" />
                                    <span class="username username-hide-on-mobile"> {{Auth::user()->userFirstName}} </span>
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-default">
                                   <!-- <li>
                                        <a href="page_user_profile_1.html">
                                            <i class="icon-user"></i> Perfil </a>
                                    </li> -->
                                    <!--<li>
                                        <a href="app_todo.html">
                                            <i class="icon-rocket"></i> My Tasks
                                            <span class="badge badge-success"> 7 </span>
                                        </a>
                                    </li>-->
                                    <li class="divider"> </li>
                                    <li>
                                        @if (Auth::guest())
                                        
                                        @else
                                            <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="icon-key"></i> 
                                            Salir
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                {{ csrf_field() }}
                                            </form>
                                        @endif
                                    </li>
                                </ul>
                            </li>
                            <!-- END USER LOGIN DROPDOWN -->
                            <!-- BEGIN QUICK SIDEBAR TOGGLER -->
                            <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                            <li class="dropdown dropdown-quick-sidebar-toggler">
                                <a href="javascript:;" class="dropdown-toggle">
                                    <i class="icon-logout"></i>
                                </a>
                            </li>
                            <!-- END QUICK SIDEBAR TOGGLER -->
                        </ul>
                    </div>
                    <!-- END TOP NAVIGATION MENU -->
                </div>
                <!-- END HEADER INNER -->
            </div>
            <!-- END HEADER -->
            <!-- BEGIN HEADER & CONTENT DIVIDER -->
            <div class="clearfix"> </div>
            <!-- END HEADER & CONTENT DIVIDER -->
            <!-- BEGIN CONTAINER -->
            <div class="page-container">
                <!-- BEGIN SIDEBAR -->
                <div class="page-sidebar-wrapper">
                    <!-- BEGIN SIDEBAR -->
                    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                    <div class="page-sidebar navbar-collapse collapse">
                        <!-- BEGIN SIDEBAR MENU -->
                        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
                        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
                        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
                        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
                        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                        <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 0px">
                            <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
                            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                            <li class="sidebar-toggler-wrapper hide">
                                <div class="sidebar-toggler">
                                    <span></span>
                                </div>
                            </li>
                            <!-- END SIDEBAR TOGGLER BUTTON -->
                            <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
                           <!-- <li class="sidebar-search-wrapper"> -->
                                <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
                                <!-- DOC: Apply "sidebar-search-bordered" class the below search form to have bordered search box -->
                                <!-- DOC: Apply "sidebar-search-bordered sidebar-search-solid" class the below search form to have bordered & solid search box -->
                               <!-- <form class="sidebar-search  " action="page_general_search_3.html" method="POST">
                                    <a href="javascript:;" class="remove">
                                        <i class="icon-close"></i>
                                    </a>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search...">
                                        <span class="input-group-btn">
                                            <a href="javascript:;" class="btn submit">
                                                <i class="icon-magnifier"></i>
                                            </a>
                                        </span>
                                    </div>
                                </form> -->
                                <!-- END RESPONSIVE QUICK SEARCH FORM -->
                            <!-- </li> -->
                            <li class="nav-item start active open">
                                <a href="{{url('/expositor/main')}}" class="nav-link nav-toggle">
                                    <i class="icon-home"></i>
                                    <span class="title">Inicio</span>
                                    <!--<span class="selected"></span>-->
                                    <span class="arrow"></span>
                                </a>
                            </li>
                            <li class="heading">
                                <h3 class="uppercase">Tareas</h3>
                            </li>
                            <li class="nav-item  ">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="icon-layers"></i>
                                    <span class="title">Reportería</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li class="nav-item  ">
                                        <a href="#" class="nav-link ">
                                            <i class="fa fa-users"></i>
                                            <span class="title">Usuarios</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="#" class="nav-link ">
                                            <i class="fa fa-edit"></i>
                                            <span class="title">Eventos</span>
                                        </a>
                                    </li>
                                    
                                </ul>
                            </li>
                          <!--  <li class="nav-item  ">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="icon-user"></i>
                                    <span class="title">Actividad de Usuario</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li class="nav-item  ">
                                        <a href="app_todo.html" class="nav-link ">
                                            <i class="icon-clock"></i>
                                            <span class="title">Todo 1</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="app_todo_2.html" class="nav-link ">
                                            <i class="icon-check"></i>
                                            <span class="title">Todo 2</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="app_inbox.html" class="nav-link ">
                                            <i class="icon-envelope"></i>
                                            <span class="title">Inbox</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="app_calendar.html" class="nav-link ">
                                            <i class="icon-calendar"></i>
                                            <span class="title">Calendar</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="app_ticket.html" class="nav-link ">
                                            <i class="icon-notebook"></i>
                                            <span class="title">Support</span>
                                        </a>
                                    </li>
                                </ul>
                            </li> -->
                            <li class="nav-item  ">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="fa fa-dollar"></i>
                                    <span class="title">Pagos</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li class="nav-item  ">
                                        <a href="#" class="nav-link ">
                                            <i class="icon-user"></i>
                                            <span class="title">Pagos Realizados</span>
                                        </a>
                                    </li>
                                    
                                    
                                </ul>
                            </li>
                            <li class="nav-item  ">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="icon-notebook"></i>
                                    <span class="title">Catálogos</span>
                                    <span class="arrow"></span>
                                </a>
                            <!--    <ul class="sub-menu">
                                    <li class="nav-item  ">
                                        <a href="page_general_about.html" class="nav-link ">
                                            <i class="icon-info"></i>
                                            <span class="title">About</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="page_general_contact.html" class="nav-link ">
                                            <i class="icon-call-end"></i>
                                            <span class="title">Contact</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="javascript:;" class="nav-link nav-toggle">
                                            <i class="icon-notebook"></i>
                                            <span class="title">Portfolio</span>
                                            <span class="arrow"></span>
                                        </a>
                                        <ul class="sub-menu">
                                            <li class="nav-item ">
                                                <a href="page_general_portfolio_1.html" class="nav-link "> Portfolio 1 </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="javascript:;" class="nav-link nav-toggle">
                                            <i class="icon-magnifier"></i>
                                            <span class="title">Search</span>
                                            <span class="arrow"></span>
                                        </a>
                                        <ul class="sub-menu">
                                            <li class="nav-item ">
                                                <a href="page_general_search.html" class="nav-link "> Search 1 </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul> -->
                            </li>
                            <li class="nav-item  ">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="icon-note"></i>
                                    <span class="title">Eventos</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li class="nav-item">
                                    	<a href="{{ route('create-event')}}" class="nav-link ">
                                          <span class="title">Crear Evento</span>
                                        </a>
                                    </li>
                                    <li class="nav-item ">
                                        <a href="{{ route('sponsor-events')}}" class="nav-link ">
                                            <span class="title">Mis Eventos</span>
                                        </a>
                                    </li>

                                </ul>
                            </li>
                         <!--   <li class="nav-item">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="icon-settings"></i>
                                    <span class="title">Sistema</span>
                                    <span class="arrow "></span>
                                </a>
                                <ul class="sub-menu">
                                    <li class="nav-item">
                                        <a href="javascript:;" class="nav-link nav-toggle">
                                            <i class="icon-settings"></i> Item 1
                                            <span class="arrow"></span>
                                        </a>
                                        <ul class="sub-menu">
                                            <li class="nav-item">
                                                <a href="javascript:;" target="_blank" class="nav-link">
                                                    <i class="icon-user"></i> Arrow Toggle
                                                    <span class="arrow nav-toggle"></span>
                                                </a>
                                                <ul class="sub-menu">
                                                    <li class="nav-item">
                                                        <a href="#" class="nav-link">
                                                            <i class="icon-power"></i> Sample Link 1</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#" class="nav-link">
                                                            <i class="icon-paper-plane"></i> Sample Link 1</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#" class="nav-link">
                                                            <i class="icon-star"></i> Sample Link 1</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#" class="nav-link">
                                                    <i class="icon-camera"></i> Sample Link 1</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#" class="nav-link">
                                                    <i class="icon-link"></i> Sample Link 2</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#" class="nav-link">
                                                    <i class="icon-pointer"></i> Sample Link 3</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="nav-item">
                                        <a href="javascript:;" target="_blank" class="nav-link">
                                            <i class="icon-globe"></i> Arrow Toggle
                                            <span class="arrow nav-toggle"></span>
                                        </a>
                                        <ul class="sub-menu">
                                            <li class="nav-item">
                                                <a href="#" class="nav-link">
                                                    <i class="icon-tag"></i> Sample Link 1</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#" class="nav-link">
                                                    <i class="icon-pencil"></i> Sample Link 1</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#" class="nav-link">
                                                    <i class="icon-graph"></i> Sample Link 1</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="icon-bar-chart"></i> Item 3 </a>
                                    </li>
                                </ul>
                            </li> -->
                        </ul>
                        <!-- END SIDEBAR MENU -->
                        <!-- END SIDEBAR MENU -->
                    </div>
                    <!-- END SIDEBAR -->
                </div>
                <!-- END SIDEBAR -->
                <!-- BEGIN CONTENT -->
                <div class="page-content-wrapper">
              
                    <!-- BEGIN CONTENT BODY -->
                    <div class="page-content" >
                    	       <!-- BEGIN QUICK SIDEBAR -->
                 <div class="page-quick-sidebar-wrapper" data-close-on-body-click="false">
                    <div class="page-quick-sidebar">
                       
                        <div class="col-md-12" style="margin-top: 1px; padding-right: 1px !important; padding-left: 1px !important">
                            
                                <a class="dashboard-stat dashboard-stat-v2 red sidebar-widget" href="#">
                                    <div class="visual">
                                        <i class="fa fa-users"></i>
                                    </div>
                                    <div class="details">
                                        <div class="number">
                                            <span data-counter="counterup" data-value="12,5">100</span></div>
                                        <div class="desc"> Visitantes </div>
                                    </div>
                                    <i class="widged-go-to fa fa-play"></i>
                                </a>
                            

                            <a class="dashboard-stat dashboard-stat-v2 purple sidebar-widget" href="#">

                                <div class="visual">
                                    <i class="fa fa-tv"></i>
                                </div>
                                <div class="details">
                                    <div class="number"> 
                                        <span data-counter="counterup" data-value="89">10</span> </div>
                                    <div class="desc"> Expositores </div>
                                </div>
                                <i class="widged-go-to fa fa-play"></i>
                            </a>

                            <a class="dashboard-stat dashboard-stat-v2 blue sidebar-widget" href="#">
                                <div class="visual">
                                    <i class="fa fa-comments"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="1349">225</span>
                                    </div>
                                    <div class="desc"> Productos </div>
                                </div>
                                <i class="widged-go-to fa fa-play"></i>
                            </a>

                            <a class="dashboard-stat dashboard-stat-v2 blue sidebar-widget" href="#">
                                <div class="visual">
                                    <i class="fa fa-dollar"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="1349">Q 7770</span>
                                    </div>
                                    <div class="desc"> Pagos Recibidos </div>
                                </div>
                                <i class="widged-go-to fa fa-play"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- END QUICK SIDEBAR -->
                    	@yield('content')
                    </div>
                    <!-- END PAGE CONTENT BODY -->
                </div>
                 <!-- END PAGE CONTENT WRAPPER -->



                <!-- BEGIN FOOTER -->
	            <div class="page-footer">
	                <div class="page-footer-inner"> 2017 &copy; New Working App
	                     &nbsp;|&nbsp;
	                    <a target="_blank" href="http://xsolutions.com">XS</a>
	                </div>
	                <div class="scroll-to-top">
	                    <i class="icon-arrow-up"></i>
	                </div>
	            </div>
	            <!-- END FOOTER -->
	       </div>
        </div>         
        <!-- END PAGE WRAPPER -->

   
   		<!-- BEGIN CORE PLUGINS -->
        <script type="text/javascript" src="{{ URL::asset('metronic/scripts/jquery.min.js')}}"></script>
        <script type="text/javascript" src="{{ URL::asset('metronic/scripts/bootstrap/js/bootstrap.min.js')}}"></script>
        <script type="text/javascript" src="{{ URL::asset('metronic/scripts/js.cookie.min.js')}}"></script>
        <script type="text/javascript" src="{{ URL::asset('metronic/scripts/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
        <script type="text/javascript" src="{{ URL::asset('metronic/scripts/jquery.blockui.min.js')}}"></script>
        <script type="text/javascript" src="{{ URL::asset('metronic/scripts/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>
        <script type="text/javascript" src="{{ URL::asset('metronic/scripts/jquery.blockui.min.js')}}"></script>
        <!-- END CORE PLUGINS -->

        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script type="text/javascript" src="{{ URL::asset('metronic/scripts/moment.min.js')}}"></script>
        <script type="text/javascript" src="{{ URL::asset('metronic/scripts/bootstrap-daterangepicker/daterangepicker.min.js')}}"></script>
        <script type="text/javascript" src="{{ URL::asset('metronic/scripts/morris/morris.min.js')}}"></script>
        <script type="text/javascript" src="{{ URL::asset('metronic/scripts/morris/raphael-min.js')}}"></script>
        <script type="text/javascript" src="{{ URL::asset('metronic/css/select2/js/select2.full.min.js')}}"></script>

        

        <!-- END PAGE LEVEL PLUGINS -->
        <!-- END PAGE LEVEL PLUGINS -->
		
        <script type="text/javascript" src="{{ URL::asset('metronic/global/plugins/bootstrap-sweetalert/sweetalert.min.js')}}"></script>
        <script type="text/javascript" src="{{ URL::asset('metronic/global/plugins/bootstrap-summernote/summernote.min.js')}}"></script>
        <script type="text/javascript" src="{{ URL::asset('metronic/global/plugins/datatables/datatables.min.js')}}"></script>

        <script type="text/javascript" src="{{ URL::asset('metronic/global/plugins/ladda/spin.min.js')}}"></script>
        <script type="text/javascript" src="{{ URL::asset('metronic/global/plugins/ladda/ladda.min.js')}}"></script>
        <script type="text/javascript" src="{{ URL::asset('metronic/global/plugins/bootstrap-select/js/bootstrap-select.min.js')}}"></script>
        
        <script type="text/javascript" src="{{ URL::asset('metronic/global/plugins/fancybox/source/jquery.fancybox.js')}}"></script>
        <script type="text/javascript" src="{{ URL::asset('metronic/global/plugins/fancybox/source/jquery.fancybox.pack.js')}}"></script>

        <script type="text/javascript" src="{{ URL::asset('metronic/global/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js')}}"></script>

        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script type="text/javascript" src="{{ URL::asset('metronic/scripts/app.min.js')}}"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
         
        <script type="text/javascript" src="{{ URL::asset('metronic/scripts/ui-sweetalert.min.js')}}"></script>
        <script type="text/javascript" src="{{ URL::asset('metronic/scripts/components-select2.min.js')}}"></script>
        <script type="text/javascript" src="{{ URL::asset('metronic/scripts/dashboard.min.js')}}"></script>
        <script type="text/javascript" src="{{ URL::asset('metronic/scripts/ui-blockui.min.js')}}"></script>
        <script type="text/javascript" src="{{ URL::asset('metronic/scripts/dropzone.js')}}"></script>



        <script type="text/javascript" src="{{ URL::asset('metronic/global/plugins/icheck/icheck.min.js')}}"></script>

        <script type="text/javascript" src="{{ URL::asset('metronic/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js')}}"></script>

        <script type="text/javascript" src="{{ URL::asset('metronic/scripts/components-bootstrap-tagsinput.min.js')}}"></script>

        <script type="text/javascript" src="{{ URL::asset('metronic/global/plugins/jquery-validation/js/jquery.validate.min.js')}}"></script>
        <script type="text/javascript" src="{{ URL::asset('metronic/global/plugins/jquery-validation/js/additional-methods.min.js')}}"></script>
        <script type="text/javascript" src="{{ URL::asset('metronic/scripts/form-wizard.min.js')}}"></script>
       
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script type="text/javascript" src="{{ URL::asset('metronic/scripts/layout.min.js')}}"></script>
        <script type="text/javascript" src="{{ URL::asset('metronic/scripts/demo.min.js')}}"></script>
        <script type="text/javascript" src="{{ URL::asset('metronic/scripts/quick-sidebar.min.js')}}"></script>
        <script type="text/javascript" src="{{ URL::asset('metronic/scripts/quick-nav.min.js')}}"></script>
        <!-- END THEME LAYOUT SCRIPTS -->
        <!-- CUSTOM SCRIPTS -->
        <script type="text/javascript" src="{{ URL::asset('metronic/scripts/application.js')}}"></script>
        <script type="text/javascript" src="{{ URL::asset('metronic/scripts/controls.js')}}"></script>

        <!-- END CUSTOM SCRIPTS -->
        <script type="text/javascript">
		$.ajaxSetup({
		   headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
		});
		</script>

        <script>
            (function($) {
                $.fn.menumaker = function(options) {  
                 var cssmenu = $(this), settings = $.extend({
                   format: "dropdown",
                   sticky: false
                 }, options);
                 return this.each(function() {
                   $(this).find(".button").on('click', function(){
                     $(this).toggleClass('menu-opened');
                     var mainmenu = $(this).next('ul');
                     if (mainmenu.hasClass('open')) { 
                       mainmenu.slideToggle().removeClass('open');
                     }
                     else {
                       mainmenu.slideToggle().addClass('open');
                       if (settings.format === "dropdown") {
                         mainmenu.find('ul').show();
                       }
                     }
                   });

                   cssmenu.find('li ul').parent().addClass('has-sub');
                multiTg = function() {
                     cssmenu.find(".has-sub").prepend('<span class="submenu-button"></span>');
                     cssmenu.find('.submenu-button').on('click', function() {
                       $(this).toggleClass('submenu-opened');
                       if ($(this).siblings('ul').hasClass('open')) {
                         $(this).siblings('ul').removeClass('open').slideToggle();
                       }
                       else {
                         $(this).siblings('ul').addClass('open').slideToggle();
                       }
                     });
                   };
                   if (settings.format === 'multitoggle') multiTg();
                   else cssmenu.addClass('dropdown');
                   if (settings.sticky === true) cssmenu.css('position', 'fixed');
                resizeFix = function() {
                  var mediasize = 1279;
                     if ($( window ).width() > mediasize) {
                       cssmenu.find('ul').show();
                     }
                     if ($(window).width() <= mediasize) {
                       cssmenu.find('ul').hide().removeClass('open');
                     }
                   };
                   resizeFix();
                   return $(window).on('resize', resizeFix);
                 });
                  };
                })(jQuery);

                (function($){
                $(document).ready(function(){
                $("#cssmenu").menumaker({
                   format: "multitoggle"
                });
                });
                })(jQuery);
        </script>
		
        @yield('scripts')
</body>
</html>