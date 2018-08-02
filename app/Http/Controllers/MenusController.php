<?php

namespace App\Http\Controllers;

use App\model\OrderGood;
use Illuminate\Http\Request;

class MenusController extends Controller
{
    //统计
    public function count(Request $request){
        $menus_all=OrderGood::all();
        $count_all=0;
        $count_today=0;
        $count_this_month=0;
        $count_day=0;
        $count_month=0;
        $count_shop_all=[];
        $count_shop_day=[];
        $count_shop_month=[];
        foreach ($menus_all as $menu){
            $count_all+=$menu->amount;
            if(isset($count_shop_all[$menu->menu->shop->shop_name])){
                $count_shop_all[$menu->menu->shop->shop_name]+=$menu->amount;
            }else{
                $count_shop_all[$menu->menu->shop->shop_name]=$menu->amount;
            }


            if (substr($menu->created_at,0,7)==date('Y-m',time())){
                $count_this_month++;
                if (substr($menu->created_at,0,10)==date('Y-m-d',time())){
                    $count_today+=$menu->amount;
                }
            }
            if ($request->search_day){
                if (substr($menu->created_at,0,10)==$request->search_day){
                    $count_day+=$menu->amount;
                }
            }
            if ($request->search_month){
                if (substr($menu->created_at,0,7)==$request->search_month){
                    $count_month+=$menu->amount;
                }
            }
            if ($request->search_shop_day) {
                if (substr($menu->created_at, 0, 10) == $request->search_shop_day) {
                    if (isset($count_shop_day[$menu->menu->shop->shop_name])) {
                        $count_shop_day[$menu->menu->shop->shop_name]+=$menu->amount;
                    } else {
                        $count_shop_day[$menu->menu->shop->shop_name]=$menu->amount;
                    }
                }
                if (substr($menu->created_at, 0, 7) == substr($request->search_shop_day, 0, 7)) {
                    if (isset($count_shop_month[$menu->menu->shop->shop_name])) {
                        $count_shop_month[$menu->menu->shop->shop_name]+=$menu->amount;
                    } else {
                        $count_shop_month[$menu->menu->shop->shop_name]=$menu->amount;
                    }
                }
            }
            arsort($count_shop_all);
            arsort($count_shop_day);
            arsort($count_shop_month);
        }
        return view('menu/count',[
            'count_today'=>$count_today,
            'count_this_month'=>$count_this_month,
            'count_all'=>$count_all,
            'count_day'=>$count_day,
            'count_month'=>$count_month,
            'count_shop_all'=>$count_shop_all,
            'count_shop_day'=>$count_shop_day,
            'count_shop_month'=>$count_shop_month,
            'search_month'=>$request->search_month,
            'search_day'=>$request->search_day,
            'search_shop_day'=>$request->search_shop_day,

        ]);
    }
}
