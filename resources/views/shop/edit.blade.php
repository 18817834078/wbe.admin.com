@extends('default')
@section('content')
    @include('/error')
    <!--引入CSS-->
    <link rel="stylesheet" type="text/css" href="/webupload/webuploader.css">
    <!--引入JS-->
    <script type="text/javascript" src="/webupload/webuploader.js"></script>
    <div>
        <div class="col-xs-3"></div>
        <div class="col-xs-6">
            <form class="form-horizontal" method="post" action="{{route('shops.update',[$shop,$shop_user])}}" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">商家账户</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" readonly name="name" value="{{$shop_user->name}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">商家邮箱</label>
                    <div class="col-sm-10">
                        <input type="text" readonly class="form-control" name="email" value="{{$shop_user->email}}">
                    </div>
                </div>
                <br>
                <hr>
                <br>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">店铺名称</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="shop_name" value="{{$shop->shop_name}}" placeholder="shop_name">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-xs-2 control-label">是否品牌</label>
                    <div class="col-xs-1">
                        <input type="checkbox" name="brand" value=1 @if($shop->brand) checked @endif>
                    </div>
                    <label style="color: red;font-size: small;text-align: left" class="col-sm-3 control-label">选中即为品牌店</label>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-xs-2 control-label">准时送达</label>
                    <div class="col-xs-1">
                        <input type="checkbox" name="on_time" value=1 @if($shop->on_time) checked @endif>
                    </div>
                    <label style="color: red;font-size: small;text-align: left" class="col-sm-3 control-label">选中即为保证准时</label>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-xs-2 control-label">蜂鸟配送</label>
                    <div class="col-xs-1">
                        <input type="checkbox" name="fengniao" value=1 @if($shop->fengniao) checked @endif>
                    </div>
                    <label style="color: red;font-size: small;text-align: left" class="col-sm-4 control-label">选中表示使用蜂鸟配送</label>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-xs-2 control-label">保标记</label>
                    <div class="col-xs-1">
                        <input type="checkbox" name="bao" value=1 @if($shop->bao) checked @endif>
                    </div>
                    <label style="color: red;font-size: small;text-align: left" class="col-sm-3 control-label">保标记</label>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-xs-2 control-label">票标记</label>
                    <div class="col-xs-1">
                        <input type="checkbox" name="piao" value=1 @if($shop->piao) checked @endif>
                    </div>
                    <label style="color: red;font-size: small;text-align: left" class="col-sm-3 control-label">票标记</label>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-xs-2 control-label">准标记</label>
                    <div class="col-xs-1">
                        <input type="checkbox" name="zhun" value=1 @if($shop->zhun) checked @endif>
                    </div>
                    <label style="color: red;font-size: small;text-align: left" class="col-sm-3 control-label">准标记</label>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">起送金额</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="start_send" value="{{$shop->start_send}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">配送费</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="send_cost" value="{{$shop->send_cost}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">店公告</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="notice" value="{{$shop->notice}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">优惠信息</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="discount" value="{{$shop->discount}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">店铺分类</label>
                    <div class="col-sm-10">
                        <select name="shop_category_id" class="form-control">
                            @foreach($shop_categories as $shop_category)
                                <option @if($shop->shop_category_id==$shop_category->id) selected @endif value="{{$shop_category->id}}">{{$shop_category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-2 control-label">
                        <label for="inputEmail3" class="avatar-label">店铺图片</label>
                    </div>
                    <div class="col-xs-5">
                        <!--webupload dom结构部分-->
                        <div id="uploader-demo">
                            <!--用来存放item-->
                            <div id="fileList" class="uploader-list"></div>
                            <div id="filePicker">选择图片</div>
                            <input id="img" type="hidden" name="shop_img" value="">
                        </div>
                        <script>
                            // 初始化Web Uploader
                            var uploader = WebUploader.create({
                                // 选完文件后，是否自动上传。
                                auto: true,
                                // swf文件路径
                                //swf: BASE_URL + '/js/Uploader.swf',
                                // 文件接收服务端。
                                server: "{{route('web_upload_shop')}}",
                                // 选择文件的按钮。可选。
                                // 内部根据当前运行是创建，可能是input元素，也可能是flash.
                                pick: '#filePicker',
                                // 只允许选择图片文件。
                                accept: {
                                    title: 'Images',
                                    extensions: 'gif,jpg,jpeg,bmp,png',
                                    mimeTypes: 'image/*'
                                },
                                formData:{
                                    _token:"{{csrf_token()}}"
                                }
                            });
                            uploader.on( 'uploadSuccess', function( file,response ) {
                                $('#img_callback').attr('src',response.file_name);
                                $('#img').attr('value',response.file_name);
                            });
                        </script>

                    </div>
                    <div class="col-xs-4">
                        <img id="img_callback" height="50" src="{{$shop->shop_img}}">
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