@extends('master')
@section('content')
    <ol class="breadcrumb hidden-xs">
        <li><a href="{{ url('/users') }}">Home</a></li>
        <li class="active">Researchers List</li>
        {{--<li class="active"><a>  </a></li>--}}
        {{--<li class="active"><a>Posts</a></li>--}}
    </ol>
    <h4 class="page-title">Researchers Listing</h4>


    <div class="row">
        <div class="col-md-12" >
            <div class="tab-pane" id="closure">
                <!-- Responsive Table -->
                <div class="block-area" id="responsiveTable">
                    <div class="table-responsive">
                        <h3 class="block-title">RESEARCHES </h3>
                        <table class="table tile table-striped" id="reseachersTable">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nature Of Bussiness</th>
                                <th>Summary </th>
                                <th>Research Note</th>
                                <th>Created</th>
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


            var reseachersTable     = $('#reseachersTable').DataTable({
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
                "ajax": "{!! url('/getResearchList/')!!}",
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
                    {data: 'natureOfBusiness', name: 'natureOfBusiness'},
                    {data: 'summaryBox', name: 'summaryBox'},
                    {data: 'researchNotes', name: 'researchNotes'},
                    {data: 'created_at', name: 'created_at'},

                    {data: function(d)
                    {
                        return "<a href='{!! url('researchProfile/" + d.id + "') !!}' class='btn btn-sm'>" + 'View' + "</a>";
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