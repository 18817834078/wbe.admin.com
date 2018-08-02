@extends('default')
@section('content')
    @include('/error')
    <div>
        <div class="col-xs-3"></div>
        <div class="col-xs-6">
            <form class="form-horizontal" method="post" action="{{route('admins.store')}}" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">管理员名字</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="name" value="{{old('name')}}" placeholder="name">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">邮箱</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="email" value="{{old('email')}}" placeholder="email">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">密码</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" name="password">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">再次输入</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" name="re_password">
                    </div>
                </div>
                <div class="form-group">
                    <label  for="inputEmail3" class="col-sm-2 control-label">角色</label>
                    <div class="col-sm-10">
                        @foreach($roles as $role)
                            <input type="checkbox" name="roles[]" value="{{$role->id}}">
                            {{$role->name}}
                            &emsp;&emsp;
                        @endforeach
                    </div>
                </div>

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