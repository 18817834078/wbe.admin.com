<?php

namespace App\Http\Controllers;

use App\model\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    //展示
    public function index(){
        $users=User::paginate(5);
        return view('user/index',['users'=>$users]);
    }
    public function show(){

    }
    //修改状态
    public function status(){

    }
}
