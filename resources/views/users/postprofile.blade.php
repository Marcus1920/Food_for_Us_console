@extends('master')
@section('content')
    <ol class="breadcrumb hidden-xs">
        <li><a href="{{ url('/users') }}">Home</a></li>
        <li><a href="{{ url('/postslist') }}">Post Listing</a></li>
        <li class="active">Posts</li>
        {{--<li class="active"><a>  </a></li>--}}
        {{--<li class="active"><a>Posts</a></li>--}}
    </ol>
    <h4 class="page-title">Post Profile</h4>



    <div class="container-fluid" style="margin-top: 2%">

        <div class="row">

            <div class="col-md-4">
                <h3 class="block-title">Product Image</h3>
                <div class="col-md-12">
                    <img class="img" alt="Loading Product picture" src="{{$data->productPicture}}" >
                </div>
            </div>

                <div class="col-md-4">

                            <h3 class="block-title">Product Details</h3>
                    <div  id="map" style="height: 300px;">

                    </div>

                        <table class="table table-condensed">

                            <tr>
                                <td>Product Type</td>
                                <td>{{$data->Products->name}}</td>
                            </tr>
                            <tr>
                                <td>Quantity</td>
                                <td>{{$data->quantity}}</td>
                            </tr>
                            <tr>
                                <td>Cost per kg</td>
                                <td>{{$data->costPerKg}}</td>
                            </tr>
                            <tr>
                                <td>Packaging</td>
                                <td>{{$data->Packaging->name}}</td>
                            </tr>


                            <tr>
                                <td>Payment Type</td>
                                <td>{{$data->paymentMethods}}</td>
                            </tr>
                            <tr>
                                <td>Posted </td>
                                <td>{{$data->Packaging->created_at->diffForHumans()}}</td>

                                <td>{{$data->lat}}</td>
                            </tr>


                        </table>
                </div>


            <div class="col-md-4">


                        <h3 class="block-title">Sellers Details</h3>
                        <div class="col-md-12" >
                            <img alt="Loading sellers picture" src="{{$data->newuser->profilePicture}}" style="width: 350px;height: 300px" >
                        </div>

<table class="table">
    <tr>
    <td>Name</td>
    <td>{{$data->newuser->name}}</td>
    </tr>
    <tr>
        <td> Surname</td>
        <td>{{$data->newuser->surname}}</td>
    </tr>
    <tr>
        <td> Cellphone</td>
        <td>{{$data->newuser->cellphone}}</td>
    </tr>
    <tr>
        <td>Email</td>
        <td>{{$data->newuser->email}}</td>
    </tr>
    <tr>
        <td>Location</td>
        <td>{{$data->newuser->location}}</td>
    </tr>


</table>


            </div>


        </div>

        </div>



    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBwXS96_uM6y-6ZJZhSJGE87pO-qxpDp-Q&libraries=geometry,places"></script>

@endsection
@section('footer')
    {{--<script src="js/jquery.min.js"></script>--}}
    {{--<script src="js/bootstrap.min.js"></script>--}}
    {{--<script src="js/scripts.js"></script>--}}

    {{--<link href="css/bootstrap.min.css" rel="stylesheet">--}}
    {{--<link href="css/style.css" rel="stylesheet">--}}

    <script>

            // Create a map object and specify the DOM element for display.
            var lat = {!! $data->gps_lat !!};
            var long = {!! $data->gps_long !!};

            var pos = {
                lat: lat,
                lng: long,

            };

//            alert(long);

//            var latlng = new google.maps.LatLng(lat,long);

            var map=new google.maps.Map(document.getElementById("map"), {
                center: {
                    lat: -30.559482,
                    lng: 22.937505999999985
                }, zoom: 8,

            });

            {{--var lat =  {!! $data->lat !!}--}}
            {{--var long = {!! $data->long !!}--}}
            //get a marker
            var marker=new google.maps.Marker({
                position: {
                    lat: lat,
                    lng: long,
                    zoom:10
                }, map: map,
                draggable: false,
                visible:true,
                title: 'Post location',
                animation: google.maps.Animation.BOUNCE,
//                icon:"C:/Users/Thandekah/Desktop/Food for us/public/img/Markers/icons8-Map.png"
                icon:"http://154.0.164.72:8080/Foods/img/Markers/icons8-Map-1.png"
//                icon:"public/img/markers/1.png"

//            icon:'https://d30y9cdsu7xlg0.cloudfront.net/png/2955-200.png'
                //http://www.iconsdb.com/icons/preview/soylent-red/map-marker-2-xl.png
            });

            var circle = new google.maps.Circle({
                map: map,
                radius: 40000,    // 10 miles in metres
                strokeColor: '#67ff9f',
                strokeOpacity: 0.8,
                strokeWeight: 2,
                fillColor: '#baffff',
                fillOpacity: 0.35,
            });
            circle.bindTo('center', marker, 'position');

            map.setCenter(pos);


            //            var marker = new google.maps.Marker({
//                position: latlng,
//                map: map,
//                title:"location : Dublin"
//            });


    </script>

@endsection