<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Reseachers_details_tabs extends Eloquent
{
    protected $fillable=[

        'img_url',
        'natureOfBusiness',
        'summaryBox',
        'researchNotes',
    ];

    public  function User(){

        return $this->belongsTo(NewUser::class,'new_user_id','id');
    }
}
