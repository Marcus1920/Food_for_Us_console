@extends('master')
@section('content')
        <!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBwXS96_uM6y-6ZJZhSJGE87pO-qxpDp-Q&libraries=geometry,places"></script>
    <script src="dist/js/jquery-3.2.1.min.js" ></script>
    {{--<script src="dist/js/bootstrap.js" ></script>--}}

    <title>Laravel</title>

    <!-- Fonts -->
    {{--<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">--}}
    <link rel="stylesheet" href="dist/css/bootstrap.css" type="text/css">

</head>
<body>


<div class="container">


        <div style="width: 500px; height: 500px;">
            {!! Mapper::render() !!}
        </div>



</div>
@endsection

<script src="dist/js/jquery-3.2.1.min.js" ></script>
<script src="dist/js/bootstrap.js" ></script>

{{--<script type="text/javascript">--}}

{{--function addEventListener(map)--}}
{{--{--}}
{{--google.maps.event.addListener(map, 'click', function (e) {--}}
{{--var marker = new google.maps.Marker({--}}
{{--position: e.latLng,--}}
{{--map: map--}}
{{--});--}}

{{--map.panTo(e.latLng);--}}
{{--});--}}
{{--}--}}

{{--</script>--}}

</body>
</html>
