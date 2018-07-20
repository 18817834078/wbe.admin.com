@extends('default')
@section('content')
    @include('/error')
    <div>
        <div class="col-xs-3"></div>
        <div class="col-xs-6">
            <form class="form-horizontal" method="post" action="{{route('shop_categories.update',[$shop_category])}}" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">分类名称</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="name" value="{{$shop_category->name}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-xs-2 control-label">是否显示</label>
                    <div class="col-xs-1">
                        <input type="checkbox" name="status" value="1" @if($shop_category->status==1) checked @endif>
                    </div>
                    <label style="color: red;font-size: small" class="col-sm-3 control-label">选中即为显示</label>
                </div>
                <div class="form-group">
                    <div class="col-xs-2 control-label">
                        <label for="inputEmail3" class="avatar-label">上传图片</label>
                    </div>
                    <div class="col-xs-4">
                        <input type="file" name="img">
                    </div>
                    <div class="col-xs-5">
                        <img height="50" src="{{$shop_category->img}}">
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