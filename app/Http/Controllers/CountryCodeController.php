<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CountryCode;
class CountryCodeController extends Controller
{
    public function index()
    {

        $country = CountryCode::orderBy('name')->get();
        return response()->json($country);

    }


}
