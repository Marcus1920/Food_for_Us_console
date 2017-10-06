@extends('master')
@section('content')
    <ol class="breadcrumb hidden-xs">
        <li><a href="{{ url('/master') }}">Home</a></li>
        <li class="active">Add Recipe</li>
        {{--<li class="active"><a>  </a></li>--}}
        {{--<li class="active"><a>Posts</a></li>--}}
    </ol>
    <h4 class="page-title">Add Recipe</h4>


    <div class="row">
        <div class="col-md-6 col-md-offset-2">
            <br/>

            {!! Form::open(['url' => 'createRecipe', 'method' => 'post', 'class' => 'form-horizontal' ,'files' => 'true' ]) !!}

            <div class="form-group">
                {!! Form::label('Picture', 'Picture', array('class' => 'col-md-2 control-label')) !!}
                <div class="fileupload fileupload-new row" data-provides="fileupload">
                    <div class="input-group col-md-9">
                        <div class="uneditable-input form-control">
                            <i class="fa fa-file m-r-5 fileupload-exists"></i>
                            <span class="fileupload-preview"></span>
                        </div>
                        <div class="input-group-btn">
                                <span class="btn btn-file btn-alt btn-sm">
                                <span class="fileupload-new">Select file</span>
                                <span class="fileupload-exists">Change</span>
                                <input type="file" name="file" id="file"/>
                            </span>
                        </div>

                        <a href="#" class="btn btn-sm btn-gr-gray fileupload-exists" data-dismiss="fileupload">Remove</a>
                    </div>
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('Recipe Type', 'Recipe Type', array('class' => 'col-md-2 control-label')) !!}
                <div class="col-md-10">
                    {!! Form::select('type',['0' => 'Select/All','Recipe' => 'Recipe','Trick' => 'Trick'],0,['class' => 'form-control' ,'id' => 'type']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('Recipe Name', 'Recipe Name', array('class' => 'col-md-2 control-label')) !!}
                <div class="col-md-10">
                    {!! Form::text('name',NULL,['class' => 'form-control input-sm','id' => 'name']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('Description', 'Description', array('class' => 'col-md-2 control-label')) !!}
                <div class="col-md-10">
                    <textarea rows="5" id="description" name="description" class="sms form-control" maxlength="500" placeholder="Enter recipe description"></textarea>
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('ingredients', 'ingredients', array('class' => 'col-md-2 control-label')) !!}
                <div class="col-md-10">
                    <textarea rows="4" id="ingredients" name="ingredients" class="sms form-control" maxlength="500" placeholder="Enter recipe ingredients"></textarea>
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('methods', 'methods', array('class' => 'col-md-2 control-label')) !!}
                <div class="col-md-10">
                    <textarea rows="5" id="methods" name="methods" class="sms form-control" maxlength="500" placeholder="Enter recipe methods"></textarea>
                </div>
            </div>
			
<input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <div class="col-md-offset-2 col-md-10">
                    <button type="submit" class="btn btn-sm">Add Recipe</button>
                </div>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
    </div>



@endsection
@section('footer')
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>

@endsection