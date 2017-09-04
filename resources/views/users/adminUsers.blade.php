@extends('master')
@section('content')
    <ol class="breadcrumb hidden-xs" xmlns="http://www.w3.org/1999/html">
        <li><a href="{{ url('/users') }}">Home</a></li>
        <li class="active"><a>Admin Users List</a></li>
    </ol>
    <h4 class="page-title">Admin Users</h4>
    <div class="row">
        <div class="col-md-12" >
            <div class="tab-pane" id="closure">
                <!-- Responsive Table -->
                <div class="block-area" id="responsiveTable">
                    <div class="table-responsive overflow">
                        <h3 class="block-title">Admin User  List </h3>

                        <a href="{{url('register')}}"> <button type="submit" id='addingAdmin' class="btn btn-info btn-sm m-t-10" style="margin-bottom: 1%">Add Admin</button></a>
                        <table class="table tile table-striped" id="pendingreferralCasesTable">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Surname</th>
                                <th>Email</th>
                                <th>Cellphone</th>
                                <th>Created By</th>
                                <th>Action</th>

                            </tr>
                            </thead>
                            @foreach($adminUsers  as $adminUser)
                                <tr>

                                    <td> {{$adminUser->id}} </td>
                                    <td> {{$adminUser->name}}  </td>
                                    <td> {{$adminUser->surname}}  </td>
                                    <td> {{$adminUser->email}}  </td>
                                    <td> {{$adminUser->cellphone}} </td>
                                    <td> {{$adminUser->created_by}} </td>
                                    <td><a href="{{url('/viewAdmin/'.$adminUser->id)}}"  value="click me" class="btn btn-secondary">Edit</a></td>

                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection