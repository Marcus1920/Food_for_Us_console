@extends('master')
@section('content')
    <ol class="breadcrumb hidden-xs">
        <li><a href="{{ url('/users') }}">Home</a></li>
        <li class="active">Posts</li>
        {{--<li class="active"><a>  </a></li>--}}
        {{--<li class="active"><a>Posts</a></li>--}}
    </ol>
    <h4 class="page-title">Seller Post Listing</h4>


    <div>
    <div class="row">
        <div class="col-md-12" >
            <div class="tab-pane" id="closure">
                <!-- Responsive Table -->
                <div class="block-area" id="responsiveTable">
                    <div class="table-responsive">
                        <h3 class="block-title">Post </h3>
                        <table class="table tile table-striped" id="sellersPostTable">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Surname</th>
                                <th>Email</th>
                                <th>Packaging</th>
                                <th>Product Type</th>
                                <th>Cost Per KG</th>
                                <th>Quantity</th>
                                <th>Created At</th>
                                <th>Action</th>
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


            var sellersPostTable     = $('#sellersPostTable').DataTable({
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
                "ajax": "{!! url('/sellersPostList/')!!}",
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
                    {data: 'surname', name: 'surname'},
                    {data: 'email', name: 'email'},
                    {data: 'packaging', name: 'packaging'},
                    {data: 'productType', name: 'productType'},
                    {data: 'costPerKg', name: 'costPerKg'},
                    {data: 'quantity', name: 'quantity'},
                    {data: 'created_at', name: 'created_at'},
                    {data: function(d)
                    {
                        return "<a href='{!! url('postview/" + d.id + "') !!}' class='btn btn-sm'>" + 'View' + "</a>";
                    }},
                ],

                "aoColumnDefs": [
                    { "bSearchable": false, "aTargets": [ 4] },
                    { "bSortable": false, "aTargets": [ 4] }
                ]

            });

        });
    </script>
@endsection