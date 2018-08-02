@extends('default')
@section('content')
    <div class="container-fluid">
        @can('管理员操作')
        <a href="{{route('admins.create')}}"><button type="button" class="btn btn-primary">添加管理员</button></a>
            @endcan
    </div>
    <div class="container-fluid">
        <h1>用户角色</h1>
        <br>
        <li style="font-size: large">用户名:{{$admin->name}}</li>
        <li style="font-size: large">用户角色:
            @foreach($roles as $role)
                <span style="font-size: medium">{{$role}},</span>
            @endforeach
        </li>
        <li style="font-size: large">用户权限:
            @foreach($permissions as $permission)
                <span style="font-size: medium">{{$permission->name}},</span>
            @endforeach
        </li>

    </div>
@endsection