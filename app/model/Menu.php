<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    public function category(){
        return $this->belongsTo('App\model\MenuCategory','category_id','id');
    }
    public function shop(){
        return $this->belongsTo('App\model\Shop','shop_id','id');
    }
}
