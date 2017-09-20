@extends('master')
@section('content')

    <ol class="breadcrumb hidden-xs">
        <li><a href="{{ url('/users') }}">Home</a></li>
        <li><a href="{{ url('/inactiveUsers') }}">Inactive Users</a></li>
        <li><a href="{{ url('/activeUsers') }}">Active Users</a></li>
        <li class="active">De-activated App Users</li>
    </ol>
    <h4 class="page-title">De-activated App Users</h4>

    <div class="tab-pane" id="inactive">

        <div class="row">
            <div class="col-md-12" >
                <div class="tab-pane" id="closure">
                    <!-- Responsive Table -->
                    <div class="block-area" id="responsiveTable">
                        <div class="table-responsive overflow">
                            <h3 class="block-title"> De-activated User  List </h3>
                            <a href="{{ url('userroleslist') }}" class="btn btn-sm">
                                <i aria-hidden="true" title="Filter Users By User Group" data-toggle="tooltip">Filter By User Group</i>
                            </a>
                            <table class="table tile table-striped" id="deactivated">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Surname</th>
                                    <th>Email</th>
                                    <th>Interest </th>
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