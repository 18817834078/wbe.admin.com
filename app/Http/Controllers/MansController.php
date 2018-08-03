<?php

namespace App\Http\Controllers;

use App\model\Address;
use App\model\Permission;
use App\model\User;
use Illuminate\Http\Request;

class MansController extends Controller
{
    //展示
    public function index(Request $request){
        Permission::set_permission('用户查看');//设置权限
        $users=null;
        if ($request->search){
            $users=User::where('username','like','%'.$request->search.'%')->paginate(5);
        }else{
            $users=User::paginate(5);
        }

        return view('user/index',['users'=>$users,'search'=>$request->search]);
    }
    public function show(User $user){
        $address=Address::where('user_id','=',$user->id)->get();
        return view('user/show',['user'=>$user,'address'=>$address]);
    }
    //修改状态
    public function change_status(User $user){
        Permission::set_permission('用户审核');//设置权限
        if($user->status==1){
            $user->update(['status'=>0]);
        }else{
            $user->update(['status'=>1]);
        }
        return redirect('users.index');
    }

}
