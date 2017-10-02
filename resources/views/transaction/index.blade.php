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
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Surname</th>
                                    <th>Status </th>
                                    <th>Transaction Id</th>
                                    <th>Created At</th>
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
                        {data: 'app_users.name', name: 'app_users.name'},
                        {data: 'app_users.surname', name: 'app_users.surname'},
//                        {
//                            data: function (d) {
//
//                                return d.name  + " " +  d.surname;
//
//                            }, "name": 'fullName'
//                        },
                    {data: 'transaction_statuses.name', name: 'transaction_statuses.name'},
                    {data: 'transactionId', name: 'transactionId'},
                    {data: 'created_at', name: 'created_at'},

                ],

                "aoColumnDefs": [
                    { "bSearchable": false, "aTargets": [ 4] },
                    { "bSortable": false, "aTargets": [ 4] }
                ]

            });
        });
    </script>
@endsection