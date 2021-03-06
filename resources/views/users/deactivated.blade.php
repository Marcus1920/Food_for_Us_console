@extends('master')
@section('content')

    <ol class="breadcrumb hidden-xs">
        <li><a href="{{ url('/users') }}">Home</a></li>
        <li><a href="{{ url('/inactiveUsers') }}">Inactive Users</a></li>
        <li><a href="{{ url('/activeUsers') }}">Active Users</a></li>
        <li class="active">De-activated App Users</li>
    </ol>
    <h4 class="page-title">De-activated App Users</h4>

    <input type="text" class="hidden" style="color:black" id="role" value={!! Auth::user()->role !!} />

    <div class="tab-pane" id="active">
        <div class="row">
            <div class="col-md-12" >
                <div class="tab-pane" id="closure">
                    <!-- Responsive Table -->
                    <div class="block-area" id="responsiveTable">

                        @if(Session::has('success'))
                            <div class="alert alert-success alert-icon">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{ Session::get('success') }}
                                <i class="icon">&#61845;</i>
                            </div>
                        @endif

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
                                    <th class="delete hidden">Delete</th>
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
            if($( "#role" ).val() == "admin") {
                $('.delete').removeClass('hidden');
            }

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
                    { data: function (data, type, row)
                        {
                            if($( "#role" ).val() == "admin") {
                        return "<a href='{!! url('logins/" + data.id + "') !!}' class='btn btn-sm'>" + 'View' + "</a>"+
                            "<a href='{!! url('inactivateUsers/" + data.id + "') !!}' class='btn btn-sm'>" + 'DeActivate' + "</a>";
                            }
                            else if($( "#role" ).val() == "manager")
                            {
                                return "<a href='{!! url('logins/" + data.id + "') !!}' class='btn btn-sm'>" + 'View' + "</a>";
                            }

                        data.replace( /[$,]/g, '' )
                        data;
                    } },
                    {data: function(d)
                        {
                            if($( "#role" ).val() == "admin") {
                                return "<a href='{!! url('deleteUser/" + d.id + "') !!}' class='glyphicon glyphicon-remove' style='color:red'></a>";
                            }
                            else if($( "#role" ).val() == "manager")
                            {
                                return "";
                            }
                        },"name" : 'name'},
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