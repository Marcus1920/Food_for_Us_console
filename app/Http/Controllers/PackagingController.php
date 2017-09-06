<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Packaging;

class PackagingController extends Controller
{
    public function index()
    {
        $packagings=Packaging::all();
        return view('Packaging.index',compact('packagings'));
    }
    public function create()
    {
        return view('Packaging.create');
    }
    public function store(Request $request)
    {
        $this->validate($request,[

           'name'=>'required|alpha',

        ]);

        $newPackaging=new Packaging();
        $newPackaging->name = $request['name'];
        $newPackaging->slug = $request['name'];
        $newPackaging->save();

        return Redirect('/packaginglist');
    }

    public function getPackaging()
    {

        $packaging = Packaging::select('id','name')->get();
        return response()->json($packaging);
    }
}
