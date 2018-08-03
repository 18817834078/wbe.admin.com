<?php

namespace App\Http\Controllers;

use App\model\Admin;
use App\model\ModelHasPermission;
use App\model\ModelHasRole;
use App\model\Permission;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class AdminsController extends Controller
{
    //展示
    public function index(){
        Permission::set_permission('管理员查看');//设置权限
       $admins=Admin::paginate(5);
        return view('/admin/index',['admins'=>$admins]);
    }
    public function show(Admin $admin){
        Permission::set_permission('管理员查看');//设置权限
        $roles=$admin->getRoleNames();
        $permissions=$admin->getAllPermissions();
        return view('admin/show',['admin'=>$admin,'roles'=>$roles,'permissions'=>$permissions]);
    }
    //添加
    public function create(){
        Permission::set_permission('管理员操作');//设置权限
        $roles=Role::all();
        return view('/admin/create',['roles'=>$roles]);
    }
    public function store(Request $request){
        Permission::set_permission('管理员操作');//设置权限
        $this->validate($request, [
            'name' => 'required|max:50|unique:admins,name',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required',
            're_password' => 'required',
            'roles' => 'required',
        ],[
            'name.required'=>'请输入管理员名字',
            'name.max'=>'管理员名字过长',
            'name.unique'=>'已存在的管理员姓名',
            'email.required'=>'请输入邮箱',
            'email.email'=>'错误的邮箱格式',
            'email.unique'=>'邮箱已被使用',
            'password.required'=>'请输入密码',
            're_password.required'=>'请再次输入密码',
            'roles.required'=>'请选择角色',
        ]);
        if ($request->password!=$request->re_password){
            return back()->withInput()->with('danger','两次密码输入不一致');
        }
        $admin=Admin::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password)
        ]);
        $admin->assignRole($request->roles);

        session()->flash('success','添加成功');
        return redirect()->route('admins.index');
    }
    //删除
    public function destroy(Admin $admin){
        Permission::set_permission('管理员操作');//设置权限
        $admin->delete();
        session()->flash('success','删除成功');
        return redirect()->route('admins.index');
    }
    //修改
    public function edit(Admin $admin){
        Permission::set_permission('管理员操作');//设置权限
        $roles=Role::all();
        $has_roles=$admin->getRoleNames();
        $the_roles=[];
        foreach ($has_roles as $value){
            $the_roles[]=$value;
        }
        return view('/admin/edit',['admin'=>$admin,'the_roles'=>$the_roles,'roles'=>$roles]);
    }
    public function update(Request $request,Admin $admin){
        Permission::set_permission('管理员操作');//设置权限
        $this->validate($request, [
            'name'=>['required','max:50',Rule::unique('admins')->ignore($admin->id)],
            'email'=>['required','email',Rule::unique('admins')->ignore($admin->id)],
            'roles' => 'required',
        ],[
            'name.required'=>'请输入管理员名字',
            'name.max'=>'管理员名字过长',
            'name.unique'=>'已存在的管理员姓名',
            'email.required'=>'请输入邮箱',
            'email.email'=>'错误的邮箱格式',
            'email.unique'=>'邮箱已被使用',
            'roles.required'=>'请选择角色',
        ]);
        $admin->update([
            'name'=>$request->name,
            'email'=>$request->email,
        ]);
        $has_roles=ModelHasRole::select('role_id')->where('model_id','=',$admin->id)->get();
        foreach ($has_roles as $value){
            $admin->removeRole($value->role_id);
        }
        $admin->assignRole($request->roles);

        session()->flash('success','修改成功');
        return redirect()->route('admins.index');
    }
}
