@extends('default')
@section('content')
    @include('/error')
    <div>
        <div class="col-xs-3"></div>
        <div class="col-xs-6">
            <form class="form-horizontal" method="post" action="{{route('reset_password_store')}}" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">管理员名字</label>
                    <div class="col-sm-10">
                        <input type="text" readonly class="form-control" name="name" value="{{$admin->name}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">邮箱</label>
                    <div class="col-sm-10">
                        <input type="text" readonly class="form-control" name="email" value="{{$admin->email}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">新密码</label>
                    <div class="col-sm-10">
                        <input type="password"  class="form-control" name="new_password">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">再次输入</label>
                    <div class="col-sm-10">
                        <input type="password"  class="form-control" name="re_password">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">原密码</label>
                    <div class="col-sm-10">
                        <input type="password"  class="form-control" name="old_password">
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" class="col-sm-2 control-label">验证码</label>
                    <div class="col-sm-10 row">
                        <div class="col-xs-8">
                            <input type="text"  class="form-control" name="captcha">
                        </div>
                        <div class="col-xs-4">
                            <img width="" class="thumbnail captcha" src="{{ captcha_src('default') }}"
                                 onclick="this.src='/captcha/default?'+Math.random()" title="点击图片重新获取验证码">
                        </div>

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