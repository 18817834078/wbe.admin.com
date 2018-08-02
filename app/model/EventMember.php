<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class EventMember extends Model
{
    protected $fillable=[
        'events_id','name','description','member_id'
    ];

    public function shop_user(){
        return $this->belongsTo('App\model\ShopUser','member_id','id');
    }
}
