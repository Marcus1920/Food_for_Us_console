@extends('master')
@section('content')
    <ol class="breadcrumb hidden-xs">
        <li><a href="{{ url('/master') }}">Home</a></li>
        <li class="active">Add Packaging</li>
        {{--<li class="active"><a>  </a></li>--}}
        {{--<li class="active"><a>Posts</a></li>--}}
    </ol>
    <h4 class="page-title">Add Packaging</h4>

    <div class="row">
        <div class="col-md-6 col-md-offset-2">

            <form action="storePackaging" method="post">

                {{ csrf_field() }}

                <div class="form-group">
                    <label for="product">Packaging Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Packaging name">
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