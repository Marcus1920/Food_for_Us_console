@extends('master')
@section('content')
    <ol class="breadcrumb hidden-xs">
        <li><a href="{{ url('/users') }}">Home</a></li>
        <li><a href="{{ url('/inactiveUsers') }}">Inactive Users</a></li>
        <li><a href="{{ url('/deactivatedUser') }}"> De-actived App Users</a></li>
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
                        <a href="{{ url('userroleslist') }}" class="btn btn-sm">
                            <i aria-hidden="true" title="Filter Users By User Group" data-toggle="tooltip">Filter By User Group</i>
                        </a>
                        <table class="table tile table-striped" id="activeUsersTable">
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
                                <th>Gps Lat</th>
                                <th>Gps Long</th>
                                <th>Created At</th>
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
@section('footer')
    <script>

        jQuery(document).ready(function($){


            var activeUsersTable     = $('#activeUsersTable').DataTable({
                "autoWidth": false,

                "processing": true,
                speed: 500,
                "dom": 'Bfrtip',
                "buttons": [
                    'copyHtml5',
                    'excelHtml5',
                    ,{

                        extend : 'pdfHtml5',
                        title  : 'Siyaleader_Report',
                        header : 'I am text in',
                    },

                ],


                "order" :[[0,"desc"]],
                "ajax": "{!! url('/active/')!!}","processing": true,
                "serverSide": true,
                "dom": 'Bfrtip',
                "order" :[[0,"desc"]],

                "buttons": [
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5'
                ],


                "columns": [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'surname', name: 'surname'},
                    {data: 'email', name: 'email'},
                    {data: 'intrest', name: 'intrest'},
                    {data: 'location', name: 'location'},
                    {data: 'travelRadius', name: 'travelRadius'},
                    {data: 'descriptionOfAcces', name: 'descriptionOfAcces'},
                    {data: 'gps_lat', name: 'gps_lat'},
                    {data: 'gps_long', name: 'gps_long'},
                    {data: 'created_at', name: 'created_at'},
                    {data: function(d)
                    {
                        return "<a href='{!! url('logins/" + d.id + "') !!}' class='btn btn-sm'>" + 'View' + "</a>";
                    },"name" : 'name'},
                    {data: function(d)
                    {
                        return "<a href='{!! url('inactivateUsers/" + d.id + "') !!}' class='btn btn-sm'>" + 'DeActivate' + "</a>";
                    },"name" : 'name'},
                ],

                "aoColumnDefs": [
                    { "bSearchable": false, "aTargets": [ 4] },
                    { "bSortable": false, "aTargets": [ 4] }
                ]

            });
        });
    </script>
@endsection