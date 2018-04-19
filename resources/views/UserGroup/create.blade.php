@extends('master')
@section('content')
    <ol class="breadcrumb hidden-xs">
        <li><a href="{{ url('/master') }}">Home</a></li>
        <li><a href="{{ url('/group') }}">Groups</a></li>
        <li class="active">Add User To {{$group->name}}</li>
        {{--<li class="active"><a>  </a></li>--}}
        {{--<li class="active"><a>Posts</a></li>--}}
    </ol>
    <h4 class="page-title">Add User To {{$group->name}}</h4>
    <br/>
    <br/>
    <br/>

    <div class="row">
        {!! Form::open(['url' => 'groupUser', 'method' => 'post', 'class' => 'form-horizontal' ]) !!}

        <div class="form-group">
            {!! Form::label('Group Users', 'Group Users', array('class' => 'col-md-3 control-label')) !!}
            {!! Form::hidden('group_id',$group->id) !!}
            <div class="col-md-6">
                {!! Form::text('user_id',NULL,['class' => 'form-control input-sm','id' => 'user_id']) !!}
            </div>
        </div>
        <br/>
        <br/>

        <div class="form-group">
            <div class="col-md-offset-3 col-md-10">
                <button type="submit" type="button" class="btn btn-sm">Add Users</button>
            </div>
        </div>
    </div>
    <div class="modal-footer">

    </div>

    {!! Form::close() !!}

    </div>



@endsection
@section('footer')
    <script>
        jQuery(document).ready(function($) {
            $("#user_id").tokenInput("{!! url('/getUserss')!!}", {tokenLimit: 50})
        });
    </script>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
    <link href="css/style.css" rel="stylesheet">

@endsection