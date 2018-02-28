<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;




class NewUser extends Eloquent
{
    //
    protected $table = 'new_users';
    protected $fillable = [
                            'idNumber',
                            'profilePicture',
                             'name',
                             'surname',
                             'email',
                             'intrest',
                             'cellphone',
                             'location',
                             'travelRadius'
                          ];

    public  function  Sellers_details_tabss()
    {
        return $this->hasMany(Sellers_details_tabs::class);
    }

    public  function  publicwallpost()
    {
        return $this->hasMany(PublicWall::class);
    }

    public function cart()
    {
        return $this->hasMany(Cart::class);
	}
    public  function UserStatuses(){

        return $this->belongsTo(UserStatus::class,'active','id');
    }
    public  function UserRole()
    {

        return $this->belongsTo(UserRoles::class,'intrest','id');
    }
    public  function UserTravelRadius()
    {
        return $this->belongsTo(UserTravelRadius::class, 'travelRadius', 'id');
    }

    public  function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public  function transactionActivity()
    {
        return $this->hasMany(TransactionActivity::class);
    }

    public  function productInterest(){

        return $this->belongsTo(ProductType::class,'productInterest','id');
    }
}
