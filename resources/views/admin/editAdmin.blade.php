@extends('master')
@section('content')
    <!-- Breadcrumb -->
    <ol class="breadcrumb hidden-xs">
        <li><a href="{{ url('/users') }}"> Home</a></li>
        <li class="active">Update Form</li>
    </ol>
    <h4 class="page-title">ADMIN USERS</h4>

    <!-- Basic with panel-->
    <div class="block-area" id="basic">
        <h3 class="block-title">Update Form</h3>
        <div class="tile p-15">



            {!! Form::open(['url' => 'editAdmin/'.$admin->id, 'method' => 'post', 'class' => 'form-horizontal', 'id'=>"UpdateForm" ]) !!}
            {!! Form::hidden('id') !!}

            <div class="form-group">
                {!! Form::label('Name', 'Name', array('class' => 'col-md-2 control-label')) !!}
                <div class="col-md-6">
                    {!! Form::text('name',$admin->name,['class' => 'form-control input-sm','id' => 'name']) !!}
                    @if ($errors->has('name'))<span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>@endif
                </div>
            </div>


            <div class="form-group">
                {!! Form::label('Surname', 'Surname', array('class' => 'col-md-2 control-label')) !!}
                <div class="col-md-6">
                    {!! Form::text('surname',$admin->surname,['class' => 'street_number form-control input-sm','id' => 'surname']) !!}
                    @if ($errors->has('surname'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('surname') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('Email', 'Email', array('class' => 'col-md-2 control-label')) !!}
                <div class="col-md-6">
                    {!! Form::text('email',$admin->email,['class' => 'locality form-control input-sm','id' => 'email']) !!}
                    @if ($errors->has('email'))<span class="help-block"><strong>{{ $errors->first('cellphone') }}</strong></span>@endif
                </div>
            </div>


            <div class="form-group">
                {!! Form::label('Cellphone', 'cellphone', array('class' => 'col-md-2 control-label')) !!}
                <div class="col-md-6">
                    {!! Form::text('cellphone',$admin->cellphone,['class' => 'administrative_area_level_1 form-control input-sm','id' => 'cellphone']) !!}
                    @if ($errors->has('cellphone'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-offset-2 col-md-6">
                    <button type="submit" id='updateAdmin' class="btn btn-info btn-sm m-t-10">SUBMIT FORM</button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>

@endsection
