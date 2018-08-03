<?php

namespace App\Http\Controllers;

use App\model\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SessionController extends Controller
{
    //登入
    public function login_view(){
        return view('session/login');
    }
    public function login(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'password' => 'required',
            'captcha' => 'required|captcha',
        ],[
            'name.required'=>'请输用户名',
            'password.required'=>'请输入密码',
            'captcha.required' => '验证码不能为空',
            'captcha.captcha' => '请输入正确的验证码',
        ]);
        if (Auth::attempt(['name' => $request->name, 'password' => $request->password])) {
            session()->flash('success','登录成功');
            return redirect()->route('admins.index');
        }else{
            session()->flash('danger','用户名或密码错误');
            return redirect()->route('admins.index');
        }

    }
    //登出
    public function logout(){
        Auth::logout();
        session()->flash('danger','已成功注销登录状态');
        return redirect()->route('login_view');
    }
    //修改密码
    public function reset_password(){
        return view('session/edit',['admin'=>auth()->user()]);
    }
    public function reset_password_store(Request $request,Admin $admin){
        $this->validate($request, [
            'new_password' => 'required',
            're_password' => 'required',
            'old_password' => 'required',
            'captcha' => 'required|captcha',
        ],[
            'new_password.required'=>'请输用新的密码',
            're_password.required'=>'请再次输入密码',
            'old_password.required'=>'请输入原来的密码',
            'captcha.required' => '验证码不能为空',
            'captcha.captcha' => '请输入正确的验证码',
        ]);
        if ($request->re_password!=$request->new_password){
            return back()->with('danger','两次密码输入须一致');
        }
        if ($request->new_password==$request->old_password){
            return back()->with('danger','新密码不能与旧密码相同');
        }
        if(Hash::check($request->old_password,auth()->user()->password)){
            Admin::where('id','=',auth()->user()->id)->update(['password'=>bcrypt($request->new_password)]);
            Auth::logout();
            session()->flash('success','密码修改成功,请重新登录');
            return redirect()->route('admins.index');
        }else{
            return back()->with('danger','原密码不匹配');
        }

    }
}
