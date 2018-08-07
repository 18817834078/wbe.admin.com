<?php

namespace App\Http\Controllers;

use App\model\Permission;
use App\model\Shop;
use App\model\ShopCategory;
use App\model\ShopUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;

class ShopsController extends Controller
{
    //展示
    public function index(){
        Permission::set_permission('商店查看');//设置权限
        $shops=Shop::paginate(5);
        return view('/shop/index',['shops'=>$shops]);
    }
    public function show(Shop $shop){
        Permission::set_permission('商店查看');//设置权限
        $shop_user=ShopUser::where('shop_id','=',$shop->id)->first();
        return view('/shop_user/show',['shop'=>$shop,'shop_user'=>$shop_user]);
    }
    //添加
    public function create(){
        Permission::set_permission('商店操作');//设置权限
        $shop_categories=ShopCategory::all()->where('status','=',1);
        return view('shop/create',['shop_categories'=>$shop_categories]);
    }
    public function store(Request $request){
        Permission::set_permission('商店操作');//设置权限
        $this->validate($request, [
            'name' => 'required|max:50|unique:shop_users,name',
            'email' => 'required|email|unique:shop_users,email',
            'password' => 'required',
            're_password' => 'required',
            'shop_name' => 'required|max:50',
            'start_send' => 'required|numeric',
            'send_cost' => 'required|numeric',
            'shop_img' => 'required',
        ],[
            'name.required'=>'请输入账户名',
            'name.max'=>'账户名字过长',
            'name.unique'=>'已存在的账户名',
            'email.required'=>'请输入邮箱',
            'email.email'=>'错误的邮箱格式',
            'email.unique'=>'邮箱已被使用',
            'password.required'=>'请输入密码',
            're_password.required'=>'请再次输入密码',
            'shop_name.required'=>'请输入店铺名',
            'shop_name.max'=>'店铺名过长',
            'start_send.required'=>'请输入起送价',
            'start_send.numeric'=>'起送价必须为数字',
            'send_cost.required'=>'请输入配送费',
            'send_cost.numeric'=>'配送费必须为数字',
            'shop_img.required'=>'请上传一张对应的图片',
        ]);
        if ($request->password!=$request->re_password){
            return back()->withInput()->with('danger','两次密码输入不一致');
        }
        $shop_img=$request->shop_img;

        DB::transaction(function () use ($request,$shop_img) {
            $new_shop=Shop::create([
                'shop_name'=>$request->shop_name,
                'brand'=>$request->brand?1:0,
                'on_time'=>$request->on_time?1:0,
                'fengniao'=>$request->fengniao?1:0,
                'bao'=>$request->bao?1:0,
                'piao'=>$request->piao?1:0,
                'zhun'=>$request->zhun?1:0,
                'start_send'=>$request->start_send,
                'send_cost'=>$request->send_cost,
                'notice'=>$request->notice?$request->notice:'暂无',
                'discount'=>$request->discount?$request->discount:'暂无',
                'shop_rating'=>3,
                'status'=>1,
                'shop_category_id'=>$request->shop_category_id,
                'shop_img'=>$shop_img,
            ]);
            ShopUser::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'status'=>1,
                'shop_id'=>$new_shop->id,
                'password'=>bcrypt($request->password),
            ]);
        });
        //redis修改
        if (Redis::get('shops_json')){
            Redis::del('shops_json');
        }


        session()->flash('success','添加成功');
        return redirect()->route('shops.index');

    }
    //删除
    public function destroy(Shop $shop){
        Permission::set_permission('商店操作');//设置权限
        $shop_user=ShopUser::where('shop_id','=',$shop->id)->first();
        $shop->delete();
        $shop_user->delete();
        //redis修改
        if (Redis::get('shops_json')){
            Redis::del('shops_json');
        }


        session()->flash('success','删除成功');
        return redirect()->route('shops.index');
    }
    //修改
    public function edit(Shop $shop){
        Permission::set_permission('商店操作');//设置权限
        $shop_user=ShopUser::where('shop_id','=',$shop->id)->first();
        $shop_categories=ShopCategory::all()->where('status','=',1);
        return view('shop/edit',['shop'=>$shop,'shop_user'=>$shop_user,'shop_categories'=>$shop_categories]);
    }
    public function update(Request $request,Shop $shop,ShopUser $shop_user){
        Permission::set_permission('商店操作');//设置权限
        $this->validate($request, [
            'shop_name' => 'required|max:50',
            'start_send' => 'required|numeric',
            'send_cost' => 'required|numeric',
        ],[
            'shop_name.required'=>'请输入店铺名',
            'shop_name.max'=>'店铺名过长',
            'start_send.required'=>'请输入起送价',
            'start_send.numeric'=>'起送价必须为数字',
            'send_cost.required'=>'请输入配送费',
            'send_cost.numeric'=>'配送费必须为数字',
        ]);
        $shop_update=[
            'shop_name'=>$request->shop_name,
            'brand'=>$request->brand?1:0,
            'on_time'=>$request->on_time?1:0,
            'fengniao'=>$request->fengniao?1:0,
            'bao'=>$request->bao?1:0,
            'piao'=>$request->piao?1:0,
            'zhun'=>$request->zhun?1:0,
            'start_send'=>$request->start_send,
            'send_cost'=>$request->send_cost,
            'notice'=>$request->notice?$request->notice:'暂无',
            'discount'=>$request->discount?$request->discount:'暂无',
            'shop_category_id'=>$request->shop_category_id,
        ];
        if ($request->shop_img){
            $shop_update['shop_img']=$request->shop_img;
        }
        $shop->update($shop_update);
        //redis修改
        if (Redis::get('shops_json')){
            Redis::del('shops_json');
        }
        if (Redis::get('shop_json'.$shop)){
            Redis::del('shop_json'.$shop);
        }

        session()->flash('success','修改成功');
        return redirect()->route('shops.index');

    }
    //审核
    public function un_pass(){
        Permission::set_permission('商店审核');//设置权限
        $shops=Shop::where('status','=',0)->paginate(5);
        //redis修改
        if (Redis::get('shops_json')){
            Redis::del('shops_json');
        }

        return view('/shop/pass',['shops'=>$shops]);
    }
    public function pass(Request $request,Shop $shop){
        Permission::set_permission('商店审核');//设置权限
        $shop->update([
            'status'=>$request->status
        ]);
        //redis修改
        if (Redis::get('shops_json')){
            Redis::del('shops_json');
        }

        return back()->with('success','商店审核成功');
    }
}
