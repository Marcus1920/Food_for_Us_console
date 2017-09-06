@extends('master')
@section('content')
    <ol class="breadcrumb hidden-xs">
        <li><a href="{{ url('/master') }}">Home</a></li>
        <li class="active">Add User Role</li>
        {{--<li class="active"><a>  </a></li>--}}
        {{--<li class="active"><a>Posts</a></li>--}}
    </ol>
    <h4 class="page-title">Add User Role</h4>


    <div class="row">
        <div class="col-md-6 col-md-offset-2">

            <form action="storeUserRole" method="post">

                {{ csrf_field() }}

                <div class="form-group">
                    <label for="">Name</label>
                        <input type="text" name="name" id="" class="form-control" placeholder="name">


                   @if ($errors->has('name'))

                <span class="text text-danger">
                             {{$errors->first()}}
                    </span>

                       @endif
                </div>

                <input type="submit" value="Save" class="btn btn-primary">
            </form>


        </div>
        </div>
    </div>



@endsection
@section('footer')
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
    <link href="css/style.css" rel="stylesheet">

@endsection