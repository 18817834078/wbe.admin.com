<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class ShopUser extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password','status','shop_id'
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function shop(){
        return $this->belongsTo('App\model\Shop','shop_id','id');
    }
}
