@extends('default')
@section('content')
    <div class="container-fluid row">
        <div class="col-xs-2">
            <a href="{{route('events.create')}}"><button type="button" class="btn btn-primary">添加新活动</button></a>
        </div>

    </div>
    <br>
    <div class="container-fluid">
        <table class="table table-bordered table-hover">
            <tr>
                <th>活动名称</th>
                <th>报名开始时间</th>
                <th>报名结束时间</th>
                <th>开奖时间</th>
                <th>报名人数限制</th>
                <th>是否已开奖</th>
                <th>操作</th>
            </tr>
            @foreach($events as $event)
                <tr>
                    <td>{{$event->title}}</td>
                    <td>{{date('Y-m-d H:i',$event->signup_start)}}</td>
                    <td>{{date('Y-m-d H:i',$event->signup_end)}}</td>
                    <td>{{substr($event->prize_date,0,16)}}</td>
                    <td>{{$event->signup_num}}</td>
                    <td>@if($event->is_prize) 已开奖 @else 未开奖 @endif</td>
                    <td class="row">
                        <div class="col-xs-2">
                            <a href="{{route('events.show',[$event])}}">
                                <button type="submit" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-zoom-in"></span></button>
                            </a>
                        </div>

                        <div class="col-xs-2">
                            <a href="{{route('events.edit',[$event])}}">
                                <button type="submit" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-pencil"></span></button>
                            </a>
                        </div>
                        <div class="col-xs-2">
                            <form action="{{route('events.destroy',[$event])}}" method="post">
                                <button type="submit" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span></button>
                                {{method_field('DELETE')}}
                                {{csrf_field()}}
                            </form>
                        </div>
                        <div class="col-xs-2">
                            <a href="{{route('event_prizes.index',['event'=>$event])}}">
                                <button type="submit" class="btn  btn-sm">奖品设定</button>
                            </a>
                        </div>
                        <div class="col-xs-2">
                            <a href="{{route('event_members.index',['event'=>$event])}}">
                                <button type="submit" class="btn  btn-sm">报名查看</button>
                            </a>
                        </div>
                        @if(!$event->is_prize)
                        <div class="col-xs-2">
                            <a href="{{route('open',['event'=>$event])}}">
                                <button type="submit" class="btn  btn-sm">开奖</button>
                            </a>
                        </div>
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

{{ $events->links() }}
@endsection