<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable=[
        'title','content','signup_start','signup_end','prize_date','signup_num','is_prize'
    ];

    public function prize(){
        return $this->hasMany('App\model\EventPrize','events_id','id');
    }
}
