@extends('master')
@section('content')
    <ol class="breadcrumb hidden-xs">
        <li><a href="{{ url('/users') }}">Home</a></li>
        <li><a href="{{ url('/transactionList') }}">Transaction Listing</a></li>
        <li class="active">Posts</li>
        {{--<li class="active"><a>  </a></li>--}}
        {{--<li class="active"><a>Posts</a></li>--}}
    </ol>
    <h4 class="page-title">{{strtoupper($userTransactionDetails->name)}} {{strtoupper($userTransactionDetails->surname)}}</h4>



    <div class="container-fluid" style="margin-top: 2%">

        <div class="row">

            <div class="col-md-4">
                <h3 class="block-title">User Profile</h3>
                <div class="col-md-12">
                    <img class="img" alt="Loading Product picture">
                    <table class="table table-condensed">
                        <tr>
                            <td>NAME</td>
                            <td>{{$userTransactionDetails->name}}</td>
                        </tr>
                        <tr>
                            <td>SURNAME</td>
                            <td>{{$userTransactionDetails->surname}}</td>
                        </tr>
                        <tr>
                        <tr>
                            <td>GPS LATITUDE</td>
                            <td>{{$userTransactionDetails->gps_lat}}</td>
                        </tr>
                        <tr>
                            <td>GPS LONGITUDE</td>
                            <td>{{$userTransactionDetails->gps_long}}</td>
                        </tr>


                        <tr>
                            <td>TRANSACTION ID</td>
                            <td>{{$userTransactionDetails->transactionId}}</td>
                        </tr>

                        <tr >
                            <td>TRANSACTION QUANTITY</td>
                            <td>{{$userTransactionDetails->quantity}}</td>
                        </tr>
                        <tr >
                            <td>TRANSACTION COMMENT</td>
                            <td>{{$userTransactionDetails->comment}}</td>
                        </tr>
                        <tr >
                            <td>TRANSACTION RATING</td>
                            <td>{{$userTransactionDetails->rating}}</td>
                        </tr>

                    </table>
                </div>
            </div>

            <div class="col-md-8">
                <div class="tile">
                    <h1 class="tile-title">{{strtoupper($userTransactionDetails->name)}} {{strtoupper($userTransactionDetails->surname)}}'s Transaction History</h1>

                    <div class="listview narrow">
                        @foreach($buyerTransactionSide as $item)
                            <div class="media p-l-5">
                                <div class="pull-left">

                                </div>
                                <div class="media-body">
                                    <span class="t-overflow" href="">{{strtoupper($item->sellers->name)}} {{strtoupper($item->sellers->surname)}} ($item->id)</span><br>
                                    From {{strtoupper($item->sellers->location)}}
                                    <br/>
                                    <small class="text-muted">{{ $item->created_at->diffForHumans() }} </small>

                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
                <div class="tile">
                    <h1 class="tile-title">Transaction Activity Log</h1>
                    <div class="listview narrow">
                        @foreach($transactionActivitiesData as $item)
                            <div class="media p-l-5">
                                <div class="pull-left">

                                </div>
                                <div class="media-body">
                                    <span class="t-overflow">{{strtoupper($userTransactionDetails->name)}}  {{strtoupper($userTransactionDetails->surname)}}  {{$item->transactionStatuses->name}}  TRANSACTION NUMBER : {{$item->transactionId}}</><br/>
                                    <small class="text-muted">{{ $item->created_at->diffForHumans() }} </small>

                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection