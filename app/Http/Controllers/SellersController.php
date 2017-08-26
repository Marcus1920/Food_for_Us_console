<?php

namespace App\Http\Controllers;
use  App\NewUser ;
use App\Sellers_details_tabs;
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
            $sellers_tabs=Sellers_details_tabs::where('new_user_id',$user->id)->get();

            return json_encode($sellers_tabs) ;
        }
        else
        {
            $respond['msg']="No Api key found";

            $respond['error']=true;

            return response()->json($respond);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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

        $sellersPost->product_picture = $destinationFolder.'/'.$name;

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
