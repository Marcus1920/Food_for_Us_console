<?php

namespace App\Services;

use App\Cart;
use App\Sellers_details_tabs;
use Carbon\Carbon;

class OverDueCartItemService
{

    public function overDueItems()
    {
        $current    = Carbon::now();
        $day        = 86400; // one day in seconds

        $cartItems  = Cart::where('active','=',0)->get();

        $newArray   = array();
        for($i=0;$i<count($cartItems) ;$i++)
        {
            $created_at = $cartItems[$i]->created_at;
            $diff       =  abs(strtotime($created_at) - strtotime($current));

            if($diff > $day)
            {
                $overDue  = Cart::select('quantity','productId')
                                        ->where('id', $cartItems[$i]->id)
                                        ->get();
                array_push($newArray ,$overDue);
            }
        }

        for($i=0;$i<count($newArray) ;$i++)
        {
            $ItemForSale   =  Sellers_details_tabs::select('quantity')
                                        ->where('id',$newArray[$i][0]->productId)->get();
            foreach($ItemForSale as $item)
            {
                $newStock             = $item->quantity + $newArray[$i][0]->quantity;
                $availableStock       = Sellers_details_tabs::where('id',$newArray[$i][0]->productId)
                                         ->update(['quantity'=>$newStock]);
            }

            $removeOverDueCartItems  = Cart::where('id', $cartItems[$i]->id)
                                         ->delete();
        }

    }

}