<!DOCTYPE html>
<!--[if IE 9 ]>
![endif]-->
<html class="ie9">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <meta name="format-detection" content="telephone=no">
    <meta charset="UTF-8">
    <meta name="description" content="Siyaleader Ethekwini Case Console Management">
    <meta name="keywords" content="Siyaleader, Ethekwini, Ethekwini,Ethekwini Management System,Incidents Management System">
    <link rel="icon" type="image/x-icon" sizes="16x16" href="{{ asset('/img/favicon.ico?v1') }}">


    <title>Siyaleader Ports</title>


    <!-- CSS -->
    <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/form.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/calendar.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/generics.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/token-input.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/icons.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/lightbox.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/media-player.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/file-manager.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/buttons.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/HoldOn.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/bootstrap-switch.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/incl/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/Treant.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/collapsable.css') }}" rel="stylesheet">

    <link href="{{ asset('/css/toggles.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/toggle-themes/toggles-all.css') }}" rel="stylesheet">



    <!-- jQuery Library -->
    <script src="{{ asset('/js/jquery.min.js') }}"></script>





    <!-- DataTables CSS -->
    <link href="{{ asset('/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css') }}" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="{{ asset('/bower_components/datatables-responsive/css/responsive.dataTables.scss') }}" rel="stylesheet">



    <script>


        var placeSearch, autocomplete;
        var componentForm = {
            street_number: 'short_name',
            route: 'long_name',
            locality: 'long_name',
            administrative_area_level_1: 'short_name',
            country: 'long_name',
            postal_code: 'short_name'
        };

    </script>





</head>
<body id="skin-blur-ocean" style="background-color: darkblue">

<header id="header" class="media">
    <a href="" id="menu-toggle"></a>
    <a class="logo pull-left" href="#">
    <!--<img class="" src="{{ asset('/images/dashboard_logo.png') }}" width="60%" alt="">-->
    </a>

    <div class="media-body">
        <div class="media" id="top-menu">

            <div id="home">

                {{-- <div class="pull-left tm-icon">
                      <a data-drawer="messages" class="drawer-toggle">
                          <i class="fa fa-envelope-o fa-2x"></i>
                          <i class="n-count animated" id='countPrivateMessages'>{{ count($noPrivateMessages,0) }}</i>

                      </a>
                  </div>--}}

                <div class="pull-left tm-icon">

                    <a href="" data-toggle="modal" onClick="launchAddress();" data-target=".modalAddress" >
                        <i class="fa fa-book fa-2x"></i>
                    </a>
                </div>

            </div>



            <div id="time" class="pull-right">
                <span id="hours"></span>
                :
                <span id="min"></span>
                :
                <span id="sec"></span>
            </div>
        </div>
    </div>
</header>

<div class="clearfix"></div>

<section id="main" class="p-relative" role="main">

    <!-- Sidebar -->
    <aside id="sidebar">

        <!-- Sidbar Widgets -->
        <div class="side-widgets overflow" style="position: relative;">
            <!-- Profile Menu -->
            <div class="text-center s-widget m-b-25 dropdown" id="profile-menu">
                <a href="#" data-toggle="dropdown">
                    <img class="profile-pic animated" src="{{ asset('/img/food.jpg') }}" alt="lomnin">
                </a>

                <ul class="dropdown-menu profile-menu">
                    {{--<li><a href="{{ url('all-messages') }}">Messages</a> <i class="icon left">&#61903;</i><i class="icon right">&#61815;</i></li>--}}
                    <li><a href="{{ url('user-profile') }}">Profile</a> <i class="icon left">&#61903;</i><i class="icon right">&#61815;</i></li>
                    <li><a href="{{ url('/auth/logout') }}">Sign Out</a> <i class="icon left">&#61903;</i><i class="icon right">&#61815;</i></li>
                </ul>
                @if (Auth::user())
                    <h4 class="m-0">
                        {{ Auth::user()->name }}  {{ Auth::user()->surname }}
                    </h4>
                    {{--{{ $systemRole->name }}<br>--}}
                    {{--{{ Auth::user()->email }}--}}
                @endif


            </div>

        @if (Request::is('message-detail/*') || Request::is('all-messages'))
            @include('messages.message-widget')
        @endif

        <!-- Calendar -->
            {{--<div class="s-widget m-b-25">--}}
                {{--<div id="landings_calendar"></div>--}}
            {{--</div>--}}

            {{--<img class="" src="{{ asset('/images/dashboard_logo.png') }}" width="60%" alt="" style=" position: absolute; left: 25px; bottom: 10px;">--}}
        </div>

        <!-- Side Menu -->
        <ul class="list-unstyled side-menu">




                <li {{ (Request::is('list-users') ? "class=active dropdown" : 'dropdown') }}>

                    <a class="sa-side-ui" href="">
                        <span class="menu-item">Settings</span>
                    </a>
                    <ul class="list-unstyled menu-item">

                        <li><a href="{{ url('register') }}"><span class="badge badge-r"></span>Register Admin</a></li>


                    </ul>
                </li>


            <li {{ (Request::is('reports') ? "class=active" : '') }}>
                    <a class="sa-side-chart" href="{{ url('users') }}">
                        <span class="menu-item">Users</span>
                    </a>
                </li>

                <li {{ (Request::is('calendar') ? "class=active" : '') }}>
                    <a class="sa-side-calendar" href="{{ url('calendar/events') }}">
                        <span class="menu-item">Calendar</span>
                    </a>
                </li>



        </ul>
    </aside>


    <!-- Content -->
    <section id="content" class="container">
        @yield('content')
    </section>
 </section>
@yield('footer')
</body>
</html>
