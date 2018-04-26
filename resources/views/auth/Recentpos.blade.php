<?php
$total_row=$sellers_posts;$rrp=4;
$last=ceil($total_row / $rrp);
if($last < 1){$last=1;}
?>
<!DOCTYPE html>
</html>
<html >
<head>
    <!-- Site made with Mobirise Website Builder v4.5.4, https://mobirise.com -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="generator" content="Mobirise v4.5.4, mobirise.com">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
    <link rel="icon" type="image/x-icon" sizes="16x16" href="{{ asset('img/food_for_us_logo.png') }}">
    <meta name="description" content="Food  for   us ">
    <title>Food  for us </title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,700">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic&subset=latin">
    <link rel="stylesheet" href="assets/bootstrap-material-design-font/css/material.css">
    <link rel="stylesheet" href="assets/tether/tether.min.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/soundcloud-plugin/style.css">
    <link rel="stylesheet" href="assets/dropdown/css/style.css">
    <link rel="stylesheet" href="assets/animate.css/animate.min.css">
    <link rel="stylesheet" href="assets/theme/css/style.css">
    <link rel="stylesheet" href="assets/mobirise/css/mbr-additional.css" type="text/css">



</head>





<body>


<script>

    function request_page(pn) {
        var controls=document.getElementById("pagination_controls");
        var rpp = "<?php echo $rrp; ?>", last = "<?php echo $last; ?>";
        var div_container = document.getElementById("div_container");
        var ajax = new XMLHttpRequest();
        ajax.open("GET","../postrecent/"+pn, true);
        ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        ajax.onreadystatechange = function() {
            var data = JSON.parse(ajax.responseText);
            var count1,count2,container='', adds=0,size=data.length,num=4;
            for(count1=0;count1 < data.length ; count1+=4)
            {
                container +="<div class=\"mbr-cards-row row\">";
                for(count2=0; count2 < num ; count2++){
                    container +='<div class=\"mbr-cards-col col-xs-12 col-lg-3\" style=\"padding-top: 80px;  padding-bottom: 80px;\">' +
                        ' <div class=\"container\"> <div class=\"card cart-block\" > <div class=\"card-img\"><img src=\"'+data[adds]["productPicture"]+'" class="card-img-top" data-toggle="modal" data-target="#exampleModalCenter'+adds+'" style="width:200px;height:200px;cursor: pointer"></div>' +
                        ' <div class=\"card-block\"> <h4 class=\"card-title\">'+data[adds]["productType"]+'</h4><h5 class=\"card-subtitle\"><'+data[adds]["country"]+'/'+data[adds]["city"]+'</h5>' +
                        ' <p class=\"card-text\" style="text-align: center">'+data[adds]["description"]+'</p>' +
                        ' <div class=\"card-btn\"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter'+adds+'">View</button></div></div></div>' +
                        ' <div class="modal fade" id="exampleModalCenter'+adds+'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">' +
                        ' <div class="modal-dialog modal-dialog-centered" role="document"> <div class="modal-content"> <div class="modal-header">' +
                        ' <h3 class="modal-title" style="margin-bottom: -10px; margin-top: -10px;  float: left" id="exampleModalLongTitle">'+data[adds]["productType"]+' </h3>' +
                        ' <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span> </button></div><div class="modal-body">' +
                        ' <div class="card-img"><img src="'+data[adds]["productPicture"]+'" style="width: 100%; height: 350px" class="card-img-top"></div><br style="line-height: .2">' +
                        ' <span>ProductType&emsp;&emsp;&emsp;&emsp;:&emsp;'+data[adds]["productType"]+' </span><br><span>Location&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;:&emsp;'+data[adds]["country"]+' </span><br>' +
                        ' <span>City&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;:&emsp;'+data[adds]["city"]+' </span><br><span>Packaging&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;:&emsp;'+data[adds]["packaging"]+' </span><br>' +
                        ' <span>Payment Methods&emsp;&nbsp;&nbsp;&nbsp;:&emsp;'+data[adds]["paymentMethods"]+' </span><br><span>Cost PerKg&emsp;&emsp;&emsp;&emsp;&emsp;:&emsp;'+data[adds]["costPerKg"]+' </span><br>' +
                        ' <span>Description&emsp;&emsp;&emsp;&emsp;&emsp;:&emsp;'+data[adds]["description"]+' </span></div> </div></div></div></div></div>' ;
                    adds ++;
                    if(data.length - (adds-3) < 4){num=data.length - (adds-1) }else{num=4}
                }
                container += "</div>";
            }
            div_container.innerHTML=container;
        }
        ajax.send(null);

        var pageControl='';
        if(last != 1){
            if(pn > 1){
                pageControl+='<button  style="margin-left: 150px; float: left" onclick="request_page('+(pn-1)+')" class="btn btn-default" >Prev</button>';
            }
            pageControl +='<h1 style="position: absolute; margin-left:650px; margin-top:0px" align="center"> '+pn+'</h1>';
            if(pn != last){
                pageControl +='<button id="btn1" style="float:right;margin-right:250px" onclick="request_page('+(pn+1)+')" class="btn btn-default" >Next</button>';
            }
        }
        controls.innerHTML=pageControl;
    }

</script>





<section id="menu-7" data-rv-view="53">

    <nav class="navbar navbar-dropdown transparent navbar-fixed-top bg-color">
        <div class="container">

            <div class="mbr-table">
                <div class="mbr-table-cell">

                    <div class="navbar-brand">
                        <a href="#" class="navbar-logo"><img src="assets/images/logo-128x128.png" alt="Mobirise"></a>
                        <a class="navbar-caption" href="#">Food For Us</a>
                    </div>

                </div>
                <div class="mbr-table-cell">

                    <button class="navbar-toggler pull-xs-right hidden-md-up" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar">
                        <div class="hamburger-icon"></div>
                    </button>

                    <ul class="nav-dropdown collapse pull-xs-right nav navbar-nav navbar-toggleable-sm" id="exCollapsingNavbar"><li class="nav-item"><a class="nav-link link" href="lading">HOME</a></li><li class="nav-item"><a class="nav-link link" href="recentPost" aria-expanded="false">RECENT POST</a></li><li class="nav-item"><a class="nav-link link" href="/" aria-expanded="false"></a></li><li class="nav-item nav-btn"><a class="nav-link btn btn-white btn-white-outline" href="dologin">Login</a></li></ul>
                    <button hidden="" class="navbar-toggler navbar-close" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar">
                        <div class="close-icon"></div>
                    </button>

                </div>
            </div>

        </div>
    </nav>

</section>

<section class="engine"><a href="#">web creator</a></section><section class="mbr-section article mbr-parallax-background mbr-after-navbar" id="msg-box8-b" data-rv-view="87" style="background-image: url(assets/images/mbr-720x1080.jpg); padding-top: 0px; padding-bottom: 80px;">

    <div class="mbr-overlay" style="opacity: 0.8; background-color: rgb(34, 34, 34);">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 text-xs-center">
                <h3 class="mbr-section-title display-2"></h3>
                <div class="lead"></div>

            </div>
        </div>
    </div>

</section>

{{--<section class="mbr-cards mbr-section mbr-section-nopadding" id="features3-8" data-rv-view="54" style="background-color: rgb(255, 255, 255);">--}}



    {{--<div class="mbr-cards-row row">--}}
        {{--<div class="mbr-cards-col col-xs-12 col-lg-3" style="padding-top: 80px; padding-bottom: 80px;">--}}
            {{--<div class="container">--}}
                {{--<div class="card cart-block">--}}
                    {{--<div class="card-img"><img src="assets/images/o-bananas-facebook-600x300.jpg" class="card-img-top"></div>--}}
                    {{--<div class="card-block">--}}
                        {{--<h4 class="card-title">Bootstrap 4</h4>--}}
                        {{--<h5 class="card-subtitle">Bootstrap 4 has been noted</h5>--}}
                        {{--<p class="card-text">Bootstrap 4 has been noted as one of the most reliable and proven frameworks and Mobirise has been equipped to develop websites using this framework.</p>--}}
                        {{--<div class="card-btn"><a href="https://mobirise.com" class="btn btn-primary">MORE</a></div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="mbr-cards-col col-xs-12 col-lg-3" style="padding-top: 80px; padding-bottom: 80px;">--}}
            {{--<div class="container">--}}
                {{--<div class="card cart-block">--}}
                    {{--<div class="card-img"><img src="assets/images/carrots-for-sale-1523187977qan-600x357.jpg" class="card-img-top"></div>--}}
                    {{--<div class="card-block">--}}
                        {{--<h4 class="card-title">Responsive</h4>--}}
                        {{--<h5 class="card-subtitle">One of Bootstrap 4's big points</h5>--}}
                        {{--<p class="card-text">One of Bootstrap 4's big points is responsiveness and Mobirise makes effective use of this by generating highly responsive website for you.</p>--}}
                        {{--<div class="card-btn"><a href="https://mobirise.com" class="btn btn-primary">MORE</a></div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="mbr-cards-col col-xs-12 col-lg-3" style="padding-top: 80px; padding-bottom: 80px;">--}}
            {{--<div class="container">--}}
                {{--<div class="card cart-block">--}}
                    {{--<div class="card-img"><img src="assets/images/orangeedit-600x463.jpg" class="card-img-top"></div>--}}
                    {{--<div class="card-block">--}}
                        {{--<h4 class="card-title">Web Fonts</h4>--}}
                        {{--<h5 class="card-subtitle">Google has a highly exhaustive list of fonts</h5>--}}
                        {{--<p class="card-text">Google has a highly exhaustive list of fonts compiled into its web font platform and Mobirise makes it easy for you to use them on your website easily and freely.</p>--}}
                        {{--<div class="card-btn"><a href="https://mobirise.com" class="btn btn-primary">MORE</a></div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="mbr-cards-col col-xs-12 col-lg-3" style="padding-top: 80px; padding-bottom: 80px;">--}}
            {{--<div class="container">--}}
                {{--<div class="card cart-block">--}}
                    {{--<div class="card-img"><img src="assets/images/o-bananas-facebook-600x300.jpg" class="card-img-top"></div>--}}
                    {{--<div class="card-block">--}}
                        {{--<h4 class="card-title">Unlimited Sites</h4>--}}
                        {{--<h5 class="card-subtitle">Mobirise gives you the freedom to develop</h5>--}}
                        {{--<p class="card-text">Mobirise gives you the freedom to develop as many websites as you like given the fact that it is a desktop app.</p>--}}
                        {{--<div class="card-btn"><a href="https://mobirise.com" class="btn btn-primary">MORE</a></div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}


    {{--</div>--}}
{{--</section>--}}


<section class="mbr-cards mbr-section mbr-section-nopadding" id="features3-9" data-rv-view="57" style="background-color: rgb(255, 255, 255);">


    {{--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">MORE</button>--}}

    {{--<!-- Modal -->--}}
    {{--<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">--}}
        {{--<div class="modal-dialog modal-dialog-centered" role="document">--}}
            {{--<div class="modal-content">--}}
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


<div id="div_container" >






    {{--<div class="mbr-cards-row row">--}}

        {{--<div class="mbr-cards-col col-xs-12 col-lg-3" style="padding-top: 80px; padding-bottom: 80px;">--}}
            {{--<div class="container">--}}
                {{--<div class="card cart-block">--}}
                    {{--<div class="card-img"><img src="assets/images/o-bananas-facebook-600x300.jpg" class="card-img-top"></div>--}}
                    {{--<div class="card-block">--}}
                        {{--<h4 class="card-title">Bootstrap 4</h4>--}}
                        {{--<h5 class="card-subtitle">Bootstrap 4 has been noted</h5>--}}
                        {{--<p class="card-text">Bootstrap 4 has been noted as one of the most reliable and proven frameworks and Mobirise has been equipped to develop websites using this framework.</p>--}}
                        {{--<div class="card-btn"><a href="https://mobirise.com" class="btn btn-primary">MORE</a></div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}

        {{--<div class="mbr-cards-col col-xs-12 col-lg-3" style="padding-top: 80px; padding-bottom: 80px;">--}}
            {{--<div class="container">--}}
                {{--<div class="card cart-block">--}}
                    {{--<div class="card-img"><img src="assets/images/orangeedit-600x463.jpg" class="card-img-top"></div>--}}
                    {{--<div class="card-block">--}}
                        {{--<h4 class="card-title">Responsive</h4>--}}
                        {{--<h5 class="card-subtitle">One of Bootstrap 4's big points</h5>--}}
                        {{--<p class="card-text">One of Bootstrap 4's big points is responsiveness and Mobirise makes effective use of this by generating highly responsive website for you.</p>--}}
                        {{--<div class="card-btn"><a href="https://mobirise.com" class="btn btn-primary">MORE</a></div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="mbr-cards-col col-xs-12 col-lg-3" style="padding-top: 80px; padding-bottom: 80px;">--}}
            {{--<div class="container">--}}
                {{--<div class="card cart-block">--}}
                    {{--<div class="card-img"><img src="assets/images/carrots-for-sale-1523187977qan-600x357.jpg" class="card-img-top"></div>--}}
                    {{--<div class="card-block">--}}
                        {{--<h4 class="card-title">Web Fonts</h4>--}}
                        {{--<h5 class="card-subtitle">Google has a highly exhaustive list of fonts</h5>--}}
                        {{--<p class="card-text">Google has a highly exhaustive list of fonts compiled into its web font platform and Mobirise makes it easy for you to use them on your website easily and freely.</p>--}}
                        {{--<div class="card-btn"><a href="https://mobirise.com" class="btn btn-primary">MORE</a></div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="mbr-cards-col col-xs-12 col-lg-3" style="padding-top: 80px; padding-bottom: 80px;">--}}
            {{--<div class="container">--}}
                {{--<div class="card cart-block">--}}
                    {{--<div class="card-img"><img src="assets/images/o-bananas-facebook-600x300.jpg" class="card-img-top"></div>--}}
                    {{--<div class="card-block">--}}
                        {{--<h4 class="card-title">Unlimited Sites</h4>--}}
                        {{--<h5 class="card-subtitle">Mobirise gives you the freedom to develop</h5>--}}
                        {{--<p class="card-text">Mobirise gives you the freedom to develop as many websites as you like given the fact that it is a desktop app.</p>--}}
                        {{--<div class="card-btn"><a href="https://mobirise.com" class="btn btn-primary">MORE</a></div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}


    {{--</div>--}}

</div>
    <div id="pagination_controls"></div>
</section>


<script src="assets/web/assets/jquery/jquery.min.js"></script>
<script src="assets/tether/tether.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/viewport-checker/jquery.viewportchecker.js"></script>
<script src="assets/jarallax/jarallax.js"></script>
<script src="assets/dropdown/js/script.min.js"></script>
<script src="assets/touch-swipe/jquery.touch-swipe.min.js"></script>
<script src="assets/smooth-scroll/smooth-scroll.js"></script>
<script src="assets/theme/js/script.js"></script>
{{--<script type="text/javascript" src="js/RecentContent.js"></script>--}}

<input name="animation" type="hidden">
<script>request_page(1);</script>
</body>
</html>