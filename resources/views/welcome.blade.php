<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- CSS -->
        <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('/css/animate.min.css') }}" rel="stylesheet">
        <link href="{{ asset('/css/font-awesome.min.css') }}" rel="stylesheet">
        <link href="{{ asset('/css/form.css') }}" rel="stylesheet">
        <link href="{{ asset('/css/calendar.css') }}" rel="stylesheet">
        <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('/css/generics.css') }}" rel="stylesheet">
        <link href="{{ asset('/css/token-input.css') }}" rel="stylesheet">
        <link href="{{ asset('/css/icons.css') }}" rel="stylesheet">
        <link href="{{ asset('/css/lightbox.css') }}" rel="stylesheet">
    <!-- <link href="{{ asset('/css/media-player.css') }}" rel="stylesheet"> -->
        <link href="{{ asset('/css/file-manager.css') }}" rel="stylesheet">
        <link href="{{ asset('/css/buttons.dataTables.min.css') }}" rel="stylesheet">
        <link href="{{ asset('/css/HoldOn.min.css') }}" rel="stylesheet">
        <link href="{{ asset('/css/bootstrap-switch.min.css') }}" rel="stylesheet">
        <link href="{{ asset('/incl/animate.css') }}" rel="stylesheet">
        <link href="{{ asset('/css/Treant.css') }}" rel="stylesheet">
        <link href="{{ asset('/css/collapsable.css') }}" rel="stylesheet">
    <!-- <link href="{{ asset('/css/perfect-scrollbar.css') }}" rel="stylesheet"> -->
        <link href="{{ asset('/css/form-builder.css') }}" rel="stylesheet">

        <link href="{{ asset('/css/toggles.css') }}" rel="stylesheet">
        <link href="{{ asset('/css/toggle-themes/toggles-all.css') }}" rel="stylesheet">

        <!-- DataTables CSS -->
        <link href="{{ asset('/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css') }}" rel="stylesheet">

        <!-- DataTables Responsive CSS -->
    {{--<link href="{{ asset('/bower_components/datatables-responsive/css/responsive.dataTables.scss') }}" rel="stylesheet">--}}
    <!-- jQuery Library -->
        <script src="{{ asset('/js/jquery.min.js') }}"></script>


        <script>

            $document.ready(function () {

                alert(

                    "nmnnnnnnnn"
                );

            });

        </script>

        <style>
            html, body {
                background-color: #2f7fad;

            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }


            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
    <h1>   Food  for   us  </h1> 
     <div class="row">
         <div class="col-md-12" >
    <div class="tab-pane" id="closure">
        <!-- Responsive Table -->
        <div class="block-area" id="responsiveTable">
            <div class="table-responsive overflow">
                <h3 class="block-title">User  List </h3>


                <table class="table tile table-striped" id="pendingreferralCasesTable">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Surname</th>
                        <th>Email</th>
                        <th>Intrest </th>
                        <th>Location</th>
                        <th>Travel Radius</th>
                        <th>Password</th>
                        <th>Description</th>
                    </tr>
                    </thead>
                    @foreach($NewUser  as $NewUser)
                    <tr>
                        <td> {{$NewUser->id}} </td>
                        <td> {{$NewUser->name}}  </td>
                        <td> {{$NewUser->surname}}  </td>
                        <td>  {{$NewUser->email}}  </td>
                        <td> {{$NewUser->intrest}} </td>
                        <td> {{$NewUser->location}} </td>
                        <td> {{$NewUser->travel_radius}} </td>
                        <td> {{$NewUser->password}} </td>
                        <td> {{$NewUser->description_of_acces}} </td>


                    </tr>

                        @endforeach
                </table>
            </div>
        </div>
    </div>
         </div>

     </div>

    <!-- Javascript Libraries -->
    <!-- jQuery -->

    <!--Toggles-->
    <script src="{{ asset('/js/toggles.js') }}"></script>

    <script src="{{ asset('/js/jquery-ui.min.js') }}"></script> <!-- jQuery UI -->
    <script src="{{ asset('/js/jquery.easing.1.3.js') }}"></script> <!-- jQuery Easing - Requirred for Lightbox + Pie Charts-->

    <!-- Bootstrap -->
    <script src="{{ asset('/js/bootstrap.min.js') }}"></script>




    <!--  Form Related -->
    <script src="{{ asset('/js/icheck.js') }}"></script> <!-- Custom Checkbox + Radio -->

    <!-- UX -->
    <script src="{{ asset('/js/scroll.min.js') }}"></script> <!-- Custom Scrollbar -->

    <!-- Other -->
    <script src="{{ asset('/js/calendar.min.js') }}"></script> <!-- Calendar -->
    <script src="{{ asset('/js/feeds.min.js') }}"></script> <!-- News Feeds -->


    <!--  Form Related -->
    <script src="{{ asset('/js/validation/validate.min.js') }}"></script> <!-- jQuery Form Validation Library -->
    <script src="{{ asset('/js/validation/validationEngine.min.js') }}"></script> <!-- jQuery Form Validation Library - requirred with above js -->


    <!-- All JS functions -->
    <script src="{{ asset('/js/functions.js') }}"></script>


    <!-- Token Input -->
    <script src="{{ asset('/js/jquery.tokeninput.js') }}"></script> <!-- Token Input -->


    <!-- Noty JavaScript -->
    <script src="{{ asset('/bower_components/noty/js/noty/packaged/jquery.noty.packaged.js') }}"></script>

    <!-- DataTables JavaScript -->


    <script src="{{ asset('/bower_components/datatables/media/js/datatables-plugins/pagination/scrolling.js') }}"></script>
    <script src="{{ asset('/bower_components/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js') }}"></script>



    <!-- Jquery Bootstrap Maxlength -->
    <script src="{{ asset('/bower_components/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>


    <!-- Media -->
    <script src="{{ asset('/js/media-player.min.js') }}"></script> <!-- Video Player -->
    <script src="{{ asset('/js/pirobox.min.js') }}"></script> <!-- Lightbox -->
    <script src="{{ asset('js/file-manager/elfinder.js') }}"></script> <!-- File Manager -->


    <script type="text/javascript" src="{{ asset('/incl/oms.min.js') }}"></script>



    <!-- File Upload -->
    <script src="{{ asset('/js/fileupload.min.js') }}"></script> <!-- File Upload -->

    <!-- Spinner -->
    <script src="{{ asset('/js/HoldOn.min.js') }}"></script> <!-- Spinner -->

    <!-- bootstrap-switch. -->
    <script src="{{ asset('/js/bootstrap-switch.js') }}"></script> <!-- bootstrap-switch. -->

    <!-- Date & Time Picker -->
    <script src="{{ asset('/js/datetimepicker.min.js') }}"></script> <!-- Date & Time Picker -->

    <!-- Buttons HTML5 -->
    <script src="{{ asset('/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('/js/jszip.min.js') }}"></script>
    <script src="{{ asset('/js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('/js/vfs_fonts.js') }}"></script>
    <!--  Buttons HTML5 -->

    <script src="{{ asset('js/socket.io.js') }}"></script>

    <script src="{{ asset('js/calendar.min.js') }}"></script> <!-- Calendar -->

    <script src="{{ asset('js/raphael.js') }}"> </script>
    <!--  Buttons HTML5 -->



    </body>


</html>
