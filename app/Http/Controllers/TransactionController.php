<?php

namespace App\Http\Controllers;

use App\Transaction;
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

