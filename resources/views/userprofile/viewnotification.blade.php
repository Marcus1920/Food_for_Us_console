<!DOCTYPE html>
<html lang="en">
<head>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Favicons -->
        <link rel="apple-touch-icon" href="{{ asset('img/food_for_us_logo.png') }}">
        <link rel="icon" href="{{ asset('../img/food_for_us_logo.png') }}">
        <title>
            Food  for us
        </title>
        <!--     Fonts and icons     -->
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
        <link rel="stylesheet" href="../profile/assets/css/material-kit.css?v=2.0.2">
        <link href="../profile/assets/assets-for-demo/demo.css" rel="stylesheet" />
        <!-- iframe removal -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>
    <style>
        /* Dropdown Button */
        .dropbtn {
            background-color: #3498DB;
            color: white;
            padding: 16px;
            font-size: 16px;
            border: none;
            cursor: pointer;
        }

        /* Dropdown button on hover & focus */
        .dropbtn:hover, .dropbtn:focus {
            background-color: #2980B9;
        }

        /* The container <div> - needed to position the dropdown content */
        .dropdown {
            position: relative;
            display: inline-block;

        }

        /* Dropdown Content (Hidden by Default) */
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: white ;
            min-width: 460px;
            box-shadow: 1px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
            margin-left: -130px;
            margin-top: 22px;
            border-radius: 2px 2px 2px 2px ;
            max-height: 652px;
            overflow: auto;
        }
        .dropdown-content:before{
            content: '';
            position: absolute;
            width: 25px;
            height: 25px;
            background: #ddd;
            left:14%;
            transform: translateX(-50%) translateY(-13px)  rotate(45deg);
        }

        .dropdown-content span {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            margin-bottom: -25px;
            display: block;
        }
        /* Links inside the dropdown */
        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }
        .show {display:block;}
        /* Change color of dropdown links on hover */
        .dropdown-content a:hover {background-color:#f1f1f1;}

        #chat{
            display: none;
            background-color: white ;
            box-shadow: 1px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
            border-radius: 2px 2px 2px 2px ;
            overflow: auto;
            width: 350px;
            height: 482px;
            margin-top: -297px;
            float: right;
            -webkit-transition: display ease 5s;
            transition: display ease 5s;
        }
        #chat > span > button{
            margin-left: 275px;
            border-radius: 100%;
            border: 1px solid black;
            color: black;
            font-weight: bold;
            cursor: pointer;
            opacity: 0.5;
        }
        #chat > span > button:hover{
         color: black;
         border: 1px solid black;
            transition: ease 1s;
            opacity: 1;
        }


        #chat   .container {
            border: 2px solid #dedede;
            background-color: #f1f1f1;
            border-radius: 5px;
            padding: 10px;
            margin: 10px 5px 0px 0px;
        }

        /* Darker chat container */
        #chat    .darker {
            border-color: #ccc;
            background-color: #ddd;
        }

        /* Clear floats */
        #chat   .container::after {
            content: "";
            clear: both;
            display: table;
        }

        /* Style images */
        #chat   .container img {
            float: left;
            max-width: 60px;
            width: 100%;
            margin-right: 20px;
            border-radius: 50%;
        }

        /* Style the right image */
        #chat .container img.right {
            float: right;
            margin-left: 20px;
            margin-right:0;
        }

        /* Style time text */
          .time-right {
            float: right;
            color: #aaa;
        }

        /* Style time text */
        .time-left {
            float: left;
            color: #999;
        }


    </style>
<body class="profile-page" style="z-index: 0" onkeydown="clochat(event)" onkeypress="clochat(event)" onkeyup="clochat(event)">

<script>

    function _(x){return document.getElementById(x);}
    var count22,contant="";
    var ajax2 = new XMLHttpRequest();
    var api_key='<?php echo $user->api_key;  ?>';
    ajax2.open("GET","http://dev.foodforus.cloud/public/api/v1/notification?api_key="+api_key, true);
    ajax2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajax2.onreadystatechange = function() {
        var data = JSON.parse(ajax2.responseText);
        contant="<span style='background-color: #ddd; position: fixed; width: 100%'>"+ data.length +" New Notifications</span><br><br>";
        for(count22=0; count22 < data.length ; count22++) {
            contant +='<a href="../../veiwnotification/'+data[count22]['id']+'">'+
                '<img   style="width:55px; height: 55px; float: left; margin-right: 5px; border-radius: 80%; border: silver 1px solid;" src='+data[count22]['productPicture']+'>'+
                '<span style=" margin-top: -10px;"><b>'+data[count22]['ProductName']+'</b></span>'+
                '<span style=" margin-top: -28px; font-size: 13px">'+data[count22]['Message']+'</span>'+
                '<span  style=" margin-top: -29px; font-size: 10px;">'+data[count22]['created_at']+'</span><br style="line-height: .9"></a>';
        }
        _("myDropdown").innerHTML=contant;
    }
    ajax2.send(null);


    function chat(event) {
       if(event.keyCode === 13){
           if(_('inputmessage').value !== "") {
               var ajax5 = new XMLHttpRequest();
               var api_key='<?php echo $user->api_key;  ?>'
               ajax5.open("POST", "http://dev.foodforus.cloud/public/api/v1/createMessage", true);
               ajax5.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
               ajax5.onreadystatechange = function () {
                   _('inputmessage').value='';
                   getAllConversation(_('conveId').value);
               }
               ajax5.send('conversation_id=' + _('conveId').value +'&api_key='+ api_key +'&message=' + _('inputmessage').value);
           }

       }else if(event.keyCode === 27){
           _("inputmessage").value="";
           closeChat();
       }
    }


function clochat() {
    if(event.keyCode == 27){
        _("inputmessage").value="";
        closeChat();
    }
}

</script>

<nav class="navbar navbar-color-on-scroll navbar-transparent   fixed-top  navbar-expand-lg " color-on-scroll="50" id="sectionsNav">
    <div class="container">
        <div class="navbar-translate">
            <a class="navbar-brand" href="#"> <img  style="width: 50px; height: 50px; margin-bottom: 8px; padding-bottom: 15px;" src="../../profile/assets/img/logo.png"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" aria-expanded="false" aria-label="Toggle navigation">
                <span  class="navbar-toggler-icon"></span>
                <span class="navbar-toggler-icon"></span>
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>

        <div class="collapse navbar-collapse" >
            <ul class="navbar-nav"  data-tabs="tabs">
                <li class="nav-item">
                    <a href="../userporifiles" class="nav-link" > <i class="material-icons">account_circle</i>
                        Profile </a>
                </li>
                <li  class="nav-item">
                    <a href="../mypostlist" class="nav-link"> <i class="material-icons">poll</i>
                        My Post </a>
                </li>


                <li class="nav-item">
                    <a href="../recieptlist" class="nav-link"> <i class="material-icons">receipt</i>
                        Public Wall</a>
                </li>

                <li class="nav-item active">
                    <a href="#" class="nav-link" onclick="myFunction()" > <i class="material-icons">notifications</i>
                        Notifications</a>
                </li>

                <div class="dropdown">
                    <div id="myDropdown" class="dropdown-content">
                    </div>
                </div>


                <li class="nav-item">
                    <a href="{{ url('/auth/logout') }}" class="nav-link"> <i class="material-icons">settings_power</i>
                        Logout</a>
                </li>

            </ul>


        </div>
    </div>
</nav>

<div class="page-header header-filter" data-parallax="true" style="background-image: url('profile/assets/img/FFU.png');"></div>


<div class="main main-raised">
    <div class="profile-content">


        <div class="container" style="margin-top: -200px">





                    <div id="myDropdownh" class="dropdown-conthent">



                    </div>





                <div class="modal-body" >

                <div class="card-img" id="boximg" align="center"  style="float: left; " >
                    {{csrf_field()}}
                    <img src="{{$sellers_posts->productPicture}}" id="pic_image" class="card-img-top" style="width: 60%; cursor: pointer; height: 280px">
                </div>


                    <div id="chat"  >
                       <span style='background-color: #ddd; position: fixed; padding: 5px; width: 350px'><b>Chat</b>
                           <button onclick="closeChat()">x</button>
                       </span>
   <br><br style="line-height: 0.9">

                        <div style="width: 332px; height: 30px; margin-top: 398px ; margin-left: -5px; padding: 5px; z-index: 100; position: fixed">
                            <input type="hidden" id="conveId">
                            <input id="inputmessage"  onkeydown="chat(event)" type="text" style="width: 332px; padding: 5px; border: none" placeholder="Write your message here">
                        </div>
<div id="chatBoxs">


</div>
                    </div>

                <p align="center" style="color:black; font-weight: bold; font-size: 32px; margin-bottom: 0px; margin-top: 10px;">{{$sellers_posts->productType}}</p>
                <span><b>Location :</b> {{$sellers_posts->location}} </span><br>
                <span><b>Packaging :</b> {{$sellers_posts->packaging}} </span><br>
                <span><b>Pick Up Address :</b> {{$sellers_posts->pickUpAddress}} </span><br>
                <span><b>Posted  :</b> {{$sellers_posts->created_at}} </span><br>
                <span><b>Description :</b> {{$sellers_posts->description}} </span><br>

                </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-info" id="btnchat"  style="border-radius: 10%" onclick="chatBox()">Chat</button>
            </div>

        </div>
    </div>

        
<script>
    function _(x){return document.getElementById(x);}
    function chatBox() {
        _('chat').style.display = "block";
        _('boximg').style.marginLeft = "40px";
        _('boximg').align = "left";
        _('btnchat').style.display = "none";
        var id = '<?php echo  $sellers_posts->id;  ?>';
        var ajax = new XMLHttpRequest();
        var api_key='<?php echo $user->api_key;  ?>'
        ajax.open("POST", "http://dev.foodforus.cloud/public/api/v1/conversation", true);
        ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        ajax.onreadystatechange = function () {
            var data = JSON.parse(ajax.responseText);
            getAllConversation(data[0]['conversation_id']);
            _('conveId').value=data[0]['conversation_id'];
        }
        ajax.send('post_id='+id+'&api_key='+api_key);
    }
    function closeChat() {
        _('chat').style.display="none";
        _('boximg').style.marginLeft="0px";
        _('boximg').align="center";
        _('btnchat').style.display="block"
    }

    function getAllConversation(id){
        var content='';
        var ajax = new XMLHttpRequest();
        ajax.open("GET", "http://dev.foodforus.cloud/public/api/v1/getMessages?conversation_id="+id, true);
        ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        ajax.onreadystatechange = function () {
            var data = JSON.parse(ajax.responseText);
            for(var x=0 ; x < data.length ; x++){
                if(data[x]['user_type'] === "Receiver") {
                    content ='<div class="container">\n' +
                   '<img src="'+ data[x]['profilePicture'] +'" alt="Avatar">\n' +
                   '<p>' + data[x]['message'] + '</p>\n' +
                   '<span class="time-right">11:00</span>\n' +
                   '</div>';
                }else{
                    content +='<div class="container darker">\n' +
                        '<img src="'+ data[x]['profilePicture'] +'" alt="Avatar" class="right">\n' +
                        '<p>' + data[x]['message'] + '</p>\n' +
                        '<span class="time-left">11:00</span>\n' +
                        '</div>';
                  }
                }
                content +='<br><br>';
            _('chatBoxs').innerHTML=content;
            }

        ajax.send(null);
    }

    setTimeout(getAllConversation(_('conveId').value), 100);


</script>


            <div class="row" id="div_container" >



            </div>



            <div id="pagination_controls"></div>

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
            &copy;

        </div>
    </div>
</footer>



<!--   Core JS Files   -->
<script src="../profile/assets/js/core/jquery.min.js"></script>
<script src="../profile/assets/js/core/popper.min.js"></script>
<script src="../profile/assets/js/bootstrap-material-design.js"></script>
<!--  Plugin for Date Time Picker and Full Calendar Plugin  -->
<script src="../profile/assets/js/plugins/moment.min.js"></script>
<!--	Plugin for the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker -->
<script src="../profile/assets/js/plugins/bootstrap-datetimepic+ker.min.js"></script>
<!--	Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
<script src="../profile/assets/js/plugins/nouislider.min.js"></script>
<!-- Material Kit Core initialisations of plugins and Bootstrap Material Design Library -->
<script src="../profile/assets/js/material-kit.js?v=2.0.2"></script>
<!-- Fixed Sidebar Nav - js With initialisations For Demo Purpose, Don't Include it in your project -->
<script src="../profile/assets/assets-for-demo/js/material-kit-demo.js"></script>
<script>

    var x="close"
    function myFunction() {
        document.getElementById("myDropdown").style.display="block";
        x="open"
    }
    window.onclick = function(event) {
        if (x  === 'close') {document.getElementById("myDropdown").style.display="none";x="open";}else{x="close";}
    }

</script>
<script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
<script>
    var OneSignal = window.OneSignal || [];
    OneSignal.push(function() {
        OneSignal.init({
            appId: "9061f725-d62f-4978-97f1-eb1235f13b10",
            autoRegister: false,
            notifyButton: {
                enable: true,
            },
        });
    });
</script>
</body>
</html>
