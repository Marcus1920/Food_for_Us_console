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

