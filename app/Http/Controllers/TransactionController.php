<?php

namespace App\Http\Controllers;


use App\Cart;
use App\NewUser;
use App\Sellers_details_tabs;
use App\Transaction;
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
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
=======
>>>>>>> 3ce0fecc85fcf8b9c7560651bf567140b7fd3cf9
=======
>>>>>>> 2366d3e2ffbc965ebe19f9dd95995bd81e1c20ae
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
<<<<<<< HEAD
}

<<<<<<< HEAD
=======
use function Couchbase\defaultDecoder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
=======
>>>>>>> 2366d3e2ffbc965ebe19f9dd95995bd81e1c20ae

    public function addToCart()
    {

        $buyer           = NewUser::find(Input::get('id'));
        $productName     = Sellers_details_tabs::select('id')->where('productName',Input::get('foodItem'))->first();


        $cartItemsObj               =new Cart();
        $cartItemsObj->userId       =$buyer->id;
        $cartItemsObj->productId    =$productName->id;
        $cartItemsObj->quantity     =Input::get('quantity');
        $cartItemsObj->save();

        $initialQuantity           =Sellers_details_tabs::select('quantity')
                                    ->where('id',$productName->id)->first();
        $remainingQuantity         =$initialQuantity->quantity - Input::get('quantity');
        $updateFoodQuantity        =Sellers_details_tabs::where('id',$productName->id)
                                    ->update(['quantity'=>$remainingQuantity]);

        $newFoodQuantity           =Sellers_details_tabs::select('quantity')
                                        ->where('id',$productName->id)->first();
        return                      "   $newFoodQuantity->quantity  remaining Items";


    }


    public function getCartItem()
    {
        $buyerId        = Input::get('id');
        $cartItems       = Cart::with('products','buyers')->where('userId',$buyerId)->get();


        foreach ($cartItems as $cartItem)
        {
            return "Hey ". $cartItem->buyers->name . " ". "you have". " " . $cartItem->products->quantity."  ". $cartItem->products->productName;
        }
    }
}
<<<<<<< HEAD
>>>>>>> 217fa44c87efea2d0c96db767cb65c25c6ca078c
=======
>>>>>>> 6ec4eb19a0770ecf98c1aff98e40eb13e5b1d2e6
>>>>>>> 3ce0fecc85fcf8b9c7560651bf567140b7fd3cf9
=======

>>>>>>> 2366d3e2ffbc965ebe19f9dd95995bd81e1c20ae
