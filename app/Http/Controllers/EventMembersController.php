<?php

namespace App\Http\Controllers;

use App\model\EventMember;
use App\model\Permission;
use Illuminate\Http\Request;

class EventMembersController extends Controller
{
    public function index(Request $request){
        Permission::set_permission('管理抽奖活动');//设置权限
        $event_members=EventMember::where('events_id',$request->event)->get();
        return view('event_member/index',['event_members'=>$event_members]);
    }
}
