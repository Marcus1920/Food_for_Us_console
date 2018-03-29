@extends('master')
@section('content')
    <ol class="breadcrumb hidden-xs">
        <li><a href="{{ url('/users') }}">Home</a></li>
        <li class="active">Posts</li>

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
                                    <th>ID Number</th>
                                    <th>gps Lat</th>
                                    <th>gps long</th>
                                    <th>Packaging</th>
                                    <th>Product Type</th>
                                    <th>Description</th>
                                    <th>Cost Per KG</th>
                                    <th>Sell By Date</th>
                                    <th>Quantity Posted</th>
                                    <th>Quantity Sold</th>
                                    <th>Quantity Remaining</th>
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

        jQuery(document).ready(function($) {

             $('#sellersPostTable').dataTable({

            ajax: "{!! url('/sellersPostList/')!!}", "processing": true,

            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'surname', name: 'surname'},
                {data: 'email', name: 'email'},
                {data: 'idNumber', name: 'idNumber'},
                {data: 'gps_lat', name: 'gps_lat'},
                {data: 'gps_long', name: 'gps_long'},
                {data: 'packaging', name: 'packaging'},
                {data: 'productType', name: 'productType'},
                {data: 'description', name: 'description'},
                {data: 'costPerKg', name: 'costPerKg'},
                {data: 'sellByDate', name: 'sellByDate'},
                {data: 'quantityPosted', name: 'quantityPosted'},
                {data: 'quantitySold', name: 'quantitySold'},
                {data: 'quantityRemaining', name: 'quantityRemaining'},
                {data: 'created_at', name: 'created_at'},
                {
                    data: function (d) {

                        return "<a href='{!! url('postview/" + d.id + "') !!}' class='btn btn-sm'>" + 'View' + "</a>";

                        data.replace( /[$,]/g, '' )
                        data;
                    }
                }
                ],
                 dom: 'Bfrtip',
                 "scrollX": true,
                 "bAutoWidth": false,
                 "aaSorting": [],
                 "buttons":
                     [
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
                     'copyHtml5',
                     'pdfHtml5'
                 ],

                })
        });
    </script>
@endsection