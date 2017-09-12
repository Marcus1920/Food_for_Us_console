<?php

namespace App\Http\Controllers;

use App\PublicWall;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class PublicWallController extends Controller
{

    public function getRecipes()
    {
        $recipes=\DB::table('public_wall')
            ->join('users', 'public_wall.poster', '=', 'users.id')
            ->select(
                \DB::raw(
                    "
                                public_wall.id,             
                                public_wall.name,                       
                                public_wall.description,
                                public_wall.recipe_picture,
                                public_wall.ingredients,
                                public_wall.methods,
                                public_wall.poster,
                                public_wall.created_at as createdAt,
                                users.name as Name,
                                users.surname as surname   
                                "
                )
            )
            ->get();

        return $recipes;
    }

    public function viewRecipe()
    {
        $id = Input::get('id');


        $viewRecipe = PublicWall::with('users')->where('id',$id)->first();
        return $viewRecipe;
    }

    public function editRecipe()
    {

        $id =Input::get('id');
        $poster= Input::get('poster');

        $recipe = PublicWall::where('poster',$poster)->where('id',$id)
            ->update(['name'=> Input::get('name'),
                'description'=> Input::get('description'),
                'ingredients'=> Input::get('ingredients'),
                'methods'=> Input::get('methods'),
                'updated_at'=>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()]);



        $updatedRecipe=PublicWall::get()->where('poster',$poster)->where('id',$id);

        return $updatedRecipe;
    }

    public function createRecipe()
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

    public function deleteRecipe()
    {
        $id                 = Input::get('id');
        $poster             = Input::get('poster');

        $deleteRecipe       = PublicWall::where('id',$id)->where('poster', $poster);
        $deleteRecipe->delete();
         $myRecipes           = PublicWall::get()->where('poster', $poster);
         return $myRecipes;


    }

}
