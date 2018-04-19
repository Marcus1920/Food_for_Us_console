<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Packaging;
use Yajra\DataTables\DataTables;

class PackagingController extends Controller
{
    public function index()
    {
        return view('Packaging.index');
//        $packagings=Packaging::all();
//        return view('Packaging.index',compact('packagings'));
    }

    public function getPackagingList()
    {
        $packagingList = Packaging::all();

        return Datatables::of($packagingList)
            ->make(true);
    }

    public function retrivePackaging($id)
    {

        $packaging=Packaging::find($id);
        return view('Packaging.edit',compact('packaging'));

    }

    public function update(Request $request)
    {
        Packaging::where('id',$request['id'])
            ->update(['name'=>$request['packagingName'],
                'slug'=>$request['packagingName']]);

        return Redirect('/packaginglist');
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
