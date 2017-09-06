<?php

namespace App\Http\Controllers;
use App\ProductType;
use Illuminate\Http\Request;

class ProductTypeController extends Controller
{
     public   function index () 
	 {
		 $ProductType = ProductType::select('name' , 'id')-> get() ;
		 
		 return   $ProductType  ;   
	 }

	 public function create()
     {
         return view ('Products.create');
     }
     public function store(Request $request)
     {
         $lastProduct = ProductType::all()->last();
         $markerNum= $lastProduct->id + 1;

         $product = new ProductType();
         $product->name = $request['productName'];
         $product->slug = $request['productName'];
         $product->type = $request['productType'];
         $product->marker_url = "img/Markers/$markerNum.png";
         $product->save();

//         return redirect()->route("productlist");
         return Redirect('/productlist');
     }
}
