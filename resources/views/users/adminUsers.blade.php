@extends('master')
@section('content')
    <ol class="breadcrumb hidden-xs">
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
                        <h3 class="block-title">User  List </h3>
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
                                    <td><a href="{{url('/editUsers/'.$adminUser->id)}}"  value="click me" class="btn btn-secondary">Edit</a></td>

                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection