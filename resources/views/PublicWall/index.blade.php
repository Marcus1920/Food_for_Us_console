@extends('master')
@section('content')
    <ol class="breadcrumb hidden-xs">
        <li><a href="{{ url('/users') }}">Home</a></li>
        <li class="active">Recipes List</li>
        {{--<li class="active"><a>  </a></li>--}}
        {{--<li class="active"><a>Posts</a></li>--}}
    </ol>
    <h4 class="page-title">Recipes Listing</h4>


    <div class="row">
        <div class="col-md-12" >
            <div class="tab-pane" id="closure">
                <!-- Responsive Table -->
                <div class="block-area" id="responsiveTable">
                    <div class="table-responsive overflow">
                        <h3 class="block-title">RECIPES </h3>
                        <a href="{{ url('addRecipe') }}" class="btn btn-sm">
                            <i class="fa fa-plus" aria-hidden="true" title="Add new recipe" data-toggle="tooltip"></i>
                        </a>
                        <table class="table tile table-striped">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Type</th>
                                <th>Title </th>
                                <th>Description</th>
                                <th>Ingredients</th>
                                <th>Methods</th>
                                <th>Created</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            @foreach($recipes  as $recipe)
                                <tr>
                                    <td> {{$recipe->id}} </td>
                                    <td> {{$recipe->type}} </td>
                                    <td> {{$recipe->name}} </td>
                                    <td> {{$recipe->description}} </td>
                                    <td> {{$recipe->ingredients}} </td>
                                    <td> {{$recipe->methods}} </td>
                                    <td> {{$recipe->created_at->diffForHumans()}} </td>

                                    <td><a href="{{url('/RecipeProfile/'.$recipe->id)}}"  value="click me" class="btn btn-secondary">View</a></td>

                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>



@endsection
@section('footer')
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

@endsection