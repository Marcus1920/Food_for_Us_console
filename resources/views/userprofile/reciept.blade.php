<!DOCTYPE html>
<html lang="en">
<head>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <!-- Favicons -->
        <link rel="apple-touch-icon" href="{{ asset('img/food_for_us_logo.png') }}">
        <link rel="icon" href="{{ asset('img/food_for_us_logo.png') }}">
        <title>
            Food  for us
        </title>
        <!--     Fonts and icons     -->
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
        <link rel="stylesheet" href="profile/assets/css/material-kit.css?v=2.0.2">
        <!-- Documentation extras -->
        <!-- CSS Just for demo purpose, don't include it in your project -->
        <link href="profile/assets/assets-for-demo/demo.css" rel="stylesheet" />
        <!-- iframe removal -->

    </head>
<body  class="profile-page ">


<nav class="navbar navbar-color-on-scroll navbar-transparent   fixed-top  navbar-expand-lg " color-on-scroll="50" id="sectionsNav">
    <div class="container">
        <div class="navbar-translate">
            <a class="navbar-brand" href="#"> <img  style="width: 50px; height: 50px; margin-bottom: 8px; padding-bottom: 15px;" src="profile/assets/img/logo.png"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                <span class="navbar-toggler-icon"></span>
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>

        <div class="collapse navbar-collapse">
            <ul class="navbar-nav"  data-tabs="tabs">
                <li class="nav-item">
                    <a href="userporifiles" class="nav-link" > <i class="material-icons">account_circle</i>
                        Profile </a>
                </li>
                <li class="nav-item">
                    <a href="mypostlist" class="nav-link"> <i class="material-icons">poll</i>
                        My Post </a>
                </li>


                <li class="nav-item active">
                    <a href="recieptlist" class="nav-link"> <i class="material-icons">receipt</i>
                        Receipt</a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('/auth/logout') }}" class="nav-link"> <i class="material-icons">settings_power</i>
                        Logout</a>
                </li>


            </ul>

            <form class="form-inline ml-auto">
                <div class="form-group has-white">
                    <input type="text" class="form-control" placeholder="Search">
                </div>
                <button type="submit" class="btn btn-white btn-raised btn-fab btn-fab-mini btn-round">
                    <i class="material-icons">search</i>
                </button>
            </form>
        </div>
    </div>
</nav>
<div class="page-header header-filter" data-parallax="true" style="background-image: url('profile/assets/img/FFU.png');"></div>
<div class="main main-raised">
    <div class="profile-content">
        <div class="container">


            <div  id="div_container" >

            </div>
            {{--<div class="row">--}}
                {{--<div class="col-md-6 ml-auto mr-auto">--}}
                    {{--<div class="card card-nav-tabs">--}}
                        {{--<h4 class="card-header card-header-info"> Chinese Orange Chicken</h4>--}}
                        {{--<div class="card-body">--}}
                            {{--<img class="card-img-top" style="width: 100%; height: 250px" src="profile/assets/img/4557074.jpg" alt="Card image cap">--}}
                            {{--<p class="card-text">With supporting text below as a natural lead-in to additional content.With supporting text below as a natural lead-in to additional content.With supporting text below as a natural lead-in to additional content.</p>--}}
                            {{--<a href="#" class="btn btn-info">View Details </a>--}}
                        {{--</div>--}}
                        {{--<div class="card-footer text-muted">--}}
                            {{--2 days ago--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}

                {{--<div class="col-md-6">--}}
                    {{--<div class="card card-nav-tabs">--}}
                        {{--<h4 class="card-header card-header-info"> Faloacorza   Mixicain  Orange Chicken</h4>--}}
                        {{--<div class="card-body">--}}
                            {{--<h4 class="card-title">Special title treatment</h4>--}}
                            {{--<img class="card-img-top" style="width: 100px;" src="profile/assets/img/4557074.jpg" alt="Card image cap">--}}
                            {{--<p class="card-text">With supporting text below as a natural lead-in to additional content.With supporting text below as a natural lead-in to additional content.With supporting text below as a natural lead-in to additional content.</p>--}}
                            {{--<a href="#" class="btn btn-info">View Details </a>--}}
                        {{--</div>--}}
                        {{--<div class="card-footer text-muted">--}}
                            {{--2 days ago--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}





        </div>
    </div>


</div>


</div>

</div>








<footer class="footer ">
    <div class="container">
        <nav class="pull-left">
            <ul>
                <li>
                    <button class="btn btn-just-icon btn-round btn-linkedin">
                        <i class="fa fa-linkedin"></i>
                    </button>
                </li>
                <li>
                    <button class="btn btn-just-icon btn-round btn-linkedin">
                        <i class="fa fa-twitter"></i>
                    </button>
                </li>
                <li>
                    <button class="btn btn-just-icon btn-round btn-linkedin">
                        <i class="fa fa-facebook"> </i>
                    </button>
                </li>
                <li>
                    <button class="btn btn-just-icon btn-round btn-linkedin">
                        <i class="fa fa-youtube"> </i>
                    </button>
                </li>
            </ul>
        </nav>
        <div class="copyright pull-right">


        </div>
    </div>
</footer>


<script src="profile/assets/js/core/jquery.min.js"></script>
<script src="profile/assets/js/core/popper.min.js"></script>
<script src="profile/assets/js/bootstrap-material-design.js"></script>
<!--  Plugin for Date Time Picker and Full Calendar Plugin  -->
<script src="profile/assets/js/plugins/moment.min.js"></script>
<!--	Plugin for the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker -->
<script src="profile/assets/js/plugins/bootstrap-datetimepicker.min.js"></script>
<!--	Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
<script src="profile/assets/js/plugins/nouislider.min.js"></script>
<!-- Material Kit Core initialisations of plugins and Bootstrap Material Design Library -->
<script src="profile/assets/js/material-kit.js?v=2.0.2"></script>
<!-- Fixed Sidebar Nav - js With initialisations For Demo Purpose, Don't Include it in your project -->
<script src="profile/assets/assets-for-demo/js/material-kit-demo.js"></script>
<script type="text/javascript" src="js/receipt.js"></script>
</body>

