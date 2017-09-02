<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Packaging   ; 
class packagingListController extends Controller
{
   
  public  function   index  ()
  {
	  
	  
	  $Packaging  = Packaging::select('name' , 'id')->get();
	  
	  
	  return  $Packaging;
	  
  }
}
