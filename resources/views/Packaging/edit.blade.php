@extends('master')
@section('content')
    <ol class="breadcrumb hidden-xs">
        <li><a href="{{ url('/master') }}">Home</a></li>
        <li><a href="{{ url('/packaginglist') }}">Packaging List</a></li>
        <li class="active">Edit Packaging</li>
    </ol>
    <h4 class="page-title">Edit Packaging</h4>

    <div class="row">
        <div class="col-md-6 col-md-offset-2">

            <form action="updatepackaging" method="post">

                {{ csrf_field() }}

                <input type="hidden" value="{{$packaging->id}}" class="form-control" name="id">

                <div class="form-group">
                    <label for="product">Packaging Name</label>
                    <input type="text" name="packagingName" value=" {{$packaging->name}}" class="form-control" placeholder="Product name">

                </div>

                <div class="form-group">
                    <input type="submit" value="Update" class="btn btn-primary">
                </div>
            </form>

        </div>

    </div>



@endsection
