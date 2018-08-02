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
        <h1>角色列表</h1>
        <a href="{{route('roles.create')}}"><button type="button" class="btn btn-primary">添加角色</button></a>
        <br>
        <table class="table table-bordered table-hover">
            <tr>
                <th>角色名</th>
                <th>操作</th>
            </tr>
            @foreach($roles as $role)
            <tr>
                <td>
                    {{$role->name}}
                </td>
                <td>
                    <div class="col-xs-2">
                        <a href="{{route('roles.show',[$role])}}">
                            <button type="submit" class="btn btn-primary btn-sm">查看权限</button>
                        </a>
                    </div>
                    <div class="col-xs-2">
                        <a href="{{route('roles.edit',[$role])}}">
                            <button type="submit" class="btn btn-primary btn-sm">修改角色</button>
                        </a>
                    </div>

                    <div class="col-xs-2">
                        <form action="{{route('roles.destroy',[$role])}}" method="post">
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



@endsection