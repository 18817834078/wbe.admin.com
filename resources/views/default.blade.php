<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link href="/css/bootstrap.css" rel="stylesheet">

    <!-- HTML5 shim 和 Respond.js 是为了让 IE8 支持 HTML5 元素和媒体查询（media queries）功能 -->
    <!-- 警告：通过 file:// 协议（就是直接将 html 页面拖拽到浏览器中）访问页面时 Respond.js 不起作用 -->
    <!--[if lt IE 9]>
    <!--<script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>-->
    <!--<script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>-->
    <![endif]-->
    <!-- jQuery (Bootstrap 的所有 JavaScript 插件都依赖 jQuery，所以必须放在前边) -->
    <script src="/jquery/jquery-3.2.1.js"></script>
    <!-- 加载 Bootstrap 的所有 JavaScript 插件。你也可以根据需要只加载单个插件。 -->
    <script src="/js/bootstrap.js"></script>
    <script type="text/javascript"></script>
</head>
<body>
@include('_nav')
<div class="container-fluid row">
        <div class="col-xs-2">
            <ul class="nav nav-pills nav-stacked">
                {{--@foreach(\App\model\Nav::where('pid','0')->get() as $nav)--}}
                        {{--<li class="dropdown">--}}
                    {{--<span  class="dropdown-toggle list-group-item" data-toggle="dropdown" role="button" aria-haspopup="true"--}}
                           {{--aria-expanded="false">{{$nav->name}} <span class="caret"></span></span>--}}
                            {{--<ul class="dropdown-menu">--}}
                                {{--@foreach(\App\model\Nav::where('pid',$nav->id)->get() as $n)--}}
                                        {{--@can($nav->permission->name)--}}
                                        {{--<li><a href='{{route("$n->url")}}'>{{$n->name}}</a></li>--}}
                                        {{--@endcan--}}
                                {{--@endforeach--}}
                            {{--</ul>--}}
                        {{--</li>--}}
                {{--@endforeach--}}
                {!! \App\model\Nav::getHTML() !!}
            </ul>

        </div>
    <div class="col-xs-10 container">
        <div class="container-fluid">@include('/success')</div>
        @yield('content')
    </div>
</div>



</body>
</html>