@extends('master')
@section('content')
    <ol class="breadcrumb hidden-xs" xmlns="http://www.w3.org/1999/html">
        <li><a href="{{ url('/users') }}">Home</a></li>
        <li class="active"><a>Admin Users List</a></li>
    </ol>
    <h4 class="page-title">Admin Users</h4>

    <input type="text" class="hidden" style="color:black" id="role" value={!! Auth::user()->role !!} />

    <div class="row">
        <div class="col-md-12" >
            <div class="tab-pane" id="closure">
                <!-- Responsive Table -->
                <div class="block-area" id="responsiveTable">
                    <div class="table-responsive">
                        <h3 class="block-title">Admin User  List </h3>

                        <a href="{{url('register')}}"> <button type="submit" id='addingAdmin' class="btn btn-info btn-sm m-t-10 hidden" style="margin-bottom: 1%">Add Admin</button></a>
                        <table class="table tile table-striped" id="adminTable">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Surname</th>
                                <th>Email</th>
                                <th>Cellphone</th>
                                <th>Role</th>
                                <th>Created By</th>
                                <th class="action hidden">Action</th>

                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('footer')
    <script>

        jQuery(document).ready(function($){

            if($( "#role" ).val() == "admin") {
                $('.action').removeClass('hidden');
                $('.btn').removeClass('hidden');
            }

            var adminTable     = $('#adminTable').DataTable({
                "autoWidth": false,
                "processing": true,
                "sorting":true,
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
                "ajax": "{!! url('/getAdminUsers/')!!}","processing": true,
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
                    {data: 'cellphone', name: 'cellphone'},
                    {data: 'role', name: 'role'},
                    {data: 'created_by', name: 'created_by'},
                    {data: function(d)
                    {
                        if($( "#role" ).val() == "admin") {
                            return "<a href='{!! url('viewAdmin/" + d.id + "') !!}' class='btn btn-sm'>" + 'Edit' + "</a>";
                        }
                        else if($( "#role" ).val() == "manager")
                        {
                            return "";
                        }

                    },"name" : 'name'},


                ],

                "aoColumnDefs": [
                    { "bSearchable": false, "aTargets": [ 5] },
                   { "bSortable": false, "aTargets": [ 1] }
                ]

            });
        });
    </script>
@endsection