@extends('master')
@section('content')
    <div class="row">
        <div class="col-md-12" >
            <div class="tab-pane" id="closure">
                <!-- Responsive Table -->

                <ul class="nav nav-pills navbar-right" role="tablist">
                    <li class="active"><a href="#all"  data-toggle="tab">My Tasks</a></li>
                    <li><a href="#assigned"  data-toggle="tab">Assigned by Me</a></li>

                </ul>
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
@endsection