@extends('master')
@section('content')

    <ol class="breadcrumb hidden-xs">
        <li><a href="{{ url('/users') }}">Home</a></li>
        <li><a href="{{ url('/activeUsers') }}">Active Users</a></li>
        <li><a href="{{ url('/deactivatedUser') }}">De-activated App Users</a></li>
        <li class="active">Inactive App Users</li>
    </ol>
    <h4 class="page-title">Inactive App Users</h4>

<div class="tab-pane" id="inactive">

    <div class="row">
        <div class="col-md-12" >
            <div class="tab-pane" id="closure">
                <!-- Responsive Table -->
                <div class="block-area" id="responsiveTable">
                    <div class="table-responsive">
                        <h3 class="block-title"> Inactive User  List </h3>
                        <a href="{{ url('userroleslist') }}" class="btn btn-sm">
                            <i aria-hidden="true" title="Filter Users By User Group" data-toggle="tooltip">Filter By User Group</i>
                        </a>
                        <table class="table tile table-striped" id="InactiveUserTable">
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
                                <th>created at</th>
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


            var InactiveUserTable     = $('#InactiveUserTable').DataTable({
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
                "ajax": "{!! url('/inactive/')!!}","processing": true,
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
                    {data: 'created_at', name: 'created_at'},
                    {data: function(d)
                    {
                        return "<a href='{!! url('userProfile/" + d.id + "') !!}' class='btn btn-sm'>" + 'View' + "</a>";
                    },"name" : 'name'},
                    {data: function(d)
                    {
                        return "<a href='{!! url('editUsers/" + d.id + "') !!}' class='btn btn-sm'>" + 'Activate' + "</a>";
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