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
}
