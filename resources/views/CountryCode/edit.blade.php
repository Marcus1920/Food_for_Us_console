@extends('master')
@section('content')
    <!-- Breadcrumb -->
    <ol class="breadcrumb hidden-xs">
        <li><a href="{{ url('/users') }}"> Home</a></li>
        <li><a href="{{ url('/countrylistView') }}"> Country List</a></li>
        <li class="active">Country Code</li>
    </ol>
    <h4 class="page-title">Country Code</h4>

    <!-- Basic with panel-->
    <div class="block-area" id="basic">
        <h3 class="block-title">Update Country Code</h3>




            {!! Form::open(['url' => 'updateCountry/', 'method' => 'post', 'class' => 'form-horizontal', 'id'=>"UpdateForm" ]) !!}
            {!! Form::hidden('id',$editCountryCode->id) !!}


            <div class="form-group">
                {!! Form::label('Name', 'Name', array('class' => 'col-md-2 control-label')) !!}
                <div class="col-md-6">
                    {!! Form::text('name',$editCountryCode->name,['class' => 'form-control input-sm','id' => 'name']) !!}
                    @if ($errors->has('name'))<span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>@endif
                </div>
            </div>




            <div class="form-group">
                {!! Form::label('Internet', 'Internet', array('class' => 'col-md-2 control-label')) !!}
                <div class="col-md-6">
                    {!! Form::text('internet',$editCountryCode->internet,['class' => 'locality form-control input-sm','id' => 'internet']) !!}
                    @if ($errors->has('internet'))<span class="help-block"><strong>{{ $errors->first('internet') }}</strong></span>@endif
                </div>
            </div>


            <div class="form-group">
                {!! Form::label('Dial Code', 'Dial Code', array('class' => 'col-md-2 control-label')) !!}
                <div class="col-md-6">
                    {!! Form::text('dial_code',$editCountryCode->dial_code,['class' => 'locality form-control input-sm','id' => 'dial_code']) !!}
                    @if ($errors->has('dial_code'))<span class="help-block"><strong>{{ $errors->first('dial_code') }}</strong></span>@endif
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-offset-2 col-md-6">
                    <button type="submit" id='updateAdmin' class="btn btn-info btn-sm m-t-10">Update</button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>

@endsection
