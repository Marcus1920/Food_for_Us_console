@extends('master')
@section('content')

    <div id="tabs">
        <ul class="nav nav-pills  navbar-right responsive" role="tablist">


            <li class="active"><a href="#inactive"  data-toggle="tab">Inactive Users</a></li>
            <li><a href="#active"  data-toggle="tab">Active Users</a></li>

        </ul>
        <h4 class="page-title">APP USERS LIST</h4>

        <div class="container-fluid" style="margin-top: 2%; border-color: white; align-content: center">

            <div class="tab-content responsive">

                <!--Global Content Tab-->
            @include('users.inactive')
            <!--Private Content Tab-->
                @include('users.active')


            </div>

        </div>
    </div>
@endsection
@section('footer')
    <script>
        $( function() {
            $( "#tabs" ).tabs();
        } );
    </script>
@endsection