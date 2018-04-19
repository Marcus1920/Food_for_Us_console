@extends('master')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>

    <title>My Charts</title>

    {!! Charts::styles() !!}

</head>
<body>

<ol class="breadcrumb hidden-xs">
    <li><a href="{{ url('/users') }}">Home</a></li>
    <li class="active">Reports</li>
    {{--<li class="active"><a>  </a></li>--}}
    {{--<li class="active"><a>Posts</a></li>--}}
</ol>
<h4 class="page-title">Reports</h4>
&nbsp;
&nbsp;
&nbsp;
&nbsp;
<div class="col-md-12">
        <div class="col-md-6">
            {!! $chart->html() !!}
        </div>
        <div class="col-md-6">
            {!! $chart1->html() !!}
        </div>
    </div>
&nbsp;
    <div class="col-md-12">
        <br/>
    </div>
    <div class="col-md-12">
            {!! $chart2->html() !!}
    </div>
<!-- Main Application (Can be VueJS or other JS framework) -->
<div class="app">
    <center>

    </center>
</div>
<!-- End Of Main Application -->
{!! Charts::scripts() !!}
{!! $chart->script() !!}
{!! $chart1->script() !!}
{!! $chart2->script() !!}
</body>
</html>
@endsection