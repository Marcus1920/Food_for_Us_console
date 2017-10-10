<?php

namespace App\Http\Controllers;

use App\PublicWall;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Yajra\DataTables\DataTables;

class PublicWallController extends Controller
{

    public function index()
    {
        return view('PublicWall.index');
    }

    public function getAllRecipes()
    {
        $allRecipes=PublicWall::all();

        return Datatables::of($allRecipes)
            ->make(true);
    }

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
                                public_wall.imgurl,
                                public_wall.ingredients,
                                public_wall.methods,
                                public_wall.poster,
                                public_wall.created_at as createdAt,
                                users.name as firstName,
                                users.surname as surname   
                                "
                )
            )
            ->get();

        return $recipes;
    }
 public function RecipeProfile($id)
    {
        $recipe=PublicWall::find($id);

        return view ('PublicWall.profile',compact('recipe'));
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

       
        $recipe = PublicWall::where('id',$id)
            ->update(['name'=> Input::get('name'),
                'description'=> Input::get('description'),
                'ingredients'=> Input::get('ingredients'),
                'methods'=> Input::get('methods'),
                'updated_at'=>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()]);




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

        $recipe->imgurl             = env('APP_URL').$destinationFolder.'/'.$name;
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
