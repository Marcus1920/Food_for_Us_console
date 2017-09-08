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
        $chart = Charts::database(NewUser::all(), 'bar', 'highcharts')
            ->title('Users Per User Group')
            ->elementLabel("Total")
            ->dimensions(1000, 500)
            ->responsive(true)
            ->groupBy('intrest',null,[1 => 'Seller', 2 =>'Buyer' , 3 => 'Researcher' , 4 => 'Charity']);

        $chart1 = Charts::database(Sellers_details_tabs::all(), 'pie', 'highcharts')
            ->title('Sellers Posts By Product Type')
            ->elementLabel("Total")
            ->dimensions(1000, 500)
            ->responsive(true)
            ->groupBy('productType',null,[1 => 'Apples', 2 =>'Oranges' , 3 => 'Babanas' , 4 => 'Peas',5 => 'Cabbages', 6 =>'Spinach' , 7 => 'Tomatoes' , 8 => 'Potatoes' , 9 => 'Carrots' , 10 => 'Grapes']);

//        $chart2 = Charts::database(NewUser::all(), 'line', 'highcharts')
//            ->title('Users Per User')
//            ->elementLabel("Total")
//            ->dimensions(1000, 500)
//            ->responsive(true)
//            ->groupBy('intrest',null,[1 => 'Seller', 2 =>'Buyer' , 3 => 'Researcher' , 4 => 'Charity']);
//
//        $chart3 = Charts::database(Sellers_details_tabs::all(), 'pie', 'highcharts')
//            ->title('Sellers Posts By ProductType')
//            ->elementLabel("Total")
//            ->dimensions(1000, 500)
//            ->responsive(true)
//            ->groupBy('productType',null,[1 => 'Apples', 2 =>'Oranges' , 3 => 'Babanas' , 4 => 'Peas',5 => 'Cabbages', 6 =>'Spinach' , 7 => 'Tomatoes' , 8 => 'Potatoes' , 9 => 'Carrots' , 10 => 'Grapes']);


        return view('Reports.index', ['chart' => $chart , 'chart1' => $chart1]);


    }
}
