<?php

namespace App\Http\Controllers;
use App\ProductType;

use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        $products=ProductType::all();
        return view ('Products.index', compact('products'));
    }

    public function getProductType()
    {

        $productType    =ProductType::select('id','name')->get();
        return response()->json($productType);
    }


}
