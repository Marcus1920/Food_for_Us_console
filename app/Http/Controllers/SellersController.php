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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
	 
	 
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *
     * App\Flight::where('active', 1)
    ->where('destination', 'San Diego')
    ->update(['delayed' => 1]);
     */
    public function update(Request $request)
    {
        $user  = NewUser::where('api_key',$request['api_key'])->first();

        $sellersPost=Sellers_details_tabs::where('new_user_id',$user->id)
            ->where('id',$request['seller_post_id'])->get();

        return $sellersPost;

//        $user  = NewUser::findOrFail(1);
//        $user->Sellers_details_tabss()->whereId(1)-> update([
//            'product_picture'=> 'hommmmmme.png' , 'location' => 'Drban' ,'gps_lat' =>'32323',
//            'gps_long'=>'12121232','product_type' => 'product_type' ,'quantity' => '12'  ,
//            'cost_per_kg' => '12kg' , 'packaging' =>'packaging',
//            'available_hours' =>'34','payment_methods'=>'FTP' , 'transaction_rating' => '10'
//
//        ]);
//
//        return "ok";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        $user  = NewUser::findOrFail(1);
        $user->Sellers_details_tabss()->whereId(2)->delete();

        return "ok";
    }
}
