@extends('default')
@section('content')

<div class="row">
    <div class="col-xs-2"></div>

    <div class="col-xs-6">
        @include('/error')
        <form class="form-horizontal" method="post" action="{{route('login')}}" enctype="multipart/form-data">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">用户名</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="name" name="name">
                </div>
            </div>

            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">密码</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" name="password">
                </div>
            </div>

            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">验证码</label>
                <div class="col-sm-10 row">
                    <div class="col-xs-8">
                        <input id="captcha" type="text" class="form-control" name="captcha">
                    </div>
                    <div class="col-xs-4">
                        <img width="" class="thumbnail captcha" src="{{ captcha_src('default') }}"
                             onclick="this.src='/captcha/default?'+Math.random()" title="点击图片重新获取验证码">
                    </div>
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

