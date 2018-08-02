<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function shop(){
        return $this->belongsTo('App\model\shop','shop_id','id');
    }
}
