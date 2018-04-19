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
        $sellers_posts=\DB::table('sellers_details_tabs')
            ->join('product_types', 'sellers_details_tabs.productType', '=', 'product_types.id')
            ->select(
                \DB::raw(
                    "
                        product_types.name,
                        sum(sellers_details_tabs.quantity) as QuantitySum,
                        sum(sellers_details_tabs.quantitySold) as QuantitySoldSum,
                        sum(sellers_details_tabs.quantity)-sum(sellers_details_tabs.quantitySold) as QuantityAvailable
                    "
                )
            )
            ->groupBy('product_types.name')
            ->get();

        $labels=null;
        $QuantitySum=null;
        $QuantitySoldSum=null;
        $QuantityAvailable=null;

        for($i=0; $i < sizeof($sellers_posts); $i++){
            $labels.=(string)$sellers_posts[$i]->name.',';
        }

        for($i=0; $i < sizeof($sellers_posts); $i++){
            $QuantitySum.=$sellers_posts[$i]->QuantitySum.',';
        }

        for($i=0; $i < sizeof($sellers_posts); $i++){
            $QuantitySoldSum.=$sellers_posts[$i]->QuantitySoldSum.',';
        }

        for($i=0; $i < sizeof($sellers_posts); $i++){
            $QuantityAvailable.=$sellers_posts[$i]->QuantityAvailable.',';
        }

        $chart2=Charts::multi('areaspline', 'highcharts')
            ->title('Quantity Posted, Sold and Available')
            ->elementLabel("Total")
            ->colors(['#ff0000', '#07F0F7','#F5E70E'])
            ->labels(explode(',',chop($labels,',')))
            ->dataset('Quantity Posted', explode(',',chop($QuantitySum,',')))
            ->dataset('Quantity Sold', explode(',',chop($QuantitySoldSum,',')))
            ->dataset('Quantity Available', explode(',',chop($QuantityAvailable,',')));

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

        return view('Reports.index', ['chart' => $chart , 'chart1' => $chart1 , 'chart2' => $chart2]);
    }
}
