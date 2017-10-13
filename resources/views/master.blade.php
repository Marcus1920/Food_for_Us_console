<!DOCTYPE html>
<!--[if IE 9 ]>
![endif]-->
<html class="ie9">
<head>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <meta name="format-detection" content="telephone=no">
    <meta charset="UTF-8">
    <meta name="description" content="Food For Us">
    <meta name="keywords" content="Food for Us is funded through the 10YFP Trust Fund established by UNEP.
    The project was selected through an open 10YFP Trust Fund Call for Proposals for Sustainable Lifestyles and
    Education Programme with the financial support of the Government of Japan.
    In a country that produces more than enough food to feed everybody how is it that just under 50% are nutritionally poor.
     Two key factors in this crisis are challenges related to finding markets for produce and accessing affordable
      nutritious food. Food for Us provides an innovative mobile phone application that brings together producers and
      consumers of food. The vision is to reduce food waste and enhance food security be providing a convenient platform
      for connecting interested peopl">
    <link rel="icon" type="image/x-icon" sizes="16x16" href="{{ asset('/img/food_for_us_logo.png') }}">


    <title>Food For Us</title>


    <!-- CSS -->
    <link href="{{ asset('public/css/token-input.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/form.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/calendar.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/generics.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/token-input.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/icons.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/lightbox.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/media-player.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/file-manager.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/buttons.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/HoldOn.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/bootstrap-switch.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/incl/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/Treant.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/collapsable.css') }}" rel="stylesheet">

    <link href="{{ asset('public/css/toggles.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/toggle-themes/toggles-all.css') }}" rel="stylesheet">

    <link href="{{ asset('public/css/toggles.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/toggle-themes/toggles-all.css') }}" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="{{ asset('/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css') }}" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
{{--<link href="{{ asset('public/bower_components/datatables-responsive/css/responsive.dataTables.scss') }}" rel="stylesheet">--}}
<!-- jQuery Library -->
    <script src="{{ asset('public/js/jquery.min.js') }}"></script>

    <!-- jQuery Library -->
    <script src="{{ asset('public/js/jquery.min.js') }}"></script>





    <!-- DataTables CSS -->
    <link href="{{ asset('public/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css') }}" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="{{ asset('public/bower_components/datatables-responsive/css/responsive.dataTables.scss') }}" rel="stylesheet">



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
<body id="skin-blur-ocean" style="background-color: #265a88">

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
                    <img class="profile-pic animated" src="{{ asset('public/img/food_for_us_logo.png') }}" alt="lomnin">
                </a>

                <ul class="profile-menu">
                    {{--<li><a href="{{ url('all-messages') }}">Messages</a> <i class="icon left">&#61903;</i><i class="icon right">&#61815;</i></li>--}}
                    {{--<li><a href="{{ url('user-profile') }}">Profile</a> <i class="icon left">&#61903;</i><i class="icon right">&#61815;</i></li>--}}

                </ul>


            @if (Auth::user())
                    <h4 class="m-0">
                        {{ Auth::user()->name }}  {{ Auth::user()->surname }}
                    </h4>
                    {{--{{ $systemRole->name }}<br>--}}
                    {{ Auth::user()->email }}
                @endif
                <span style="margin-top:20px"></span>
                 <br/>
                 <br/>
                <a href="{{ url('/auth/logout') }}">Log Out</a>


            </div>

        @if (Request::is('message-detail/*') || Request::is('all-messages'))
            @include('messages.message-widget')
        @endif

        <!-- Calendar -->
            <div class="s-widget m-b-25">
                <div id="landings_calendar"></div>
            </div>

            {{--<img class="" src="{{ asset('public/images/dashboard_logo.png') }}" width="60%" alt="" style=" position: absolute; left: 25px; bottom: 10px;">--}}
        </div>

        <!-- Side Menu -->
        <ul class="list-unstyled side-menu">

            <li {{ (Request::is('list-users') ? "class=active dropdown" : 'dropdown') }}>

                <a class="sa-side-ui"href="#">
                    <span class="menu-item">Settings</span>
                </a>
                <ul class="list-unstyled menu-item">
                    <li><a href="{{ url('register') }}"><span class="badge badge-r"></span>Register Admin</a></li>
                    <li><a href="{{ url('adminUser') }}"><span class="badge badge-r"></span>Admin List</a></li>
                    <li><a href="{{ url('userroleslist')}}"><span class="badge badge-r"></span>User Roles List</a></li>
                    <li><a href="{{ url('allProduct') }}"><span class="badge badge-r"></span>Product List</a></li>
                    <li><a href="{{ url('packaginglist') }}"><span class="badge badge-r"></span>Packaging List</a></li>
                    <li><a href="{{ url('countrylistView') }}"><span class="badge badge-r"></span>Countries</a></li>
                </ul>
            </li>

            <li {{ (Request::is('') ? "class=active dropdown" : 'dropdown') }}>
                <a class="sa-side-user" href="#">
                    {{--<span class="menu-item">App Users</span>--}}
                </a>
                <ul class="list-unstyled menu-item">
                    <h6><b>APP USERS</b></h6>
                    <li><a href="{{ url('inactiveUsers') }}"><span class="badge badge-r"></span>Inactive Users</a></li>
                    <li><a href="{{ url('activeUsers') }}"><span class="badge badge-r"></span>Active Users</a></li>
                    <li><a href="{{ url('deactivatedUser') }}"><span class="badge badge-r"></span>Deactivated Users</a></li>
                </ul>
            </li>

            <li {{ (Request::is('map') ? "class=active" : '') }}>
                <a class="sa-side-home" href="{{ url('getUsers') }}">
                    <span class="menu-item">map</span>
                </a>
            </li>

            <li {{ (Request::is('posts') ? "class=active" : '') }}>
                <a class="sa-side-list" href="{{ url('postslist') }}">
                    <span class="menu-item">Post List</span>

                </a>
            </li>

            <li {{ (Request::is('research') ? "class=active" : '') }}>
                <a class="sa-side-research" href="{{ url('researchList') }}">
                    <span class="menu-item">Researchers List</span>

                </a>
            </li>

            <li {{ (Request::is('public_wall') ? "class=active" : '') }}>
                <a class="sa-side-public_wall" href="{{ url('publicWall') }}">
                    <span class="menu-item">Public Wall</span>

                </a>
            </li>

            <li {{ (Request::is('reports') ? "class=active" : '') }}>
                <a class="sa-side-reports" href="{{ url('reports') }}">
                    <span class="menu-item">Reports</span>

                </a>
            </li>

            <li {{ (Request::is('transaction') ? "class=active" : '') }}>
                <a class="sa-side-transaction" href="{{ url('transactionList') }}">
                    <span class="menu-item">Transaction history</span>
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
<script src="{{ asset('public/js/toggles.js') }}"></script>

<script src="{{ asset('public/js/jquery-ui.min.js') }}"></script> <!-- jQuery UI -->
<script src="{{ asset('public/js/jquery.easing.1.3.js') }}"></script> <!-- jQuery Easing - Requirred for Lightbox + Pie Charts-->

<!-- Bootstrap -->
<script src="{{ asset('public/js/bootstrap.min.js') }}"></script>




<!--  Form Related -->
<script src="{{ asset('public/js/icheck.js') }}"></script> <!-- Custom Checkbox + Radio -->

<!-- UX -->
<script src="{{ asset('public/js/scroll.min.js') }}"></script> <!-- Custom Scrollbar -->

<!-- Other -->
<script src="{{ asset('public/js/calendar.min.js') }}"></script> <!-- Calendar -->
<script src="{{ asset('public/js/feeds.min.js') }}"></script> <!-- News Feeds -->


<!--  Form Related -->
<script src="{{ asset('public/js/validation/validate.min.js') }}"></script> <!-- jQuery Form Validation Library -->
<script src="{{ asset('public/js/validation/validationEngine.min.js') }}"></script> <!-- jQuery Form Validation Library - requirred with above js -->


<!-- All JS functions -->
<script src="{{ asset('public/js/functions.js') }}"></script>


<!-- Token Input -->
<script src="{{ asset('public/js/jquery.tokeninput.js') }}"></script> <!-- Token Input -->



<!-- Noty JavaScript -->
<script src="{{ asset('public/bower_components/noty/js/noty/packaged/jquery.noty.packaged.js') }}"></script>

<!-- DataTables JavaScript -->


<script src="{{ asset('public/bower_components/datatables/media/js/datatables-plugins/pagination/scrolling.js') }}"></script>
<script src="{{ asset('public/bower_components/datatables/media/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('public/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js') }}"></script>



<!-- Jquery Bootstrap Maxlength -->
<script src="{{ asset('public/bower_components/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>


<!-- Media -->
<script src="{{ asset('public/js/media-player.min.js') }}"></script> <!-- Video Player -->
<script src="{{ asset('public/js/pirobox.min.js') }}"></script> <!-- Lightbox -->
<script src="{{ asset('public/js/file-manager/elfinder.js') }}"></script> <!-- File Manager -->


<script type="text/javascript" src="{{ asset('public/incl/oms.min.js') }}"></script>



<!-- File Upload -->
<script src="{{ asset('public/js/fileupload.min.js') }}"></script> <!-- File Upload -->

<!-- Spinner -->
<script src="{{ asset('public/js/HoldOn.min.js') }}"></script> <!-- Spinner -->

<!-- bootstrap-switch. -->
<script src="{{ asset('/js/bootstrap-switch.js') }}"></script> <!-- bootstrap-switch. -->

<!-- Date & Time Picker -->
<script src="{{ asset('public/js/datetimepicker.min.js') }}"></script> <!-- Date & Time Picker -->

<!-- Buttons HTML5 -->
<script src="{{ asset('public/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('public/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('public/js/jszip.min.js') }}"></script>
<script src="{{ asset('public/js/pdfmake.min.js') }}"></script>
<script src="{{ asset('public/js/vfs_fonts.js') }}"></script>
<!--  Buttons HTML5 -->

<script src="{{ asset('public/js/socket.io.js') }}"></script>

<script src="{{ asset('public/js/calendar.min.js') }}"></script> <!-- Calendar -->

<script src="{{ asset('public/js/raphael.js') }}"> </script>





<!-- D3.js
        <script src="{{ asset('js/d3/plugins.js') }}"></script>
        <script src="{{ asset('js/d3/script.js') }}"></script>
        <script src="{{ asset('js/d3/libs/coffee-script.js') }}"></script>
        <script src="{{ asset('js/d3/libs/d3.v2.js') }}"></script>
        <script src="{{ asset('js/d3/Tooltip.js') }}"></script>
        <script src="{{ asset('js/d3/Tooltip.js') }}"></script>
    -->

<script>
    $("#country").tokenInput("{!! url('/getCountries')!!}",
        {tokenLimit: 1,
        animateDropdown: false,
            onAdd: function (results) {

                if(results.name)
                {
                    $("#code").val(results.dial_code);
                }
                else
                    {

            }
            return results;
    },
        });



</script>

</body>
</html>