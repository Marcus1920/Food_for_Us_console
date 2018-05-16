@extends('master')
@section('content')
    <!-- Breadcrumb -->
    <ol class="breadcrumb hidden-xs">
        <li><a href="{{ url('/users') }}"> Home</a></li>
        <li class="active">Update Form</li>
    </ol>
    <h4 class="page-title">EDIT USER</h4>

    <!-- Basic with panel-->
    <div class="block-area" id="basic">
        <h3 class="block-title">Update Form</h3>
        <div class="tile p-15">
            {!! Form::open(['url' => 'editNewUser/'.$user->id, 'method' => 'post', 'class' => 'form-horizontal', 'id'=>"UpdateForm" ]) !!}
            {!! Form::hidden('id') !!}

            <input type="text" class="hidden" style="color:black" id="new_user_id" value={!! $user->id !!} />

            <div class="form-group">
                {!! Form::label('Name', 'Name', array('class' => 'col-md-2 control-label')) !!}
                <div class="col-md-6">
                    {!! Form::text('name',$user->name,['class' => 'form-control input-sm','id' => 'name']) !!}
                    @if ($errors->has('name'))<span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>@endif
                </div>
            </div>


            <div class="form-group">
                {!! Form::label('Surname', 'Surname', array('class' => 'col-md-2 control-label')) !!}
                <div class="col-md-6">
                    {!! Form::text('surname',$user->surname,['class' => 'street_number form-control input-sm','id' => 'surname']) !!}
                    @if ($errors->has('surname'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('surname') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('Email', 'Email', array('class' => 'col-md-2 control-label')) !!}
                <div class="col-md-6">
                    {!! Form::text('email',$user->email,['class' => 'locality form-control input-sm','id' => 'email']) !!}
                    @if ($errors->has('email'))<span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>@endif
                </div>
            </div>


            <div class="form-group">
                {!! Form::label('Cellphone', 'cellphone', array('class' => 'col-md-2 control-label')) !!}
                <div class="col-md-6">
                    {!! Form::text('cellphone',$user->cellphone,['class' => 'administrative_area_level_1 form-control input-sm','id' => 'cellphone']) !!}
                    @if ($errors->has('cellphone'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('cellphone') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('Current Location', 'Current Location', array('class' => 'col-md-2 control-label')) !!}
                <div class="col-md-6">
                    {!! Form::text('location',$user->location,['class' => 'locality form-control input-sm','id' => 'location','disabled'=>'disabled']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('New Location', 'New Location', array('class' => 'col-md-2 control-label')) !!}
                <div class="col-md-6">
                    <input type="search" id="seachmap" name="seachmap" class="form-control" placeholder="search address">
                </div>
            </div>

            <div class="col-md-12">
              <div class="col-md-4 col-lg-offset-1">

                <div id="map" style="height: 350px; margin: 8px; border-radius: 10px" class="push-left">

                </div>

              </div>
                <div class="col-md-3">
                    {!! Form::label('GPS Latitude', 'GPS Latitude', array('class' => 'col-md-4 control-label')) !!}
                    <div class="col-md-8">
                        {!! Form::text('lat',NULL,['class' => 'form-control input-sm','id' => 'lat']) !!}
                    </div>

                    {!! Form::label('GPS Longitude', 'GPS Longitude', array('class' => 'col-md-4 control-label')) !!}
                    <div class="col-md-8">
                        {!! Form::text('lng',NULL,['class' => 'form-control input-sm','id' => 'lng']) !!}
                    </div>

                    {!! Form::label('Address', 'Address', array('class' => 'col-md-4 control-label')) !!}
                    <div class="col-md-8">
                        <textarea rows="2" id="address" name="address" class="form-control"></textarea>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-offset-2 col-md-6">
                    <button type="submit" id='updateAdmin' disabled="disabled" class="btn btn-info btn-sm m-t-10">SUBMIT FORM</button>
                </div>
            </div>
            {!! Form::close() !!}
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

@endsection
@section('footer')
    <script>
        $(function()
        {
            $("#UpdateForm").keypress(function()
            {
                $("#updateAdmin").removeAttr('disabled');
            });
        })
    </script>
@endsection

