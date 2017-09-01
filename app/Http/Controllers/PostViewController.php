<?php

namespace App\Http\Controllers;

use App\NewUser;
use App\Sellers_details_tabs;
use Illuminate\Http\Request;

class PostViewController extends Controller
{

    public function index()
    {
       $post = Sellers_details_tabs::with('newuser')->with('User')->with('Products')->with('Packaging')->get();

//
      return view('users.postslist', compact('post'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {


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

        $data = Sellers_details_tabs::with('newuser')->where('id', $id)->first();

//
        return view('users.postprofile', compact('data'));
//        return view('users.postprofile');
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

}
