<?php

namespace App\Http\Controllers;

use App\model\RoleHasPermission;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    //展示
    public function index(){
        $roles=Role::all();
        return view('role/index',['roles'=>$roles]);
    }
    public function show(Role $role){
        $permissions=RoleHasPermission::where('role_id','=',$role->id)->get();
        return view('role/show',['role'=>$role,'permissions'=>$permissions]);
    }
    //添加
    public function create(){
        $permissions=Permission::all();
        return view('role/create',['permissions'=>$permissions]);
    }
    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'permissions'=>'required',
        ],[
            'name.required'=>'角色名不能为空',
            'permissions.required'=>'请选择权限',
        ]);
        $role=Role::create(['name'=>$request->name]);
        $role->syncPermissions($request->permissions);
        return redirect()->route('roles.index')->with('success','添加成功');

    }
    //删除
    public function destroy(Role $role){
        $has_permissions=RoleHasPermission::select('permission_id')->where('role_id','=',$role->id)->get();
        foreach ($has_permissions as $value){
            $role->revokePermissionTo($value->permission_id);
        }
        $role->delete();
        return redirect()->route('roles.index')->with('success','删除成功');
    }
    //修改
    public function edit(Role $role){
        $permissions=Permission::all();
        return view('role/edit',['role'=>$role,'permissions'=>$permissions]);
    }
    public function update(Role $role,Request $request){
        $this->validate($request,[
            'name'=>'required',
            'permissions'=>'required',
        ],[
            'name.required'=>'角色名不能为空',
            'permissions.required'=>'请选择权限',
        ]);
        $has_permissions=RoleHasPermission::select('permission_id')->where('role_id','=',$role->id)->get();
        foreach ($has_permissions as $value){
            $role->revokePermissionTo($value->permission_id);
        }
        $role->update(['name'=>$request->name]);
        $role->syncPermissions($request->permissions);
        return redirect()->route('roles.index')->with('success','添加成功');
    }
}
