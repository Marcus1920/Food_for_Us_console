@extends('master')
@section('content')
    <ol class="breadcrumb hidden-xs" xmlns="http://www.w3.org/1999/html">
        <li><a href="{{ url('/users') }}">Home</a></li>
        <li><a href="{{ url('/transactionList') }}">Transaction Listing</a></li>
        <li class="active">Transaction Details</li>
        {{--<li class="active"><a>  </a></li>--}}
        {{--<li class="active"><a>Posts</a></li>--}}
    </ol>
    <h4 class="page-title">{{strtoupper($userTransactionDetails->name)}} {{strtoupper($userTransactionDetails->surname)}}</h4>



    <div class="container-fluid" style="margin-top: 2%">

        <div class="row">

            <div class="col-md-4">
                <div class="container">
                    <div class="panel panel-default">
                        <div>
                            <div  class="center-block" id ="-imgContainer" style="max-width: 200px;max-height: 200px; display:block; margin-right: auto; margin-left:auto;">
                                <img class="img" alt="Loading Product picture" src="{{$userTransactionDetails->profilePicture}}">
                            </div>
                        </div>
                        <div class="panel-body">
                            <p class="text-center">
                               <strong>{{$userTransactionDetails->name}} {{$userTransactionDetails->surname}}</strong>
                           </p>
                            <p class="text-center"> GPS LAT : {{$userTransactionDetails->gps_lat}}  GPS LONG : {{$userTransactionDetails->gps_long}}</p>
                            <div class="divider"></div>
                            <span class="text-center">
                                <dl class="dl-horizontal">
                                    <dt>TRANSACTION ID</dt>
                                    <dd>{{$userTransactionDetails->transactionId}} </dd>
                                    <dt>TRANSACTION QUANTITY</dt>
                                    <dd>{{$userTransactionDetails->quantity}} </dd>
                                    <dt>TRANSACTION COMMENT</dt>
                                    <dd>{{$userTransactionDetails->comment}}</dd>
                                    <dt>TRANSACTION RATING</dt>
                                    <dd>{{$userTransactionDetails->rating}}</dd>
                                </dl>
                                </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="tile">
                    <h1 class="tile-title">{{strtoupper($userTransactionDetails->name)}} {{strtoupper($userTransactionDetails->surname)}} Transaction History</h1>

                    <div class="listview narrow">
                        @foreach($sellerTransactionSide as $item)
                            <div class="media p-l-5">
                                <div class="pull-left">
                                    <div class="pull-left">
                                        <img src="{{$item->buyers->profilePicture}}" class="media-object" style="width:60px">
                                    </div>
                                </div>
                                <div class="media-body">
                                    <span class="t-overflow" href="">{{strtoupper($item->buyers->name)}} {{strtoupper($item->buyers->surname)}} ( TRANSACTION ID {{$item->id}})</span><br>
                                    From {{strtoupper($item->buyers->location)}}
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