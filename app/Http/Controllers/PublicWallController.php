<?php

namespace App\Http\Controllers;

use App\PublicWall;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class PublicWallController extends Controller
{

    public function index()
    {

        $recipes = PublicWall::all();
        return response()->json($recipes);
    }

    public function getRecipe($id)
    {
        $recipe = PublicWall::with('newusers')->where('id',$id)->first();
        return $recipe;
    }


    public function editRecipe($id, $poster)
    {



        $recipe = PublicWall::where('poster',$poster)->where('id',$id)
            ->update(['name'=> Input::get('name'),'description'=> Input::get('description'),'ingredients'=> Input::get('ingredients'),'methods'=> Input::get('methods'),'updated_at'=>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()]);



        $updatedrecipe=PublicWall::get()->where('poster',$poster)->where('id',$id);

        return $updatedrecipe;
    }

    public function create()
    {

        $recipe                     = new PublicWall();

        $recipe->name               = Input::get('name');
        $recipe->description        = Input::get('description');
        $recipe->ingredients        = Input::get('ingredients');
        $recipe->methods            = Input::get('methods');
        $recipe->poster             = Input::get('poster');
        $recipe-> save() ;
        return $recipe;
    }

}
