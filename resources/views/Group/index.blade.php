@extends('master')
@section('content')
    <ol class="breadcrumb hidden-xs">
        <li><a href="{{ url('/master') }}">Home</a></li>
        <li class="active">Group Push Alerts List</li>
        {{--<li class="active"><a>  </a></li>--}}
        {{--<li class="active"><a>Posts</a></li>--}}
    </ol>
    <h4 class="page-title">Group Push Alerts</h4>

    <input type="text" class="hidden" style="color:black" id="role" value={!! Auth::user()->role !!} />

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
                        <h3 class="block-title">Add Group</h3>
                        <a href="{{ url('group/create') }}" class="btn btn-sm hidden">
                            <i class="fa fa-plus" aria-hidden="true" title="Add new group" data-toggle="tooltip"></i>
                        </a>
                        <table class="table tile table-striped" id="GroupTable">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Message</th>
                                <th class="edit hidden">Edit</th>
                                <th class="delete hidden">Delete</th>
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
                $('.delete').removeClass('hidden');
            }

            var $data = {!! $groups !!};
            {{--$.ajax({--}}
            {{--url: '{!! url('/getattendanceList/')!!}',--}}
            {{--type: 'GET',--}}
            {{--dataType: 'json',--}}
            {{--success: function (data) {--}}
            {{--assignToEventsColumns(data);--}}
            {{--}--}}
            {{--});--}}
            assignToEventsColumns($data);
            function assignToEventsColumns(data) {
                var table = $('#GroupTable').dataTable({
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
                        {data: 'id', name: 'id'},
                        {data: function(d)
                            {
                                return "<a href='{!! url('groupUsers/" + d.id + "') !!}' class='btn btn-sm'>" + d.name + "</a>";
                            },"name" : 'name'},
                        {data: function(d)
                            {
                                return "<a href='{!! url('sendToGroup/" + d.id + "') !!}' class='glyphicon glyphicon-envelope'></a>";
                            },"name" : 'name'},
                        {data: function(d)
                            {
                                if($( "#role" ).val() == "admin") {
                                    return "<a href='{!! url('group/" + d.id + "/edit') !!}' class='glyphicon glyphicon-edit' style='color:yellow'></a>";
                                }
                                else if($( "#role" ).val() == "manager")
                                {
                                    return "";
                                }
                            },"name" : 'name'},
                        {data: function(d)
                            {
                                if($( "#role" ).val() == "admin") {
                                    return "<a href='{!! url('removeGroup/" + d.id + "') !!}' class='glyphicon glyphicon-remove' style='color:red'></a>";
                                }
                                else if($( "#role" ).val() == "manager")
                                {
                                    return "";
                                }
                            },"name" : 'name'},
                    ],
                    "aoColumnDefs": [
                        {
                            "aTargets": [0],
                            "bSearchable": false,
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