<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Nav extends Model
{
    protected $fillable=[
        'name','url','permission_id','pid'
    ];
    public function permission(){
        return $this->belongsTo('App\model\Permission','permission_id','id');
    }
    public function pid_name(){
        return $this->belongsTo('App\model\Nav','pid','id');
    }
    //生成
    public static function getHTML(){
        $html='';
        foreach(\App\model\Nav::where('pid','0')->get() as $nav){
            $child_html='';
            foreach(\App\model\Nav::where('pid',$nav->id)->get() as $n){
                if (auth()->user()&&auth()->user()->can($nav->permission->name)){
                    $child_html.='<li><a href="'.$n->url.'">'.$n->name .'</a></li>';
                }
            }
            if ($child_html){
                $html.=' <li class="dropdown">
                    <span  class="dropdown-toggle list-group-item" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false">'.$nav->name.'<span class="caret"></span></span>
                            <ul class="dropdown-menu">'.$child_html.' </ul>
                        </li>';
            }else{
                continue;
            }

        }
        return $html;
    }
}
