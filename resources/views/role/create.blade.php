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
        <h1>添加角色</h1>
        @include('error')
        <form action="{{route('roles.store')}}" method="post">

            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-1 control-label">角色名</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="name" value="{{old('name')}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-1 control-label">权限</label>
                <div class="col-sm-10">
                    @foreach($permissions as $permission)
                        <label>
                            <input type="checkbox" name="permissions[]" value="{{$permission->id}}">
                            {{$permission->name}}
                        </label>
                        &emsp;&emsp;
                    @endforeach
                </div>
            </div>

            {{ csrf_field() }}
            <button type="submit" class="btn btn-primary">提交</button>
        </form>
    </div>



@endsection