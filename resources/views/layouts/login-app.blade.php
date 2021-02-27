<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>NetworkingApp</title>

    <!-- Styles -->
      <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet"
              href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.5.10/css/bootstrap-material-design.min.css"/>
        <link rel="stylesheet"
              href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.5.10/css/ripples.min.css"/>

        <link href="{{ asset('css/bootstrap-material-datetimepicker.css') }}" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Roboto:400,500' rel='stylesheet' type='text/css'>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
         <link href="{{ asset('css/material.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/getmdl-select.css') }}" rel="stylesheet">
        <link href="{{ asset('css/getmdl-select.min.css') }}" rel="stylesheet">
    @yield('css')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <!--{{ config('app.name', 'Inicio') }}-->
                        Inicio
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                           <!-- <li><a href="{{ route('login') }}">Ingresar</a></li>
                            <li><a href="{{ url('visitor/register') }}">Registrarse</a></li> -->
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/jquery.js')}}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/getmdl-select.js')}}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/material.min.js')}}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/getmdl-select.min.js')}}"></script>
    
    <script>
        jQuery(document).ready( function($) {
            $('.panel-default').addClass('panel-animate');
           
             $(".circle-logo").fadeIn("slow");

          
      });
    </script>

    <script>
jQuery(document).ready( function($) {
    $(window, document, undefined).ready(function() {

  $('input').blur(function() {
    var $this = $(this);
    if ($this.val())
      $this.addClass('used');
    else
      $this.removeClass('used');
  });

  var $ripples = $('.ripples');

  $ripples.on('click.Ripples', function(e) {

    var $this = $(this);
    var $offset = $this.parent().offset();
    var $circle = $this.find('.ripplesCircle');

    var x = e.pageX - $offset.left;
    var y = e.pageY - $offset.top;

    $circle.css({
      top: y + 'px',
      left: x + 'px'
    });

    $this.addClass('is-active');

  });

  $ripples.on('animationend webkitAnimationEnd mozAnimationEnd oanimationend MSAnimationEnd', function(e) {
    $(this).removeClass('is-active');
  });

});
});
</script>

<script>
jQuery(document).ready( function($) {    
    
    $('#get-create-fields').click(function(){
        $('.panel-body-login').slideToggle();
        $('.panel-body-register').slideToggle();
        $('.panel-body-register').slideDown();
        $('.panel-body-register').css('display', 'block');
        $('#userFirstName').select();
        
      
    }); 

     $('#get-log-in').click(function(){
        $('.panel-body-login').slideToggle();
        $('.panel-body-register').slideUp();
        
        $('#userEmail').select();
        
        

        
     });
});

</script>

@yield('scripts')
</body>
</html>
