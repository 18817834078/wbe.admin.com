@extends('default')
@section('content')
    @include('/error')
    <div>
        <div class="col-xs-3"></div>
        <div class="col-xs-6">

            <form class="form-horizontal" method="post" action="{{route('navs.update',[$nav])}}" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">导航名</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="name" value="{{$nav->name}}" placeholder="name">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">导航地址</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="url" value="{{$nav->url}}" placeholder="url">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">关联权限</label>
                    <div class="col-sm-10">
                        <select name="permission_id" class="form-control">
                            @foreach($permissions as $permission)
                            <option @if($permission->id==$nav->permission_id) selected @endif value="{{$permission->id}}">{{$permission->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">上层菜单</label>
                    <div class="col-sm-10">
                        <select name="pid" class="form-control">
                            <option @if($nav->pid==0) selected @endif value="0">顶级菜单</option>
                            @foreach($p_navs as $p_nav)
                                <option @if($nav->pid==$p_nav->id) selected @endif value="{{$p_nav->id}}">{{$p_nav->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                {{ method_field('PATCH') }}
                {{ csrf_field() }}

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary">提交</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection