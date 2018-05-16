<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
class PpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ($request->file('file_pic') == null) {
            return "Select image before click upload";
        }
        $file=$request->file('file_pic');
        if (preg_match("/.(png|jpg|jpeg|gif)$/i" , $file->getClientOriginalName() )
        ) {
        }else{
            return "We only accept png,jpeg and gif format";
        }
//        $img=register::where('id',session()->get('id'))->first();
//        if(file_exists('img/'.$img->image)){
//            unlink('img/'.$img->image);
//        }

//        register::where('username',session()->get('username'))->update(['image'=>$file->getClientOriginalName()]);
        $image= $request->file('file_pic');

        $path = public_path('img/' .$image->getClientOriginalName());
        if(Image::make($image->getRealPath())->resize(200, 200)){
            Image::make($image->getRealPath())->resize(200, 200)->save($path);
        }else{
            return "Image corrupted";
        }
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
