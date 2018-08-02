<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class ModelHasRole extends Model
{
    protected $fillable=[
        'role_id','model_id','model_type'
    ];
}
