<!DOCTYPE html>
<!--[if IE 9 ]><html class="ie9"><![endif]-->
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <meta name="format-detection" content="telephone=no">
    <meta charset="UTF-8">
    <meta name="description" content="Siyaleader Durban University of Technology">
    <meta name="keywords" content="Siyaleader,Durban University of Technology, HIV/AIDS">
    <title>Food For Us</title>


    <!-- CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('css/generics.css') }}" rel="stylesheet">



</head>
<body id="skin-blur-ocean"  style="background-color:#265a88" >

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (Session::has('status'))
    <div class="alert alert-info">{{ Session::get('status') }}</div>
@endif
<section id="login">
    <header>
        <h1></h1>
        <p></p>
    </header>

    <div class="row" >
        <div class="col-md-6" style="background-color:#265a88; height: 600px; ">

            <form class="box tile animated active" id="box-login" role="form" method="POST" action="{{ route('password.email') }}">
                <center>
                </center>
                <br/>
                <h2 class="m-t-0 m-b-15">Reset Password</h2>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="text" class="login-control m-b-10" id="email" name="email"  placeholder="email"  value="{{ old('email') }}" required>
                <button class="btn btn-default btn-sm m-r-5" type="submit"> Send Password Reset Link</button>
                <small>
                    <a class="btn btn-default btn-sm m-r-5" href="{{ route('login') }}">
                        Already have an Account
                    </a>
                </small>
            </form>

        </div>
        <div class="col-md-6" style="background-image: url(img/login_illustration.png); height: 600px">


        </div>

        <div id="login_img" class="col-lg-6"></div>

    </div>

    <div class="clearfix"></div>
</section>

<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/functions.js') }}"></script>
</body>
</html>


