<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable=[
        'username','password','tel','created_at','status'
    ];
}
