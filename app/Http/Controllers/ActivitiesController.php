<?php

namespace App\Http\Controllers;

use App\model\Activity;
use App\model\Permission;
use Illuminate\Http\Request;

class ActivitiesController extends Controller
{
    //展示
    public function index(Request $request){
        Permission::set_permission('活动查看');//设置权限
        //shop端页面生成
        $activities=Activity::where('end_time','>=',date('Y-m-d',time()))->get();
        $activities_shop=view('activity/index_shop',['activities'=>$activities]);
        file_put_contents('activity/activities_shop.html',$activities_shop);
        foreach ($activities as $val){
            $activityID_shop=view('activity/show_shop',['activity'=>$val]);
            file_put_contents('activity/activity'.$val->id.'_shop.html',$activityID_shop);
        }
        //admin页面展示
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
        Permission::set_permission('活动查看');//设置权限
        return view('activity/show',['activity'=>$activity]);
    }
    //添加
    public function create(){
        Permission::set_permission('活动操作');//设置权限
        return view('activity/create');
    }
    public function store(Request $request){
        Permission::set_permission('活动操作');//设置权限
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
        Permission::set_permission('活动操作');//设置权限
        $activity->delete();
        session()->flash('success','删除成功');
        return redirect()->route('activities.index');
    }
    //修改
    public function edit(Activity $activity){
        Permission::set_permission('活动操作');//设置权限
        return view('activity/edit',['activity'=>$activity]);
    }
    public function update(Request $request,Activity $activity){
        Permission::set_permission('活动操作');//设置权限
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
