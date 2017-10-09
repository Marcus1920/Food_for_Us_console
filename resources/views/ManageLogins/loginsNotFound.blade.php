@extends('master')
@section('content')
    <ol class="breadcrumb hidden-xs">
        <li><a href="{{ url('/users') }}">Home</a></li>
        <li><a href="{{ url('/activeUsers') }}">Active Users</a></li>
        <li class="active">User Logins</li>

    </ol>

    <h4 class="page-title">User Logins Details</h4>

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

                    <p class="text-left">Never logged in</p>

                </div>


                <div class="panel-body">
                    <h2 class="alert alert-success">Number Of Logins</h2>

                    <p class="text-left">0</p>

                </div>

            </div>

        </div>
    </div>
    </div>




@endsection
@section('footer')

@endsection