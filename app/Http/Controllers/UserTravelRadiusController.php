<?php

namespace App\Http\Controllers;
use App\UserTravelRadius;
use Illuminate\Http\Request;

class UserTravelRadiusController extends Controller
{
    public function getTravelRadius()
    {

        $radius     = UserTravelRadius::select('id','kilometres')->get();
        return response()->json($radius);
    }
}
