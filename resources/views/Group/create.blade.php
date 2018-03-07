@extends('master')
@section('content')
    <ol class="breadcrumb hidden-xs">
        <li><a href="{{ url('/master') }}">Home</a></li>
        <li class="active">Add Group</li>
        {{--<li class="active"><a>  </a></li>--}}
        {{--<li class="active"><a>Posts</a></li>--}}
    </ol>
    <h4 class="page-title">Add Group</h4>
    <br/>
    <br/>
    <br/>

    <div class="row">
        <div class="col-md-6 col-md-offset-2">

            <form action="{{ url('group') }}" method="POST">

                {{ csrf_field() }}

                <div class="form-group">
                    <label for="product">Group Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Group name">

                    {{--@if($errors->has('name'))--}}

                        {{--<span class="text text-danger">--}}

                        {{--{{$errors->first()}}--}}

                        {{--</span>--}}

                    {{--@endif--}}


                </div>

                <div class="form-group">
                    <input type="submit" value="save" class="btn btn-primary">
                </div>
            </form>

        </div>

    </div>



@endsection
@section('footer')
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
    <link href="css/style.css" rel="stylesheet">

@endsection