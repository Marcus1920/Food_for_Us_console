<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GeoTable;

class GeoTableController extends Controller
{
    public function getPlaces()
    {
        $lng = 31.005749;
        $lat = -29.859843;
        $radius = 30;

        $places = \DB::table('new_users')
            ->select(
                \DB::raw(
                    "
                    id,
                    name,
                    gps_lat,
                    gps_long,
                    ( 3959 * acos ( cos ( radians(".$lat.") ) * cos( radians( gps_lat ) ) * cos( radians( gps_long ) - radians(".$lng.") ) + sin ( radians(".$lat.") ) * sin( radians( gps_lat ) ) ) ) AS distance
                    "
                )
            )
            ->having('distance', '<', $radius)
        ->get();

        return $places;

    }
}
