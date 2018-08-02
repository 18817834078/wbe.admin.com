<?php

namespace App\Http\Controllers;

use App\model\Nav;
use App\model\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NavsController extends Controller
{



    //展示
    public function index(){
        $navs=Nav::all();
        return view('nav/index',['navs'=>$navs]);
    }
    //添加
    public function create(){
        $permissions=Permission::all();
        $p_navs=Nav::where('pid','=',0)->get();
        return view('nav/create',['permissions'=>$permissions,'p_navs'=>$p_navs]);
    }
    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required|max:50|unique:navs,name',
            'url' => 'required',
        ],[
            'name.required'=>'请输入导航名名字',
            'name.max'=>'导航名过长',
            'name.unique'=>'已存在的导航名',
            'url.required'=>'请输入导航地址',
        ]);
        if(Nav::create([
            'name'=>$request->name,
            'url'=>$request->url,
            'permission_id'=>$request->permission_id,
            'pid'=>$request->pid,
        ])){
            return redirect()->route('navs.index')->with('success','添加成功');
        }else{
            return back()->with('danger','添加失败');
        }


    }
    //修改
    public function edit(Nav $nav){
        $permissions=Permission::all();
        $p_navs=Nav::where([['pid','=',0],['id','!=',$nav->id]])->get();
        return view('nav/edit',['nav'=>$nav,'permissions'=>$permissions,'p_navs'=>$p_navs]);
    }
    public function update(Request $request,Nav $nav){
        $this->validate($request, [
            'name' => 'required|max:50',
            'url' => 'required',
        ],[
            'name.required'=>'请输入导航名名字',
            'name.max'=>'导航名过长',
            'url.required'=>'请输入导航地址',
        ]);
        $nav->update([
            'name'=>$request->name,
            'url'=>$request->url,
            'permission_id'=>$request->permission_id,
            'pid'=>$request->pid,
        ]);
        return redirect()->route('navs.index')->with('success','修改成功');
    }
    //删除
    public function destroy(Nav $nav){
        if (Nav::where('pid','=',$nav->id)->first()){
            return back()->with('danger','尚存在下级分类.不可删除');
        }
        $nav->delete();
        return redirect()->route('navs.index')->with('success','删除成功');
    }




}
