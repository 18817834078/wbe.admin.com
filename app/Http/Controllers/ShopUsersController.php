<?php

namespace App\Http\Controllers;

use App\model\Shop;
use App\model\ShopCategory;
use App\model\ShopUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ShopUsersController extends Controller
{
    //展示
    public function index(){
        $shop_users=ShopUser::paginate(5);
        return view('/shop_user/index',['shop_users'=>$shop_users]);
    }
    public function show(ShopUser $shop_user){
        $shop=Shop::where('id','=',$shop_user->shop_id)->first();
        return view('/shop_user/show',['shop'=>$shop,'shop_user'=>$shop_user]);
    }
    //添加
    public function create(){

    }
    public function store(){

    }
    //删除
    public function destroy(ShopUser $shop_user){
        $shop=Shop::where('id','=',$shop_user->shop_id)->first();
        $shop_user->delete();
        $shop->delete();
        session()->flash('success','删除成功');
        return redirect()->route('shop_users.index');
    }
    //修改
    public function edit(ShopUser $shop_user){
        $shop=Shop::where('id','=',$shop_user->shop_id)->first();
        $shop_categories=ShopCategory::all();
        return view('shop/edit',['shop'=>$shop,'shop_user'=>$shop_user,'shop_categories'=>$shop_categories]);
    }
    public function update(){

    }
    //审核

    public function pass(ShopUser $shop_user){
        if ($shop_user->status==1){
            $shop_user->update(['status'=>0]);
        }else{
            $shop_user->update(['status'=>1]);
            //发邮件
            Mail::raw('您的账号已通过审核',function ($message) use($shop_user){
                $message->subject('审核通知');
                $message->to($shop_user->email);
            });
        }



        return back()->with('success','账户审核成功');
    }
    //密码修改
    public function shop_user_password(ShopUser $shop_user){
        return view('shop_user/edit',['shop_user'=>$shop_user]);
    }
    public function shop_user_password_store(Request $request,ShopUser $shop_user){
        $this->validate($request, [
            'new_password' => 'required',
            're_password' => 'required',
            'captcha' => 'required|captcha',
        ],[
            'new_password.required'=>'请输用新的密码',
            're_password.required'=>'请再次输入密码',
            'captcha.required' => '验证码不能为空',
            'captcha.captcha' => '请输入正确的验证码',
        ]);
        if ($request->re_password!=$request->new_password){
            return back()->with('danger','两次密码输入须一致');
        }
        $shop_user->update([
            'password'=>bcrypt($request->new_password)
        ]);
        session()->flash('success','新密码修改成功');
        return redirect()->route('shop_users.index');
    }
}
