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

        $api_key                        = Input::get('api_key');
        $product_id                     = Input::get('productType');
        $buyer                          = NewUser::where('api_key',$api_key)->first();
        $sellerDetails                  = Sellers_details_tabs::where('productType',$product_id)->first();

        $productDetails                 = Cart::where('productId',$sellerDetails->id)->where('userId',$buyer->id)->first();


        $transactionObj                 = new Transaction();
        $transactionObj->buyer_id       = $buyer->id;
        $transactionObj->seller_id      = $sellerDetails->new_user_id;
        $transactionObj->status         = 1;
        $transactionObj->product        = $productDetails->productId;
        $transactionObj->quantity       = $productDetails->quantity;
        $transactionObj->save();


        $removeFromCart                 = Cart::where('productId',$productDetails->productId)
                                               ->where('userId',$buyer->id)
                                               ->update(['active'=>1]);

        return \Response::json($transactionObj);
    }
    public function show()
    {

        $api_key            = Input::get('api_key');
        $userDetails        = NewUser::where('api_key',$api_key)->first();
        $transaction        = Transaction::where('buyer_id',$userDetails->id)->get();
        return \Response::json($transaction);
    }

    public function sellerTransaction()
    {
        $api_key            = Input::get('api_key');
        $userDetails        = NewUser::where('api_key',$api_key)->first();
        $sellerTransaction  = Transaction::with('buyers','product')
                            ->where('seller_id',$userDetails->id)
                            ->get();


        return \Response::json($sellerTransaction);
    }

    public function transactionDetails()
    {

        $api_key            = Input::get('api_key');
        $userDetails        = NewUser::where('api_key',$api_key)->first();

        if($userDetails->intrest ==1 )
            {

                $sellerTransactionsDetails =\DB::table('transactions')
                    ->join('new_users', 'transactions.buyer_id','=','new_users.id')
                    ->join('carts','transactions.product','=','carts.productId')
                    ->join('sellers_details_tabs','carts.productId','=','sellers_details_tabs.id')
                    ->join('product_types','sellers_details_tabs.productType','=','product_types.id')
                    ->where('transactions.seller_id',$userDetails->id)
                    ->select(
                        \DB::raw(
                            "                        
                      new_users.name,  
                      new_users.surname,   
                      new_users.profilePicture,   
                      new_users.email,  
                      new_users.cellphone,   
                      new_users.location,   
                      new_users.travelRadius,   
                      new_users.descriptionOfAcces,                        
                      transactions.buyer_id,                        
                      transactions.product, 
                      transactions.quantity,
                      transactions.status,
                      product_types.name as productName,
                      transactions.created_at 
                                                            
                   "
                        )
                    )
                    ->orderBy('transactions.created_at','DESC')
                    ->get();
                return \Response::json($sellerTransactionsDetails);

            }
        elseif($userDetails->intrest ==2)
            {

                $buyerTransactionsDetails =\DB::table('transactions')
                    ->join('new_users', 'transactions.seller_id','=','new_users.id')
                    ->join('carts','transactions.product','=','carts.productId')
                    ->join('sellers_details_tabs','carts.productId','=','sellers_details_tabs.id')
                    ->join('product_types','sellers_details_tabs.productType','=','product_types.id')
                    ->where('transactions.buyer_id',$userDetails->id)
                    ->select(
                        \DB::raw(
                            "                        
                      new_users.name,  
                      new_users.surname,   
                      new_users.profilePicture,   
                      new_users.email,  
                      new_users.cellphone,   
                      new_users.location,   
                      new_users.travelRadius,   
                      new_users.descriptionOfAcces,                        
                      transactions.seller_id,                        
                      transactions.product, 
                      transactions.quantity,
                      transactions.status,
                      product_types.name as productName,
                      transactions.created_at
                                                            
                   "
                        )
                    )
                    ->orderBy('transactions.created_at','DESC')
                    ->get();
                return \Response::json($buyerTransactionsDetails);
            }
        else
            {
            return "no transaction";
            }
    }

    public function addToCart()
    {

        $api_key                    = Input::get('api_key');
        $buyer                      = NewUser::where('api_key',$api_key)->first();
        $productName                = Sellers_details_tabs::select('id')->where('productType',Input::get('foodItem'))->first();

        $cartItemsObj               = new Cart();
        $cartItemsObj->userId       = $buyer->id;
        $cartItemsObj->productId    = $productName->id;
        $cartItemsObj->quantity     = Input::get('quantity');
        $cartItemsObj->save();
        return "okay items Added";
    }


    public function getCartItem()
    {
        $api_key        =Input::get('api_key');
        $buyerId       = NewUser::where('api_key',$api_key)->first();
        $cartItems     =\DB::table('carts')
                       ->join('sellers_details_tabs', 'carts.productId', '=', 'sellers_details_tabs.id')
                       ->join('new_users', 'sellers_details_tabs.new_user_id', '=', 'new_users.id')
                       ->join('product_types','sellers_details_tabs.productType','=','product_types.id')
                       ->select(
                                \DB::raw(
                                        "                        
                                        carts.userId,                        
                                        carts.productId,                        
                                        carts.quantity,
                                        sellers_details_tabs.new_user_id,                        
                                        new_users.name, 
                                        product_types.name as productName,
                                        sellers_details_tabs.productPicture
                                        
                                     "
                                        )
                                )
                        ->where('carts.active','=',0)
                        ->where('userId',$buyerId->id)
                        ->orderBy('carts.created_at','DESC')
                        ->get();
        return $cartItems;

    }

    public function removeFromCart()
    {
        $api_key          =Input::get('api_key');
        $product_id       =Input::get('productType');
        $sellerDetails    = Sellers_details_tabs::where('productType',$product_id)->first();
        $buyerId          = NewUser::where('api_key',$api_key)->first();
        $removeCartItems  = Cart::with('products','buyers')
                                  ->where('userId',$buyerId->id)
                                  ->where('productId',$sellerDetails->id)
                                  ->where('active',0)->delete();

        $remainingCartItems =Cart::with('products','buyers')->where('userId',$buyerId->id)->where('active',0)->get();
        return $remainingCartItems;


    }
}

