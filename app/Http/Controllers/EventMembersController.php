<?php

namespace App\Http\Controllers;

use App\model\EventMember;
use Illuminate\Http\Request;

class EventMembersController extends Controller
{
    public function index(Request $request){
        $event_members=EventMember::where('events_id',$request->event)->get();
        return view('event_member/index',['event_members'=>$event_members]);
    }
}
