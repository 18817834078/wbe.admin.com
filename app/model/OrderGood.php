<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class OrderGood extends Model
{
    public function menu(){
        return $this->belongsTo('App\model\Menu','goods_id','id');
    }
}
