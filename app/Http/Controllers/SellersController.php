<?php

namespace App\Http\Controllers;
use  App\NewUser ;
use App\Sellers_details_tabs;
use Illuminate\Http\Request;

class SellersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user  = NewUser::findOrFail(1);

        return json_decode($user->Sellers_details_tabss ) ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
//        $input  = $request->all() ;
//
//        if ($img  = $request->file('file'))
//        {
//
//
//         $name =    $img->getClientOriginalName();
//         $img->move('images' ,$name) ;
//
//         $input['product_picture'] = $name ;
//        }
//

//       $user->Sellers_details_tabss()->save($input);
//

        $user  = NewUser::findOrFail(1);
        $user->Sellers_details_tabss()->save(new Sellers_details_tabs([
            'product_picture'=> 'home.png' , 'location' => 'Drban' ,'gps_lat' =>'32323',
            'gps_long'=>'12121232','product_type' => 'product_type' ,'quantity' => '12'  ,
            'cost_per_kg' => '12kg' , 'packaging' =>'packaging',
            'available_hours' =>'34','payment_methods'=>'FTP' , 'transaction_rating' => '10'

            ]));
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
     */
    public function update()
    {
        $user  = NewUser::findOrFail(1);
        $user->Sellers_details_tabss()->whereId(1)-> update([
            'product_picture'=> 'hommmmmme.png' , 'location' => 'Drban' ,'gps_lat' =>'32323',
            'gps_long'=>'12121232','product_type' => 'product_type' ,'quantity' => '12'  ,
            'cost_per_kg' => '12kg' , 'packaging' =>'packaging',
            'available_hours' =>'34','payment_methods'=>'FTP' , 'transaction_rating' => '10'

        ]);

        return "ok";
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
