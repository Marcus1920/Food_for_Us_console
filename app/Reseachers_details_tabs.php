<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Reseachers_details_tabs extends Eloquent
{
    protected $fillable=[

        'img_url',
        'nature_of_business',
        'summary_box',
        'research_notes',
    ];

    public  function User(){

        return $this->belongsTo(NewUser::class,'new_user_id','id');
    }
}
