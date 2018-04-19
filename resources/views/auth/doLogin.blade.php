<!DOCTYPE html>
<html >
<head>
    <!-- Site made with Mobirise Website Builder v4.5.4, https://mobirise.com -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
    <link rel="icon" type="image/x-icon" sizes="16x16" href="{{ asset('img/food_for_us_logo.png') }}">
    <meta name="description" content="Web Page Creator Description">
    <title>Login </title>
    <link rel="stylesheet" href="assets/bootstrap-material-design-font/css/material.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,700">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic&subset=latin">
    <link rel="stylesheet" href="assets/tether/tether.min.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/soundcloud-plugin/style.css">
    <link rel="stylesheet" href="assets/dropdown/css/style.css">
    <link rel="stylesheet" href="assets/animate.css/animate.min.css">
    <link rel="stylesheet" href="assets/theme/css/style.css">
    <link rel="stylesheet" href="assets/mobirise/css/mbr-additional.css" type="text/css">

    <style>

        background-image:url('assets/images/ffu-1920x1280.png')

    </style>

</head>
<body >
<section id="menu-2" data-rv-view="26">

    <nav class="navbar navbar-dropdown transparent navbar-fixed-top bg-color">
        <div class="container">

            <div class="mbr-table">
                <div class="mbr-table-cell">

                    <div class="navbar-brand">
                        <a href="#"  class="navbar-logo"><img src="assets/images/logo-128x128.png" alt="Food  for us"></a>
                        <a class="navbar-caption" href="#">Food For Us</a>
                    </div>

                </div>
                <div class="mbr-table-cell">

                    <button class="navbar-toggler pull-xs-right hidden-md-up" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar">
                        <div class="hamburger-icon"></div>
                    </button>

                    <ul class="nav-dropdown collapse pull-xs-right nav navbar-nav navbar-toggleable-sm" id="exCollapsingNavbar"><li class="nav-item"><a class="nav-link link" href="/">HOME</a></li><li class="nav-item"><a class="nav-link link" href="recentPost" aria-expanded="false">RECENT POST</a></li><li class="nav-item"><a class="nav-link link" href="/" aria-expanded="false"></a></li><li class="nav-item nav-btn"><a class="nav-link btn btn-white btn-white-outline" href="dologin">Login</a></li></ul>
                    <button hidden="" class="navbar-toggler navbar-close" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar">
                        <div class="close-icon"></div>
                    </button>

                </div>
            </div>

        </div>
    </nav>

</section>

<section class="engine"><a href="#">web page software</a></section><section class="mbr-section form1 mbr-parallax-background mbr-after-navbar" id="form1-4" data-rv-view="28" style="background-image: url(assets/images/ffu-1920x1280.png); padding-top: 250px; padding-bottom: 250px;">

    <div class="mbr-section mbr-section__container mbr-section__container--middle">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 text-xs-center">

                    <small class="mbr-section-subtitle">.</small>
                </div>
            </div>
        </div>
    </div>
    <div class="mbr-section mbr-section-nopadding">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-lg-10 col-lg-offset-1 " >


                    <div data-form-alert="true">
                        <div hidden="" data-form-alert-success="true" class="alert alert-form alert-success text-xs-center">Thanks for filling out form!</div>


                        @if (count($errors) > 0)
                            <div class="alert alert-form alert-danger text-xs-center">
                                <strong>Whoops!</strong> There were some problems with your input <br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if (Session::has('status'))
                            <div class="alert alert-form alert-success text-xs-center">{{ Session::get('status') }}</div>
                        @endif
                    </div>


                    <form method="post" action="{{ url('login') }}">

                        {!! csrf_field() !!}



                        <div class="row row-sm-offset">

                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label"  Style="color:white; font-weight:bolder"for="form1-4-name">Username<span class="form-asterisk"></span></label>
                                    <input type="text" class="form-control" name="email" required="" data-form-field="Name" id="form1-4-name">
                                </div>
                            </div>

                        </div>




                        <div class="row row-sm-offset">
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label"  Style="color:white; font-weight:bolder"for="form1-4-name">Password<span class="form-asterisk"></span></label>
                                    <input type="password" class="form-control" name="password" required="" data-form-field="Name" id="form1-4-name">
                                </div>
                            </div>

                        </div>

                        <div class="row row-sm-offset">
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <input type="checkbox"  name="name"  id="form1-4-name"> <span style="color:white"> Remember Me </span>
                                </div>
                            </div>
                        </div>



                        <div><button type="submit" class="btn btn-primary">Login</button></div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


<script src="assets/web/assets/jquery/jquery.min.js"></script>
<script src="assets/tether/tether.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/dropdown/js/script.min.js"></script>
<script src="assets/smooth-scroll/smooth-scroll.js"></script>
<script src="assets/jarallax/jarallax.js"></script>
<script src="assets/touch-swipe/jquery.touch-swipe.min.js"></script>
<script src="assets/viewport-checker/jquery.viewportchecker.js"></script>
<script src="assets/theme/js/script.js"></script>
<script src="assets/formoid/formoid.min.js"></script>


<input name="animation" type="hidden">
</body>
</html>