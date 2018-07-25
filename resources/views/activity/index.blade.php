@extends('default')
@section('content')
    <div class="container-fluid row">
        <div class="col-xs-2">
            <a href="{{route('activities.create')}}"><button type="button" class="btn btn-primary">添加新活动</button></a>
        </div>
        <div class="col-xs-7 row">
            <form navbar-form navbar-left action="{{route('activities.index')}}" method="get">
                <div class="col-xs-5">
                    <select class="form-control" name="status">
                        <option value="">全部</option>
                        <option value="before">已结束</option>
                        <option value="now">进行中</option>
                        <option value="later">未开始</option>
                    </select>
                </div>
               <div class="col-xs-2">
                   <button type="submit" class="btn btn-default">搜索</button>
               </div>
            </form>
        </div>
    </div>
    <br>
    <div class="container-fluid">
        <table class="table table-bordered table-hover">
            <tr>
                <th>活动名称</th>
                <th>开始时间</th>
                <th>结束时间</th>
                <th>操作</th>
            </tr>
            @foreach($activities as $activity)
                <tr>
                    <td>{{$activity->title}}</td>
                    <td>{{substr($activity->start_time,0,16)}}</td>
                    <td>{{substr($activity->end_time,0,16)}}</td>
                    <td class="row">
                        <div class="col-xs-2">
                            <a href="{{route('activities.show',[$activity])}}">
                                <button type="submit" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-zoom-in"></span></button>
                            </a>
                        </div>
                        <div class="col-xs-2">
                            <a href="{{route('activities.edit',[$activity])}}">
                                <button type="submit" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-pencil"></span></button>
                            </a>
                        </div>
                        <div class="col-xs-2">
                            <form action="{{route('activities.destroy',[$activity])}}" method="post">
                                <button type="submit" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span></button>
                                {{method_field('DELETE')}}
                                {{csrf_field()}}
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

{{ $activities->appends(['status'=>$status])->links() }}
@endsection