<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class ModelHasPermission extends Model
{
    protected $fillable=[
        'permission_id','model_id','model_type'
    ];
}
