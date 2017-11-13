@extends('master')
@section('content')
    <ol class="breadcrumb hidden-xs">
        <li><a href="{{ url('/users') }}">Home</a></li>
        <li><a href="{{ url('/publicWall') }}">Recipe Listing</a></li>
        <li class="active">Recipe Details</li>
    </ol>
    <h4 class="page-title">Recipe Details</h4>
    <br/>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <center>
                <img src="{{$recipe->imgurl}}" style="width: 400px;height: 300px;">
                </center>
            </div>
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h2 class="alert alert-success">Recipe Type</h2>
                        <p class="text-left">{{$recipe->type}}</p>
                    </div>
                    <div class="panel-body">
                        <h2 class="alert alert-success">Title</h2>
                        <p class="text-left">{{$recipe->name}}</p>
                    </div>
                    <div class="panel-body">
                        <h2 class="alert alert-success">Description</h2>
                        <p class="text-left">{{$recipe->description}}</p>
                    </div>
                    <div class="panel-body">
                        <h2 class="alert alert-success">Ingredients</h2>
                        <p class="text-left">{{$recipe->ingredients}}</p>
                    </div>
                    <div class="panel-body">
                        <h2 class="alert alert-success">Methods</h2>
                        <p class="text-left">{{$recipe->methods}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
@endsection