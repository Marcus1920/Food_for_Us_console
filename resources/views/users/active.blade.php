@extends('master')
@section('content')
    <ol class="breadcrumb hidden-xs">
        <li><a href="{{ url('/users') }}">Home</a></li>
        <li><a href="{{ url('/inactiveUsers') }}">Inactive Users</a></li>
        <li class="active">Active App Users</li>
        {{--<li class="active"><a>  </a></li>--}}
        {{--<li class="active"><a>Posts</a></li>--}}
    </ol>
    <h4 class="page-title">Active App Users</h4>

<div class="tab-pane" id="active">
    <div class="row">
        <div class="col-md-12" >
            <div class="tab-pane" id="closure">
                <!-- Responsive Table -->
                <div class="block-area" id="responsiveTable">
                    <div class="table-responsive overflow">
                        <h3 class="block-title"> Active User  List</h3><h16>&nbsp</h16>
                        <table class="table tile table-striped" id="activeUsersTable">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Surname</th>
                                <th>Email</th>
                                <th>Intrest </th>
                                <th>Location</th>
                                <th>Travel Radius</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection