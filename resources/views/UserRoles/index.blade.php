@extends('master')
@section('content')
    <ol class="breadcrumb hidden-xs">
        <li><a href="{{ url('/master') }}">Home</a></li>
        <li class="active">User Roles</li>
        {{--<li class="active"><a>  </a></li>--}}
        {{--<li class="active"><a>Posts</a></li>--}}
    </ol>
    <h4 class="page-title">User Roles Listing</h4>

    <input type="text" class="hidden" style="color:black" id="role" value={!! Auth::user()->role !!} />

    <div class="row">
        <div class="col-md-12" >
            <div class="tab-pane" id="closure">
                <!-- Responsive Table -->
                <div class="block-area" id="responsiveTable">
                    <div class="table-responsive">
                        <h3 class="block-title">User Roles</h3>
                        <a href="{{ url('addUserRole') }}" class="btn btn-sm hidden">
                            <i class="fa fa-plus" aria-hidden="true" title="Add new user role" data-toggle="tooltip"></i>
                        </a>
                        <table class="table tile table-striped" id="userRolesTable">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>View Users</th>
                                <th class="edit hidden">Edit</th>
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
@section('footer')
    <script>

        jQuery(document).ready(function($){

            if($( "#role" ).val() == "admin") {
                $('.edit').removeClass('hidden');
                $('.btn').removeClass('hidden');
            }

            var userRolesTable     = $('#userRolesTable').DataTable({
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
                "ajax": "{!! url('/allUserRole/')!!}",
                "processing": true,
                "serverSide": true,
                "order" :[[0,"desc"]],

                "buttons": [
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5'
                ],


                "columns": [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: function(d)
                    {
                        return "<a href='{!! url('getUsersPerGroup/" + d.id + "') !!}' class='btn btn-sm'>" + 'View users' + "</a>";
                    },"name" : 'name'},
                    {data: function(d)
                    {
                        if($( "#role" ).val() == "admin") {
                            return "<a href='{!! url('editUserRole/" + d.id + "') !!}' class='btn btn-sm'>" + 'Edit '+d.name + "</a>";
                        }
                        else if($( "#role" ).val() == "manager")
                        {
                            return "";
                        }
                    },"name" : 'name'},
                ],

                "aoColumnDefs": [
                    { "bSearchable": false, "aTargets": [ 1] },
                ]

            });
        });
    </script>
@endsection