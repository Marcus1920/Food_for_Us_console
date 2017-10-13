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
                    <div class="table-responsive">
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
    {{--<script src="jquery-1.11.2.js"></script>--}}
    {{--<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">--}}
    <script>

        $(document).ready(function () {



            var activeUsersTable     = $('#activeUsersTable').DataTable({
                "autoWidth": false,




            $('#activeUsersTable').dataTable({

                ajax:"{!! url('/active/')!!}","processing": true,
                columns: [
                    { data: 'id' },
                    { data: 'name' },
                    { data: 'surname' },
                    { data: 'email' },
                    { data: 'intrest' },
                    { data: 'location' },
                    { data: 'travelRadius' },
                    { data: 'descriptionOfAcces' },
                    { data: 'created_at' },
                    { data: function (data, type, row) {
                        return "<a href='{!! url('logins/" + data.id + "') !!}' class='btn btn-sm'>" + 'View' + "</a>"+
                            "<a href='{!! url('inactivateUsers/" + data.id + "') !!}' class='btn btn-sm'>" + 'DeActivate' + "</a>";

                        data.replace( /[$,]/g, '' )
                            data;
                    } }
                ],
                dom: 'Bfrtip',
                buttons: [

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

                        extend: 'copyHtml5',
                        orientation: 'landscape',
                        exportOptions: { orthogonal: 'export',
                            columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        orientation: 'landscape',
                        exportOptions: { orthogonal: 'export',
                            columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        orientation: 'landscape',
                        exportOptions: { orthogonal: 'export',
                            columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
                        }
                    }

                ]
            });

        })
    </script>
    


@endsection