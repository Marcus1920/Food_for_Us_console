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

    <div style="width: 100% ; height:600px ;">

        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <ul class="nav navbar-nav">
                    <li><a href="{{url('getPosts')}}">Sellers Posts</a></li>
                    <li><a href="{{url('getUsers')}}">Users</a></li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-10">
                        <div style=" height:600px ;">
                            @if(Session::has('success'))
                                <div class="alert alert-success alert-icon">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    {{ Session::get('success') }}
                                    <i class="icon">&#61845;</i>
                                </div>
                            @endif


                            <div id="maps2">
                                {!! Mapper::render(0) !!}
                            </div>

                        </div>
                    </div>
                    <div class="col-md-2">

                        <h2 class="tile-title" style="color: white;"><i class="glyphicon glyphicon-map-marker"></i> Marker Labels
                            <div class="pull-right">
                                <a href="{{ url('tasks') }}" >
                                    {{--Total.....<i class="n-count animated">{{ count($allTasks,0) }}</i>--}}
                                </a>
                            </div>
                        </h2>
                        <br/>
                        <br/>
                        &nbsp;
                        {{--@foreach($productTypes as $productType)--}}
                            {{--<div class="row">--}}
                                {{--<form  class="form-horizontal"  method="post" action="searchByProductType">--}}

                                    {{--<input type="hidden" name="_token" value="{!! csrf_token() !!}">--}}
                                    {{--<input type="hidden" name="productTypeId" value="{{$productType->id}}">--}}

                                    {{--<div class="col-sm-4"><button type="submit" title="Search for {{$productType->name}} cases" class="btn"><img src="{{$productType->marker_url}}" alt=""></button></div>--}}

                                    {{--<div class="col-sm-8" style="color: white;">{{$productType->name}}</div>--}}
                                {{--</form>--}}
                            {{--</div>--}}
                            {{--&nbsp;--}}
                        {{--@endforeach--}}

                    </div>
                </div>
            </div>
        </nav>

    </div>


</div>
@endsection

<script src="dist/js/jquery-3.2.1.min.js" ></script>
<script src="dist/js/bootstrap.js" ></script>

</body>
</html>
