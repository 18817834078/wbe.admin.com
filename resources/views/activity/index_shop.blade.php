@extends('../default_shop')
@section('content')
    <div class="container-fluid">
        <a href="http://wbe.shop.com"><button type="button" class="btn btn-primary">返回主页</button></a>
        {{--<a href="http://wbe.shop.com/activities.index"><button type="button" class="btn btn-primary">查看所有活动</button></a>--}}
    </div>
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
                            <a href={{"http://wbe.admin.com/activity/activity".$activity->id."_shop.html"}}>
                                <button type="submit" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-zoom-in"></span></button>
                            </a>
                        </div>

                    </td>
                </tr>
            @endforeach
        </table>
    </div>

{{--{{ $activities->links() }}--}}
@endsection