@extends('master')
@section('content')
    <ol class="breadcrumb hidden-xs">
        <li><a href="{{ url('/master') }}">Home</a></li>
        <li><a href="{{ url('/group') }}">Groups</a></li>
        <li class="active">Send Message</li>
        {{--<li class="active"><a>  </a></li>--}}
        {{--<li class="active"><a>Posts</a></li>--}}
    </ol>
    <h4 class="page-title">Send Message to {{$group->name}} group</h4>
    <br/>
    <br/>
    <br/>

    <div class="row">
        <div class="col-md-6 col-md-offset-2">

            {!! Form::open(['url' => 'msgGroup', 'method' => 'post', 'class' => 'form-horizontal']) !!}
            {!! Form::hidden('group_id',$group->id) !!}

            <br/>
            <br/>

            <div class="form-group">
                {!! Form::label('To', 'To', array('class' => 'col-md-2 control-label')) !!}

                <div class="col-md-10">
                    {!! Form::text('msgTo',$group->name,['class' => 'form-control input-sm','id' => 'msgTo', 'disabled' => 'disabled']) !!}
                </div>
            </div>

            <br/>

            <div class="form-group">
                {!! Form::label('Message', 'Message', array('class' => 'col-md-2 control-label')) !!}
                <div class="col-md-10">
                    <textarea rows="5" id="message" name="message" class="sms form-control" maxlength="500"></textarea>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-offset-2 col-md-10">
                    <button type="submit" class="btn btn-sm">Send Message</button>
                </div>
            </div>

            {!! Form::close() !!}

        </div>

    </div>



@endsection
@section('footer')
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
    <link href="css/style.css" rel="stylesheet">

@endsection