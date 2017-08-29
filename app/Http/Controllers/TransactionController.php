<?php

namespace App\Http\Controllers;

use App\Transaction;
<<<<<<< HEAD
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Response;

class TransactionController extends Controller
{

    public function index()
    {
        //
    }
    public function create()
    {

    }
    public function store()
    {
        $transactionObj                 = new Transaction();
        $transactionObj->buyer_id       = Input::get('buyer_id');
        $transactionObj->seller_id      = Input::get('seller_id');
        $transactionObj->status         = 1;
        $transactionObj->product        = Input::get('product');
        $transactionObj->save();
        return \Response::json($transactionObj);
    }
    public function show($id)
    {
        $transaction        =Transaction::where('',$id)
                            ->with('buyers','sellers')->first();
        return \Response::json($transaction);
    }

    public function sellerTransaction($id)
    {
        $sellerTransaction  =Transaction::where('seller_id',$id)
                            ->with('sellers')->get();

        return \Response::json($sellerTransaction);
    }

    public function buyerTransaction($id)
    {
        $buyerTransaction  =Transaction::where('buyer_id',$id)
            ->with('buyers')->get();

         return \Response::json($buyerTransaction);
    }
}

=======
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
>>>>>>> 217fa44c87efea2d0c96db767cb65c25c6ca078c
