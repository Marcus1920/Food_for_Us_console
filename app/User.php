<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;


    protected $table ='users';
    protected $fillable = [
        'name', 'email', 'password','gps_lat','gps_long',
    ];


    protected $hidden = [
        'password', 'remember_token',
    ];




}
