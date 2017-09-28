<?php

namespace App\Http\Controllers;

use App\Events\newPostEvent;
use App\Jobs\SendEmailsToBuyers;
use  App\NewUser ;
use App\Sellers_details_tabs;
use App\ProductType;
use App\Packaging;
use App\ProductPickupDetails;
use App\UserDefaultLocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Mail;
use Carbon\Carbon;

class SellersController extends Controller
{
    public function getDistance()
    {
        
        $radius   = Input::get('radius');
        $cord1  = NewUser::where('api_key',Input::get('api_key'))->first();
        $cord1->gps_lat;
        $cord1->gps_long;

        $nearSellers = array();
        foreach ( $seller = Sellers_details_tabs::all() as $cord2) {
            $cord2->gps_lat;
            $cord2->gps_long;
            $cord2->id;

            $earth_radius = 6371;
            $dLat = deg2rad($cord2->gps_lat - $cord1->gps_lat);
			

            $dLon = deg2rad($cord2->gps_long - $cord1->gps_long);

            $a = sin($dLat / 2) * sin($dLat / 2) + cos(deg2rad($cord1->gps_lat)) * cos(deg2rad($cord2->gps_lat)) * sin($dLon / 2) * sin($dLon / 2);
            $c = 2 * asin(sqrt($a));
            $d = $earth_radius * $c;

            if ($radius > $d) {
                $sellers = Sellers_details_tabs::where('id', $cord2->id)->get();
                for ($i = 0; $i < count($sellers); $i++) {
                    array_push($nearSellers, $sellers[$i]);
                }

            }
        }

        return response()->json($nearSellers);


    }
    public function index()
    {
        $respond=array();

        $api_key   = Input::get('api_key');
		
		
        $user  = NewUser::where('api_key',$api_key)->first();

        if($user!=NULL)
        {
            $sellers_tabs=Sellers_details_tabs::where('new_user_id',$user->id)
                ->join('product_types', 'sellers_details_tabs.productType', '=', 'product_types.id')
                ->join('packagings', 'sellers_details_tabs.packaging', '=', 'packagings.id')
                ->join('product_pickup_details','sellers_details_tabs.id','=','product_pickup_details.SellersPostId')
                ->select(
                    \DB::raw(
                        "
                        sellers_details_tabs.id,
                        sellers_details_tabs.new_user_id,
                        sellers_details_tabs.productPicture,
                        sellers_details_tabs.location,
                        sellers_details_tabs.gps_lat,
                        sellers_details_tabs.gps_long,
                        product_types.name as productType,
				
                        sellers_details_tabs.quantity,
                        sellers_details_tabs.costPerKg,
                        sellers_details_tabs.description,
                        sellers_details_tabs.country,
                        sellers_details_tabs.city,
                        packagings.name as packaging,
                        sellers_details_tabs.availableHours,
                        sellers_details_tabs.paymentMethods,
                        sellers_details_tabs.transactionRating,
                        sellers_details_tabs.created_at,
                        sellers_details_tabs.updated_at,
                        product_pickup_details.sellByDate,
                        product_pickup_details.PickUpAddress as pickUpAddress,
                        product_pickup_details.MonToFridayHours as monToFridayHours,
                        product_pickup_details.SaturdayHours as saturdayHours,
                        product_pickup_details.SundayHours as sundayHours
                        
                        "
                    )
                )->where('sellers_details_tabs.post_status',1)
			->orderBy('created_at' ,'desc')	->get();

			  return response()->json($sellers_tabs);
        }
        else
        {
            $respond['msg']="No Api key found";

            $respond['error']=true;

            return response()->json($respond);
        }
    }
    public function allSellersPosts()

    {
        $sellers_posts=\DB::table('sellers_details_tabs')
            ->join('product_types', 'sellers_details_tabs.productType', '=', 'product_types.id')
            ->join('packagings', 'sellers_details_tabs.packaging', '=', 'packagings.id')
            ->join('product_pickup_details','sellers_details_tabs.id','=','product_pickup_details.SellersPostId')
            ->where('sellers_details_tabs.quantity','>',0)
            ->where('sellers_details_tabs.post_status','=',1)
            ->select(
                \DB::raw(
                    "
                        sellers_details_tabs.id,
                        sellers_details_tabs.new_user_id,
                        sellers_details_tabs.productPicture,
                        sellers_details_tabs.location,
                        sellers_details_tabs.gps_lat,
                        sellers_details_tabs.gps_long,
                        product_types.name as productType,
                        product_types.id as productTypeId,
                        sellers_details_tabs.quantity,
                        sellers_details_tabs.costPerKg,
                        sellers_details_tabs.description,
                        sellers_details_tabs.country,
                        sellers_details_tabs.city,
                        packagings.name as packaging,
                        sellers_details_tabs.availableHours,
                        sellers_details_tabs.paymentMethods,
                        sellers_details_tabs.transactionRating,
                        sellers_details_tabs.created_at,
                        sellers_details_tabs.updated_at,
                        product_pickup_details.sellByDate,
                        product_pickup_details.PickUpAddress as pickUpAddress,
                        product_pickup_details.MonToFridayHours as monToFridayHours,
                        product_pickup_details.SaturdayHours as saturdayHours,
                        product_pickup_details.SundayHours as sundayHours
                        
                        "
                )
            )
            ->where('sellers_details_tabs.quantity','>',0)
            ->orderBy('created_at' ,'desc')	->get();
        return $sellers_posts;
    }
    public function created(Request $request)
      {
          $input                          = $request->all();
          $user                           = NewUser::where('api_key',$input['api_key'])->first();

//
//          $sellersPost= new Sellers_details_tabs();
//          $name =$user->name;
//          $surname=$user->name;
//          $id=$user->id;
//          $sellersPost->new_user_id     = $user->id;
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

      //  $sellersPost->productPicture     = env('APP_URL').$destinationFolder.'/'.$name;


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
		 $sellersPost->post_status = 1;

        $sellersPost->save();

        $productPickupDetails                      = new ProductPickupDetails();
        $productPickupDetails->SellersPostId       = $sellersPost->id;
        $productPickupDetails->sellByDate          = Input::get('sellByDate');
        $productPickupDetails->PickUpAddress       = Input::get('PickUpAddress');
        $productPickupDetails->MonToFridayHours    = Input::get('MonToFridayHours');
        $productPickupDetails->SaturdayHours       = Input::get('SaturdayHours');
        $productPickupDetails->SundayHours         = Input::get('SundayHours');
        $productPickupDetails->gps_lat             = "0";
        $productPickupDetails->gps_long            = "0";
        $productPickupDetails->save();

//       event(new newPostEvent($sellersPost));
        return $sellersPost;
      }
    public function changeDefaultLocation()
    {
        $newUserDetails         = NewUser::select('id')
                                    ->where('api_key',Input::get('apiKey'))
                                    ->first();

        $sellerDetails          = Sellers_details_tabs::select('id')
                                                ->where('id',$newUserDetails->id)
                                                ->first();

        $changeDefaultLocation  = UserDefaultLocation::where('userId',$newUserDetails->id)

                ->update([
                    'gps_lat'  =>Input::get('gps_lat'),
                    'gps_long' =>Input::get('gps_long'),
                         ]);
        return " default  location updated";
    }
    public function create(Request $request)
    {
        $input  =  $request->all();

        $user  = NewUser::where('api_key',$input['api_key'])->first();

        $sellersPost= new Sellers_details_tabs();
        $sellersPost->new_user_id     = $user->id;

        $img=$request->file('file');

        $destinationFolder = 'images/'.$user['name'].'_'.$user['surname'].'_'.$user['id'];

        if(!\File::exists($destinationFolder)) {
            \File::makeDirectory($destinationFolder,0777,true);
        }

        $name =    $img->getClientOriginalName();

        $img->move($destinationFolder,$name) ;

        $sellersPost->productPicture =env('APP_URL').$destinationFolder.'/'.$name;

        $sellersPost->fill($input);
        $sellersPost->save();

        return $sellersPost;
    }
    public function destroy()
    {
        $id             = Input::get('id');
        $user           = NewUser::where('api_key',Input::get('api_key'))->first();
        $deletePost     = Sellers_details_tabs::where('id', $id)
                             ->where('new_user_id', $user->id)
                              ->update(['post_status'=> 2]);
        $sellesPosts      = Sellers_details_tabs::where('new_user_id',$user->id)->where('post_status',1)->get();
        return response()->json($sellesPosts);

    }
    public function updating()
    {
        $apiKey         = Input::get('api_key');//change  apiKey to   api_key  
        $user           = NewUser::where('api_key',$apiKey)->first();
        $id             = Input::get('id');
        $deletePost     =  Sellers_details_tabs::where('id', $id)->where('new_user_id', $user)
            ->update(['productPicture'          => Input::get('name'),
                        'location'              => Input::get('description'),
                        'gps_lat'               => Input::get('ingredients'),
                        'gps_long'              => Input::get('gps_long'),
                        'productType'           => Input::get('productType'),
                        'quantity'              => Input::get('quantity'),
                        'costPerKg'             => Input::get('costPerKg'),
                        'description'           => Input::get('description'),
                        'country'               => Input::get('country'),
                        'city'                  => Input::get('city'),
                        'packaging'             => Input::get('packaging'),
                        'availableHours'        => Input::get('availableHours'),
                        'paymentMethods'        => Input::get('paymentMethods'),
                        'transactionRating'     => Input::get('transactionRating'),
                        'updated_at'            =>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()]);
        $posts          =   Sellers_details_tabs::where('new_user_id',$user);
    }
}
