@extends('master')
@section('content')
    <ol class="breadcrumb hidden-xs">
        <li><a href="{{ url('/master') }}">Home</a></li>
        <li class="active">Send Message</li>
        {{--<li class="active"><a>  </a></li>--}}
        {{--<li class="active"><a>Posts</a></li>--}}
    </ol>
    <div class="row">
        {!! Form::open(['url' => 'groupUser', 'method' => 'post', 'class' => 'form-horizontal' ]) !!}

        <div class="form-group Notification col-md-6 ">

            {!! Form::label('', '') !!}
            <div class="col-sm-offset-8">
                {!! Form::textarea('Message',$notification->message,['class' => 'form-control input-sm','id' => 'message','placeholder'=>'message.','required']) !!}
                @if ($errors->has('message')) <p class="help-block red">*{{ $errors->first('message') }}</p> @endif
            </div>
        </div>
        <div class="form-group">
        </div>

        <div class="form-group col-md-offset-8 col-md-6 ">
            {!! Form::label(' Users', ' Users', array('class' => 'col-md-3 control-label')) !!}
            <div class="col-md-offset-8">
                {!! Form::text('userId',NULL,['class' => 'form-control input-sm','id' => 'userId']) !!}
            </div>
        </div>
        <br/>
        <div class="form-group col-md-offset-8 col-md-6 ">
            {!! Form::label('Group Users', 'Group Users', array('class' => 'col-md-3 control-label')) !!}
            <div class="col-md-offset-8 ">
                {!! Form::text('user',NULL,['class' => 'form-control input-sm','id' => 'user']) !!}

            </div>
        </div>
        <br/>
        <br/>
        <br/>
        <br/>

        <div class="form-group ">
            <div class="col-md-offset-4 col-md-4">
                <button type="submit" type="button" class="btn btn-sm">Forward</button>
            </div>
        </div>
    </div>

    {!! Form::close() !!}

@endsection
@section('footer')
    <script>
        jQuery(document).ready(function($) {
            $("#userId").tokenInput("{!! url('/getUserss')!!}", {tokenLimit: 50})
        });
        jQuery(document).ready(function($) {
            $("#user").tokenInput("{!! url('/getGroup')!!}", {tokenLimit: 1})
        });
    </script>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
    <link href="css/style.css" rel="stylesheet">
@endsection