<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductInterest;
use Illuminate\Support\Facades\Input;
use App\NewUser;

class ProductInterestController extends Controller
{
    public function index()
    {
        $api_key = Input::get('api_key');

        $user   =  NewUser::where('api_key',$api_key)->first();

        $productInterests=\DB::table('product_interests')
            ->join('product_types', 'product_interests.ProductInterestID', '=', 'product_types.id')
            ->where('product_interests.new_user_id','=',$user->id)
            ->select(
                \DB::raw(
                    "
                                product_interests.id, 
                                product_interests.new_user_id,            
                                product_types.name as productName,
                                product_interests.active
                                "
                )
            )
            ->orderBy('productName','ASC')
            ->get();

        return response()->json($productInterests);
    }
    public function deactivate()
    {
        $response = array();

        $id = Input::get('id');

        ProductInterest::where('id',$id)
            ->update(['active'=>0]);

        $response['message'] = "Successfully deactivated";

        return response()->json($response);
    }

    public function activate()
    {
        $response = array();

        $id = Input::get('id');

        ProductInterest::where('id',$id)
            ->update(['active'=>1]);

        $response['message'] = "Successfully activated";

        return response()->json($response);
    }
}
