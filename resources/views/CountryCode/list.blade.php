@extends('master')
@section('content')
    <ol class="breadcrumb hidden-xs">
        <li><a href="{{ url('/users') }}">Home</a></li>
        <li class="active">Country Code</li>
        {{--<li class="active"><a>  </a></li>--}}
        {{--<li class="active"><a>Posts</a></li>--}}
    </ol>
    <h4 class="page-title">Country Code Listing</h4>


    <div class="row">
        <div class="col-md-12" >
            <div class="tab-pane" id="closure">
                <!-- Responsive Table -->
                <div class="block-area" id="responsiveTable">
                    <div class="table-responsive">
                        <h3 class="block-title">Countries</h3>
                        {{--<a href="{{ url('CreateProduct') }}" class="btn btn-sm">--}}
                            {{--<i class="fa fa-plus" aria-hidden="true" title="Add new product" data-toggle="tooltip"></i>--}}
                        {{--</a>--}}
                        <table class="table tile table-striped" id="pendingreferralCasesTable">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Internet Code</th>
                                <th>Dial Code</th>
                                <th>Edit</th>
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
                "ajax": "{!! url('/countrylist/')!!}","processing": true,
                "serverSide": true,
                "dom": 'Bfrtip',
                "order" :[[0,"desc"]],

                "buttons": [
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5'
                ],


                "columns": [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data:'internet', name: 'internet'},
                    {data: 'dial_code', name: 'dial_code'},

                    {data: function(d)
                    {
                        return "<a href='{!! url('editCountryCode/" + d.id + "') !!}' class='btn btn-sm'>" + 'Edit' + "</a>";
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