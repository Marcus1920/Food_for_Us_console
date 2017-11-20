@extends('master')
@section('content')
    <ol class="breadcrumb hidden-xs">
        <li><a href="{{ url('/users') }}">Home</a></li>
        <li class="active">Transaction List</li>
    </ol>
    <h4 class="page-title">Transaction List</h4>

    <div class="tab-pane" id="inactive">
        <div class="row">
            <div class="col-md-12" >
                <div class="tab-pane" id="closure">
                    <!-- Responsive Table -->
                    <div class="block-area" id="responsiveTable">
                        <div class="table-responsive">
                            <h3 class="block-title"> Transaction List</h3>
                            {{--<a href="{{ url('userroleslist') }}" class="btn btn-sm">--}}
                            {{--</a>--}}
                            <table class="table tile table-striped" id="transactionListTable">
                                <thead>
                                <tr>
                                    <th>Transaction Id</th>
                                    <th>Name</th>
                                    <th>Surname</th>
                                    <th>ID Number</th>
                                    <th>Gps Lat</th>
                                    <th>Gps Long</th>
                                    <th>Post Id</th>
                                    <th>Product name</th>
                                    <th>Quantity Posted</th>
                                    <th>Quantity Purchased</th>
                                    <th>Quantity available</th>
                                    <th>Transaction rating</th>
                                    <th>Transaction Comment</th>
                                    <th>Created At</th>
                                    {{--<th>Action</th>--}}
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
            var transactionListTable     = $('#transactionListTable').DataTable({
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
                "ajax": "{!! url('/transactionHistory/')!!}","processing": true,
                "serverSide": true,
                "dom": 'Bfrtip',
                "order" :[[0,"desc"]],

                "buttons": [
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5'
                ],
                "columns":
                    [
                    {data: 'id', name: 'id'},
                        {data: 'name', name: 'name'},
                        {data: 'surname', name: 'surname'},
                        {data: 'idNumber', name: 'idNumber'},
                        {data: 'gps_lat', name: 'gps_lat'},
                        {data: 'gps_long', name: 'gps_long'},
                        {data: 'postRefference', name: 'postRefference'},
                        {data: 'productName', name: 'productName'},
                        {data: 'quantityPosted', name: 'quantityPosted'},
                        {data: 'quantity', name: 'quantity'},
                        {data: 'quantityAvailable', name: 'quantityAvailable'},
                        {data: 'rating', name: 'rating'},
                        {data: 'comment', name: 'comment'},
                        {data: 'created_at', name: 'created_at'},
                        {{--{data: function(d)--}}
                        {{--{--}}
                            {{--return "<a href='{!! url('postview/" + d.postRefference " ') !!}' class='btn btn-sm'>" + 'View' + "</a>";--}}
                        {{--}},--}}

                ],

                "aoColumnDefs": [
                    { "bSearchable": false, "aTargets": [ 4] },
                    { "bSortable": false, "aTargets": [ 4] }
                ]

            });
        });
    </script>
@endsection