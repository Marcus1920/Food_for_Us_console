<?php

namespace App\Http\Controllers;

use App\Transaction;
use function Couchbase\defaultDecoder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class TransactionController extends Controller
{
    public function create()
    {


    $transaction                = new Transaction();
    $transaction->seller_id     = Input::get('seller_id');
    $transaction->buyer_id      = Input::get('buyer_id');
    $transaction->status        = 0;
    $transaction->product_type  = Input::get('product_type');
    $transaction->save();

    return $transaction;
    }

    public function update($id)
    {

        return "okay";

//        $transaction =Transaction::where('id',$id)->first()
//        ->update(['status'=>1]);


//        return $transaction;


//        $user = NewUser::where('id',$id)
//            ->update(['active'=>2]);
//
//        $userDetails = NewUser::find($id);
    }


}
