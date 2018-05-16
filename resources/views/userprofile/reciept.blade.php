<?php
$total_row=$recipes;$rrp=4;
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


<script>

    function request_page(pn) {
        var controls=document.getElementById("pagination_controls");
        var rpp = "<?php echo $rrp; ?>", last = "<?php echo $last; ?>";
        var div_container = document.getElementById("div_container");
        var ajax = new XMLHttpRequest();
        ajax.open("GET","../getrecieptlist/"+pn, true);
        ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        ajax.onreadystatechange = function() {
            var data = JSON.parse(ajax.responseText);
            var count1,count2,container='',description='', add=0,size=0;
            if(data.length < 4){size=data.length}else{size=4}
            for(count1=0;count1 < data.length; count1+=4)
            {
                container +="<div class=\"row\">";
                for(count2=0; count2 < size ; count2++){

                    if(data[add]["description"].length > 400){description = data[add]["description"].substring(0,400)+" ...";}else{description = data[add]["description"];}name

                    container +='<div class="col-md-6 ml-auto mr-auto"><div class="card card-nav-tabs"><h4 class="card-header card-header-info">'+data[add]["name"]+'</h4>' +
                        '   <div class="card-body"><img class="card-img-top" style="width: 100%; height: 250px" src="'+data[add]["imgurl"]+'" alt="Card image cap">' +
                        '   <p class="card-text">'+description+'</p>'+
                        '   <a data-toggle="collapse" href="#ModalCenter'+add+'" aria-expanded="false" class="btn btn-info" data-toggle="tooltip" data-placement="right" title="View Details">View Details </a><div class="card-footer text-muted"> 2 days ago </div>' +
                        '  <div class="collapse" id="ModalCenter'+add+'"><div >'+
                        '  <span><b>First Name</b>&emsp;&emsp;&emsp;&emsp;<b>:</b>&emsp;'+data[add]["firstName"]+' </span><br><br><span><b>Last Name</b>&emsp;&emsp;&emsp;&emsp;<b>:</b>&emsp;'+data[add]["surname"]+' </span><br><br>'+
                        '  <span><b>Ingredients</b>&nbsp;&nbsp;&nbsp;&emsp;&emsp;&emsp;&nbsp;<b>:</b>&emsp;'+data[add]["ingredients"]+' </span><br><br><span><b>Methods</b>&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;<b>:</b>&emsp;'+data[add]["methods"]+'</span><br>' +
                        '  </div></div></div></div></div>'
                    add+=1;
                }
                container +="</div>"
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
                        Public Wall</a>
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
<div class="main main-raised">
    <div class="profile-content">
        <div class="container">
            <div  id="div_container" ></div>
            <div id="pagination_controls" class="col-sm-10 col-md-10 col-lg-10"></div><br><br><br>
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
<script>request_page(1);</script>
</body>

