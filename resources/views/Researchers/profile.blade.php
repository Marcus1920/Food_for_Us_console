@extends('master')
@section('content')
    <ol class="breadcrumb hidden-xs">
        <li><a href="{{ url('/users') }}">Home</a></li>
        <li><a href="{{ url('/researchList') }}">Researcher Listing</a></li>
        <li class="active">Researcher</li>
        {{--<li class="active"><a>  </a></li>--}}
        {{--<li class="active"><a>Posts</a></li>--}}
    </ol>

    <div class="container-fluid">
    <div class="row">


<div class="col-md-6">
    <br/><br/>

    <div class="panel panel-default">

        <div class="panel-body">
            <h4 class="alert alert-success">
               Posted by :
            </h4>
            {{$research->User->name}} {{$research->User->surname}}
        </div>
    </div>
    <center>
    <img src="{{$research->imageUrl}}">
    </center>

</div>


        <div class="col-sm-12 col-md-6">

            <div class="panel panel-default">

                <div class="panel-body">

                    <h2 class="alert alert-success">Created</h2>
                    <p>{{$research->created_at->diffForHumans()}}</p>
                </div>


                <div class="panel-body">
                    <h2 class="alert alert-success">Buniness Nature</h2>
                    <p>{{$research->natureOfBusiness}}</p>

                </div>

                <div class="panel-body">
                    <h2 class="alert alert-success">Summary box</h2>
                    <p>{{$research->summaryBox}}</p>
                </div>


                <div class="panel-body">
                    <h2 class="alert alert-success">Research Note</h2>
                    <p>{{$research->researchNotes}}</p>
                </div>

            </div>


        </div>


    </div>
    </div>

@endsection
@section('footer')

