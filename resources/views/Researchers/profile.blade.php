@extends('master')
@section('content')
    <ol class="breadcrumb hidden-xs">
        <li><a href="{{ url('/users') }}">Home</a></li>
        <li><a href="{{ url('/researchList') }}">Researcher Listing</a></li>
        <li class="active">Researcher</li>
        {{--<li class="active"><a>  </a></li>--}}
        {{--<li class="active"><a>Posts</a></li>--}}
    </ol>

    <div class="container">
    <div class="row">

        <div class="col-md-12">







                    {{--{{$research->img_url publi}}--}}




                    <table class="table" style="width: 90%">

                        <tr colspan="2">

                            <td><center><img src="{{$research->img_url}}" class="img-rounded" width="304" height="236"></center></td>

                        </tr>

                        <tr>
                            <th>Created</th>
                            <td class="alert alert-info"> {{$research->created_at->diffForHumans()}}</td>
                        </tr>

                        <tr>
                            <th  style="width: 1%">Buniness Nature</th>
                            <td  style="width: 1%" class="alert alert-info">{{$research->natureOfBusiness}}</td>
                        </tr>

                         <tr>
                            <th>Summary box</th>
                            <td class="alert alert-info"> {{$research->summaryBox}}</td>
                        </tr>

                        <tr>
                            <th>Research Note</th>
                            <td class="alert alert-info"> {{$research->researchNotes}}</td>
                        </tr>

                    </table>

                </div>



    </div>
    </div>
@endsection
@section('footer')

@endsection