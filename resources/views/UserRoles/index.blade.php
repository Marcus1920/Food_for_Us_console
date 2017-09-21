@extends('master')
@section('content')
    <ol class="breadcrumb hidden-xs">
        <li><a href="{{ url('/master') }}">Home</a></li>
        <li class="active">User Roles</li>
        {{--<li class="active"><a>  </a></li>--}}
        {{--<li class="active"><a>Posts</a></li>--}}
    </ol>
    <h4 class="page-title">User Roles Listing</h4>


    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-8" >
            <div class="tab-pane" id="closure">
                <!-- Responsive Table -->
                <div class="block-area" id="responsiveTable">
                    <div class="table-responsive overflow">
                        <h3 class="block-title">User Roles</h3>
                        <a href="{{ url('addUserRole') }}" class="btn btn-sm">
                            <i class="fa fa-plus" aria-hidden="true" title="Add new user role" data-toggle="tooltip"></i>
                        </a>
                        <table class="table tile table-striped" id="userRolesTable">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>View Users</th>
                                <th>Edit</th>
                                {{--<th>Delete</th>--}}
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>



@endsection