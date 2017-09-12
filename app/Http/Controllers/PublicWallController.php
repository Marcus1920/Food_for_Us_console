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
        $recipes=PublicWall::all();
        return view('PublicWall.index',compact('recipes'));
    }

    public function getRecipes()
    {

        $recipes = PublicWall::all();
        return response()->json($recipes);
    }

    public function viewRecipe()
    {
        $id = Input::get('id');
        $viewRecipe = PublicWall::where('id',$id)->first();
        return $viewRecipe;
    }

    public function RecipeProfile($id)
    {
        $recipe=PublicWall::find($id);
        return view ('PublicWall.profile',compact('recipe'));
    }


    public function editRecipe()
    {

        $id =Input::get('id');

        $recipe = PublicWall::where('id',$id)
            ->update(['name'=> Input::get('name'),'description'=> Input::get('description'),'ingredients'=> Input::get('ingredients'),'methods'=> Input::get('methods'),'updated_at'=>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()]);



        $updatedRecipe=PublicWall::get()->where('id',$id);

        return $updatedRecipe;
    }

    public function createRecipe(Request $request)
    {

        $recipe                     = new PublicWall();
        $recipe->type               = Input::get('type');


        $img=$request->file('file');

        $destinationFolder = "images/Recipes/";

        if(!\File::exists($destinationFolder)) {
            \File::makeDirectory($destinationFolder,0777,true);
        }

        $name =    $img->getClientOriginalName();

        $img->move($destinationFolder,$name) ;

        $recipe->RecipePicture      = env('APP_URL').$destinationFolder.'/'.$name;
        $recipe->name               = Input::get('name');
        $recipe->description        = Input::get('description');
        $recipe->ingredients        = Input::get('ingredients');
        $recipe->methods            = Input::get('methods');
        $recipe->poster             = Auth::user()->id;
        $recipe-> save() ;

        return Redirect('/publicWall');
    }

    public function deleteRecipe()
    {
        $id                 = Input::get('id');

        $deleteRecipe       = PublicWall::where('id',$id);
        $deleteRecipe->delete();
         $Recipes           = PublicWall::all();
         return $Recipes;


    }

}
