@extends('master')
@section('content')
    <ol class="breadcrumb hidden-xs">
        <li><a href="{{ url('/master') }}">Home</a></li>
        <li class="active">Products</li>
        {{--<li class="active"><a>  </a></li>--}}
        {{--<li class="active"><a>Posts</a></li>--}}
    </ol>
    <h4 class="page-title">Products Listing</h4>


    <div class="row">
        <div class="col-md-12" >
            <div class="tab-pane" id="closure">
                <!-- Responsive Table -->
                <div class="block-area" id="responsiveTable">
                    <div class="table-responsive overflow">
                        <h3 class="block-title">Products</h3>
                        <a href="{{ url('CreateProduct') }}" class="btn btn-sm">
                            <i class="fa fa-plus" aria-hidden="true" title="Add new product" data-toggle="tooltip"></i>
                        </a>
                        <table class="table tile table-striped" id="pendingreferralCasesTable">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Edit</th>
                                {{--<th>Delete</th>--}}
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
    {{--<script src="js/jquery.min.js"></script>--}}
    {{--<script src="js/bootstrap.min.js"></script>--}}
    {{--<script src="js/scripts.js"></script>--}}
    {{--<link href="css/bootstrap.min.css" rel="stylesheet">--}}
    {{--<link href="css/style.css" rel="stylesheet">--}}
<script>

    jQuery(document).ready(function($){


        var pendingreferralCasesTable     = $('#pendingreferralCasesTable').DataTable({
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
            "ajax": "{!! url('/productlist/')!!}","processing": true,
            "serverSide": true,
            "dom": 'Bfrtip',
            "order" :[[0,"desc"]],

            "buttons": [
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ],


            "columns": [
                {data: 'name', name: 'name'},
                {data: 'type', name: 'type'},
                {data: function(d)
                {
                    return "<a href='{!! url('editproduct/" + d.id + "') !!}' class='btn btn-sm'>" + 'Edit' + "</a>";
                },"name" : 'name'},


            ],

            "aoColumnDefs": [
                { "bSearchable": false, "aTargets": [ 2] }
//                { "bSortable": false, "aTargets": [ 1] }
            ]

        });
    });
</script>
@endsection