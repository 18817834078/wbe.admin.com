<?php

namespace App\Http\Controllers;

use App\model\RoleHasPermission;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

class PermissionsController extends Controller
{
    //权限展示
    public function index(){
        \App\model\Permission::set_permission('权限查看');//设置权限
        $permissions=Permission::all();
        return view('permission/index',['permissions'=>$permissions]);
    }
    //权限添加
    public function create(Request $request){
        \App\model\Permission::set_permission('权限管理');//设置权限
        if (!$request->permission_name){
            return back()->with('danger','未填写权限名');
        }else{
            Permission::create(['name'=>$request->permission_name]);
            return redirect()->route('permissions.index')->with('success','添加成功');
        }
    }
    //权限删除
    public function destroy(Permission $permission){
        \App\model\Permission::set_permission('权限管理');//设置权限
        if(RoleHasPermission::where('permission_id','=',$permission->id)->first()){
            return redirect()->route('permissions.index')->with('danger','不可删除已被角色拥有的权限');
        }
        $permission->delete();
        return redirect()->route('permissions.index')->with('success','删除成功');
    }
    //权限修改
    public function update(Request $request,Permission $permission){
        \App\model\Permission::set_permission('权限管理');//设置权限
        if (!$request->permission_name){
            return back()->with('danger','未填写权限名');
        }else{
            $permission->update(['name'=>$request->permission_name]);
            return redirect()->route('permissions.index')->with('success','修改成功');
        }
    }


}
