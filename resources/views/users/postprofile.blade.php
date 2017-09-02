@extends('master')
@section('content')
    <ol class="breadcrumb hidden-xs">
        <li><a href="{{ url('/users') }}">Home</a></li>
        <li><a href="{{ url('/postslist') }}">Post Listing</a></li>
        <li class="active">Posts</li>
        {{--<li class="active"><a>  </a></li>--}}
        {{--<li class="active"><a>Posts</a></li>--}}
    </ol>
    <h4 class="page-title">Post Profile</h4>



    <div class="container-fluid" style="margin-top: 2%">
        <div class="block-area" style="background-color: rgba(0, 0, 0, 0.35);">
        <div class="row">

            <div class="col-md-6">
                <div class="block-area" style="background-color: rgba(0, 0, 0, 0.35);">
                    <div class="row" style="margin-left: 0%">
                        <h3 class="block-title">Product Details</h3>
                        <div class="col-md-12">
                            <img alt="Loading Product picture" src="{{$data->productPicture}}" style="width: 450px;height: 300px">
                        </div>
                    </div><br/><br/>
                    <form class="form-horizontal" role="form">
                        <div class="form-group">

                            <label class="col-sm-2 control-label">
                                Product Type
                            </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="{{$data->Products->name}}" id="product_type" readonly>
                            </div>
                        </div>
                        <div class="form-group">

                            <label  class="col-sm-2 control-label">
                                Quantity
                            </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="{{$data->quantity}}" id="quantity" readonly>
                            </div>
                        </div>

                        <div class="form-group">

                            <label  class="col-sm-2 control-label">
                                Cost per kg
                            </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="{{$data->costPerKg}}" id="cost_per_kg" readonly>
                            </div>
                        </div>

                        <div class="form-group">

                            <label class="col-sm-2 control-label">
                                Packaging
                            </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="{{$data->Packaging->name}}" id="packaging" readonly>
                            </div>
                        </div>

                        <div class="form-group">

                            <label  class="col-sm-2 control-label">
                                Payment Type
                            </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="{{$data->paymentMethods}}" id="payment" readonly>
                            </div>
                        </div>
                    </form>
                    <br/>
                </div>
            </div>
            <div class="col-md-6">
                <div class="block-area" style="background-color: rgba(0, 0, 0, 0.35);">
                    <div class="row" style="margin-left: 0%">
                        <h3 class="block-title">Sellers Details</h3>
                        <div class="col-md-12" >
                            <img alt="Loading sellers picture" src="{{$data->newuser->profilePicture}}" style="width: 350px;height: 300px" class="img-circle">
                        </div>
                    </div><br/><br/>
                    <form class="form-horizontal" role="form">
                        <div class="form-group">

                            <label  class="col-sm-2 control-label">
                                Name
                            </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="{{$data->newuser->name}}" id="name" readonly>
                            </div>
                        </div>
                        <div class="form-group">

                            <label  class="col-sm-2 control-label">
                                Surname
                            </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="{{$data->newuser->surname}}" id="surname" readonly>
                            </div>
                        </div>

                        <div class="form-group">

                            <label class="col-sm-2 control-label">
                                Cellphone
                            </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="{{$data->newuser->cellphone}}" id="cellphone" readonly>
                            </div>
                        </div>

                        <div class="form-group">

                            <label  class="col-sm-2 control-label">
                                Email
                            </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="{{$data->newuser->email}}" id="email" readonly>
                            </div>
                        </div>

                        <div class="form-group">

                            <label  class="col-sm-2 control-label">
                                Location
                            </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="{{$data->newuser->location}}" id="location" readonly>
                            </div>
                        </div>
                    </form>
                    <br/>
                </div>
            </div>


        </div>
            <br/>
        </div>
    </div>



@endsection
@section('footer')
    {{--<script src="js/jquery.min.js"></script>--}}
    {{--<script src="js/bootstrap.min.js"></script>--}}
    {{--<script src="js/scripts.js"></script>--}}

    {{--<link href="css/bootstrap.min.css" rel="stylesheet">--}}
    {{--<link href="css/style.css" rel="stylesheet">--}}
    @endsection