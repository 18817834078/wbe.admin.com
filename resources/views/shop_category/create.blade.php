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
            <form class="form-horizontal" method="post" action="{{route('shop_categories.store')}}" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">分类名称</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="name" value="{{old('name')}}" placeholder="name">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-xs-2 control-label">是否显示</label>
                    <div class="col-xs-1">
                        <input type="checkbox" name="status" value="1">
                    </div>
                    <label style="color: red;font-size: small" class="col-sm-3 control-label">选中即为显示</label>
                </div>
                <div class="form-group">
                    <div class="col-xs-2 control-label">
                        <label for="inputEmail3" class="avatar-label">上传图片</label>
                    </div>
                    <div class="col-xs-5">
                        <!--webupload dom结构部分-->
                        <div id="uploader-demo">
                            <!--用来存放item-->
                            <div id="fileList" class="uploader-list"></div>
                            <div id="filePicker">选择图片</div>
                            <input id="img" type="hidden" name="img" value="">
                            <div>
                                <img height="50" id="img_callback">
                            </div>
                        </div>
                        <script>
                            // 初始化Web Uploader
                            var uploader = WebUploader.create({
                                // 选完文件后，是否自动上传。
                                auto: true,
                                // swf文件路径
                                //swf: BASE_URL + '/js/Uploader.swf',
                                // 文件接收服务端。
                                server: "{{route('web_upload')}}",
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