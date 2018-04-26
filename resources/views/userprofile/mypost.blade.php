<?php
$total_row=$sellers_posts;$rrp=8;
$last=ceil($total_row / $rrp);
if($last < 1){$last=1;}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>
<body class="profile-page" style="z-index: 0">


<script>

    function request_page(pn) {
        var controls=document.getElementById("pagination_controls");
        var rpp = "<?php echo $rrp; ?>", last = "<?php echo $last; ?>";
        var div_container = document.getElementById("div_container");
        var ajax = new XMLHttpRequest();
        ajax.open("GET","../postlist/"+pn, true);
        ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        ajax.onreadystatechange = function() {
            var data = JSON.parse(ajax.responseText);

            var count1,count2,container='',add=0,description='';
            for(count2=0; count2 < data.length ; count2++){
                if(data[add]["description"].length > 200){description = data[add]["description"].substring(0,200)+" ...";}else{description = data[add]["description"];}
                container +='<div class="col-md-4"> <div class="card" style="width: 20rem;"><img class="card-img-top" style="width: 100%; height: 200px" src="'+data[add]["productPicture"]+'" alt="Card image cap"><div class="card-body">' +
                    '   <h4 class="card-title">'+data[add]["productType"]+'</h4><p class="card-text">'+description+'' +
                    '<span style="color: darkorange"></span></p>'+
                    '   <br style="line-height: .2"><a data-toggle="collapse" href="#ModalCenter'+add+'" aria-expanded="false" class="btn btn-info" data-toggle="tooltip" data-placement="right" title="View Details">View Details</a>'+
                    '   <div class="collapse" id="ModalCenter'+add+'"><div >' +
                    ' <span>ProductType&emsp;&emsp;&emsp;&emsp;:&emsp;'+data[add]["productType"]+' </span><br><span>Location&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;:&emsp;'+data[add]["country"]+' </span><br>' +
                    ' <span>City&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;:&emsp;'+data[add]["city"]+' </span><br><span>Packaging&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;:&emsp;'+data[add]["packaging"]+'</span><br>' +
                    ' <span>Payment Methods&emsp;&nbsp;&nbsp;&nbsp;:&emsp;'+data[add]["paymentMethods"]+' </span><br><span>Cost PerKg&emsp;&emsp;&emsp;&emsp;&emsp;:&emsp;'+data[add]["costPerKg"]+' </span><br>'+
                    '  ' +
                    '</div></div></div></div></div>'
                add++;
            }
            if(container===''){container='<h2 class="card-title" style="text-align: center">You do not have any post post</h2>'}
            div_container.innerHTML=container;
        }
        ajax.send(null);

     var pageControl='';
      if(last != 1){
        if(pn > 1){
            pageControl+='<button id="btn1" onclick="request_page('+(pn-1)+')" class="btn btn-default" ><</button>';
        }
//            pageControl +='<h1 style="position: absolute; margin-left:300px; margin-top:5px">'+pn+'</h1>';
        if(pn != last){
            pageControl +='<button id="btn1" style="margin-left:900px" onclick="request_page('+(pn+1)+')" class="btn btn-default" >></button>';
        }
        }
    controls.innerHTML=pageControl;
    }

</script>







<nav class="navbar navbar-color-on-scroll navbar-transparent   fixed-top  navbar-expand-lg " color-on-scroll="50" id="sectionsNav">
    <div class="container">
        <div class="navbar-translate  " >
            <a class="navbar-brand" href="#"> <img  style="width: 50px; height: 50px; margin-bottom: 8px; padding-bottom: 15px;" src="profile/assets/img/logo.png"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" aria-expanded="false" aria-label="Toggle navigation">
                <span  class="navbar-toggler-icon"></span>
                <span class="navbar-toggler-icon"></span>
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>

        <div class="collapse navbar-collapse" >
            <ul class="navbar-nav"  data-tabs="tabs">
                <li class="nav-item">
                    <a href="userporifiles" class="nav-link" > <i class="material-icons">account_circle</i>
                        Profile </a>
                </li>
                <li  class="nav-item active">
                    <a href="mypostlist" class="nav-link"> <i class="material-icons">poll</i>
                        My Post </a>
                </li>


                <li class="nav-item">
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

          {{--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">MORE</button>--}}
            {{--<!-- Modal -->--}}
            {{--<div class="modal fade" id="exampleModalCenter"  tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">--}}
                {{--<div class="modal-dialog modal-dialog-centered" role="document">--}}
                    {{--<div class="modal-content" style="z-index: 900">--}}
                        {{--<div class="modal-header">--}}
                            {{--<h3 class="modal-title" style="margin-bottom: -10px; margin-top: -10px;  float: left" id="exampleModalLongTitle">--}}
                                {{--Livestock </h3>--}}
                            {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
                                {{--<span aria-hidden="true">&times;</span>--}}
                            {{--</button>--}}
                        {{--</div>--}}
                        {{--<div class="modal-body">--}}
                            {{--<div class="card-img"><img src="assets/images/o-bananas-facebook-600x300.jpg" class="card-img-top"></div><br style="line-height: .2">--}}
                            {{--<span>ProductType&emsp;&emsp;&emsp;&emsp;:&emsp;Livestock </span><br>--}}
                            {{--<span>Location&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;:&emsp;South Africa </span><br>--}}
                            {{--<span>City&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;:&emsp;Middledrift </span><br>--}}
                            {{--<span>Packaging&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;:&emsp;Plastic Bags </span><br>--}}
                            {{--<span>Payment Methods&emsp;&nbsp;&nbsp;&nbsp;:&emsp;Cash </span><br>--}}
                            {{--<span>Cost PerKg&emsp;&emsp;&emsp;&emsp;&emsp;:&emsp;200 </span><br>--}}
                            {{--<span>Description&emsp;&emsp;&emsp;&emsp;&emsp;:&emsp;Domestic goose </span>--}}
                        {{--</div>--}}

                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}

            <div class="row" id="div_container" >



            </div>

            <div id="pagination_controls"></div>

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
            &copy;

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

{{--<script type="text/javascript" src="js/mypostlist.js"></script>--}}
<script>request_page(1);</script>
</body>

