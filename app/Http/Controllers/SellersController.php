<?php

namespace App\Http\Controllers;
use  App\NewUser ;
use App\Sellers_details_tabs;
use App\ProductType;
use App\Packaging;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class SellersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
                        sellers_details_tabs.updated_at
                        "
                    )
                )
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
						sellers_details_tabs.productType,
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
                        sellers_details_tabs.updated_at
                        "
                )
            )
            ->orderBy('created_at' ,'desc')	->get();

        return $sellers_posts;
    }
	  public function created(Request $request)
    {
        $input  =  $request->all();

        $user  = NewUser::where('api_key',$input['api_key'])->first();

	
		
        $sellersPost= new Sellers_details_tabs();
        $name =$user->name;
        $surname=$user->name; 		
		$id=$user->id;
        $sellersPost->new_user_id     = $user->id;
		
    	$img=$request->file('file');
        $destinationFolder = "images/".$name."_".$surname."_".$id."/";

        if(!\File::exists($destinationFolder)) {
            \File::makeDirectory($destinationFolder,0777,true);
			move_uploaded_file($img,$destinationFolder); 
        }

        $name =    $img->getClientOriginalName();

         $img->move($destinationFolder,$name) ;

        $sellersPost->productPicture  =env('APP_URL').$destinationFolder.'/'.$name;

        $productTypeID = ProductType::where('name',Input::get('productName'))->first();
        $sellersPost->productType  = $productTypeID['id'];

        $packagingID = Packaging::where('name',Input::get('packaging'))->first();
        $sellersPost->packaging = $packagingID['id'];

        $sellersPost->costPerKg  = Input::get('costPerKg');
        $sellersPost->transactionRating  = Input::get('rating');
        $sellersPost->city  = Input::get('city');
        $sellersPost->country  = Input::get('country');
        $sellersPost->location = Input::get('country').', '.Input::get('city');
        $sellersPost->description  = Input::get('description');
        $sellersPost->quantity = Input::get('quantity');
        $sellersPost->gps_lat    = Input::get('gps_lat');
        $sellersPost->gps_long = Input::get('gps_long');
        $sellersPost->availableHours = Input::get('availableHours');
        $sellersPost->paymentMethods = Input::get('paymentMethods');
        $sellersPost->transactionRating = Input::get('transactionRating');
        $sellersPost->save();

        return $sellersPost;
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

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {

    }

    public function update(Request $request)
    {
//        $user  = NewUser::where('api_key',$request['api_key'])->first();
//      $remove =  $user->productPicture;
//        unlink($filename);
//        if (file_exists($filename)) {
//            unlink($filename);
//           // echo 'File '.$filename.' has been deleted';
//        } else {
//           // echo 'Could not delete '.$filename.', file does not exist';
//        }
//
//        $sellersPost=Sellers_details_tabs::where('new_user_id',$user->id)
//            ->where('id',$request['id'])
//
//
//            /*$img=$request->file('file');
//        $destinationFolder = "images/".$name."_".$surname."_".$id."/";
//
//        if(!\File::exists($destinationFolder)) {
//            \File::makeDirectory($destinationFolder,0777,true);
//        }
//
//        $name =    $img->getClientOriginalName();
//
//        $img->move($destinationFolder,$name) ;
//
//        $sellersPost->productPicture  =env('APP_URL').$destinationFolder.'/'.$name;*/
//
//
//            ->update(['productPicture'=> Input::get('productPicture'),
//                'location'=> Input::get('location'),
//                'gps_lat'=> Input::get('gps_lat'),
//                'gps_long'=> Input::get('gps_long'),
//                'productType'=> Input::get('productType'),
//                'quantity'=> Input::get('quantity'),
//                'costPerKg'=> Input::get('costPerKg'),
//                'description'=> Input::get('description'),
//                'country'=> Input::get('country'),
//                'city'=> Input::get('city'),
//                'packaging'=> Input::get('packaging'),
//                'availableHours'=> Input::get('availableHours'),
//                'paymentMethods'=> Input::get('paymentMethods'),
//                'transactionRating'=> Input::get('transactionRating'),
//                'updated_at'=>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()]);
//
//        $sellersPost     = Sellers_details_tabs::where('new_user_id',$user->id)->get();
//        return  response()->json($sellersPost);
//
////        $user  = NewUser::findOrFail(1);
////        $user->Sellers_details_tabss()->whereId(1)-> update([
////            'product_picture'=> 'hommmmmme.png' , 'location' => 'Drban' ,'gps_lat' =>'32323',
////            'gps_long'=>'12121232','product_type' => 'product_type' ,'quantity' => '12'  ,
////            'cost_per_kg' => '12kg' , 'packaging' =>'packaging',
////            'available_hours' =>'34','payment_methods'=>'FTP' , 'transaction_rating' => '10'
////
////        ]);
////
////        return "ok";
    }

    public function destroy()
    {
        $apiKey         = Input::get('apiKey');
        $id             = Input::get('id');

        $user           = NewUser::where('api_key',$apiKey)->first();
        $deletePost     = Sellers_details_tabs::where('id', $id)
                             ->where('new_user_id', $user->id)
                             ->delete();

        $sellesPosts      = Sellers_details_tabs::where('new_user_id',$user->id)->get();
        return response()->json($sellesPosts);

    }


    public function updating()
    {
        $apiKey         = Input::get('apiKey');
        $user           = NewUser::where('api_key',$apiKey)->first();
        $id             = Input::get('id');
        $deletePost     =  Sellers_details_tabs::where('id', $id)->where('new_user_id', $user)
            ->update(['productPicture'=> Input::get('name'),
                'location'=> Input::get('description'),
                'gps_lat'=> Input::get('ingredients'),
                'gps_long'=> Input::get('methods'),
                'productType'=> Input::get('methods'),
                'quantity'=> Input::get('methods'),
                'costPerKg'=> Input::get('methods'),
                'description'=> Input::get('methods'),
                'country'=> Input::get('methods'),
                'city'=> Input::get('methods'),
                'packaging'=> Input::get('methods'),
                'availableHours'=> Input::get('methods'),
                'paymentMethods'=> Input::get('methods'),
                'transactionRating'=> Input::get('methods'),
                'updated_at'=>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()]);
        $posts          =   Sellers_details_tabs::where('new_user_id',$user);
    }
}
