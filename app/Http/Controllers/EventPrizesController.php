<?php

namespace App\Http\Controllers;

use App\model\Event;
use App\model\EventPrize;
use Illuminate\Http\Request;

class EventPrizesController extends Controller
{
    //展示
    public function index(Request $request){
        $event=$request->event;
        $event_prizes=EventPrize::where('events_id','=',$event)->get();
        $event=Event::where('id','=',$event)->first();

        return view('event_prize/index',['event_prizes'=>$event_prizes,'event'=>$event]);
    }
    //添加
    public function create(Request $request){
        return view('event_prize/create',['event'=>$request->event]);
    }
    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required|max:50',
            'description' => 'required',
        ],[
            'name.required'=>'请输入奖品名',
            'name.max'=>'奖品名过长',
            'description.required'=>'请输入奖品描述',
        ]);
        EventPrize::create([
            'events_id'=>$request->event,
            'name'=>$request->name,
            'description'=>$request->description,
            'member_id'=>0,
        ]);
        return redirect()->route("event_prizes.index",['event'=>$request->event])->with('success','奖品添加成功');
    }
    //修改
    public function edit(EventPrize $event_prize){
        return view('event_prize/edit',['event_prize'=>$event_prize]);
    }
    public function update(Request $request,EventPrize $event_prize){
        $this->validate($request, [
            'name' => 'required|max:50',
            'description' => 'required',
        ],[
            'name.required'=>'请输入奖品名',
            'name.max'=>'奖品名过长',
            'description.required'=>'请输入奖品描述',
        ]);
        $event_prize->update([
            'name'=>$request->name,
            'description'=>$request->description,
        ]);
        return redirect()->route("event_prizes.index",['event'=>$event_prize->events_id])->with('success','修改成功');

    }
    //删除
    public function destroy(Request $request,EventPrize $event_prize){
        $event_prize->delete();
        return redirect()->route("event_prizes.index",['event'=>$request->event])->with('success','删除成功');
    }
}
