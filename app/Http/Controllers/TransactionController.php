<?php

namespace App\Http\Controllers;


use App\Cart;
use App\NewUser;
use App\Sellers_details_tabs;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Response;

class TransactionController extends Controller
{

    public function index()
    {

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

    public function addToCart()
    {

        $api_key         =Input::get('api_key');
        $buyer           = NewUser::where('api_key',$api_key)->first();
        $productName     = Sellers_details_tabs::select('id')->where('productName',Input::get('foodItem'))->first();

        $cartItemsObj               =new Cart();
        $cartItemsObj->userId       =$buyer->id;
        $cartItemsObj->productId    =$productName->id;
        $cartItemsObj->quantity     =Input::get('quantity');
        $cartItemsObj->save();
        return "okay items Added";
    }


    public function getCartItem()
    {
        $api_key         =Input::get('api_key');
        $buyerId        = NewUser::where('api_key',$api_key)->first();
        $cartItems       = Cart::with('products','buyers')->where('userId',$buyerId->id)->get();

        return \Response::json($cartItems);
    }
}

