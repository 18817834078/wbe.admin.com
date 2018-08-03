<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable=[
        'name','guard_name','created_at','updated_at'
    ];
    //设置权限
    public static function set_permission($permission){
        if (!auth()->user()->can('分类查看')){
            echo '<h1>';
            echo '您没有权限查看此页面';
            echo '</h1>';
            die;
        }
    }
}
