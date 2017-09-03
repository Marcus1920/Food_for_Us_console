<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transport;
class TransportController extends Controller
{

   public function getTransportType()
   {

       $transportType = Transport::select('id','name')->get();
       return response()->json($transportType);
   }

}
