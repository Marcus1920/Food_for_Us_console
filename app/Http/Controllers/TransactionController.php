<?php


namespace App\Http\Controllers;

use App\Cart;
use App\NewUser;
use App\ProductType;
use App\Sellers_details_tabs;
use App\Transaction;
use App\TransactionActivity;
use App\TransactionRating;
use App\TransactionStatus;
use App\UserRoles;
use Illuminate\Http\Request;
use App\Services\OverDueCartItemService;
use Illuminate\Support\Facades\Input;
use Yajra\DataTables\DataTables;

class TransactionController extends Controller
{
    protected $overDueItems;
    public function __construct(OverDueCartItemService $OverDueCartItemService)
    {
        $this->overDueItems = $OverDueCartItemService;
    }
    public function store()
    {
        $transactionStatusId = TransactionStatus::find(1);
        $api_key = Input::get('api_key');
        $product_id = Input::get('productType');
        $sellerId = Input::get('new_user_id');
        $cartId = Input::get('cartId');
        $buyer = NewUser::where('api_key', $api_key)->first();
        $sellerEmail = NewUser::where('id', $sellerId)->first();

        $sellerDetails = Sellers_details_tabs::where('productType', $product_id)
            ->where('id', Input::get('productId'))
            ->first();

        $productDetails = Cart::where('productId', $sellerDetails->id)
            ->where('id', $cartId)
            ->where('userId', $buyer->id)->first();

        $transactionObj                = new Transaction();
        $transactionObj->buyer_id      = $buyer->id;
        $transactionObj->seller_id     = $sellerDetails->new_user_id;
        $transactionObj->status        = $transactionStatusId->id;
        $transactionObj->product       = $productDetails->productId;
        $transactionObj->quantity      = $productDetails->quantity;
        $transactionObj->save();
        
        $userTransactionActivity                     = new TransactionActivity();
        $userTransactionActivity->userId             = $buyer->id;
        $userTransactionActivity->transactionId      = $transactionObj->id;
        $userTransactionActivity->status             = $transactionStatusId->id;
        $userTransactionActivity->save();


        $removeFromCart = Cart::where('productId', $productDetails->productId)
            ->where('userId', $buyer->id)
            ->update(['active' => 1]);

        $productName = \DB::table('carts')
            ->join('sellers_details_tabs', 'carts.productId', '=', 'sellers_details_tabs.id')
            ->leftjoin('product_types', 'sellers_details_tabs.productType', '=', 'product_types.id')
            ->select(
                \DB::raw
                (
                                                    "
                                                   product_types.name as productName
                                                    "
                )
            )
            ->where('carts.productId', $productDetails->productId)
            ->where('carts.id', $cartId)
            ->first();

        $messageBody = "  I am interested in buying  " . ' ' . " $transactionObj->quantity kg " . ' ' . " of  " . ' ' . "$productName->productName " . ' ' . ",you can contact me  using the following contact details.
        Email: " . ' ' . "  $buyer->email & 
         " . '' . " Cellphone : " . '' . "$buyer->cellphone";

        $data = array(
            'name' => $buyer->name . ' ' . $buyer->surname,
            'content' => $messageBody,
        );

        \Mail::send('emails.transaction', $data, function ($message) use ($sellerEmail) {
            $message->from('Info@FoodForUs.cloud', 'Food For us');
            $message->to($sellerEmail->email)->subject("Transaction Notification ");
        });

        return \Response::json($transactionObj);
    }
    public function transactionDetails()
    {
        $userDetails = NewUser::where('api_key', Input::get('api_key'))->first();

        if ($userDetails->intrest == 1   ) {

            $sellerTransactionsDetails = \DB::table('transactions')
                ->join('new_users', 'transactions.buyer_id', '=', 'new_users.id')
                ->join('transaction_statuses', 'transactions.status', '=', 'transaction_statuses.id')
                ->join('sellers_details_tabs', 'transactions.product', '=', 'sellers_details_tabs.id')
                ->leftjoin('product_types', 'sellers_details_tabs.productType', '=', 'product_types.id')
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
                      transactions.id as transactionId,                      
                      transactions.product, 
                      transactions.quantity,
                      transactions.status,
                      transaction_statuses.name as transactionName,
                      sellers_details_tabs.productPicture,
                      product_types.name as productName,
                      transactions.created_at 
                         "
                    )
                )
                ->where('transactions.seller_id', $userDetails->id, '=')
                ->orderBy('transactions.created_at', 'DESC')
                ->get();

            return \Response::json($sellerTransactionsDetails);

        } elseif ($userDetails->intrest == 2) {

            $buyerTransactionsDetails = \DB::table('transactions')
                ->join('new_users', 'transactions.seller_id', '=', 'new_users.id')
                ->join('transaction_statuses', 'transactions.status', '=', 'transaction_statuses.id')
                ->join('sellers_details_tabs', 'transactions.product', '=', 'sellers_details_tabs.id')
                ->leftjoin('product_types', 'sellers_details_tabs.productType', '=', 'product_types.id')
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
                      transactions.id as transactionId,                        
                      transactions.product, 
                      transactions.quantity,
                      transactions.status,
                      transaction_statuses.name as transactionName,
                      sellers_details_tabs.productPicture,
                      product_types.name as productName,
                      transactions.created_at
                                                            
                   "
                    )
                )
                ->where('transactions.buyer_id', $userDetails->id, '=')
                ->orderBy('transactions.created_at', 'DESC')
                ->get();

            return \Response::json($buyerTransactionsDetails);
        } else {
            return "no transaction";
        }
    }
    public function addToCart()
    {
        $buyer = NewUser::where('api_key', Input::get('api_key'))->first();
        $productName = Sellers_details_tabs::select('id')
            ->where('id', Input::get('id'))
            ->where('productType', Input::get('foodItem'))
            ->first();

        $initialQuantity = Sellers_details_tabs::select('quantity')
            ->where('id', Input::get('id'))
            ->first();

        if ($initialQuantity->quantity >= Input::get('quantity')) {
            $availableQuantity = $initialQuantity->quantity - Input::get('quantity');
            $newQuantity = Sellers_details_tabs::where('id', Input::get('id'))
                ->update(['quantity' => $availableQuantity]);

            $cartItemsObj = new Cart();
            $cartItemsObj->userId = $buyer->id;
            $cartItemsObj->productId = $productName->id;
            $cartItemsObj->quantity = Input::get('quantity');
            $cartItemsObj->save();

            return $newQuantity;
        } else {
            return "cant buy more than the available item quantity";
        }
    }
    public function getCartItem()
    {
        $api_key = Input::get('api_key');
        $buyerId = NewUser::where('api_key', $api_key)->first();
        $cartItems = \DB::table('carts')
            ->join('sellers_details_tabs', 'carts.productId', '=', 'sellers_details_tabs.id')
            ->join('new_users', 'sellers_details_tabs.new_user_id', '=', 'new_users.id')
            ->join('product_types', 'sellers_details_tabs.productType', '=', 'product_types.id')
            ->select(
                \DB::raw(
                    "     
                                        carts.id,                    
                                        carts.userId,                        
                                        carts.productId,  
                                        carts.quantity,                                                                                                   
                                        new_users.name, 
                                        product_types.name as productName,
                                        sellers_details_tabs.productPicture,
                                        sellers_details_tabs.new_user_id,
                                        sellers_details_tabs.id as sellerDetailsId,
                                        sellers_details_tabs.productType,      
                                        carts.created_at
                                        
                                     "
                )
            )
            ->where('carts.active', '=', 0)
            ->where('userId', $buyerId->id)
            ->orderBy('carts.created_at', 'DESC')
            ->get();
        return $cartItems;

    }
    public function removeFromCart()
        {
            $sellerDetails = Sellers_details_tabs::where('productType', Input::get('productType'))
                ->where('id', Input::get('sellerDetailsId'))
                ->first();

            $buyerId = NewUser::where('api_key', Input::get('api_key'))
                ->first();

            $CartItems = Cart::with('products', 'buyers')
                ->where('id', Input::get('cartId'))
                ->where('userId', $buyerId->id)
                ->where('productId', $sellerDetails->id)
                ->where('active', 0)
                ->first();

            $addBackProduct = $sellerDetails->quantity + $CartItems->quantity;
            $restoreProduct = $sellerDetails->update(['quantity' => $addBackProduct]);

            $CartItems->delete();

            $remainingCartItems = Cart::with('products', 'buyers')
                ->where('userId', $buyerId->id)
                ->where('active', 0)
                ->orderBy('carts.created_at', 'DESC')
                ->get();
            return $remainingCartItems;
        }
    public function approveTransaction()
        {
            $transactionId = Input::get('transactionId');
            $transactionStatusName = Input::get('statusName');
            $userDetails = NewUser::where('api_key', Input::get('api_key'))->first();
            $transactionStatusDetails = TransactionStatus::where('slug', $transactionStatusName)->first();
            if ($userDetails->intrest == 1)
            {
                $sellerTransactionsUpdates = Transaction::where('id',     $transactionId)
                    ->where('seller_id', $userDetails->id)
                    ->update(['status' => $transactionStatusDetails->id]);

                $transactionDetails = Transaction::where('id', $transactionId)
                    ->where('seller_id', $userDetails->id)
                    ->first();
                $transactionCounterPartDetails = NewUser::where('id', $transactionDetails->buyer_id)->first();


                $sellerTransactionsActivity                   = new TransactionActivity();
                $sellerTransactionsActivity->userId           = $userDetails->id;
                $sellerTransactionsActivity->transactionId    = $transactionId;
                $sellerTransactionsActivity->status           = $transactionStatusDetails->id;
                $sellerTransactionsActivity->save();


                $messageStatus = '';
                switch ($transactionStatusName) {
                    case 'Active':
                        $messageStatus = 'accepted';
                        break;

                    case 'Declined':
                        $messageStatus = 'rejected';

                        $getTransactionQuantity                 = Transaction::select('quantity')->where('id',$transactionId)->first();
                        $originalQuantity                       = Sellers_details_tabs::select('quantity')
                                                                ->where('id',$transactionDetails->product)
                                                                ->where('new_user_id',$userDetails->id)->first();
                        $totalQty                               = $originalQuantity->quantity + $getTransactionQuantity->quantity;
                        $putBackTransactionQty                  = Sellers_details_tabs::where('id',$transactionDetails->product)
                            ->update(['quantity'=>$totalQty]);
                        break;

                    case 'Completed':
                        $messageStatus = 'closed';

                        $getTransactionQuantity                 = Transaction::select('quantity')
                                                                        ->where('id',$transactionId)
                                                                        ->first();
                        $originalQuantitySold                   = Sellers_details_tabs::select('quantitySold')
                                             ->where('id',$transactionDetails->product)
                                                                    ->where('new_user_id',$userDetails->id)
                                                                    ->first();
                        $QtySold                                = $originalQuantitySold->quantitySold + $getTransactionQuantity->quantity;
                        
                        $UpdateTheSellerDetailsTab              = Sellers_details_tabs::where('id',$transactionDetails->product)
                                                                    ->update(['quantitySold'=>$QtySold]);

                        break;

                    case 'Cancelled':
                        $messageStatus = 'cancelled';
                        break;
                }
                $messageBody = 'This is meant to inform you that ' . "  " . "$userDetails->name" . " " . "$userDetails->surname" . " " . 'has ' . " $messageStatus" . ' the Transaction.';
                $data = array(

                    'name' => $transactionCounterPartDetails->name . ' ' . $transactionCounterPartDetails->surname,
                    'content' => $messageBody,
                );
                \Mail::send('emails.transactionUpdate', $data, function ($message) use ($transactionCounterPartDetails)
                {
                    $message->from('Info@FoodForUs.cloud', 'Food For us');
                    $message->to($transactionCounterPartDetails->email)->subject("Transaction Update Notification ");
                });

                return \Response::json($sellerTransactionsUpdates);
            } elseif ($userDetails->intrest == 2) {

                $buyerTransactionsUpdates = Transaction::where('id', '=', $transactionId)
                    ->where('buyer_id', '=', $userDetails->id)
                    ->update(['status' => $transactionStatusDetails->id]);

                $transactionDetails = Transaction::where('id', '=', $transactionId)
                    ->where('buyer_id', '=', $userDetails->id)
                    ->first();

                $transactionCounterPartDetails = NewUser::where('id', $transactionDetails->seller_id)->first();

                $buyerTransactionsActivity = new TransactionActivity();
                $buyerTransactionsActivity->userId = $userDetails->id;
                $buyerTransactionsActivity->transactionId = $transactionId;
                $buyerTransactionsActivity->status = $transactionStatusDetails->id;
                $buyerTransactionsActivity->save();


                $messageStatus = '';
                switch ($transactionStatusName) {
                    case 'Active':
                        $messageStatus = 'accepted';
                        break;

                    case 'Declined':
                        $messageStatus = 'rejected';
                        break;

                    case 'Completed':
                        $messageStatus = 'closed';
                        break;

                    case 'Cancelled':
                        $messageStatus = 'cancelled';

                        $getTransactionQuantity                 = Transaction::select('quantity')->where('id',$transactionId)->first();

                        $originalQuantity                       = Sellers_details_tabs::select('quantity')
                                                                        ->where('id',$transactionDetails->product)->first();
                        $totalQty                               = $originalQuantity->quantity + $getTransactionQuantity->quantity;
                        $putBackTransactionQty                  = Sellers_details_tabs::where('id',$transactionDetails->product)
                                                                    ->update(['quantity'=>$totalQty]);
                        break;
                }


                $messageBody = 'This is meant to inform you that ' . "  " . "$userDetails->name" . " " . "$userDetails->surname" . " " . 'has ' . " $messageStatus" . ' the Transaction.';
                $data = array(

                    'name' => $transactionCounterPartDetails->name . ' ' . $transactionCounterPartDetails->surname,
                    'content' => $messageBody,
                );

                \Mail::send('emails.transactionUpdate', $data, function ($message) use ($transactionCounterPartDetails) {
                    $message->from('Info@FoodForUs.cloud', 'Food For us');
                    $message->to($transactionCounterPartDetails->email)->subject("Transaction Update Notification ");
                });

                return \Response::json($buyerTransactionsUpdates);
            } else {
                return "No updates made";
            }
        }
    public function transactionRating()
    {
        $userDetails = NewUser::where('api_key', Input::get('apiKey'))->first();
        $transactionId = Transaction::where('id', Input::get('transactionId'))->first();

        $transactionRatingObj = new TransactionRating();
        $transactionRatingObj->userId = $userDetails->id;
        $transactionRatingObj->transactionId = $transactionId->id;
        $transactionRatingObj->rating = Input::get('rating');
        $transactionRatingObj->comment = Input::get('comment');
        $transactionRatingObj->save();

        return \Response::json($transactionRatingObj);
    }
    public function transactionStatuses()
    {
        $statuses = TransactionStatus::all();
        return response::json($statuses);
    }
    public function deleteTransaction()
        {
                $deletedStatus                            = TransactionStatus::find(6);

                $userTransactionActivity                  = new TransactionActivity();
                $userTransactionActivity->userId          = $this->userDetails()->id;
                $userTransactionActivity->transactionId   = Input::get('transactionId');
                $userTransactionActivity->status          = $deletedStatus->id;
                $userTransactionActivity->save();
                return "transaction deleted";
        }
    public function userDetails()
        {
            $userDetailsID   = NewUser::where('api_key',  Input::get('api_key'))->first();
            return $userDetailsID;
        }
    public function testTransactionDetails()
        {
            $deletedStatus = TransactionStatus::find(6);

            if ($this->userDetails()->intrest == 1) {

                $sellerTransactionsDetails = \DB::table('transactions')
                    ->join('new_users', 'transactions.buyer_id', '=', 'new_users.id')
                    ->join('transaction_statuses', 'transactions.status', '=', 'transaction_statuses.id')
                    ->join('sellers_details_tabs', 'transactions.product', '=', 'sellers_details_tabs.id')
                    ->join('transaction_activities', 'transactions.id', '=', 'transaction_activities.transactionId')
                    ->leftjoin('product_types', 'sellers_details_tabs.productType', '=', 'product_types.id')
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
                      transactions.id as transactionId,                      
                      transactions.product, 
                      transactions.quantity,
                      transactions.status,
                      transaction_statuses.name as transactionName,
                      sellers_details_tabs.productPicture,
                      product_types.name as productName,
                      transactions.created_at 
                                                            
                   "
                        )
                    )
                    ->where('transactions.seller_id', $this->userDetails()->id, '=')
                    ->where('transaction_activities.userId',$this->userDetails()->id, '=')
                    ->where('transaction_activities.status','!=' ,$deletedStatus->id)
                    ->orderBy('transactions.created_at', 'DESC')
                    ->get();

                return \Response::json($sellerTransactionsDetails);

            } elseif ($this->userDetails()->intrest == 2) {

                $buyerTransactionsDetails = \DB::table('transactions')
                    ->join('new_users', 'transactions.seller_id', '=', 'new_users.id')
                    ->join('transaction_statuses', 'transactions.status', '=', 'transaction_statuses.id')
                    ->join('sellers_details_tabs', 'transactions.product', '=', 'sellers_details_tabs.id')
                    ->join('transaction_activities', 'transactions.id', '=', 'transaction_activities.transactionId')
                    ->leftjoin('product_types', 'sellers_details_tabs.productType', '=', 'product_types.id')
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
                      transactions.id as transactionId,                        
                      transactions.product, 
                      transactions.quantity,
                      transactions.status,
                      transaction_statuses.name as transactionName,
                      sellers_details_tabs.productPicture,
                      product_types.name as productName,
                      transactions.created_at
                                       "
                        )
                    )
                    ->where('transactions.buyer_id', $this->userDetails()->id, '=')
                    ->where('transaction_activities.userId',$this->userDetails()->id, '=')
                    ->where('transaction_activities.status', '!=',$deletedStatus->id)
                    ->orderBy('transactions.created_at', 'DESC')
                    ->get();
                return \Response::json($buyerTransactionsDetails);
            }
            else
                {
                return "no transaction";
            }

        }
        //BACKEND FUNCTIONS
    public function userTransactionsActivity()
    {
        $deletedStatus = TransactionStatus::find(6);

        if ($this->userDetails()->intrest == 1) {

            $sellerTransactionsDetails = \DB::table('transactions')
                ->join('new_users', 'transactions.buyer_id', '=', 'new_users.id')
                ->join('transaction_statuses', 'transactions.status', '=', 'transaction_statuses.id')
                ->join('sellers_details_tabs', 'transactions.product', '=', 'sellers_details_tabs.id')
                ->join('transaction_activities', 'transactions.id', '=', 'transaction_activities.transactionId')
                ->leftjoin('product_types', 'sellers_details_tabs.productType', '=', 'product_types.id')
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
                      transactions.id as transactionId,                      
                      transactions.product, 
                      transactions.quantity,
                      transactions.status,
                      transaction_statuses.name as transactionName,
                      sellers_details_tabs.productPicture,
                      product_types.name as productName,
                      transactions.created_at 
                                                            
                   "
                    )
                )
                ->where('transactions.seller_id', $this->userDetails()->id, '=')
                ->where('transaction_activities.userId',$this->userDetails()->id, '=')
                ->where('transaction_activities.status','!=' ,$deletedStatus->id)
                ->orderBy('transactions.created_at', 'DESC')
                ->get();

            return \Response::json($sellerTransactionsDetails);

        } elseif ($this->userDetails()->intrest == 2) {

            $buyerTransactionsDetails = \DB::table('transactions')
                ->join('new_users', 'transactions.seller_id', '=', 'new_users.id')
                ->join('transaction_statuses', 'transactions.status', '=', 'transaction_statuses.id')
                ->join('sellers_details_tabs', 'transactions.product', '=', 'sellers_details_tabs.id')
                ->join('transaction_activities', 'transactions.id', '=', 'transaction_activities.transactionId')
                ->leftjoin('product_types', 'sellers_details_tabs.productType', '=', 'product_types.id')
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
                      transactions.id as transactionId,                        
                      transactions.product, 
                      transactions.quantity,
                      transactions.status,
                      transaction_statuses.name as transactionName,
                      sellers_details_tabs.productPicture,
                      product_types.name as productName,
                      transactions.created_at
                                       "
                    )
                )
                ->where('transactions.buyer_id', $this->userDetails()->id, '=')
                ->where('transaction_activities.userId',$this->userDetails()->id, '=')
                ->where('transaction_activities.status', '!=',$deletedStatus->id)
                ->orderBy('transactions.created_at', 'DESC')
                ->get();
            return \Response::json($buyerTransactionsDetails);
        }
        else
        {
            return "no transaction";
        }

    }
    public function UsersTransacionList()
    {
        return view('transaction.index');
    }
    public function transactionHistory()
    {
        $transactionHistory = \DB::table('transactions')
                              ->join('new_users','transactions.buyer_id','=','new_users.id')
                              ->join('sellers_details_tabs','transactions.product','=','sellers_details_tabs.id')
                              ->leftjoin('product_types','sellers_details_tabs.productType','=','product_types.id')
                              ->leftjoin('transaction_ratings','transactions.id','=','transaction_ratings.transactionId')
                              ->select(
                                  \DB::raw
                                  (
                                      "
                                      transactions.id,
                                      new_users.name,
                                      new_users.surname,
                                      new_users.idNumber,
                                      new_users.gps_lat,
                                      new_users.gps_long,
                                      transactions.product as postRefference,
                                      transactions.id as transactionId,
                                      product_types.name as productName,
                                      sellers_details_tabs.quantityPosted,
                                      transactions.quantity,
                                      sellers_details_tabs.quantity as quantityAvailable,
                                      transaction_ratings.comment,
                                      transaction_ratings.rating,
                                      transactions.created_at
                                      "
                                  )
                              )->get();
//        $transactionHistory      =\DB::table('transaction_activities')
//                                        ->join('transactions','transaction_activities.transactionId','=','transactions.id')
//                                        ->join('new_users','transaction_activities.userId','=','new_users.id')
//                                        ->join('sellers_details_tabs','transactions.product','=','sellers_details_tabs.id')
//                                        ->leftjoin('product_types','sellers_details_tabs.productType','=','product_types.id')
//                                        ->leftjoin('transaction_ratings','transactions.id','=','transaction_ratings.transactionId')
//                                        ->select(
//                                            \DB::raw
//                                            (
//                                                "
//                                                  transaction_activities.id,
//                                                  transactions.id as transactionId,
//                                                  transactions.quantity,
//                                                  transactions.product as postRefference,
//                                                  product_types.name as productName,
//                                                  transaction_ratings.comment,
//                                                  transaction_ratings.rating,
//                                                  new_users.name,
//                                                  new_users.surname,
//                                                  new_users.idNumber,
//                                                  new_users.gps_lat,
//                                                  new_users.gps_long,
//                                                  transaction_ratings.created_at
//
//                                                 "
//                                            )
//                                        )
//                                        ->get();

                                return Datatables::of($transactionHistory)
                                    ->make(true);

    }
    public function viewUserTransaction($id,$idNumber)
    {
        $userTransactionDetails =\DB::table('transaction_activities')
            ->join('transactions','transaction_activities.transactionId','=','transactions.id')
            ->join('new_users','transaction_activities.userId','=','new_users.id')
            ->join('sellers_details_tabs','transactions.product','=','sellers_details_tabs.id')
            ->leftjoin('product_types','sellers_details_tabs.productType','=','product_types.id')
            ->leftjoin('transaction_ratings','transactions.id','=','transaction_ratings.transactionId')
            ->where('transaction_activities.id', $id)
            ->select(
                \DB::raw
                (
                    "
                                                  transaction_activities.id,
                                                  transactions.id as transactionId,
                                                  transactions.quantity,
                                                  product_types.name as productName,
                                                  transaction_ratings.comment,
                                                  transaction_ratings.rating,
                                                  new_users.name,
                                                  new_users.surname,
                                                  new_users.idNumber,
                                                  new_users.gps_lat,
                                                  new_users.gps_long,
                                                  new_users.profilePicture,
                                                  transaction_ratings.created_at
                                             
                                                 "
                )
            )
            ->first();




        $userDetails                = NewUser::where('idNumber',$idNumber)
                                       ->first();
        if($userDetails->intrest == 1)
        {
            $transactionActivitiesData  = TransactionActivity::with('transactions','transactionStatuses','appUsers')
                                                                ->where('userId', $userDetails->id)
                                                                ->get();
            $sellerTransactionSide      = Transaction::with('buyers')
                                            ->where('seller_id',$userDetails->id)
                                            ->get();

            return view('transaction.sellerTransactionProfile', ['transactionActivitiesData'=>$transactionActivitiesData ,
                                                                        'sellerTransactionSide' => $sellerTransactionSide,
                                                                        'userTransactionDetails'=>$userTransactionDetails
                                                                        ]);

        }
        elseif($userDetails->intrest == 2)
        {
            $transactionActivitiesData  = TransactionActivity::with('transactions','transactionStatuses','appUsers')
                                           ->select('transactionId','status','created_at')
                                            ->where('userId', $userDetails->id)->get();
            $buyerTransactionSide      = Transaction::with('sellers')
                                                        ->where('buyer_id',$userDetails->id)
                                                        ->get();

            return view('transaction.buyerTransactionProfile', ['transactionActivitiesData'=>$transactionActivitiesData ,
                                                                            'buyerTransactionSide' => $buyerTransactionSide,
                                                                            'userTransactionDetails'  =>$userTransactionDetails
                                                                        ]);


        }else{
            return"not known";
        }

    }
}

