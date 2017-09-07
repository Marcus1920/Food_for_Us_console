@extends('master')
@section('content')
    <ol class="breadcrumb hidden-xs">
        <li><a href="{{ url('/users') }}">Home</a></li>
        <li class="active">Researchers List</li>
        {{--<li class="active"><a>  </a></li>--}}
        {{--<li class="active"><a>Posts</a></li>--}}
    </ol>
    <h4 class="page-title">Researchers Listing</h4>


    <div class="row">
        <div class="col-md-12" >
            <div class="tab-pane" id="closure">
                <!-- Responsive Table -->
                <div class="block-area" id="responsiveTable">
                    <div class="table-responsive overflow">
                        <h3 class="block-title">RESEARCHES </h3>
                        <table class="table tile table-striped" id="pendingreferralCasesTable">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nature Of Bussiness</th>
                                <th>Summary </th>
                                <th>Research Note</th>
                                <th>Created</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            @foreach($all_researchs  as $all_research)
                                <tr>
                                    <td> {{$all_research->id}} </td>
                                    <td> {{$all_research->natureOfBusiness}} </td>
                                    <td> {{$all_research->summaryBox}} </td>
                                    <td> {{$all_research->researchNotes}} </td>
                                    <td> {{$all_research->created_at->diffForHumans()}}</td>

                                    <td><a href="{{url('/researchProfile/'.$all_research->id)}}"  value="click me" class="btn btn-secondary">View</a></td>

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