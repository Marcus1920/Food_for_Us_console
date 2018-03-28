@extends('master')

@section('content')

    <ol class="breadcrumb hidden-xs">
        <li><a href="{{ url('/master') }}">Home</a></li>
        <li><a href="{{ url('/group') }}">Groups</a></li>
        <li class="active">Add User To {{$group->name}}</li>
        {{--<li class="active"><a>  </a></li>--}}
        {{--<li class="active"><a>Posts</a></li>--}}
    </ol>
    <h4 class="page-title">Add User To {{$group->name}}</h4>
    <br/>
    <br/>
    <br/>

    <div class="row">
        <div class="container" id="cornford">

            <div class="row">
                <div class="col-md-4 col-lg-offset-2">

                    <h4 class="page-title"><center>Search Location</center> </h4>
                    &nbsp;
                    <div class="col-md-12">
                        <div class="col-md-8">
                            <div class="form-group">
                                <input type="search" id="seachmap" name="seachmap" class="form-control" placeholder="search address">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group-btn">

                                <button class="btn btn-default" onclick="geolocation()">
                                    <i class="glyphicon glyphicon-map-marker" title="Use my current location"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 ">

                        <div id="map" style="height: 450px; margin: 8px; border-radius: 10px" class="push-right"></div>

                    </div>



                </div>

                {!! Form::open(['url' => 'sendByRadius', 'method' => 'post', 'class' => 'form-horizontal']) !!}

                <div class="col-md-4">
                    <h4 class="page-title"><center>Location</center> </h4>
                    &nbsp;

                    <div class="form-group">
                        {!! Form::label('GPS Latitude', 'GPS Latitude', array('class' => 'col-md-4 control-label')) !!}
                        <div class="col-md-6">
                            {!! Form::text('lat',NULL,['class' => 'form-control input-sm','id' => 'lat']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('GPS Longitude', 'GPS Longitude', array('class' => 'col-md-4 control-label')) !!}
                        <div class="col-md-6">
                            {!! Form::text('lng',NULL,['class' => 'form-control input-sm','id' => 'lng']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('Address', 'Address', array('class' => 'col-md-4 control-label')) !!}
                        <div class="col-md-6">
                            <textarea rows="2" id="address" name="address" class="form-control"></textarea>
                        </div>
                    </div>

                    <br/>
                    <br/>
                    <br/>

                    <div class="form-group">
                        {!! Form::label('Radius', 'Radius', array('class' => 'col-md-4 control-label')) !!}
                        <div class="col-md-6">
                            {!! Form::select('radius',['0' => 'Select/All','5' => '5km','10' => '10km','15' => '15km','20' => '20km','25' => '25km',
                            '30' => '30km','35' => '35km','40' => '40km','45' => '45km','50' => '50km','60' => '60km','70' => '70km','80' => '80km','90' => '90km',
                            '100' => '100km','125' => '125km','150' => '150km','175' => '175km','200' => '200km','300' => '300km','400' => '400km','500' => '500km',
                            '600' => '600km','700' => '700km','800' => '800km','900' => '900km','1000' => '1000km',],0,['class' => 'form-control' ,'id' => 'radius']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('Message', 'Message', array('class' => 'col-md-4 control-label')) !!}
                        <div class="col-md-6">
                            <textarea rows="5" id="message" name="message" class="form-control" maxlength="500" required="required"></textarea>
                        </div>

                    </div>

                    <br>
                    <div class="form-group">
                        <div class="col-md-4"></div>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-sm">Send Message</button>

                        </div>
                    </div>

                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>

    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBwXS96_uM6y-6ZJZhSJGE87pO-qxpDp-Q&libraries=geometry,places"></script>
    <script src="dist/js/jquery-3.2.1.min.js" ></script>

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
                } else {
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
            var searchBox = new google.maps.places.SearchBox(document.getElementById("seachmap"));
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
@endsection

@section('footer')

@endsection