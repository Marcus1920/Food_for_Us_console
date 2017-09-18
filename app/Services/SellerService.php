<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 9/18/2017
 * Time: 11:00 AM
 */

namespace App\Services;

use App\Jobs\SendEmailsToBuyers;
use  App\NewUser ;
use App\Sellers_details_tabs;
use App\ProductType;
use App\Packaging;
use App\ProductPickupDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Mail;
use Carbon\Carbon;



class SellerService
{

    public function newPost($request)
    {
        $input                          = $request->all();
        $user                           = NewUser::where('api_key',$input['api_key'])->first();


        $sellersPost= new Sellers_details_tabs();
        $name =$user->name;
        $surname=$user->name;
        $id=$user->id;
        $sellersPost->new_user_id     = $user->id;



        $sellersPost                    = new Sellers_details_tabs();
        $name                           =$user->name;
        $surname                        =$user->name;
        $id                             =$user->id;
        $sellersPost->new_user_id       = $user->id;


        $img                            =$request->file('file');
        $destinationFolder              = "images/".$name."_".$surname."_".$id."/";

        if(!\File::exists($destinationFolder)) {
            \File::makeDirectory($destinationFolder,0777,true);
            move_uploaded_file($img,$destinationFolder);
        }

        $name                            =    $img->getClientOriginalName();

        $img->move($destinationFolder,$name) ;


        $sellersPost->productPicture  = env('APP_URL').$destinationFolder.'/'.$name;

        $sellersPost->productPicture     = env('APP_URL').$destinationFolder.'/'.$name;


        $productTypeID                   = ProductType::where('name',Input::get('productName'))->first();
        $sellersPost->productType        = $productTypeID['id'];

        $packagingID                     = Packaging::where('name',Input::get('packaging'))->first();
        $sellersPost->packaging          = $packagingID['id'];

        $sellersPost->costPerKg          = Input::get('costPerKg');
        $sellersPost->transactionRating  = Input::get('rating');
        /*
                $sellersPost->city               = Input::get('city');
                $sellersPost->country            = Input::get('country');
                $sellersPost->location           = Input::get('country').', '.Input::get('city');
                $sellersPost->description        = Input::get('description');
                $sellersPost->quantity           = Input::get('quantity');
                $sellersPost->gps_lat            = Input::get('gps_lat');
                $sellersPost->gps_long           = Input::get('gps_long');
                $sellersPost->availableHours     = Input::get('availableHours');
                $sellersPost->paymentMethods     = Input::get('paymentMethods');
                $sellersPost->transactionRating  = Input::get('transactionRating');
        */

        $sellersPost->city              = Input::get('city');
        $sellersPost->country           = Input::get('country');
        $sellersPost->location          = Input::get('country').', '.Input::get('city');
        $sellersPost->description       = Input::get('description');
        $sellersPost->quantity          = Input::get('quantity');
        // $sellersPost->gps_lat           = Input::get('gps_lat');
        // $sellersPost->gps_long          = Input::get('gps_long');
        $sellersPost->availableHours    =  Input::get('availableHours');
        $sellersPost->paymentMethods    =  Input::get('paymentMethods');
        $sellersPost->transactionRating = Input::get('transactionRating');
        $sellersPost->save();

        $productPickupDetails                      = new ProductPickupDetails();
        $productPickupDetails->SellersPostId       = $sellersPost->id;
        $productPickupDetails->sellByDate          = Input::get('sellByDate');
        $productPickupDetails->PickUpAddress       = Input::get('PickUpAddress');
        $productPickupDetails->MonToFridayHours    = Input::get('MonToFridayHours');
        $productPickupDetails->SaturdayHours       = Input::get('SaturdayHours');
        $productPickupDetails->SundayHours         = Input::get('SundayHours');
        $productPickupDetails->gps_lat            = "0";
        $productPickupDetails->gps_long            = "0";
        $productPickupDetails->save();

        return $sellersPost;
    }
}