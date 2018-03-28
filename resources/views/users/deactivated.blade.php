@extends('master')
@section('content')

    <ol class="breadcrumb hidden-xs">
        <li><a href="{{ url('/users') }}">Home</a></li>
        <li><a href="{{ url('/inactiveUsers') }}">Inactive Users</a></li>
        <li><a href="{{ url('/activeUsers') }}">Active Users</a></li>
        <li class="active">De-activated App Users</li>
    </ol>
    <h4 class="page-title">De-activated App Users</h4>

    <div class="tab-pane" id="active">
        <div class="row">
            <div class="col-md-12" >
                <div class="tab-pane" id="closure">
                    <!-- Responsive Table -->
                    <div class="block-area" id="responsiveTable">
                        <div class="table-responsive">
                            <h3 class="block-title">  De-activated User  List </h3><h16>&nbsp</h16>
                            <a href="{{ url('userroleslist') }}" class="btn btn-sm">
                                <i aria-hidden="true" title="Filter Users By User Group" data-toggle="tooltip">Filter By User Group</i>
                            </a>
                            <table class="table tile table-striped" id="deactivated">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Surname</th>
                                    <th>Cellphone</th>
                                    <th>Email</th>
                                    <th>Cellphone</th>
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
    <script>

        $(document).ready(function () {



            $('#deactivated').dataTable({

                ajax:"{!! url('/deactivated/')!!}","processing": true,
                columns: [
                    { data: 'id' },
                    { data: 'name' },
                    { data: 'surname' },
                    { data: 'cellphone' },
                    { data: 'email' },
                    { data: 'cellphone'},
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
                "scrollX": true,
                "bAutoWidth": false,
                "aaSorting": [],
                buttons: [

                    {
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