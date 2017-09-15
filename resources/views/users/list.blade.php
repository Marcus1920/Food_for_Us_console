@extends('master')
@section('content')

    <div id="tabs">
        <ul class="nav nav-pills  navbar-right responsive" role="tablist">


            <li class="active"><a href="#inactive"  data-toggle="tab">Inactive Users</a></li>
            <li><a href="#active"  data-toggle="tab">Active Users</a></li>

        </ul>
        <h4 class="page-title">APP USERS LIST</h4>

        <div class="container-fluid" style="margin-top: 2%; border-color: white; align-content: center">

            <div class="tab-content responsive">

                <!--Global Content Tab-->
            @include('users.inactive')
            <!--Private Content Tab-->
                @include('users.active')


            </div>

        </div>
    </div>
@endsection
@section('footer')
    <script>

        jQuery(document).ready(function($){


            var InactiveUserTable     = $('#InactiveUserTable').DataTable({
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
                "ajax": "{!! url('/inactive/')!!}","processing": true,
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
                    {data: 'surname', name: 'surname'},
                    {data: 'email', name: 'email'},
                    {data: 'intrest', name: 'intrest'},
                    {data: 'location', name: 'location'},
                    {data: 'travelRadius', name: 'travelRadius'},
                    {data: 'descriptionOfAcces', name: 'descriptionOfAcces'},
                    {data: function(d)
                    {
                        return "<a href='{!! url('editUsers/" + d.id + "') !!}' class='btn btn-sm'>" + 'Edit' + "</a>";
                    },"name" : 'name'},
                ],

                "aoColumnDefs": [
                    { "bSearchable": false, "aTargets": [ 4] },
                    { "bSortable": false, "aTargets": [ 4] }
                ]

            });
        });

        $( function() {
            $( "#tabs" ).tabs();
        } );
    </script>
@endsection