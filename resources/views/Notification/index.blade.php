@extends('master')
@section('content')
    <ol class="breadcrumb hidden-xs">
        <li class="active">Notification List</li>
        {{--<li class="active"><a>  </a></li>--}}
        {{--<li class="active"><a>Posts</a></li>--}}
    </ol>
    <h4 class="page-title">Notification Listing</h4>

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
                        <table class="table tile table-striped" id="notificationsTable">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>SurName</th>
                                <th>PostId</th>
                                <th>ProductName</th>
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
            var $data = {!! $notifications !!};
            assignToEventsColumns($data);
            function assignToEventsColumns(data) {
                var table = $('#notificationsTable').dataTable({
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
                        {data: 'id'},
                        {data: 'name', name: 'name'},
                        {data: 'surname', name: 'surname'},
                        {data: 'PostId', name: 'PostId'},
                        {data: 'ProductName', name: 'ProductName'},
                        {data: 'Message', name: 'Message'},
                        {data: function(d)
                            {
                                return "<a href='{!! url('resendNotification/" + d.id +"') !!}'class='btn btn-sm glyphicon glyphicon-send'>" + ' FORWARD' + "</a>";
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