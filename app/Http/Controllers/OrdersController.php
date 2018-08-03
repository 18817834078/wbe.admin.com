<?php

namespace App\Http\Controllers;

use App\model\Order;
use App\model\Permission;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function count(Request $request){
        Permission::set_permission('订单统计');//设置权限
        $orders_all=Order::all();
        $count_all=0;
        $count_today=0;
        $count_this_month=0;
        $count_day=0;
        $count_month=0;
        $count_shop_all=[];
        $count_shop_day=[];
        $count_shop_month=[];
        foreach ($orders_all as $order){
            $count_all++;
            if(isset($count_shop_all[$order->shop->shop_name])){
                $count_shop_all[$order->shop->shop_name]++;
            }else{
                $count_shop_all[$order->shop->shop_name]=1;
            }


            if (substr($order->created_at,0,7)==date('Y-m',time())){
                $count_this_month++;
                if (substr($order->created_at,0,10)==date('Y-m-d',time())){
                    $count_today++;
                }
            }
            if ($request->search_day){
                if (substr($order->created_at,0,10)==$request->search_day){
                    $count_day++;
                }
            }
            if ($request->search_month){
                if (substr($order->created_at,0,7)==$request->search_month){
                    $count_month++;
                }
            }
            if ($request->search_shop_day) {
                if (substr($order->created_at, 0, 10) == $request->search_shop_day) {
                    if (isset($count_shop_day[$order->shop->shop_name])) {
                        $count_shop_day[$order->shop->shop_name]++;
                    } else {
                        $count_shop_day[$order->shop->shop_name] = 1;
                    }
                }
                if (substr($order->created_at, 0, 7) == substr($request->search_shop_day, 0, 7)) {
                    if (isset($count_shop_month[$order->shop->shop_name])) {
                        $count_shop_month[$order->shop->shop_name]++;
                    } else {
                        $count_shop_month[$order->shop->shop_name] = 1;
                    }
                }
            }
            arsort($count_shop_all);
            arsort($count_shop_day);
            arsort($count_shop_month);
        }
        return view('order/count',[
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
