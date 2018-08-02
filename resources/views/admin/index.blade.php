@extends('default')
@section('content')
    <div class="container-fluid">
        @can('管理员操作')
        <a href="{{route('admins.create')}}"><button type="button" class="btn btn-primary">添加管理员</button></a>
            @endcan
    </div>
    <div class="container-fluid">
        <table class="table table-bordered table-hover">
            <tr>
                <th>管理员名称</th>
                <th>管理员邮箱</th>
                <th>操作</th>
            </tr>
            @foreach($admins as $admin)
                <tr>
                    <td>{{$admin->name}}</td>
                    <td>{{$admin->email}}</td>
                    <td class="row">
                        @can('管理员操作')
                        <div class="col-xs-1">
                            <a href="{{route('admins.edit',[$admin])}}">
                                <button type="submit" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-pencil"></span></button>
                            </a>
                        </div>

                        <div class="col-xs-1">
                            <form action="{{route('admins.destroy',[$admin])}}" method="post">
                                <button type="submit" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span></button>
                                {{method_field('DELETE')}}
                                {{csrf_field()}}
                            </form>
                        </div>
                            @endcan
                            @can('管理员查看')
                        <div class="col-xs-2">
                            <a href="{{route('admins.show',[$admin])}}">
                                <button type="submit" class="btn btn-primary btn-sm">查看权限</button>
                            </a>
                        </div>
                            @endcan
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

{{ $admins->links() }}
@endsection