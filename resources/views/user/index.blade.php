@extends('default')
@section('content')
    <div class="container-fluid">
        <a href="/"><button type="button" class="btn btn-primary">返回首页</button></a>
    </div>
    <br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-6">
                <form  action="{{route('users.index')}}" method="get">
                    <div class="row">
                        <div class="col-xs-10">
                            <input type="text" class="form-control" name="search" value="{{$search}}">
                        </div>
                        <div class="col-xs-2">
                            <button type="submit" class="btn btn-default">搜索</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <table class="table table-bordered table-hover">
            <tr>
                <th>用户名</th>
                <th>联系方式</th>
                <th>状态</th>
                <th>创建时间</th>
                <th>操作</th>
            </tr>
            @foreach($users as $user)
                <tr>
                    <td>{{$user->username}}</td>
                    <td>{{$user->tel}}</td>
                    <td>@if($user->status==1) 正常 @else 禁用 @endif</td>
                    <td>{{substr($user->created_at,0,10)}}</td>
                    <td class="row">
                        <div class="col-xs-2">
                            <a href="{{route('users.show',[$user])}}">
                                <button type="submit" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-zoom-in"></span></button>
                            </a>
                        </div>
                        <div class="col-xs-2">
                            <form action="{{route('users.change_status',[$user])}}" method="post">
                                <button type="submit" class="btn btn-danger btn-sm">@if($user->status==1) 禁用 @else 解禁 @endif</button>
                                {{csrf_field()}}
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

{{ $users->appends([$search])->links() }}
@endsection