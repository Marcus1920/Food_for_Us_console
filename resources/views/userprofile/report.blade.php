<!DOCTYPE html>
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

    {!! Charts::styles() !!}

</head>
<script>
    function _(x){return document.getElementById(x);}
    function  strat() {
        var count22,contant="";
        var ajax2 = new XMLHttpRequest();
        var api_key='<?php echo $user->api_key;  ?>'
        ajax2.open("GET","http://dev.foodforus.cloud/public/api/v1/notification?api_key="+ api_key, true);
        ajax2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        ajax2.onreadystatechange = function() {

            var data = JSON.parse(ajax2.responseText);
            contant="<span style='background-color: #ddd'>"+ data.length +" New Notifications</span><br>";
            for(count22=0; count22 < data.length ; count22++) {
                contant +='<a href="veiwnotification/'+data[count22]['id']+'">'+
                    '<img   style="width:55px; height: 55px; float: left; margin-right: 5px; border-radius: 80%; border: silver 1px solid;" src='+data[count22]['productPicture']+'>'+
                    '<span style=" margin-top: -10px;"><b>'+data[count22]['ProductName']+'</b></span>'+
                    '<span style=" margin-top: -28px; font-size: 13px">'+data[count22]['Message']+'</span>'+
                    '<span  style=" margin-top: -29px; font-size: 10px;">'+data[count22]['created_at']+'</span><br style="line-height: .9"></a>'
                if(count22 > 4){break}
            }
            _("myDropdown").innerHTML=contant;
        }

        ajax2.send(null);
    }
</script>
<style>
    /* Dropdown Button */
    .dropbtn {
        background-color: #3498DB;
        color: white;
        padding: 16px;
        font-size: 16px;
        border: none;
        cursor: pointer;
    }

    /* Dropdown button on hover & focus */
    .dropbtn:hover, .dropbtn:focus {
        background-color: #2980B9;
    }

    /* The container <div> - needed to position the dropdown content */
    .dropdown {
        position: relative;
        display: inline-block;

    }

    /* Dropdown Content (Hidden by Default) */
    .dropdown-content {
        display: none;
        position: absolute;
        background-color: white ;
        min-width: 460px;
        box-shadow: 1px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1;
        margin-left: -130px;
        margin-top: 22px;
        border-radius: 2px 2px 2px 2px ;
        max-height: 652px;

    }
    .dropdown-content:before{
        content: '';
        position: absolute;
        width: 25px;
        height: 25px;
        background: #ddd;
        left:14%;
        transform: translateX(-50%) translateY(-13px)  rotate(45deg);

    }

    .dropdown-content span {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        margin-bottom: -25px;
        display: block;
    }
    /* Links inside the dropdown */
    .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }
    .show {display:block;}
    /* Change color of dropdown links on hover */
    .dropdown-content a:hover {background-color:#f1f1f1;}

    /* Show the dropdown menu (use JS to add this class to the .dropdown-content container when the user clicks on the dropdown button) */

</style>
<body class="profile-page ">
<nav class="navbar navbar-color-on-scroll navbar-transparent    fixed-top  navbar-expand-lg " color-on-scroll="100" id="sectionsNav">
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

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        <i class="material-icons">add_box</i>
                        Create Post </a>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="createPost">For Sale</a>
                        <a class="dropdown-item" href="createDonation">Donation</a>
                    </div>
                </li>


                <li class="nav-item">
                    <a href="recieptlist" class="nav-link"> <i class="material-icons">receipt</i>
                        Public wall</a>
                </li>


                <li class="nav-item">

                    <a href="#" class="nav-link" onclick="myFunction()" > <i class="material-icons">notifications</i>
                        Notifications</a>
                </li>
                <div class="dropdown">
                    <div id="myDropdown" class="dropdown-content">
                    </div>
                </div>


                <li class="nav-item active">
                    <a href="userReport" class="nav-link"> <i class="material-icons">assessment</i>
                        Report</a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('/auth/logout') }}" class="nav-link"> <i class="material-icons">settings_power</i>
                        Logout</a>
                </li>

            </ul>


            {{--<form class="form-inline ml-auto">--}}
                {{--<div class="form-group has-white">--}}
                    {{--<input type="text" class="form-control" placeholder="Search">--}}
                {{--</div>--}}
                {{--<button type="submit" class="btn btn-white btn-raised btn-fab btn-fab-mini btn-round">--}}
                    {{--<i class="material-icons">search</i>--}}
                {{--</button>--}}
            {{--</form>--}}
        </div>
    </div>
</nav>
<div class="page-header header-filter" data-parallax="true" style="background-image: url('profile/assets/img/FFU.png');"></div>
<div class="main main-raised" style="padding-top: 50px">
    <div class="profile-content">
            <div class="row">
                <div class="col-md-4 ml-auto mr-auto">
                        {!! $chart1->html() !!}
                </div>
                <div class="col-md-4 ml-auto mr-auto">
                    {!! $chart2->html() !!}
                </div>
                <div class="col-md-4 ml-auto mr-auto">
                    {!! $chart->html() !!}
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

<!--   Core JS Files   -->
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

{!! Charts::scripts() !!}
{!! $chart1->script() !!}
{!! $chart2->script() !!}
{!! $chart->script() !!}

<script>request_page(1);</script>
<script>

    var x="close"
    function myFunction() {
        document.getElementById("myDropdown").style.display="block";
        x="open"
    }
    window.onclick = function(event) {
        if (x  === 'close') {document.getElementById("myDropdown").style.display="none";x="open";}else{x="close";}
    }

</script>
<script>strat()</script>
<script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
<script>
    var OneSignal = window.OneSignal || [];
    OneSignal.push(function() {
        OneSignal.init({
            appId: "9061f725-d62f-4978-97f1-eb1235f13b10",
            autoRegister: false,
            notifyButton: {
                enable: true,
            },
        });
    });
</script>
</body>

</html>