@extends('master')
@section('content')
    <ol class="breadcrumb hidden-xs">
        <li><a href="{{ url('/master') }}">Home</a></li>
        <li class="active">Products</li>
        {{--<li class="active"><a>  </a></li>--}}
        {{--<li class="active"><a>Posts</a></li>--}}
    </ol>
    <h4 class="page-title">Products Listing</h4>


    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-8" >
            <div class="tab-pane" id="closure">
                <!-- Responsive Table -->
                <div class="block-area" id="responsiveTable">
                    <div class="table-responsive overflow">
                        <h3 class="block-title">Products</h3>
                        <a href="{{ url('CreateProduct') }}" class="btn btn-sm">
                            <i class="fa fa-plus" aria-hidden="true" title="Add new product" data-toggle="tooltip"></i>
                        </a>
                        <table class="table tile table-striped" id="pendingreferralCasesTable">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Category</th>
                            </tr>
                            </thead>
                            @foreach($products  as $product)
                                <tr>
                                    <td> {{$product->id}} </td>
                                    <td> {{$product->name}}</td>
                                    <td> {{$product->type}}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>



@endsection
@section('footer')
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

@endsection