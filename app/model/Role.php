<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable=[
        'name','guard_name','created_at','updated_at'
    ];
}
