@extends('master')
@section('content')
    <ol class="breadcrumb hidden-xs">
        <li><a href="{{ url('/users') }}">Home</a></li>
        <li><a href="{{ url('/publicWall') }}">Recipe Listing</a></li>
        <li class="active">Recipe Details</li>
        {{--<li class="active"><a>  </a></li>--}}
        {{--<li class="active"><a>Posts</a></li>--}}
    </ol>

    <h4 class="page-title">Recipe Details</h4>

    <br/>


    {{--<div class="col-md-8">--}}
        {{--<div class="block-area" style="">--}}
            {{--<div class="row" style="margin-left: 0%">--}}
                {{--<center>--}}
                {{--<div class="col-md-12">--}}
                    {{--<img alt="" src="{{$recipe->imgurl}}" style="width: 400px;height: 300px;">--}}
                {{--</div>--}}
                {{--</center>--}}
            {{--</div><br/><br/>--}}





            {{--<form class="form-horizontal" role="form">--}}
                {{--<div class="form-group">--}}

                    {{--<label class="col-sm-3 control-label">--}}
                        {{--Recipe Type--}}
                    {{--</label>--}}
                    {{--<div class="col-sm-8">--}}
                        {{--<input type="text" class="form-control" value="{{$recipe->type}}" readonly>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="form-group">--}}

                    {{--<label  class="col-sm-3 control-label">--}}
                        {{--Title--}}
                    {{--</label>--}}
                    {{--<div class="col-sm-8">--}}
                        {{--<input type="text" class="form-control" value="{{$recipe->name}}" readonly>--}}
                    {{--</div>--}}
                {{--</div>--}}

                {{--<div class="form-group">--}}

                    {{--<label  class="col-sm-3 control-label">--}}
                        {{--Description--}}
                    {{--</label>--}}
                    {{--<div class="col-sm-8">--}}
                        {{--<input type="text" class="form-control" value="{{$recipe->description}}" readonly>--}}
                    {{--</div>--}}
                {{--</div>--}}

                {{--<div class="form-group">--}}

                    {{--<label class="col-sm-3 control-label">--}}
                        {{--Ingredients--}}
                    {{--</label>--}}
                    {{--<div class="col-sm-8">--}}
                        {{--<input type="text" class="form-control" value="{{$recipe->ingredients}}" id="packaging" readonly>--}}
                    {{--</div>--}}
                {{--</div>--}}

                {{--<div class="form-group">--}}

                    {{--<label  class="col-sm-3 control-label">--}}
                        {{--Methods--}}
                    {{--</label>--}}
                    {{--<div class="col-sm-8">--}}
                        {{--<input type="text" class="form-control" value="{{$recipe->methods}}" id="payment" readonly>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</form>--}}
            {{--<br/>--}}
        {{--</div>--}}
    {{--</div>--}}

    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <img  alt="recipe" src="{{$recipe->RecipePicture}}" style="width: 400px;height: 300px;">
            </div>
            <div class="col-md-8">

                <div class="panel panel-default">

                    <div class="panel-body">
                        <h2>Recipe Type</h2>

                        <p class="text-left">{{$recipe->type}}</p>

                    </div>


                    <div class="panel-body">
                        <h2>Title</h2>

                        <p class="text-left">{{$recipe->name}}</p>

                    </div>


                    <div class="panel-body">
                        <h2>Description</h2>

                        <p class="text-left">{{$recipe->description}}</p>

                    </div>

                    <div class="panel-body">
                        <h2>Ingredients</h2>

                        <p class="text-left">{{$recipe->ingredients}}</p>

                    </div>



                    <div class="panel-body">
                        <h2>Methods</h2>

                        <p class="text-left">{{$recipe->methods}}</p>

                    </div>


                </div>

                {{--<table class="table">--}}
                    {{--<thead>--}}
                    {{--<tr>--}}
                    {{--<th>Recipe Type</th>--}}
                    {{--<th>Title</th>--}}
                    {{--<th>Ingredients</th>--}}
                    {{--<th>Methods</th>--}}
                    {{--</tr>--}}
                    {{--<tr>--}}
                        {{--<td></td>--}}
                        {{--<td></td>--}}
                        {{--<td class="text-justify">{{$recipe->description}}</td>--}}
                        {{--<td></td>--}}
                    {{--</tr>--}}
                    {{--</thead>--}}
                {{--</table>--}}

            </div>
        </div>
    </div>




@endsection
@section('footer')

@endsection