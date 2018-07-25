<?php

namespace App\Http\Controllers;

use App\model\Activity;
use Illuminate\Http\Request;

class ActivitiesController extends Controller
{
    //展示
    public function index(Request $request){
        $time=date('Y-m-d\TH:i',time());
        if (!$request->status){
            $activities=Activity::paginate(5);
        }elseif($request->status=='before'){
            $activities=Activity::where('end_time','<',$time)->paginate(5);
        }elseif($request->status=='later'){
            $activities=Activity::where('start_time','>',$time)->paginate(5);
        }elseif($request->status=='now'){
            $activities=Activity::where([
                ['start_time','<=',$time],
                ['end_time','>=',$time],
                ])->paginate(5);
        }

        return view('activity/index',['activities'=>$activities,'status'=>$request->status]);
    }
    public function show(Activity $activity){
        return view('activity/show',['activity'=>$activity]);
    }
    //添加
    public function create(){
        return view('activity/create');
    }
    public function store(Request $request){
        $this->validate($request, [
            'title' => 'required|max:50',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time|after:yesterday',
            'the_content' => 'required',
        ],[
            'title.required'=>'请输入活动标题',
            'title.max'=>'活动标题过长',
            'start_time.required'=>'请选择活动开始时间',
            'end_time.required'=>'请选择活动结束时间',
            'end_time.after'=>'结束时间必须大于开始时间,且不能在今天之前',
            'the_content.required'=>'请输入活动内容',
        ]);
        Activity::create([
            'title'=>$request->title,
            'start_time'=>$request->start_time,
            'end_time'=>$request->end_time,
            'content'=>$request->the_content
        ]);
        session()->flash('success','添加成功');
        return redirect()->route('activities.index');
    }
    //删除
    public function destroy(Activity $activity){
        $activity->delete();
        session()->flash('success','删除成功');
        return redirect()->route('activities.index');
    }
    //修改
    public function edit(Activity $activity){
        return view('activity/edit',['activity'=>$activity]);
    }
    public function update(Request $request,Activity $activity){
        $this->validate($request, [
            'title' => 'required|max:50',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time|after:yesterday',
            'the_content' => 'required',
        ],[
            'title.required'=>'请输入活动标题',
            'title.max'=>'活动标题过长',
            'start_time.required'=>'请选择活动开始时间',
            'end_time.required'=>'请选择活动结束时间',
            'end_time.after'=>'结束时间必须大于开始时间,且不能在今天之前',
            'the_content.required'=>'请输入活动内容',
        ]);
        $activity->update([
            'title'=>$request->title,
            'start_time'=>$request->start_time,
            'end_time'=>$request->end_time,
            'content'=>$request->the_content
        ]);
        session()->flash('success','修改成功');
        return redirect()->route('activities.index');
    }
}
