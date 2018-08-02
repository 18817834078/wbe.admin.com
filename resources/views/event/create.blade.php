@extends('default')
@section('content')
    @include('/error')
    <div>
        @include('vendor.ueditor.assets')
        <!-- 实例化编辑器 -->
            <script type="text/javascript">
                var ue = UE.getEditor('container');
                ue.ready(function() {
                    ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
                });
            </script>

        <div class="col-xs-3"></div>
        <div class="col-xs-6">
            <form class="form-horizontal" method="post" action="{{route('events.store')}}" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">活动标题</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="title" value="{{old('title')}}" placeholder="title">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">报名开始时间</label>
                    <div class="col-sm-10">
                        <input type="datetime-local" class="form-control" name="signup_start" value="{{old('signup_start')}}" >
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">报名结束时间</label>
                    <div class="col-sm-10">
                        <input type="datetime-local" class="form-control" name="signup_end" value="{{old('signup_end')}}" >
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">开奖时间</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" name="prize_date" value="{{old('prize_date')}}" >
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">人数限制</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="signup_num" value="{{old('signup_num')}}" >
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">活动内容</label>
                    <div class="col-sm-10">
                        <textarea id="container" name="the_content" type="text/plain">{{old('the_content')}}</textarea>
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