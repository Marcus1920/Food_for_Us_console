@extends('master')
@section('content')
    <ol class="breadcrumb hidden-xs">
        <li><a href="{{ url('/master') }}">Home</a></li>
        <li class="active">Add Product</li>
        {{--<li class="active"><a>  </a></li>--}}
        {{--<li class="active"><a>Posts</a></li>--}}
    </ol>
    <h4 class="page-title">Add Product</h4>

    <div class="row">
        <div class="col-md-6 col-md-offset-2">

            <form action="AddProduct" method="post">

                {{ csrf_field() }}

                <div class="form-group">
                    <label for="product">Product Name</label>
                    <input type="text" name="productName" class="form-control" placeholder="Product name">

                    @if ($errors->has('productName'))

                        <span class="text text-danger">
                             {{$errors->first()}}
                        </span>

                    @endif


                </div>
                <div class="form-group">
                    <label for="product">Product Type</label>


                    <select name="productType" class="form-control">
                        <option value="0" >Select product type</option>
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