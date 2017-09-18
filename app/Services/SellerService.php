<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 9/18/2017
 * Time: 11:00 AM
 */

namespace App\Services;

use App\Jobs\SendEmailsToBuyers;
use  App\NewUser ;
use App\Sellers_details_tabs;
use App\ProductType;
use App\Packaging;
use App\ProductPickupDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Mail;
use Carbon\Carbon;


class SellerService
{

    public function newPost($request)
    {

    }
}