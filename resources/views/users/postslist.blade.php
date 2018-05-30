@extends('master')
@section('content')
    <ol class="breadcrumb hidden-xs">
        <li><a href="{{ url('/users') }}">Home</a></li>
        <li class="active">Posts</li>
        {{--<li class="active"><a>  </a></li>--}}
        {{--<li class="active"><a>Posts</a></li>--}}
    </ol>
    <h4 class="page-title">Seller Post Listing</h4>

    <input type="text" class="hidden" style="color:black" id="role" value={!! Auth::user()->role !!} />

    <div>
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
                                    <th class="delete hidden">Delete</th>
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

            if($( "#role" ).val() == "admin") {
                $('.delete').removeClass('hidden');
            }

            var sellersPostTable  = $('#sellersPostTable').DataTable({
                "autoWidth": false,
                "processing": true,
                speed: 500,
                "dom": 'Bfrtip',
                "scrollX": true,
                "bAutoWidth": false,
                "aaSorting": [],
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
                    {data: function(d)
                        {
                            return "<a href='{!! url('postview/" + d.id + "') !!}' class='btn btn-sm'>" + 'View' + "</a>";
                        }},
                    {data: function(d)
                        {
                            if($( "#role" ).val() == "admin") {
                                return "<a href='{!! url('removePost/" + d.id + "') !!}' class='glyphicon glyphicon-trash'></a>";
                            }
                            else if($( "#role" ).val() == "manager")
                            {
                                return "";
                            }
                        },"name" : 'name'},
                ],
                "aoColumnDefs": [
                    { "bSearchable": false, "aTargets": [ 4] },
                    { "bSortable": false, "aTargets": [ 4] }
                ]

            });

        });
    </script>
@endsection