@extends('master')
@section('content')
<!-- Breadcrumb -->
<ol class="breadcrumb hidden-xs">
    <li><a href="#">Administration</a></li>
    <li><a href="{{ url('/home') }}">Users</a></li>
    <li class="active">Registration Form</li>
</ol>
<h4 class="page-title">USERS</h4>

<!-- Basic with panel-->
<div class="block-area" id="basic">
    <h3 class="block-title">Registration Form</h3>
    <div class="tile p-15">
        {!! Form::open(['url' => 'users', 'method' => 'post', 'class' => 'form-horizontal', 'id'=>"registrationForm" ]) !!}

        <div class="form-group">
            {!! Form::label('Enter Address', 'Name', array('class' => 'col-md-2 control-label')) !!}
            <div class="col-md-6">
                {!! Form::text('autocomplete',NULL,['class' => 'form-control input-sm','id' => 'autocomplete', "onfocus"=>"geolocate()", 'required']) !!}

            </div>
        </div>


        <div class="form-group">
            {!! Form::label('Street Number', 'Surname', array('class' => 'col-md-2 control-label')) !!}
            <div class="col-md-6">
                {!! Form::text('street_number',NULL,['class' => 'street_number form-control input-sm','id' => 'street_number' , 'required']) !!}

            </div>
        </div>

        <div class="form-group">
            {!! Form::label('Route', 'Gender', array('class' => 'col-md-2 control-label')) !!}
            <div class="col-md-6">
                {!! Form::text('route',NULL,['class' => 'route form-control input-sm','id' => 'route' , 'required']) !!}

            </div>
        </div>
        
        <div class="form-group">
            {!! Form::label('Locality', 'Cellphone', array('class' => 'col-md-2 control-label')) !!}
            <div class="col-md-6">
                {!! Form::text('locality',NULL,['class' => 'locality form-control input-sm','id' => 'locality' , 'required']) !!}

            </div>
        </div>


        <div class="form-group">
            {!! Form::label('Area', 'Email', array('class' => 'col-md-2 control-label')) !!}
            <div class="col-md-6">
                {!! Form::text('administrative_area_level_1',NULL,['class' => 'administrative_area_level_1 form-control input-sm','id' => 'administrative_area_level_1', 'required']) !!}

            </div>
        </div>


        <div class="form-group">
            {!! Form::label('Area', 'Password', array('class' => 'col-md-2 control-label')) !!}
            <div class="col-md-6">
                {!! Form::text('administrative_area_level_1',NULL,['class' => 'administrative_area_level_1 form-control input-sm','id' => 'administrative_area_level_1', 'required']) !!}

            </div>
        </div>

        <div class="form-group">
            <div class="col-md-offset-2 col-md-6">
                <button type="submit" id='submitMemberForm' class="btn btn-info btn-sm m-t-10">SUBMIT FORM</button>
            </div>
        </div>


        {!! Form::close() !!}
    </div>
</div>

@endsection
