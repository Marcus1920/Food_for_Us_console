@extends('master')
@section('content')
    <ol class="breadcrumb hidden-xs">
        <li><a href="{{ url('/master') }}">Home</a></li>
        <li><a href="{{ url('/group') }}">Groups</a></li>
        <li class="active">{{$group->name}} Group Users</li>
        {{--<li class="active"><a>  </a></li>--}}
        {{--<li class="active"><a>Posts</a></li>--}}
    </ol>
    <h4 class="page-title">{{$group->name}} Group Users</h4>


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
                        <h3 class="block-title">{{$group->name}} Group Users</h3>
                        &nbsp;&nbsp;&nbsp;
                        <a href="{{ url('addGroupUsers',$group->id) }}" class="btn btn-sm">
                            <i class="fa fa-plus" aria-hidden="true" title="Add new user" data-toggle="tooltip"></i>
                        </a>
                        &nbsp;&nbsp;&nbsp;
                        <a href="{{ url('addGroupUsersRadius',$group->id) }}" class="btn btn-sm">
                            <i class="glyphicon glyphicon-map-marker" title="Add users based on radius"></i>
                        </a>
                        <table class="table tile table-striped" id="UserGroupTable">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Surname</th>
                                <th>User Role</th>
                                <th>Location</th>
                                <th>Gps latitude </th>
                                <th>Gps Longitude</th>
                                <th>Remove</th>
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
            var $data = {!! $users !!};

            assignToEventsColumns($data);
            function assignToEventsColumns(data) {
                var table = $('#UserGroupTable').dataTable({
                    "dom": 'Bfrtip',
                    "scrollX": true,
                    "bAutoWidth": false,
                    "aaData": data,
                    "aaSorting": [],
                    "buttons": [
                        'copyHtml5',
                        'excelHtml5',
                        ,{
                            extend : 'pdfHtml5',
                            title  : 'Food_For_Us',
                            header : 'I am text in',
                        },
                    ],
                    "buttons": [
                        'excelHtml5',
                        'csvHtml5',
                        'pdfHtml5'
                    ],
                    "columns": [
                        {data: 'name', name: 'name'},
                        {data: 'surname', name: 'surname'},
                        {data: 'UserRole', name: 'UserRole'},
                        {data: 'location', name: 'location'},
                        {data: 'gps_lat', name: 'gps_lat'},
                        {data: 'gps_long', name: 'gps_long'},
                        {data: function(d)
                            {
                                return "<a href='{!! url('removeUser/" + d.id +"',$group->id) !!}' class='glyphicon glyphicon-remove' style='color:red'></a>";
                            },"name" : 'name'},
                    ],
                    "aoColumnDefs": [
                        {
                            "aTargets": [1],
                            "bSearchable": true,
                            "bSortable": false,
                            "bSort": false,
                            "mData": "EventTypeId",
                        },
                        {
                            "aTargets": [1],
                            "mData": "EventType"
                        }
                    ]
                });
            }
        });
    </script>
@endsection