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


    public function retriveProduct($id)
    {

        $product=ProductType::find($id);
        return view('Products.edit',compact('product'));

    }

    public function update(Request $request)
    {
        ProductType::where('id',$request['id'])
            ->update(['name'=>$request['productName'],
                'slug'=>$request['productName'],
                'type'=>$request['productType']]);

        return Redirect('/allProduct');
    }

    public function delete($id)
    {
        $product = ProductType::where('id',$id);
        $product->delete();

        return Redirect('/allProduct');
    }
}
