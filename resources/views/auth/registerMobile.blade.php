<!DOCTYPE html>
<html >
<head>
    <!-- Site made with Mobirise Website Builder v4.5.4, https://mobirise.com -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
    <link rel="icon" type="image/x-icon" sizes="16x16" href="{{ asset('img/food_for_us_logo.png') }}">
    <meta name="description" content="Web Page Creator Description">
    <title>Register </title>
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

        background-image:url('assets/images/ffu-1920x1280.png')  ;

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
                        <a class="navbar-caption" href="userporifiles">Food For Us</a>
                    </div>

                </div>
                <div class="mbr-table-cell">

                    <button class="navbar-toggler pull-xs-right hidden-md-up" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar">
                        <div class="hamburger-icon"></div>
                    </button>

                    <ul class="nav-dropdown collapse pull-xs-right nav navbar-nav navbar-toggleable-sm" id="exCollapsingNavbar">
                        <li class="nav-item"><a class="nav-link link" href="lading">HOME</a></li>
                        <li class="nav-item"><a class="nav-link link" href="recentPost" aria-expanded="false">RECENT POST</a></li>
                        <li class="nav-item"><a class="nav-link link" href="lading" aria-expanded="false"></a></li>
                        <li class="nav-item nav-btn"><a class="nav-link btn btn-white btn-white-outline" href="dologin">Login</a></li></ul>
                    <button hidden="" class="navbar-toggler navbar-close" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar">
                        <div class="close-icon"></div>
                    </button>

                </div>
            </div>

        </div>
    </nav>

</section>

<section class="engine"><a href="#">web page software</a></section><section class="mbr-section form1 mbr-parallax-background mbr-after-navbar" id="form1-4" data-rv-view="28" style="background-image: url(assets/images/ffu-1920x1280.png); padding-top: 150px; padding-bottom: 250px;">

    {{--<div class="mbr-section mbr-section__container mbr-section__container--middle">--}}
        {{--<div class="container">--}}
            {{--<div class="row">--}}
                {{--<div class="col-xs-12 text-xs-center">--}}

                    {{--<small class="mbr-section-subtitle">.</small>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}

    <div class="mbr-section mbr-section-nopadding">
        <div class="container">
            <div class="row">
                {{--<div class="col-xs-12 col-lg-10 col-lg-offset-1 " >--}}


                    <div data-form-alert="true">
                        <div hidden="" data-form-alert-success="true" class="alert alert-form alert-success text-xs-center">Thanks for filling out form!</div>
                        @if (Session::has('status'))
                            <div class="alert alert-form alert-success text-xs-center">{{ Session::get('status') }}</div>
                        @endif
                    </div>

                {{--@if ($errors->any())--}}
                    {{--<div class="alert alert-danger">--}}
                        {{--<ul>--}}
                            {{--@foreach ($errors->all() as $error)--}}
                                {{--<li>{{ $error }}</li>--}}
                            {{--@endforeach--}}
                        {{--</ul>--}}
                    {{--</div>--}}
                {{--@endif--}}



                {{--<div class="alert alert-success">{{$success}}  <a href="../dologin"><b>login</b></a></div>--}}

                    <div class="col-md-12">
                        <form method="post" action="api/v1/registerMobile">
                        <div class="col-md-6">
                                {!! csrf_field() !!}

                                <div class="row row-sm-offset">
                                    <div class="col-xs-12 col-md-10">
                                        <div class="form-group">
                                            <label class="form-control-label"  Style="color:white; font-weight:bolder"for="form1-4-name">Name<span class="form-asterisk"></span></label>
                                            <input type="text" class="form-control" name="name" required="" data-form-field="Name" id="form1-4-name" value="{{old('name')}}">
                                            @if($errors->has('name'))<div class="alert alert-danger">{{$errors->first('name')}}</div>@endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row row-sm-offset">
                                    <div class="col-xs-12 col-md-10">
                                        <div class="form-group">
                                            <label class="form-control-label"  Style="color:white; font-weight:bolder"for="form1-4-name">Surname<span class="form-asterisk"></span></label>
                                            <input type="text" class="form-control" name="surname" required="" data-form-field="Name" id="form1-4-name" value="{{old('surname')}}">
                                            @if($errors->has('surname'))<div class="alert alert-danger">{{$errors->first('surname')}}</div>@endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row row-sm-offset">
                                    <div class="col-xs-12 col-md-10">
                                        <div class="form-group">
                                            <label class="form-control-label"  Style="color:white; font-weight:bolder"for="form1-4-name">Email<span class="form-asterisk"></span></label>
                                            <input type="email" class="form-control" name="emails" required="" data-form-field="Name" id="form1-4-name" value="{{old('emails')}}">
                                            @if($errors->has('email'))<div class="alert alert-danger">{{$errors->first('email')}}</div>@endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row row-sm-offset">
                                    <div class="col-xs-12 col-md-10">
                                        <div class="form-group">
                                            <label class="form-control-label"  Style="color:white; font-weight:bolder"for="form1-4-name">Interest<span class="form-asterisk"></span></label>
                                            <select name="intrest" class="form-control" data-form-field="Name" id="form1-4-name">
                                                <option value="">Select Interest</option>
                                                <option value="Seller">Seller</option>
                                                <option value="Buyer">Buyer</option>
                                            </select>
                                            @if($errors->has('intrest'))<div class="alert alert-danger">{{$errors->first('intrest')}}</div>@endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row row-sm-offset">
                                    <div class="col-xs-12 col-md-10">
                                        <div class="form-group">
                                            <label class="form-control-label"  Style="color:white; font-weight:bolder"for="form1-4-name">Cellphone<span class="form-asterisk"></span></label>
                                            <input type="text" class="form-control" name="cell" required="" data-form-field="Name" id="form1-4-name" value="{{old('cell')}}">
                                            @if($errors->has('cell'))<div class="alert alert-danger">{{$errors->first('cell')}}</div>@endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row row-sm-offset">
                                    <div class="col-xs-12 col-md-10">
                                        <div class="form-group">
                                            <label class="form-control-label"  Style="color:white; font-weight:bolder"for="form1-4-name">Identity Number<span class="form-asterisk"></span></label>
                                            <input type="text" class="form-control" name="IdNumber" required="" data-form-field="Name" id="form1-4-name" value="{{old('IdNumber')}}">
                                            @if($errors->has('IdNumber'))<div class="alert alert-danger">{{$errors->first('IdNumber')}}</div>@endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row row-sm-offset">
                                    <div class="col-xs-12 col-md-10">
                                        <div class="form-group">
                                            <label class="form-control-label"  Style="color:white; font-weight:bolder"for="form1-4-name">Travel Radius<span class="form-asterisk"></span></label>
                                            <select name="travel_radius" class="form-control" data-form-field="Name" id="form1-4-name">
                                                <option value="">Select Travel Radius</option>
                                                <option value="10 km">10 km</option>
                                                <option value="20 km">20 km</option>
                                                <option value="30 km">30 km</option>
                                                <option value="40 km">40 km</option>
                                                <option value="50 km">50 km</option>
                                                <option value="60 km">60 km</option>
                                                <option value="70 km">70 km</option>
                                                <option value="80 km">80 km</option>
                                                <option value="90 km">90 km</option>
                                                <option value="100 km">100 km</option>
                                            </select>
                                            @if($errors->has('travel_radius'))<div class="alert alert-danger">{{$errors->first('travel_radius')}}</div>@endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row row-sm-offset">
                                    <div class="col-xs-12 col-md-10">
                                        <div class="form-group">
                                            <label class="form-control-label"  Style="color:white; font-weight:bolder"for="form1-4-name">Mode of transport<span class="form-asterisk"></span></label>
                                            <select name="description_of_acces" class="form-control" data-form-field="Name" id="form1-4-name">
                                                <option value="">Select Mode of transport</option>
                                                <option value="Tar road-Any vehicle">Tar road-Any vehicle</option>
                                                <option value="Dirt road-Any vehicle">Dirt road-Any vehicle</option>
                                                <option value="Dirt road-Bakkie or Truck (4x4 rainy season)">Dirt road-Bakkie or Truck (4x4 rainy season)</option>
                                                <option value="Dirt road-no large trucks">Dirt road-no large trucks</option>
                                                <option value="Dirt road-4x4">Dirt road-4x4</option>
                                                <option value="Dirt road-4x4 only">Dirt road-4x4 only</option>
                                            </select>
                                            @if($errors->has('description_of_acces'))<div class="alert alert-danger">{{$errors->first('description_of_acces')}}</div>@endif
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group" style="padding-top: 25px">
                                <input type="search" id="seachmapAd" name="seachmap" class="form-control" placeholder="search address">
                            </div>

                            <div id="map" style="height: 365px; margin: 8px; border-radius: 10px" class="push-right">

                            </div>

                            <div class="row row-sm-offset">
                                <div class="col-xs-12 col-md-12">
                                    <div class="form-group">
                                        <label class="form-control-label"  Style="color:white; font-weight:bolder"for="form1-4-name">GPS Lattitude<span class="form-asterisk"></span></label>
                                        <input type="text" class="form-control" id="lat" name="gps_long" required="" data-form-field="Name" value="{{old('gps_long')}}">
                                        @if($errors->has('gps_lat'))<div class="alert alert-danger">{{$errors->first('gps_lat')}}</div>@endif
                                    </div>
                                </div>
                            </div>

                            <div class="row row-sm-offset">
                                <div class="col-xs-12 col-md-12">
                                    <div class="form-group">
                                        <label class="form-control-label"  Style="color:white; font-weight:bolder"for="form1-4-name">GPS Longitude<span class="form-asterisk"></span></label>
                                        <input type="text" class="form-control col-md-9" id="lng" name="gps_long" required="" data-form-field="Name" value="{{old('gps_long')}}">
                                        @if($errors->has('gps_long'))<div class="alert alert-danger">{{$errors->first('gps_long')}}</div>@endif
                                    </div>
                                </div>
                            </div>

                            <div class="row row-sm-offset">
                                <div class="col-xs-12 col-md-12">
                                    <div class="form-group">
                                        <label class="form-control-label"  Style="color:white; font-weight:bolder"for="form1-4-name">Address<span class="form-asterisk"></span></label>
                                        <input type="text" class="form-control col-md-9" id="address" name="location" required="" data-form-field="Name" value="{{old('location')}}">
                                        @if($errors->has('location'))<div class="alert alert-danger">{{$errors->first('location')}}</div>@endif
                                    </div>
                                </div>
                            </div>

                            <div style="padding-top: 20px"><button type="submit" class="btn btn-primary">Register</button></div>

                        </div>
                        </form>
                    </div>



                {{--</div>--}}
            </div>
        </div>
    </div>

    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBwXS96_uM6y-6ZJZhSJGE87pO-qxpDp-Q&libraries=geometry,places"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" ></script>

    <script async defer language="javascript">
        if(navigator.onLine)
        {
            //initialize map
            var map=new google.maps.Map(document.getElementById("map"), {
                center: {
                    lat: -30.559482,
                    lng: 22.937505999999985
                }, zoom: 2,
            });
            //get a marker
            var marker=new google.maps.Marker({
                position: {
                    lat: -30.559482,
                    lng: 22.937505999999985,
                }, map: map,
                draggable: true,
                visible:false,
                icon:"img/Markers/16.png"
//            icon:'https://d30y9cdsu7xlg0.cloudfront.net/png/2955-200.png'
                //http://www.iconsdb.com/icons/preview/soylent-red/map-marker-2-xl.png
            });
            var marker2=[];
            infoWindow = new google.maps.InfoWindow;
            //function for current location
            function geolocation()
            {
                if(marker2.visible==true)
                {
                    marker2.setVisible(false);
                }
                //find the current location
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function(position) {
                        var pos = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude,
                        };
                        //clear default marker
                        marker.setVisible(false);
                        marker2=new google.maps.Marker({
                            position: {
                                lat: -30.559482,
                                lng: 22.937505999999985,
                            }, map: map,
                            draggable: true,
                            zoom:10.,
                            icon:"img/Markers/16.png"
                            //            icon:'https://d30y9cdsu7xlg0.cloudfront.net/png/2955-200.png'
                        });
                        $('#lat').val(pos['lat']);
                        $('#lng').val(pos['lng']);
                        google.maps.event.addListener(marker2,'position_changed',function(){
                            var lat=marker2.getPosition().lat();
                            var lng=marker2.getPosition().lng();
                            $('#lat').val(lat);
                            $('#lng').val(lng);
                            geocoder = new google.maps.Geocoder();
                            geocoder.geocode( { 'location': {'lat': lat, 'lng': lng} }, function(results, status) {
                                if (status == 'OK') {
                                    console.log('geocoded! results - ',results);

                                    var sAddress = "";
                                    sAddress = results[0].formatted_address;
                                    $("#address").val(sAddress);
                                } else {
                                    console.log('Geocode was not successful for the following reason: ' + status);
                                }
                            });

                        })
                        //to get the address of the current location
                        var geocoder = new google.maps.Geocoder;
                        var input = pos['lat']+','+pos['lng'];
                        var latlngStr = input.split(',', 2);
                        var latlng = {lat: parseFloat(latlngStr[0]), lng: parseFloat(latlngStr[1])};
                        geocoder.geocode({'location': latlng}, function(results, status) {
                            if (status === 'OK') {
                                if (results[0]) {
                                    $('#address').val(results[0].formatted_address);
                                    infoWindow.setContent("<div id='infor' style='color: initial'>"+results[0].formatted_address+"</div>")
                                } else {
                                    window.alert('No results found');
                                }
                            } else {
                                window.alert('Geocoder failed due to: ' + status);
                            }
                        });
                        infoWindow.setPosition(pos);
                        map.setCenter(pos);
                        map.setZoom(19);
                        marker2.setPosition(pos);
                        infoWindow.open(map,marker2);
                    }, function() {
                        handleLocationError(true, infoWindow, map.getCenter());
                    });
                }
                else
                {
                    // Browser doesn't support Geolocation
                    handleLocationError(false, infoWindow, map.getCenter());
                }
                function handleLocationError(browserHasGeolocation, infoWindow, pos) {
                    infoWindow.setPosition(pos);
                    infoWindow.setContent(browserHasGeolocation ?
                        'Error: The Geolocation service failed.' :
                        'Error: Your browser doesn\'t support geolocation.');
                    infoWindow.open(map,marker2);
                }
            }
            //Search for location
            var searchBox = new google.maps.places.SearchBox(document.getElementById("seachmapAd"));
            //when the maker is dragged arround then change both cordinates
            google.maps.event.addListener(searchBox,'places_changed',function(){
                //clear a marker for current location
                //marker2.setVisible(false);
                if(marker2.visible==true)
                {
                    marker2.setVisible(false);
                }
                var places=searchBox.getPlaces();
                var bounds=new google.maps.LatLngBounds();
                var i,place;
                for (i=0;place=places[i];i++)
                {
                    bounds.extend(place.geometry.location);
                    marker.setPosition(place.geometry.location);
                    var lat=marker.getPosition().lat();
                    var lng=marker.getPosition().lng();
                    $('#lat').val(lat).disabled=true;
                    $('#lng').val(lng);
                    //to get the address of the place searched
                    var geocoder = new google.maps.Geocoder;
                    var input = lat+','+lng;
                    var latlngStr = input.split(',', 2);
                    var latlng = {lat: parseFloat(latlngStr[0]),   lng: parseFloat(latlngStr[1])};
                    geocoder.geocode({'location': latlng}, function(results, status) {
                        if (status === 'OK') {
                            if (results[0]) {
                                $('#address').val(results[0].formatted_address);
                                infoWindow.setContent("<div id='infor' style='color: initial'>"+results[0].formatted_address+"</div>")
                            } else {
                                window.alert('No results found');
                            }
                        } else {
                            window.alert('Geocoder failed due to bugs: ' + status);
                        }
                    });
                    marker.setVisible(true);
                    infoWindow.open(map,marker);
                }
                map.fitBounds(bounds);
                map.setZoom(19);
                google.maps.event.addListener(marker,'position_changed',function(){
                    var lat=marker.getPosition().lat();
                    var lng=marker.getPosition().lng();
                    $('#lat').val(lat);
                    $('#lng').val(lng);
                })
                //reset search box
                $('#seachmap').val(null);
            });
        }
        else
        {
//        alert("you are offline");
            (document.getElementById("map")).innerHTML="<a href='{{url('map2')}}'> <img src='img/NoNetwork.png' alt='Network connection failed,Please refresh'></a>";
        }
    </script>

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