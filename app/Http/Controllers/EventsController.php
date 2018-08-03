<?php

namespace App\Http\Controllers;

use App\model\Event;
use App\model\EventMember;
use App\model\EventPrize;
use App\model\Permission;
use App\model\ShopUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EventsController extends Controller
{
    //展示
    public function index(){
        Permission::set_permission('管理抽奖活动');//设置权限
        $events=Event::paginate(5);
        return view('event/index',['events'=>$events]);
    }
    public function show(Event $event){
        Permission::set_permission('管理抽奖活动');//设置权限
        return view('event/show',['event'=>$event]);
    }
    //添加
    public function create(){
        Permission::set_permission('管理抽奖活动');//设置权限
        return view('event/create');
    }
    public function store(Request $request){
        Permission::set_permission('管理抽奖活动');//设置权限
        $this->validate($request, [
            'title' => 'required|max:50',
            'signup_start' => 'required',
            'signup_end' => 'required|after:signup_start|after:today',
            'prize_date' => 'required|after:signup_start',
            'signup_num' => 'required|integer',
            'the_content' => 'required',
        ],[
            'title.required'=>'请输入活动标题',
            'title.max'=>'活动标题过长',
            'signup_start.required'=>'请选择活动开始时间',
            'signup_end.required'=>'请选择活动结束时间',
            'prize_date.required'=>'请选择开奖时间',
            'signup_end.after'=>'结束时间必须大于开始时间,且不能在今天之前',
            'prize_date.after'=>'开奖时间必须大于开始时间,且不能在今天之前',
            'signup_num.required'=>'请输入限制报名的人数',
            'signup_num.integer'=>'报名的人数必须是一个整数数字',
            'the_content.required'=>'请输入活动内容',
        ]);
        Event::create([
            'title'=>$request->title,
            'signup_start'=>strtotime($request->signup_start),
            'signup_end'=>strtotime($request->signup_end),
            'prize_date'=>$request->prize_date,
            'signup_num'=>$request->signup_num,
            'content'=>$request->the_content,
            'is_prize'=>0,

        ]);
        return redirect()->route('events.index')->with('success','活动添加成功');


    }
    //删除
    public function destroy(Event $event){
        Permission::set_permission('管理抽奖活动');//设置权限
        $event->delete();
        return redirect()->route('events.index')->with('success','活动删除成功');
    }
    //修改
    public function edit(Event $event){
        Permission::set_permission('管理抽奖活动');//设置权限
        return view('event.edit',['event'=>$event]);
    }
    public function update(Request $request,Event $event){
        Permission::set_permission('管理抽奖活动');//设置权限
        $this->validate($request, [
            'title' => 'required|max:50',
            'signup_start' => 'required',
            'signup_end' => 'required|after:signup_start|after:today',
            'prize_date' => 'required|after:signup_start',
            'signup_num' => 'required|integer',
            'the_content' => 'required',
        ],[
            'title.required'=>'请输入活动标题',
            'title.max'=>'活动标题过长',
            'signup_start.required'=>'请选择活动开始时间',
            'signup_end.required'=>'请选择活动结束时间',
            'prize_date.required'=>'请选择开奖时间',
            'signup_end.after'=>'结束时间必须大于开始时间,且不能在今天之前',
            'prize_date.after'=>'开奖时间必须大于开始时间,且不能在今天之前',
            'signup_num.required'=>'请输入限制报名的人数',
            'signup_num.integer'=>'报名的人数必须是一个整数数字',
            'the_content.required'=>'请输入活动内容',
        ]);
        $event->update([
            'title'=>$request->title,
            'signup_start'=>strtotime($request->signup_start),
            'signup_end'=>strtotime($request->signup_end),
            'prize_date'=>$request->prize_date,
            'signup_num'=>$request->signup_num,
            'content'=>$request->the_content,
        ]);
        return redirect()->route('events.index')->with('success','活动修改成功');
    }
    //开奖
    public function open(Request $request){
        Permission::set_permission('管理抽奖活动');//设置权限
        $the_event=Event::where('id',$request->event)->first();
        if ($the_event->is_prize){
            return back()->with('danger','此活动已开奖');
        }
        $member_ids=[];
        $prize_ids=[];
        foreach(EventMember::select('member_id')->where('events_id',$request->event)->get() as $value){
            $member_ids[]=$value->member_id;
        }
        foreach(EventPrize::select('id')->where('events_id',$request->event)->get() as $value){
            $prize_ids[]=$value->id;
        }
        shuffle($prize_ids);
        shuffle($member_ids);
        if (count($prize_ids)>=count($member_ids)){
            $prize_ids=array_slice($prize_ids,0,count($member_ids));
        }
        foreach ($prize_ids as $key=>$prize_id){
            $event_prize=EventPrize::where('id',$prize_id)->first();
            $event_prize->update([
                'member_id'=>$member_ids[$key]
            ]);
            $email=ShopUser::where('id',$member_ids[$key])->first()->email;
            Mail::raw('您在我不饿平台的'.$the_event->title.'活动中中奖了!奖品为'.$event_prize->name.',请登录查看',function ($message) use($email){
                $message->subject('中奖通知');
                $message->to($email);
            });

        }
        $the_event->update([
            'is_prize'=>1,
        ]);
        return redirect()->route("event_prizes.index",['event'=>$request->event])->with('success','已开奖,请查看开奖结果');

    }
}
