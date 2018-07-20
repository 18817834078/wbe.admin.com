<?php

namespace App\Http\Controllers;

use App\model\Admin;
use Illuminate\Http\Request;

class AdminsController extends Controller
{
    //展示
    public function index(){
       $admins=Admin::paginate(5);
        return view('/admin/index',['admins'=>$admins]);
    }
    public function show(){

    }
    //添加
    public function create(){
        return view('/admin/create');
    }
    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required|max:50',
            'email' => 'required',
            'password' => 'required',
            're_password' => 'required',
        ],[
            'name.required'=>'请输入管理员名字',
            'name.max'=>'管理员名字过长',
            'email.required'=>'请输入邮箱',
            'password.required'=>'请输入密码',
            're_password.required'=>'请再次输入密码',
        ]);
        if ($request->password!=$request->re_password){
            return back()->withInput()->with('danger','两次密码输入不一致');
        }
        Admin::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password)
        ]);
        session()->flash('success','添加成功');
        return redirect()->route('admins.index');
    }
    //删除
    public function destroy(Admin $admin){
        $admin->delete();
        session()->flash('success','删除成功');
        return redirect()->route('admins.index');
    }
    //修改
    public function edit(Admin $admin){
        return view('/admin/edit',['admin'=>$admin]);
    }
    public function update(Request $request,Admin $admin){
        $this->validate($request, [
            'name' => 'required|max:50',
            'email' => 'required',
        ],[
            'name.required'=>'请输入管理员名字',
            'name.max'=>'管理员名字过长',
            'email.required'=>'请输入邮箱',
        ]);
        $admin->update([
            'name'=>$request->name,
            'email'=>$request->email,
        ]);
        session()->flash('success','修改成功');
        return redirect()->route('admins.index');
    }
}
