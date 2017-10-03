@extends('master')
@section('content')
    <ol class="breadcrumb hidden-xs">
        <li><a href="{{ url('/master') }}">Home</a></li>
        <li><a href="{{ url('/userroleslist') }}">User Role List</a></li>
        <li class="active">Edit User Role</li>
        {{--<li class="active"><a>  </a></li>--}}
        {{--<li class="active"><a>Posts</a></li>--}}
    </ol>
    <h4 class="page-title">Edit User Role</h4>
    <div class="row">
        &nbsp;
        &nbsp;
    </div>

    <div class="row">
        <div class="col-md-6 col-md-offset-2">
            <form action="updateUserRole" method="post">
                {{ csrf_field() }}
                <input type="hidden" value="{{$userRole->id}}" class="form-control" name="id">
                <div class="form-group">
                    <label for="product">User Role Name</label>
                    <input type="text" name="userRoleName" value=" {{$userRole->name}}" class="form-control" placeholder="User Role name">
                </div>
                <div class="form-group">
                    <input type="submit" value="Update" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
@endsection