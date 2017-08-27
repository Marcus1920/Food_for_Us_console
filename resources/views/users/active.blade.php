<div class="tab-pane" id="active">
    <div class="row">
        <div class="col-md-12" >
            <div class="tab-pane" id="closure">
                <!-- Responsive Table -->
                <div class="block-area" id="responsiveTable">
                    <div class="table-responsive overflow">
                        <h3 class="block-title"> Active User  List</h3><h16>&nbsp</h16> <i class="n-count animated"> {{count($activeUsers,0)}}</i>
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
                                <th>Action</th>
                            </tr>
                            </thead>
                            @foreach($activeUsers  as $Newuser)
                                <tr>
                                    <td> {{$Newuser->id}} </td>
                                    <td> {{$Newuser->name}}  </td>
                                    <td> {{$Newuser->surname}}  </td>
                                    <td> {{$Newuser->email}}  </td>
                                    <td> {{$Newuser->intrest}} </td>
                                    <td> {{$Newuser->location}} </td>
                                    <td> {{$Newuser->travel_radius}} </td>
                                    <td> {{$Newuser->password}} </td>
                                    <td> {{$Newuser->description_of_acces}} </td>
                                    <th><a href="{{url('/editUsers/'.$Newuser->id)}}"  value="click me" class="btn btn-secondary">Edit</a></th>

                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>