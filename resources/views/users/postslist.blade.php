@extends('master')
@section('content')
    <ol class="breadcrumb hidden-xs">
        <li><a href="{{ url('/master') }}">Home</a></li>
        <li><a class="active">Posts</a></li>
        {{--<li class="active"><a>  </a></li>--}}
        {{--<li class="active"><a>Posts</a></li>--}}
    </ol>
    <h4 class="page-title">Seller Post Listing</h4>


    <div class="row">
        <div class="col-md-12" >
            <div class="tab-pane" id="closure">
                <!-- Responsive Table -->
                <div class="block-area" id="responsiveTable">
                    <div class="table-responsive overflow">
                        <h3 class="block-title">Post </h3>
                        <table class="table tile table-striped" id="pendingreferralCasesTable">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Surname</th>
                                <th>Email</th>
                                <th>Product Type </th>
                                <th>Quantity</th>
                                <th>Cost Per KG</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            @foreach($post  as $posts)
                                <tr>
                                    <td> {{$posts->id}} </td>
                                    <td> {{$posts->newuser->name}}</td>
                                    <td> {{$posts->newuser->surname}}</td>
                                    <td> {{$posts->newuser->email}}  </td>
                                    <td> {{$posts->product_type}} </td>
                                    <td> {{$posts->quantity}} </td>
                                    <td> {{$posts->cost_per_kg}} </td>
                                    <th><a href="{{url('/postview/'.$posts->id)}}"  value="click me" class="btn btn-secondary">View</a></th>

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