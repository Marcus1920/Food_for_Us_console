<?php

namespace App\Http\Controllers;

use App\Events\newPostEvent;
use App\Jobs\SendEmailsToBuyers;
use  App\NewUser ;
use App\Notification;
use App\Sellers_details_tabs;
use App\ProductType;
use App\Packaging;
use App\ProductPickupDetails;
use App\UserDefaultLocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Mail;
use Auth;
use Carbon\Carbon;
use App\Services\NotificationService;
use Mockery\Matcher\Not;
use App\ProductInterest;
use Validator;

class SellersController extends Controller
{
    public function getDistance()
    {
        
        $radius   = Input::get('radius');

        $cord1  = NewUser::where('api_key',Input::get('api_key'))->first();
        $cord1->gps_lat;
        $cord1->gps_long;

        $nearSellers = array();
        foreach ( $seller = ProductPickupDetails::all() as $cord2) {
            $cord2->gps_lat;
            $cord2->gps_long;
            $cord2->i;
            $earth_radius = 6371;
            $dLat = deg2rad($cord2->gps_lat - $cord1->gps_lat);


            $dLon = deg2rad($cord2->gps_long - $cord1->gps_long);

            $a = sin($dLat / 2) * sin($dLat / 2) + cos(deg2rad($cord1->gps_lat)) * cos(deg2rad($cord2->gps_lat)) * sin($dLon / 2) * sin($dLon / 2);
            $c = 2 * asin(sqrt($a));
            $d = $earth_radius * $c;

            if ($radius > $d) {
                $sellers = ProductPickupDetails::where('id', $cord2->id)->get();
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

        if(Input::get('api_key')==NULL)
        {
            $user  = NewUser::where('id',Auth::user()->new_user_id)->first();
        }
        else {
            $user  = NewUser::where('api_key',$api_key)->first();
        }

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
			->orderBy('created_at' ,'desc')->get();

			  return response()->json($sellers_tabs);
        }
        else
        {
            $respond['msg']="No Api key found";

            $respond['error']=true;

            return response()->json($respond);
        }
    }
    public function getPost()
    {
        $id   = Input::get('id');

        $notification = Notification::where('id',$id)->first();

        Notification::where('id',$id)
            ->update(['Status'=>1]);

        $sellers_posts=\DB::table('sellers_details_tabs')
            ->join('product_types', 'sellers_details_tabs.productType', '=', 'product_types.id')
            ->join('packagings', 'sellers_details_tabs.packaging', '=', 'packagings.id')
            ->join('product_pickup_details','sellers_details_tabs.id','=','product_pickup_details.SellersPostId')
            ->where('sellers_details_tabs.id','=',$notification->PostId)
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
                        product_pickup_details.SundayHours as sundayHours"
                )
            )
            ->get();

        return $sellers_posts;
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
                        product_pickup_details.SundayHours as sundayHours"
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


          $lattitude    = null   ;

          $longitude    = null   ;

           if  (Input::get('gps_lat')=="" || Input::get('gps_long')=="")


           {
               $lattitude  = $user->gps_lat;

               $longitude =  $user->gps_long ;


           }
           else
           {

            $lattitude  =Input::get('gps_lat');

            $longitude =  Input::get('gps_long');
           }

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
          

        $productTypeID                   = ProductType::where('name',Input::get('productName'))->first();
        $sellersPost->productType        = $productTypeID['id'];

        $packagingID                     = Packaging::where('name',Input::get('packaging'))->first();
        $sellersPost->packaging          = $packagingID['id'];

        $sellersPost->costPerKg          = Input::get('costPerKg');
        $sellersPost->transactionRating  = Input::get('rating');
        $sellersPost->city              = Input::get('city');
        $sellersPost->country           = Input::get('country');
        $sellersPost->location          = Input::get('country').', '.Input::get('city');
        $sellersPost->description       = Input::get('description');
        $sellersPost->quantity          = Input::get('quantity');
        $sellersPost->quantityPosted    = Input::get('quantity');
         $sellersPost->gps_lat           = $lattitude;
         $sellersPost->gps_long          = $longitude;
        $sellersPost->availableHours    =  Input::get('availableHours');
        $sellersPost->paymentMethods    =  Input::get('paymentMethods');
        $sellersPost->transactionRating = Input::get('transactionRating');
		 $sellersPost->post_status = 1;
		 $radius = Input::get('radius');

        $sellersPost->save();

        $productPickupDetails                      = new ProductPickupDetails();
        $productPickupDetails->SellersPostId       = $sellersPost->id;
        $productPickupDetails->sellByDate          = Input::get('sellByDate');
        $productPickupDetails->PickUpAddress       = Input::get('PickUpAddress');
        $productPickupDetails->MonToFridayHours    = Input::get('MonToFridayHours');
        $productPickupDetails->SaturdayHours       = Input::get('SaturdayHours');
        $productPickupDetails->SundayHours         = Input::get('SundayHours');
        $productPickupDetails->gps_lat             = $lattitude;
        $productPickupDetails->gps_long            = $longitude;
        $productPickupDetails->save();

        //send notifications based on the radius specified on a post and product interest


        $message = "New ".Input::get('productName')." posted";

        //notification based on the users product interest
        $users = ProductInterest::where('ProductInterestID',$productTypeID['id'])
            ->where('active',1)
            ->get();

        for($i=0 ; $i < count($users) ; $i++)
        {
//            $oneUser = NewUser::where('id',$users[$i]->new_user_id)->first();

            $oneUser = \DB::table('new_users')
                ->where('id',$users[$i]->new_user_id)
                ->select(
                    \DB::raw(
                        "
                    id,
                    playerID,
                    name,
                    surname,
                    gps_lat,
                    gps_long,
                    ( 3959 * acos ( cos ( radians(" . $lattitude . ") ) * cos( radians( gps_lat ) ) * cos( radians( gps_long ) - radians(" . $longitude . ") ) + sin ( radians(" . $lattitude . ") ) * sin( radians( gps_lat ) ) ) ) AS distance
                    "
                    )
                )
                ->having('distance', '<', $radius)
                ->first();

            if($oneUser!=NULL)
            {
                $PlayerId = $oneUser->playerID;

                $newNotification = new NotificationService();
                $newNotification->sendToOne($message,$PlayerId);

                $notification = new Notification();
                $notification->new_user_id = $users[$i]->new_user_id;
                $notification->PostId = $sellersPost->id;
                $notification->ProductName = Input::get('productName');
                $notification->Message = $message;
                $notification->Status = 0;
                $notification->save();
            }
        }

        return $sellersPost;
      }
      public function createConsole(Request $request)
      {
          $validator=Validator::make(
              array(
                  'productType'          =>$request->productType,
                  'file'                 =>$request->file,
                  'transactionRating'    =>$request->transactionRating,
                  'description'          =>$request->description,
                  'city'                 =>$request->city,
                  'packaging'            =>$request->packaging,
                  'quantity'             =>$request->quantity,
                  'costPerKg'            =>$request->costPerKg,
                  'paymentMethods'       =>$request->paymentMethods,
              ),

              array(
                  'productType'          =>array('required','numeric'),
                  'file'                 =>array('required'),
                  'transactionRating'    =>array('required'),
                  'description'          =>array('required'),
                  'city'                 =>array('required'),
                  'packaging'            =>array('required'),
                  'quantity'             =>array('required','numeric'),
                  'costPerKg'            =>array('required'),
                  'paymentMethods'       =>array('required'),
              ),

              array(

                  'productType.required'            =>'The Product name field is required',
                  'productType.numeric'             =>'The Product name field is required',
                  'file.required'                   =>'The file field is required',
                  'transactionRating.required'      =>'Please select Grading',
                  'description.required'            =>'Please enter description',
                  'city.required'                   =>'Please enter a city',
                  'packaging.required'              =>'Please select packaging',
                  'quantity.required'               =>'Quantity field is required',
                  'costPerKg.required'              =>'Please enter cost per Kg',
                  'paymentMethods.required'         =>'Please select payment method',

              )


          );

          if ($validator->fails()) {
              return redirect('createPost')
                  ->withErrors($validator)
                  ->withInput();
          }



          $user                           = NewUser::where('id',Auth::user()->new_user_id)->first();

          $lattitude    = null   ;

          $longitude    = null   ;

          $sellersPost                    = new Sellers_details_tabs();

          $sellersPost->productType       = $request->productType;
          $sellersPost->new_user_id       = $user->id;

          $img                            = $request->file('file');

          $destinationFolder              = "images/".$user->name."_".$user->surname."_".$user->id."/";

          if(!\File::exists($destinationFolder)) {
              \File::makeDirectory($destinationFolder,0777,true);
              move_uploaded_file($img,$destinationFolder);
          }
          $name                            =    $img->getClientOriginalName();

          $img->move($destinationFolder,$name) ;

          $sellersPost->productPicture  = env('APP_URL').$destinationFolder.'/'.$name;

          $sellersPost->packaging          = $request->packaging;

          $sellersPost->costPerKg          = $request->costPerKg;
          $sellersPost->transactionRating  = $request->transactionRating;
          $sellersPost->city              = $request->city;
          $sellersPost->country           = "South Africa";
          $sellersPost->description       = $request->description;
          $sellersPost->quantity          = $request->quantity;
          $sellersPost->quantityPosted    = $request->quantity;
          if($request->PickUpRad == 0)
          {
              $sellersPost->location = $user->location;

              $sellersPost->gps_lat = $user->gps_lat;

              $sellersPost->gps_long = $user->gps_long;
          }
          else if($request->PickUpRad == 1)
          {
              $sellersPost->location = $request->address;

              $sellersPost->gps_lat = $request->gps_lat;

              $sellersPost->gps_long = $request->gps_long;
          }
          $sellersPost->availableHours    =  Input::get('availableHours');
          $sellersPost->paymentMethods    =  $request->paymentMethods;
          $sellersPost->post_status = 1;
          $radius = 3000;

          $sellersPost->save();

          $productPickupDetails                      = new ProductPickupDetails();
          $productPickupDetails->SellersPostId       = $sellersPost->id;
          $productPickupDetails->sellByDate          = $request->sellByDate;
          if($request->PickUpRad == 0)
          {
              $productPickupDetails->PickUpAddress = $user->location;

              $productPickupDetails->gps_lat = $user->gps_lat;

              $productPickupDetails->gps_long = $user->gps_long;
          }
          else if($request->PickUpRad == 1)
          {
              $productPickupDetails->PickUpAddress = $request->address;

              $productPickupDetails->gps_lat = $request->gps_lat;

              $productPickupDetails->gps_long = $request->gps_long;
          }
          $productPickupDetails->MonToFridayHours    = $request->MonToFriFrom.'-'.$request->MonToFriTo;
          $productPickupDetails->SaturdayHours       = $request->SatFrom.'-'.$request->SatTo;
          $productPickupDetails->SundayHours         = $request->SunFrom.'-'.$request->SunTo;
          $productPickupDetails->save();

//          //send notifications based on the radius specified on a post and product interest
//
//          $product                   = ProductType::where('id',$request->productType)->first();
//
//          $message = "New ".$product->name." posted";
//
//          //notification based on the users product interest
//          $users = ProductInterest::where('ProductInterestID',$request->productType)
//              ->where('active',1)
//              ->get();
//
//          for($i=0 ; $i < count($users) ; $i++)
//          {
////            $oneUser = NewUser::where('id',$users[$i]->new_user_id)->first();
//
//              $oneUser = \DB::table('new_users')
//                  ->where('id',$users[$i]->new_user_id)
//                  ->select(
//                      \DB::raw(
//                          "
//                    id,
//                    playerID,
//                    name,
//                    surname,
//                    gps_lat,
//                    gps_long,
//                    ( 3959 * acos ( cos ( radians(" . $lattitude . ") ) * cos( radians( gps_lat ) ) * cos( radians( gps_long ) - radians(" . $longitude . ") ) + sin ( radians(" . $lattitude . ") ) * sin( radians( gps_lat ) ) ) ) AS distance
//                    "
//                      )
//                  )
//                  ->having('distance', '<', $radius)
//                  ->first();
//
//              if($oneUser!=NULL)
//              {
//                  $PlayerId = $oneUser->playerID;
//
//                  $newNotification = new NotificationService();
//                  $newNotification->sendToOne($message,$PlayerId);
//
//                  $notification = new Notification();
//                  $notification->new_user_id = $users[$i]->new_user_id;
//                  $notification->PostId = $sellersPost->id;
//                  $notification->ProductName = Input::get('productName');
//                  $notification->Message = $message;
//                  $notification->Status = 0;
//                  $notification->save();
//              }
//          }


          \Session::flash('success', 'well done! Successfully created a post!');
          return Redirect('/mypostlist');
      }

    public function createDonation(Request $request)
    {
        $validator=Validator::make(
            array(
                'productType'          =>$request->productType,
                'file'                 =>$request->file,
                'transactionRating'    =>$request->transactionRating,
                'description'          =>$request->description,
                'city'                 =>$request->city,
                'packaging'            =>$request->packaging,
                'quantity'             =>$request->quantity,
            ),

            array(
                'productType'          =>array('required','numeric'),
                'file'                 =>array('required'),
                'transactionRating'    =>array('required'),
                'description'          =>array('required'),
                'city'                 =>array('required'),
                'packaging'            =>array('required'),
                'quantity'             =>array('required','numeric'),
            ),

            array(

                'productType.required'            =>'The Product name field is required',
                'productType.numeric'             =>'The Product name field is required',
                'file.required'                   =>'The file field is required',
                'transactionRating.required'      =>'Please select Grading',
                'description.required'            =>'Please enter description',
                'city.required'                   =>'Please enter a city',
                'packaging.required'              =>'Please select packaging',
                'quantity.required'               =>'Quantity field is required',
            )


        );

        if ($validator->fails()) {
            return redirect('createDonation')
                ->withErrors($validator)
                ->withInput();
        }



        $user                           = NewUser::where('id',Auth::user()->new_user_id)->first();

        $lattitude    = null   ;

        $longitude    = null   ;

        $sellersPost                    = new Sellers_details_tabs();

        $sellersPost->productType       = $request->productType;
        $sellersPost->new_user_id       = $user->id;

        $img                            = $request->file('file');

        $destinationFolder              = "images/".$user->name."_".$user->surname."_".$user->id."/";

        if(!\File::exists($destinationFolder)) {
            \File::makeDirectory($destinationFolder,0777,true);
            move_uploaded_file($img,$destinationFolder);
        }
        $name                            =    $img->getClientOriginalName();

        $img->move($destinationFolder,$name) ;

        $sellersPost->productPicture  = env('APP_URL').$destinationFolder.'/'.$name;

        $sellersPost->packaging          = $request->packaging;

        $sellersPost->costPerKg          = 0;
        $sellersPost->transactionRating  = $request->transactionRating;
        $sellersPost->city              = $request->city;
        $sellersPost->country           = "South Africa";
        $sellersPost->description       = $request->description;
        $sellersPost->quantity          = $request->quantity;
        $sellersPost->quantityPosted    = $request->quantity;
        if($request->PickUpRad == 0)
        {
            $sellersPost->location = $user->location;

            $sellersPost->gps_lat = $user->gps_lat;

            $sellersPost->gps_long = $user->gps_long;
        }
        else if($request->PickUpRad == 1)
        {
            $sellersPost->location = $request->address;

            $sellersPost->gps_lat = $request->gps_lat;

            $sellersPost->gps_long = $request->gps_long;
        }
        $sellersPost->availableHours    =  Input::get('availableHours');
        $sellersPost->paymentMethods    =  null;
        $sellersPost->post_status = 1;
        $radius = Input::get('radius');

        $sellersPost->save();

        $productPickupDetails                      = new ProductPickupDetails();
        $productPickupDetails->SellersPostId       = $sellersPost->id;
        $productPickupDetails->sellByDate          = $request->sellByDate;
        if($request->PickUpRad == 0)
        {
            $productPickupDetails->PickUpAddress = $user->location;

            $productPickupDetails->gps_lat = $user->gps_lat;

            $productPickupDetails->gps_long = $user->gps_long;
        }
        else if($request->PickUpRad == 1)
        {
            $productPickupDetails->PickUpAddress = $request->address;

            $productPickupDetails->gps_lat = $request->gps_lat;

            $productPickupDetails->gps_long = $request->gps_long;
        }
        $productPickupDetails->MonToFridayHours    = $request->MonToFriFrom.'-'.$request->MonToFriTo;
        $productPickupDetails->SaturdayHours       = $request->SatFrom.'-'.$request->SatTo;
        $productPickupDetails->SundayHours         = $request->SunFrom.'-'.$request->SunTo;
        $productPickupDetails->save();

        \Session::flash('success', 'well done! Successfully created a donation!');
        return Redirect('/mypostlist');
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
    public function deletePost($id)
    {
        $deletePost     = Sellers_details_tabs::where('id', $id)
            ->update(['post_status'=> 2]);

        \Session::flash('success', 'well done! Successfully deleted the post!');
        return Redirect('/postslist');
    }
}