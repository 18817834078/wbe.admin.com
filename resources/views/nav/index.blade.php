@extends('default')
@section('content')
    <div class="container-fluid">
        <a href="{{route('navs.create')}}"><button type="button" class="btn btn-primary">添加导航</button></a>
    </div>
    <div class="container-fluid">
        <table class="table table-bordered table-hover">
            <tr>
                <th>导航名称</th>
                <th>导航地址</th>
                <th>关联权限</th>
                <th>上层菜单</th>

                <th>操作</th>
            </tr>
            @foreach($navs as $nav)
                <tr>
                    <td>{{$nav->name}}</td>
                    <td>{{$nav->url}}</td>
                    <td>{{$nav->permission->name}}</td>
                    <td>@if($nav->pid==0) 顶级菜单 @else {{$nav->pid_name->name}} @endif</td>
                    <td class="row">

                        <div class="col-xs-2">
                            <a href="{{route('navs.edit',[$nav])}}">
                                <button type="submit" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-pencil"></span></button>
                            </a>
                        </div>
                        <div class="col-xs-2">
                            <form action="{{route('navs.destroy',[$nav])}}" method="post">
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