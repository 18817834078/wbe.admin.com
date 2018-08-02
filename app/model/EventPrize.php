<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class EventPrize extends Model
{
    protected $fillable=[
        'events_id','member_id','name','description'
    ];
    public function shop_user(){
        return $this->belongsTo('App\model\ShopUser','member_id','id');
    }
}
