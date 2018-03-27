<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jackpopp\GeoDistance\GeoDistanceTrait;

class GeoTable extends Model
{
    //
    use GeoDistanceTrait;
}
