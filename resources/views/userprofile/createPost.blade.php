<!DOCTYPE html>
<html lang="en">
<head>
    <html lang="en">

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

        input[type="date"]::-webkit-calendar-picker-indicator {
            color: rgba(0, 0, 0, 0);
            opacity: 1;
            display: block;
            background: url(https://mywildalberta.ca/images/GFX-MWA-Parks-Reservations.png) no-repeat;
            width: 20px;
            height: 20px;
            border-width: thin;
        }

        div.stars {
            width: 270px;
            display: inline-block;
        }

        input.star { display: none; }

        label.star {
            float: right;
            padding: 10px;
            font-size: 36px;
            color: #444;
            transition: all .2s;
        }

        input.star:checked ~ label.star:before {
            content: '\f005';
            color: #FD4;
            transition: all .25s;
        }

        input.star-5:checked ~ label.star:before {
            color: #FE7;
            text-shadow: 0 0 20px #952;
        }

        input.star-1:checked ~ label.star:before { color: #F62; }

        label.star:hover { transform: rotate(-15deg) scale(1.3); }

        label.star:before {
            content: '\f006';
            font-family: FontAwesome;
        }

    </style>

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

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css">

        <!-- Latest compiled and minified JavaScript -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js"></script>

        <!-- Add icon library -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    </head>

<body class="profile-page" style="z-index: 0">


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
                <li  class="nav-item">
                    <a href="mypostlist" class="nav-link"> <i class="material-icons">poll</i>
                        My Post </a>
                </li>

                <li class="nav-item dropdown active">
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
                        Public Wall</a>
                </li>

                <li class="nav-item">

                    <a href="#" class="nav-link" onclick="myFunction()" > <i class="material-icons">notifications</i>
                        Notifications</a>
                </li>
                <div class="dropdown">
                    <div id="myDropdown" class="dropdown-content">
                    </div>
                </div>

                <li class="nav-item">
                    <a href="userReport" class="nav-link"> <i class="material-icons">assessment</i>
                        Report</a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('/auth/logout') }}" class="nav-link"> <i class="material-icons">settings_power</i>
                        Logout</a>
                </li>

            </ul>

        </div>
    </div>
</nav>
<div class="page-header header-filter" data-parallax="true" style="background-image: url('profile/assets/img/FFU.png');"></div>
<div class="main main-raised">
    <div class="">

        <div class="container" style="padding-top: 30px">



            <div class="row" id="div_container" >

            <!-- Modal body -->



                    <div class="col-md-6">
                        <form method="post" action="createConsole" enctype="multipart/form-data">
                            {!! csrf_field() !!}

                    <label class="control-label" style="color:red"><i class="material-icons">local_offer</i>&nbsp;Product Details</label>

                    <div class="col-sm-12">
                        <div class="form-group label-floating">
                            <select class="custom-select" id="productType" name="productType">
                                <option>  Select Product Name</option>
                                @foreach($products as $product)
                                    <option value="{{$product->id}}">{{$product->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        @if($errors->has('productType'))<div class="alert alert-danger"><i class="material-icons">error</i>&nbsp;&nbsp;&nbsp;{{$errors->first('productType')}}</div>@endif
                    </div>


                    <div class="fileinput fileinput-new text-center col-sm-12" data-provides="fileinput" style="align-content: center">
                        <div class="fileinput-new thumbnail img-raised">
                            <img src={{ asset('assets/images/productLogo1.png') }} alt="..." height="150px">
                        </div>
                        <div class="fileinput-preview fileinput-exists thumbnail img-raised" style="height: 150px;"></div>
                        <div>
                        <span class="btn btn-raised btn-round btn-info btn-file">
                           <span class="fileinput-new">Select Product image</span>
                           <span class="fileinput-exists">Change</span>
                           <input type="file" name="file" id="file" value="{{old('file')}}"/>
                        </span>
                            <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput">
                                <i class="fa fa-times"></i> Remove</a>
                        </div>
                        @if($errors->has('file'))<div class="alert alert-danger"><i class="material-icons">error</i>&nbsp;&nbsp;&nbsp;{{$errors->first('file')}}</div>@endif
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group label-floating">
                            <label class="control-label">Grading</label>
                            <br/>
                            <div class="stars">

                                {{--<form action="">--}}
                                <input class="star star-5" id="star-5" type="radio" value="5" name="transactionRating"/>
                                <label class="star star-5" for="star-5"></label>
                                <input class="star star-4" id="star-4" type="radio" value="4" name="transactionRating"/>
                                <label class="star star-4" for="star-4"></label>
                                <input class="star star-3" id="star-3" type="radio" value="3" name="transactionRating"/>
                                <label class="star star-3" for="star-3"></label>
                                <input class="star star-2" id="star-2" type="radio" value="2" name="transactionRating"/>
                                <label class="star star-2" for="star-2"></label>
                                <input class="star star-1" id="star-1" type="radio" value="1" name="transactionRating"/>
                                <label class="star star-1" for="star-1"></label>
                                {{--</form>--}}
                            </div>
                            @if($errors->has('transactionRating'))<div class="alert alert-danger"><i class="material-icons">error</i>&nbsp;&nbsp;&nbsp;{{$errors->first('transactionRating')}}</div>@endif
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group label-floating">
                            <label class="control-label">Description</label>
                            <textarea class="form-control" aria-label="With textarea" name="description" value="{{old('description')}}" placeholder="Enter description" rows="3"></textarea>
                            @if($errors->has('description'))<div class="alert alert-danger"><i class="material-icons">error</i>&nbsp;&nbsp;&nbsp;{{$errors->first('description')}}</div>@endif
                        </div>
                    </div>

                    <label class="control-label" style="color:red"><i class="material-icons">add_location</i>&nbsp;Location</label>

                    <div class="col-sm-12">
                        <div class="form-group label-floating">
                            <label class="control-label">City/ Region</label>
                            <input type="text" class="form-control" name="city" value="{{old('city')}}" placeholder="Enter City e.g Durban">
                            @if($errors->has('city'))<div class="alert alert-danger"><i class="material-icons">error</i>&nbsp;&nbsp;&nbsp;{{$errors->first('city')}}</div>@endif
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group label-floating">
                            <label class="control-label">Pick Up Point</label>

                            <br/>

                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class="form-check-input" type="radio" name="PickUpRad" id="PickUpRad" value="0" checked>My default location
                            <br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class="form-check-input" type="radio" name="PickUpRad" id="PickUpRad" value="1" >Set pick up point
                        </div>
                    </div>

                        <label class="control-label" style="color:red"><i class="material-icons">local_mall</i>&nbsp;Packaging</label>

                        <div class="col-sm-12">
                            <div class="form-group label-floating">
                                <select class="custom-select" size={{count($packaging)}} id="packaging" name="packaging">
                                    @foreach($packaging as $package)
                                        <option value="{{$package->id}}">{{$package->name}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('packaging'))<div class="alert alert-danger"><i class="material-icons">error</i>&nbsp;&nbsp;&nbsp;{{$errors->first('packaging')}}</div>@endif
                            </div>
                        </div>

                            {{--map cordinates--}}
                            <div class="row">
                                <div class="col-md-12">

                                        {{--<label class="form-control-label"  Style="color:white; font-weight:bolder"for="form1-4-name">GPS Lattitude<span class="form-asterisk"></span></label>--}}
                                        <input type="text" hidden class="form-control" id="lat" name="gps_lat" required="" data-form-field="Name" value="{{old('gps_long')}}" placeholder="GPS Lattitude">
                                        @if($errors->has('gps_lat'))<div class="alert alert-danger"><i class="material-icons">error</i>&nbsp;&nbsp;&nbsp;{{$errors->first('gps_lat')}}</div>@endif

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">

                                        {{--<label class="form-control-label"  Style="color:white; font-weight:bolder"for="form1-4-name">GPS Longitude<span class="form-asterisk"></span></label>--}}
                                        <input type="text" hidden class="form-control col-md-9" id="lng" name="gps_long" required="" data-form-field="Name" value="{{old('gps_long')}}" placeholder="GPS Longitude">
                                        @if($errors->has('gps_long'))<div class="alert alert-danger"><i class="material-icons">error</i>&nbsp;&nbsp;&nbsp;{{$errors->first('gps_long')}}</div>@endif

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">

                                        {{--<label class="form-control-label"  Style="color:white; font-weight:bolder"for="form1-4-name">Address<span class="form-asterisk"></span></label>--}}
                                        <input type="text" hidden class="form-control col-md-9" id="address" name="address" required="" data-form-field="Name" value="{{old('location')}}" placeholder="Address">
                                        @if($errors->has('location'))<div class="alert alert-danger"><i class="material-icons">error</i>&nbsp;&nbsp;&nbsp;{{$errors->first('location')}}</div>@endif

                                </div>
                            </div>
                        {{--map cordinates end--}}
                    </div>

                    <div class="col-md-6">

                    <label class="control-label" style="color:red"><i class="material-icons">schedule</i>&nbsp;Daily Availability Times</label>

                    <div class="col-sm-12">
                        <div class="form-group label-floating">
                            <label class="control-label">Moday to Friday</label>
                            <div class="row">
                                &nbsp;&nbsp;&nbsp;&nbsp;From:&nbsp;&nbsp; <input type="time" value="08:00" name="MonToFriFrom" class="form-control col-md-4">

                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                &nbsp;&nbsp;&nbsp;&nbsp;To: &nbsp;&nbsp;<input type="time" value="17:00" name="MonToFriTo" class="form-control col-md-4">
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group label-floating">
                            <label class="control-label">Saturday</label>
                            <div class="row">
                                &nbsp;&nbsp;&nbsp;&nbsp;From:&nbsp;&nbsp; <input type="time" value="08:00" name="SatFrom" class="form-control col-md-4">

                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                &nbsp;&nbsp;&nbsp;&nbsp;To: &nbsp;&nbsp;<input type="time" value="17:00" name="SatTo" class="form-control col-md-4">
                            </div>

                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group label-floating">
                            <label class="control-label">Sunday</label>
                            <div class="row">
                                &nbsp;&nbsp;&nbsp;&nbsp;From:&nbsp;&nbsp; <input type="time" value="08:00" name="SunFrom" class="form-control col-md-4">

                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                &nbsp;&nbsp;&nbsp;&nbsp;To: &nbsp;&nbsp;<input type="time" value="17:00" name="SunTo" class="form-control col-md-4">
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group label-floating">
                            <label class="control-label">Sell by date</label>
                            <input type="date" class="form-control" name="sellByDate" value="{{$currentDate}}">
                        </div>
                    </div>

                    <label class="control-label" style="color:red"><i class="material-icons">local_mall</i>&nbsp;Quantity and Pricing</label>

                    <div class="col-sm-12">
                        <div class="form-group label-floating">
                            <label class="control-label">Quantity Available (in Kg)</label>
                            <input type="text" name="quantity" class="form-control" value="{{old('quantity')}}" placeholder="0">
                            @if($errors->has('quantity'))<div class="alert alert-danger"><i class="material-icons">error</i>&nbsp;&nbsp;&nbsp;{{$errors->first('quantity')}}</div>@endif
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group label-floating">
                            <label class="control-label">Selling Price (per Kg)</label>
                            <input type="text" name="costPerKg" value="{{old('costPerKg')}}" class="form-control" placeholder="0.00">
                            @if($errors->has('costPerKg'))<div class="alert alert-danger"><i class="material-icons">error</i>&nbsp;&nbsp;&nbsp;{{$errors->first('costPerKg')}}</div>@endif
                        </div>
                    </div>

                        <label class="control-label" style="color:red"><i class="material-icons">payment</i>&nbsp;Payment Method</label>

                    <div class="col-sm-12">
                        <div class="form-group label-floating">
                            <select class="custom-select" size="5" name="paymentMethods" id="paymentMethods" value="{{old('paymentMethods')}}">
                                <option value="EFT">EFT</option>
                                <option value="Cash">Cash</option>
                                <option value="Barter">Barter</option>
                                <option value="Bitcoin">Bitcoin</option>
                                <option value="Bank Deposit">Bank Deposit</option>
                            </select>
                            @if($errors->has('paymentMethods'))<div class="alert alert-danger"><i class="material-icons">error</i>&nbsp;&nbsp;&nbsp;{{$errors->first('paymentMethods')}}</div>@endif
                        </div>
                    </div>



                <div style="padding-top: 20px;padding-bottom: 20px; padding-left: 20px;">
                    <button type="submit" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Click To Save The Post">
                        Create
                    </button>
                </div>

                        </form>
                    </div>

            </div>

        </div>

    </div>

</div>

<script>
    $('input[name="PickUpRad"]').change(function() {
        if($(this).is(':checked') && $(this).val() == '1') {
            $('#myModal').modal('show');
        }
    });
</script>


<!-- The Modal -->
<div class="modal fade" id="myModal"   >
    <div class="modal-dialog"  >
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <label class="control-label" style="color:red"><i class="material-icons">add_location</i>&nbsp;Set Up Pick Up Point</label>
                <button type="button" class="close" data-dismiss="modal" onclick="removeOldImg()" onmousedown="removeImage()">&times;</button>
            </div>
        {{--<script>localStorage.clear()</script>--}}
        <!-- Modal body -->
            <div class="modal-body">

                <div class="col-sm-12">
                    <form method="post" action="createConsole" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                    {{--map--}}

                    <div class="form-group" style="padding-top: 25px;">
                        <input hidden type="search" id="seachmapAd" name="seachmap" class="form-control" placeholder="search address">
                    </div>

                    <div id="map" style="height: 365px; margin: 8px; border-radius: 10px" class="push-right">

                    </div>

                    <div class="row row-sm-offset">
                        <div class="col-xs-12 col-md-12">
                            <div class="form-group">
                                {{--<label class="form-control-label"  Style="color:white; font-weight:bolder"for="form1-4-name">Address<span class="form-asterisk"></span></label>--}}
                                <input type="text" hidden class="form-control col-md-9" id="address" name="location" required="" data-form-field="Name" value="{{old('location')}}" placeholder="Address">
                                @if($errors->has('location'))<div class="alert alert-danger">{{$errors->first('location')}}</div>@endif
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

                        <div class="modal-footer">
                            {{--<button type="button" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Click To Save Location" onclick="saveData()">Save</button>--}}
                            <button type="submit" class="btn btn-info" class="close" data-dismiss="modal" onclick="removeOldImg()" onmousedown="removeImage()" data-toggle="tooltip" data-placement="top" title="Click To Save Location">
                                Save
                            </button>
                        </div>

                    </form>

                </div>

            </div>
            <!-- Modal footer -->

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

<script>
    jQuery(document).ready(function($){

    });
</script>

{{--<script>--}}
{{--// With JQuery--}}
{{--$("#ex6").slider();--}}
{{--$("#ex6").on("slide", function(slideEvt) {--}}
{{--$("#ex6SliderVal").text(slideEvt.value);--}}
{{--});--}}

{{--// Without JQuery--}}
{{--var slider = new Slider("#ex6");--}}
{{--slider.on("slide", function(sliderValue) {--}}
{{--document.getElementById("ex6SliderVal").textContent = sliderValue;--}}
{{--});--}}
{{--</script>--}}

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

