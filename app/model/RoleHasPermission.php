<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class RoleHasPermission extends Model
{
    protected $fillable=[
        'permission_id','role_id'
    ];
    public function role(){
        return $this->belongsTo('App\model\Role','role_id','id');
    }
    public function permission(){
        return $this->belongsTo('App\model\Permission','permission_id','id');
    }
}
