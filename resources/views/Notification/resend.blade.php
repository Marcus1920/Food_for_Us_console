@extends('master')

@section('content')
    <ol class="breadcrumb hidden-xs">
        <li><a href="{{ url('/master') }}">Home</a></li>
        <li><a href="{{ url('/allNotification') }}">Notification List</a></li>
        <li class="active">Forward Message</li>
    </ol>
    <h4 class="page-title">Forward Message</h4>
    <br/>
    <br/>
    <br/>

    <div class="row">
        <div class="col-md-6 col-md-offset-2">
    {!! Form::open(['url' => 'resendNotification', 'method' => 'post', 'class' => 'form-horizontal' ]) !!}

        <br/>
        <br/>

    <div class="form-group">

        {!! Form::label('Message', 'Message', array('class' => 'col-md-2 control-label')) !!}
        <div class="col-md-10">
            {!! Form::textarea('Message',$notification->Message,['class' => 'form-control input-sm','id' => 'Message','placeholder'=>'Message.','required']) !!}
            @if ($errors->has('Message')) <p class="help-block red">*{{ $errors->first('Message') }}</p> @endif
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('To', 'To', array('class' => 'col-md-2 control-label')) !!}
        <div class="col-md-10">
            {!! Form::select('To',['0' => 'Select/All','1' => 'Users','2' => 'Group'],0,['class' => 'form-control' ,'id' => 'To']) !!}
        </div>
    </div>


    <div class="form-group searchUsers hidden">
        {!! Form::label(' Users', ' Users', array('class' => 'col-md-2 control-label')) !!}
        <div class="col-md-10">
            {!! Form::text('userId',NULL,['class' => 'form-control input-sm','id' => 'userId']) !!}
        </div>
    </div>
    <br/>
    <div class="form-group searchGroup hidden">
        {!! Form::label('Group', 'Group', array('class' => 'col-md-2 control-label')) !!}
        <div class="col-md-10">
            {!! Form::text('group',NULL,['class' => 'form-control input-sm','id' => 'group']) !!}
        </div>
    </div>

    <div class="form-group ">
        <div class="col-md-offset-2 col-md-10">
            <button type="submit" type="button" class="btn btn-sm">Resend</button>
        </div>
    </div>
    {!! Form::close() !!}
        </div>
    </div>

@endsection
@section('footer')
    <script>

        $('#To').on('change',function(){
            var selectText  = $(this).find("option:selected").text();
            if(selectText == 'Users' ){
                $('.searchUsers').removeClass('hidden');
                $('.searchGroup').addClass('hidden');
            } else if(selectText == 'Group' ){
                $('.searchGroup').removeClass('hidden');
                $('.searchUsers').addClass('hidden');
            }
            else {
                $('.searchUsers').addClass('hidden');
                $('.searchGroup').addClass('hidden');
            }
        })

        jQuery(document).ready(function($) {
            $("#userId").tokenInput("{!! url('/getUserss')!!}", {tokenLimit: 50})
        });
        jQuery(document).ready(function($) {
            $("#group").tokenInput("{!! url('/getGroup')!!}", {tokenLimit: 1})
        });
    </script>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
    <link href="css/style.css" rel="stylesheet">
@endsection