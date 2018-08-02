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
        <h1>权限列表</h1>
        <div class="row">
            <div class="col-xs-6">
                <form  action="{{route('permissions.create')}}" method="post">
                    <div class="row">
                        <div class="col-xs-10">
                            <input type="text" class="form-control" name="permission_name">
                        </div>
                        <div class="col-xs-2">
                            <button type="submit" class="btn btn-default">添加权限</button>
                        </div>
                    </div>
                    {{ csrf_field() }}
                </form>
            </div>
        </div>
        <br>
        <table class="table table-bordered table-hover">
            <tr>
                <th>权限名</th>
                <th>操作</th>
            </tr>
            @foreach($permissions as $permission)
            <tr>
                <td>
                    <div class="col-xs-3">
                        {{$permission->name}}
                    </div>
                    <div class="col-xs-5">
                        <form  action="{{route('permissions.update',[$permission])}}" method="post">
                            <div class="row">
                                <div class="col-xs-10">
                                    <input type="text" class="form-control" name="permission_name">
                                </div>
                                <div class="col-xs-2">
                                    <button type="submit" class="btn btn-default">修改权限名</button>
                                </div>
                            </div>
                            {{method_field('PATCH')}}
                            {{ csrf_field() }}
                        </form>
                    </div>
                </td>
                <td>
                        <div class="col-xs-2">
                            <form action="{{route('permissions.destroy',[$permission])}}" method="post">
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