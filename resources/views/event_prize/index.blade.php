@extends('default')
@section('content')
    <div class="container-fluid">
        @if(strtotime($event->prize_date)>time())
        <a  href="{{route('event_prizes.create',['event'=>$event->id])}}"><button type="button" class="btn btn-primary">添加奖品</button></a>
            @endif
    </div>
    <div class="container-fluid">
        <table class="table table-bordered table-hover">
            <tr>
                <th>奖品</th>
                <th>描述</th>
                <th>中奖账号</th>
                <th>操作</th>
            </tr>
            @foreach($event_prizes as $event_prize)
                <tr>
                    <td>{{$event_prize->name}}</td>
                    <td>{{$event_prize->description}}</td>
                    <td>@if($event_prize->member_id) {{$event_prize->shop_user->name}} @else 暂无 @endif</td>
                    <td class="row">
                        @if(strtotime($event->prize_date)>time())
                        <div class="col-xs-1">
                            <a href="{{route('event_prizes.edit',[$event_prize])}}">
                                <button type="submit" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-pencil"></span></button>
                            </a>
                        </div>
                        <div class="col-xs-1">
                            <form action="{{route('event_prizes.destroy',[$event_prize])}}" method="post">
                                <button type="submit" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span></button>
                                <input type="hidden" name="event" value="{{$event->id}}">
                                {{method_field('DELETE')}}
                                {{csrf_field()}}
                            </form>
                        </div>
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

@endsection