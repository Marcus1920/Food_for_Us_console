<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="generator" content="Mobirise v4.5.4, mobirise.com">
    <!-- Favicons -->
    <meta name="csrf-token" content="{{csrf_token()}}" />
    <link rel="apple-touch-icon" href="{{ asset('img/food_for_us_logo.png') }}">
    <link rel="icon" href="{{ asset('img/food_for_us_logo.png') }}">
    <title>
        Food  for us
    </title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <link rel="stylesheet" href="profile/assets/css/material-kit.css?v=2.0.2">
    <script type="text/javascript" src="js/editprofile.js"></script>




    <!-- Documentation extras -->
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="profile/assets/assets-for-demo/demo.css" rel="stylesheet" />
    <!-- iframe removal -->
</head>

<body class="profile-page ">
<nav class="navbar navbar-color-on-scroll navbar-transparent    fixed-top  navbar-expand-lg " color-on-scroll="100" id="sectionsNav">
    <div class="container">
        <div class="navbar-translate">
            <a class="navbar-brand" href="#"> <img  style="width: 50px; height: 50px; margin-bottom: 8px; padding-bottom: 15px;" src="profile/assets/img/logo.png"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                <span class="navbar-toggler-icon"></span>
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>

        <div class="collapse navbar-collapse">
            <ul class="navbar-nav"  data-tabs="tabs">
                <li class="nav-item active">
                    <a href="userporifiles" class="nav-link" > <i class="material-icons">account_circle</i>
                        Profile </a>
                </li>
                <li class="nav-item">
                    <a href="mypostlist" class="nav-link"> <i class="material-icons">poll</i>
                        My Post </a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        <i class="material-icons">add_box</i>
                        Create Post </a>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="createPost">For Sale</a>
                        <a class="dropdown-item" href="createDonation">Donation</a>
                    </div>
                </li>

                <li class="nav-item">
                    <a href="recieptlist" class="nav-link"> <i class="material-icons">receipt</i>
                        Public Wall</a>
                </li>

                <li class="nav-item">
                    <a href="userReport" class="nav-link"> <i class="material-icons">assessment</i>
                        Report</a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('/auth/logout') }}" class="nav-link"> <i class="material-icons">settings_power</i>
                        Logout</a>
                </li>

            </ul>


            {{--<form class="form-inline ml-auto">--}}
                {{--<div class="form-group has-white">--}}
                    {{--<input type="text" class="form-control" placeholder="Search">--}}
                {{--</div>--}}
                {{--<button type="submit" class="btn btn-white btn-raised btn-fab btn-fab-mini btn-round">--}}
                    {{--<i class="material-icons">search</i>--}}
                {{--</button>--}}
            {{--</form>--}}
        </div>
    </div>
</nav>
<div class="page-header header-filter" data-parallax="true" style="background-image: url('profile/assets/img/FFU.png');"></div>
<div class="main main-raised">
    <div class="profile-content">
        <div class="container">
            <div class="row">
                <div class="col-md-4 ml-auto mr-auto">
                    <div class="profile" style="float: left" >
                        <div class="avatar">
                            <img src="img/{{ $users->profilePicture }}" alt="Circle Image" class="img-raised rounded-circle img-fluid" id="img2">

                        </div>


                                               <div class="name">
                            <h3 class="title"><span id="nm">{{ $users->name }}</span>  <span id="sm">{{ $users->surname }}</span></h3>
                            <h6>Interest : <span id="inter">{{ $users->interest }}</span> </h6>
                            <h6>ID Number : <span id="idn">{{ $users->idNumber }}</span> </h6>
                            <h6>email : <span id="em"></span> {{ $users->email }}</h6> </h6>
                            <h6>cellphone : <span id="cl">{{ $users->cellphone }}</span>  </h6>
                            <h6>location :<span id="lc">{{ $users->location }}</span>  </h6>
                            {{--<a href="" class="btn btn-just-icon btn-link btn-dribbble"><i class="fa fa-dribbble"></i></a>--}}
                            {{--<a href="" class="btn btn-just-icon btn-link btn-twitter"><i class="fa fa-twitter"></i></a>--}}
                            {{--<a href="" class="btn btn-just-icon btn-link btn-pinterest"><i class="fa fa-pinterest"></i></a>--}}
                        </div>

                    </div>

                    <ul class="navbar-nav"  data-tabs="tabs" >
                        <li class="nav-item active ">
                            <a href="#" class="nav-link" style="color: black"  data-toggle="modal" data-target="#myModal"><i class="material-icons">edit</i>
                            </a>
                        </li>
                    </ul>

                </div>


            </div>



        </div>
    </div>

</div>

<script>
function removeImage() {_("pic_image").src="img/food.jpg"}
</script>
<!-- The Modal -->
<div class="modal fade" id="myModal"   >
    <div class="modal-dialog"  >
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title"><b>Edit Profile</b></h4>
                <button type="button" class="close" data-dismiss="modal" onclick="removeOldImg()" onmousedown="removeImage()">&times;</button>
            </div>
{{--<script>localStorage.clear()</script>--}}
            <!-- Modal body -->
            <div class="modal-body">
                <div class="card-img" align="center" >
                    {{csrf_field()}}
                    <img src="img/{{ $users->profilePicture }}" id="pic_image" class="card-img-top" style="width: 60%;cursor: pointer; height: 280px">
                   <input type="file" style="width: 60%; height: 280px; position: absolute; margin-left: -270px;
                    opacity: 0; cursor: pointer"  title="Change Picture" onchange="changepp()"   id="file_pic">

                </div>
                <p align="center" style="color:red; margin-bottom: 0px; margin-top: 5px; font-size: 20px" id="error"></p>

                    <input type="text" class="form-control" id="name" placeholder="Name" value="{{ $users->surname }}">
                    <select class="form-control" id="interest">
                        <option value="1">{{ $users->interest }}</option>
                        <option value="2">Buyer</option>
                        <option value="3">Researcher</option>
                        <option value="4">Charity</option>
                    </select>
                    <input type="text" class="form-control" id="idnumber" placeholder="Id number" value="{{ $users->idNumber }}">
                    <input type="email" class="form-control" id="email" placeholder="Email" value="{{ $users->email }}">
                    <input type="text" class="form-control" id="cell" placeholder="Cell number" value="{{ $users->cellphone }}">
                    <input type="text" class="form-control" id="location" placeholder="Location" value="{{ $users->location }}">
                    <input type="hidden" id="id" value="{{$users->id}}">
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-info" onclick="saveData()">Save</button>
            </div>

        </div>
    </div>
</div>


<footer class="footer ">
    <div class="container">
        <nav class="pull-left">
            <ul>
                <li>
                    <button class="btn btn-just-icon btn-round btn-linkedin">
                        <i class="fa fa-linkedin"></i>
                    </button>
                </li>
                <li>
                    <button class="btn btn-just-icon btn-round btn-linkedin">
                        <i class="fa fa-twitter"></i>
                    </button>
                </li>
                <li>
                    <button class="btn btn-just-icon btn-round btn-linkedin">
                        <i class="fa fa-facebook"> </i>
                    </button>
                </li>
                <li>
                    <button class="btn btn-just-icon btn-round btn-linkedin">
                        <i class="fa fa-youtube"> </i>
                    </button>
                </li>
            </ul>
        </nav>
        <div class="copyright pull-right">

        </div>
    </div>
</footer>

<!--   Core JS Files   -->
<script src="profile/assets/js/core/jquery.min.js"></script>
<script src="profile/assets/js/core/popper.min.js"></script>
<script src="profile/assets/js/bootstrap-material-design.js"></script>
<!--  Plugin for Date Time Picker and Full Calendar Plugin  -->
<script src="profile/assets/js/plugins/moment.min.js"></script>
<!--	Plugin for the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker -->
<script src="profile/assets/js/plugins/bootstrap-datetimepicker.min.js"></script>
<!--	Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
<script src="profile/assets/js/plugins/nouislider.min.js"></script>
<!-- Material Kit Core initialisations of plugins and Bootstrap Material Design Library -->
<script src="profile/assets/js/material-kit.js?v=2.0.2"></script>
<!-- Fixed Sidebar Nav - js With initialisations For Demo Purpose, Don't Include it in your project -->
<script src="profile/assets/assets-for-demo/js/material-kit-demo.js"></script>
</body>

</html>