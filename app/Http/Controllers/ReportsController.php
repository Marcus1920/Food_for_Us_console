<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Charts;
use App\UserRoles;
Use App\NewUser;
Use App\Sellers_details_tabs;

class ReportsController extends Controller
{
    public function index()
    {
        $chart = Charts::database(\DB::table('new_users')
            ->join('user_roles', 'new_users.intrest', '=', 'user_roles.id')
            ->select(\DB::raw(
                "
                                    new_users.id,
                                    user_roles.name  as intrest
                                    
                                    "
            )
            )
            ->get(), 'bar', 'highcharts')
            ->title('Users Per User Group')
            ->elementLabel("Total")
            ->dimensions(1000, 500)
            ->responsive(true)
            ->groupBy('intrest');

        $chart1 = Charts::database(\DB::table('sellers_details_tabs')
            ->join('product_types', 'sellers_details_tabs.productType', '=', 'product_types.id')
            ->select(
                \DB::raw(
                    "
                        sellers_details_tabs.id,
                        product_types.name as productName
  
                        "
                )
            )
            ->get(), 'pie', 'highcharts')
            ->title('Sellers Posts By Product Type')
            ->elementLabel("Total")
            ->dimensions(1000, 500)
            ->responsive(true)
            ->groupBy('productName');

        $chart2 = Charts::database(\DB::table('sellers_details_tabs')
            ->join('product_types', 'sellers_details_tabs.productType', '=', 'product_types.id')
            ->select(
                \DB::raw(
                    "
                        DISTINCT(product_types.name) as productName,
                        sellers_details_tabs.quantity
                        
                        "
                )
            )

            ->get(), 'pie', 'highcharts')
            ->title('Sellers Posts By Quantity Available')
            ->elementLabel("Total")
            ->dimensions(1000, 500)
            ->responsive(true)
            ->groupBy('productName');

//        $chart3 = Charts::database(Sellers_details_tabs::all(), 'pie', 'highcharts')
//            ->title('Sellers Posts By ProductType')
//            ->elementLabel("Total")
//            ->dimensions(1000, 500)
//            ->responsive(true)
//            ->groupBy('productType',null,[1 => 'Apples', 2 =>'Oranges' , 3 => 'Babanas' , 4 => 'Peas',5 => 'Cabbages', 6 =>'Spinach' , 7 => 'Tomatoes' , 8 => 'Potatoes' , 9 => 'Carrots' , 10 => 'Grapes']);


        return view('Reports.index', ['chart' => $chart , 'chart1' => $chart1 , 'chart2' => $chart2]);


    }
}
