<?php

namespace App\Http\Controllers;
use App\ProductType;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
class ProductsController extends Controller
{
    public function index()
    {
        $products = \DB::table('product_types')->orderBy('name')
            ->select(\DB::raw
            (
                "
                    product_types.id,
                    product_types.name,
                    product_types.type
                                   
                                    
                "
            )
            );

        return Datatables::of($products)
            ->make(true);



    }

    public function getProductType()
    {

        $productType    =ProductType::select('id','name')->get();
        return response()->json($productType);
    }


}
