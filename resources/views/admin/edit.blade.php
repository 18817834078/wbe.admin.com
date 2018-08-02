@extends('default')
@section('content')
    @include('/error')
    <div>
        <div class="col-xs-3"></div>
        <div class="col-xs-6">
            <form class="form-horizontal" method="post" action="{{route('admins.update',[$admin])}}" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">管理员名字</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="name" value="{{$admin->name}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">邮箱</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="email" value="{{$admin->email}}">
                    </div>
                </div>
                <div class="form-group">
                    <label  for="inputEmail3" class="col-sm-2 control-label">角色</label>
                    <div class="col-sm-10">
                        @foreach($roles as $role)
                            <input type="checkbox" @if(in_array($role->name,$the_roles)) checked @endif name="roles[]" value="{{$role->id}}">
                            {{$role->name}}
                            &emsp;&emsp;
                        @endforeach
                    </div>
                </div>

                {{ csrf_field() }}
                {{ method_field('PATCH') }}
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary">提交</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection