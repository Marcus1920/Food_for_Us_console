<?php

namespace App\Http\Controllers;
use App\ProductType;

use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        $products = ProductType::orderBy('name')->get();
        return view ('Products.index', compact('products'));
    }

    public function getProductType()
    {

        $productType    =ProductType::select('id','name')->get();
        return response()->json($productType);
    }


}
