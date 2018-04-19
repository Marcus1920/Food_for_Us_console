<?php

namespace App\Http\Controllers;


//use ConsoleTVs\Charts;
//use Charts;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use App\NewUser;
use SebastianBergmann\CodeCoverage\Report\Xml\Report;
use ConsoleTVs\Charts\Facades\Charts;
class ReportController extends Controller
{

    public function index()
    {

//        $chart = Charts::create('bar', 'highcharts')
//            ->Title('My nice chart')
//            ->Labels(['First', 'Second', 'Third'])
//            ->Values([5,10,20])
//            ->Dimensions(1000,500)
//            ->Responsive(false);
//        return view('Reports.view', ['chart' => $chart]);

        $chart = Charts::database(NewUser::all(), 'bar', 'highcharts')
            ->ElementLabel("Total")
            ->Dimensions(1000, 500)
            ->Responsive(false);
        return view('Reports.view', ['chart' => $chart]);
    }



}
