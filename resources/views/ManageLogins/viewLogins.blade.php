@extends('master')
@section('content')
    <ol class="breadcrumb hidden-xs">
        <li><a href="{{ url('/users') }}">Home</a></li>
        <li><a href="{{ url('/activeUsers') }}">Active Users</a></li>
        <li class="active">User Details</li>

    </ol>

    <h4 class="page-title">User Details</h4>

    <br/>

    <div class="col-md-12">
            <div class="col-md-4">


                <h3 class="block-title">User Details</h3>



                <div class="col-md-12" >
                    <img alt="Loading sellers picture" src="{{$user->profilePicture}}" style="width: 350px;height: 300px" >
                </div>

                <table class="table">
                    <tr>
                        <td>Name</td>
                        <td>{{$user->name}}</td>
                    </tr>
                    <tr>
                        <td> Surname</td>
                        <td>{{$user->surname}}</td>
                    </tr>
                    <tr>
                        <td> Cellphone</td>
                        <td>{{$user->cellphone}}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>{{$user->email}}</td>
                    </tr>
                    <tr>
                        <td> Gps Lattitude</td>
                        <td>{{$user->gps_lat}}</td>
                    </tr>
                    <tr>
                        <td>Gps Longitude</td>
                        <td>{{$user->gps_long}}</td>
                    </tr>
                    <tr>
                        <td>Location</td>
                        <td>{{$user->location}}</td>
                    </tr>


                </table>


            </div>
            <div class="col-md-8">

                <div class="panel panel-default">
                    <br/>
                    <div class="panel-body">
                        <h2 class="alert alert-success">Last Login</h2>

                        <p class="text-left">{{$showLogins->created_at->diffForHumans() }}</p>

                    </div>


                    <div class="panel-body">
                        <h2 class="alert alert-success">Number Of Logins</h2>

                        <p class="text-left">{{count($allLogins,0)}}</p>

                    </div>

                    <div class="panel-body">
                        <h2 class="alert alert-success">User Location</h2>
                         <div  id="map" style="height: 350px;">

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBwXS96_uM6y-6ZJZhSJGE87pO-qxpDp-Q&libraries=geometry,places"></script>

@endsection
@section('footer')

    <script>

        // Create a map object and specify the DOM element for display.
        var lat = {!! $user->gps_lat !!};
        var long = {!! $user->gps_long !!};

        var pos = {
            lat: lat,
            lng: long,

        };

        var map=new google.maps.Map(document.getElementById("map"), {
            center: {
                lat: -30.559482,
                lng: 22.937505999999985
            }, zoom: 8,

        });

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

    </script>

@endsection