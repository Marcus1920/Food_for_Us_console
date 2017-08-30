<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
  protected $table ='carts';

    public function products()
  {
      return $this->belongsTo(Sellers_details_tabs::class);
  }

}
