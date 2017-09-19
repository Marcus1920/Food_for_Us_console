@extends('master')
@section('content')
    <ol class="breadcrumb hidden-xs">
        <li><a href="{{ url('/master') }}">Home</a></li>
        <li><a href="{{ url('/allProduct') }}">Product List</a></li>
        <li class="active">Edit Product</li>
        {{--<li class="active"><a>  </a></li>--}}
        {{--<li class="active"><a>Posts</a></li>--}}
    </ol>
    <h4 class="page-title">Edit Product</h4>

    <div class="row">
        <div class="col-md-6 col-md-offset-2">

            <form action="updateproduct" method="post">

                {{ csrf_field() }}

                <input type="hidden" value="{{$product->id}}" class="form-control" name="id">

                <div class="form-group">
                    <label for="product">Product Name</label>
                    <input type="text" name="productName" value=" {{$product->name}}" class="form-control" placeholder="Product name">


                    @if ($errors->has('productName'))

                        <span class="text text-danger">
                             {{$errors->first()}}
                        </span>

                    @endif


                </div>
                <div class="form-group">
                    <label for="product">Product Type</label>


                    <select name="productType" class="form-control">
                        <option value=" {{$product->type}}"  selected> {{$product->type}}</option>
                        <option value="fruit">Fruit</option>
                        <option value="vegetable">Vegetable</option>

                        @if ($errors->has('productType'))

                            <span class="text text-danger">
                             {{$errors->first()}}
                        </span>

                        @endif

                    </select>
                </div>

                <div class="form-group">
                    <input type="submit" value="Update" class="btn btn-primary">
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