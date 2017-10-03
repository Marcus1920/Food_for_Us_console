<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CountryCode;
use Yajra\DataTables\DataTables;
class CountryCodeController extends Controller
{
    public function index()
    {

        $country = CountryCode::orderBy('name')->get();
        return response()->json($country);

    }

    public function allCountries4Console()
    {


        $countryCode4Console = \DB::table('country_code')->orderBy('name')
            ->select(\DB::raw
            (
                "
                    country_code.id,
                    country_code.name,
                    country_code.internet,
                    country_code.dial_code
                                   
                                    
                "
            )
            );

        return Datatables::of($countryCode4Console)
            ->make(true);


    }

    public function countryView()
    {
        return view('CountryCode.list');

    }

    public function editCountry($id)
    {
        $editCountryCode=CountryCode::find($id);
        return view('CountryCode.edit',compact('editCountryCode'));

    }

    public function update(Request $request)
    {
        CountryCode::where('id',$request['id'])
            ->update(['name'=>$request['name'],
                'internet'=>$request['internet'],
                'dial_code'=>$request['dial_code']]);

      return Redirect('/countrylistView');
    }



}
