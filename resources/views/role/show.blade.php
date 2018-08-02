@extends('default')
@section('content')
        <div class="col-xs-1 container">
            <div>
                <div><br><br><br> </div>
                <a href="{{route('permissions.index')}}"><button type="button" class="btn btn-primary">权限列表</button></a>
                <br> <br>
                <a href="{{route('roles.index')}}"><button type="button" class="btn btn-primary">角色列表</button></a>
            </div>
            <div><br> </div>

        </div>
    <div class="container-fluid col-xs-11">
        <h1>角色权限</h1>
        <br>
        <li style="font-size: large">角色名:{{$role->name}}</li>
        <li style="font-size: large">角色权限:</li>
        @foreach($permissions as $permission)
            <li style="font-size: medium">{{$permission->permission->name}}</li>
        @endforeach
    </div>



@endsection