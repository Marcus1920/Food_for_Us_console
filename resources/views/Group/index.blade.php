@extends('master')
@section('content')
    <ol class="breadcrumb hidden-xs">
        <li><a href="{{ url('/master') }}">Home</a></li>
        <li class="active">Notification Groups</li>
        {{--<li class="active"><a>  </a></li>--}}
        {{--<li class="active"><a>Posts</a></li>--}}
    </ol>
    <h4 class="page-title">Notification Groups Listing</h4>


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
                        <h3 class="block-title">Notification Groups</h3>
                        <a href="{{ url('group/create') }}" class="btn btn-sm">
                            <i class="fa fa-plus" aria-hidden="true" title="Add new group" data-toggle="tooltip"></i>
                        </a>
                        <table class="table tile table-striped" id="GroupTable">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Message</th>
                                <th>Action</th>
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
                                return "<a href='{!! url('group/" + d.id + "/edit') !!}' class='btn btn-sm'>" + 'EDIT' + "</a>";
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