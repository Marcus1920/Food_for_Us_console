@extends('master')
@section('content')
    <ol class="breadcrumb hidden-xs">
        <li><a href="{{ url('/users') }}">Home</a></li>
        <li><a href="{{ url('/userroleslist') }}">User Role List</a></li>
        <li class="active">{{$userRole->name}} App Users</li>
        {{--<li class="active"><a>  </a></li>--}}
        {{--<li class="active"><a>Posts</a></li>--}}
    </ol>
    <h4 class="page-title">{{$userRole->name}} App Users</h4>

    <div class="tab-pane" id="active">
        <div class="row">
            <div class="col-md-12" >
                <div class="tab-pane" id="closure">
                    <!-- Responsive Table -->
                    <div class="block-area" id="responsiveTable">
                        <div class="table-responsive overflow">
                            <h3 class="block-title"> {{$userRole->name}} User  List</h3><h16>&nbsp</h16>
                            <table class="table tile table-striped" id="filterUsersByRoleTable">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Surname</th>
                                    <th>Email</th>
                                    <th>Cellphone</th>
                                    <th>Interest </th>
                                    <th>Location</th>
                                    <th>Travel Radius</th>
                                    <th>Description</th>
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

            var id = {!! $userRole->id !!};

            var filterUsersByRoleTable     = $('#filterUsersByRoleTable').DataTable({
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
                "ajax": "{!! url('/allUsersByRole/" + id +"')!!}",
                "processing": true,
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
                    {data: 'intrest', name: 'intrest'},
                    {data: 'location', name: 'location'},
                    {data: 'travelRadius', name: 'travelRadius'},
                    {data: 'descriptionOfAcces', name: 'descriptionOfAcces'},
                ],

                "aoColumnDefs": [
                    { "bSearchable": false, "aTargets": [ 7] }
//                { "bSortable": false, "aTargets": [ 1] }
                ]

            });
        });
    </script>
@endsection