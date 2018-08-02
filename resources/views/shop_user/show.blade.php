@extends('default')
@section('content')
    <div class="container-fluid row">
        <div class="col-xs-1">
            <a href="{{route('shops.index')}}"><button type="button" class="btn btn-primary">返回主页</button></a>
        </div>
        @can('商店操作')
        <div class="col-xs-1">
            <a href="{{route('shop_user_password',[$shop_user])}}"><button type="button" class="btn btn-primary">修改密码</button></a>
        </div>
        @endcan
    </div>
    <div class="container-fluid">
        <ul class="list-unstyled">

            <li style="font-size: large">账号名:{{$shop_user->name}}</li>
            <li style="font-size: large">商家邮箱:{{$shop_user->email}}</li>
            <li style="font-size: large">商家状态:@if($shop_user->status) 已启用 @else 已禁用 @endif</li>
            <a href="{{route('shop_user_pass',[$shop_user])}}">
                @can('商店审核')
                @if($shop_user->status)
                <button class="btn btn-danger btn-sm">禁用</button>
                @else
                    <button class="btn btn-primary btn-sm">启用</button>
                @endif
                    @endcan
            </a>
            <hr>
            <li style="font-size: large">下属店铺:{{$shop->shop_name}}</li>
            <li style="font-size: large">店铺评分:{{$shop->shop_rating}}星</li>
            <li style="font-size: large">起送金额:{{$shop->start_send}}元</li>
            <li style="font-size: large">配送费:{{$shop->send_cost}}元</li>
            <li style="font-size: large">店公告:{{$shop->notice}}</li>
            <li style="font-size: large">优惠信息:{{$shop->discount}}</li>
            <li style="font-size: large">是否品牌: <span class="@if($shop->brand==true) glyphicon glyphicon-ok @else glyphicon glyphicon-remove @endif"></span> </li>
            <li style="font-size: large">准时送达: <span class="@if($shop->on_time==true) glyphicon glyphicon-ok @else glyphicon glyphicon-remove @endif"></span> </li>
            <li style="font-size: large">蜂鸟配送: <span class="@if($shop->fengniao==true) glyphicon glyphicon-ok @else glyphicon glyphicon-remove @endif"></span> </li>
            <li style="font-size: large">保标记: <span class="@if($shop->bao==true) glyphicon glyphicon-ok @else glyphicon glyphicon-remove @endif"></span> </li>
            <li style="font-size: large">票标记: <span class="@if($shop->piao==true) glyphicon glyphicon-ok @else glyphicon glyphicon-remove @endif"></span> </li>
            <li style="font-size: large">准标记: <span class="@if($shop->zhun==true) glyphicon glyphicon-ok @else glyphicon glyphicon-remove @endif"></span> </li>
            <li style="font-size: large">店状态:@if($shop->status==1) 正常 @elseif($shop->status==0) 审核中 @else 禁用 @endif</li>
            @can('商店审核')
                @if($shop->status==1)
                    <form action="{{route('shop_pass',[$shop])}}" method="post">
                        <input type="hidden" name="status" value="-1">
                        <button type="submit" class="btn btn-danger btn-sm">禁用</button>
                        {{csrf_field()}}
                    </form>
                @elseif($shop->status==-1)
                <form action="{{route('shop_pass',[$shop])}}" method="post">
                         <input type="hidden" name="status" value="1">
                        <button type="submit" class="btn btn-primary btn-sm">启用</button>
                    {{csrf_field()}}
                </form>
                @else
                    <div class="row">
                        <div class="col-xs-1">
                            <form action="{{route('shop_pass',[$shop])}}" method="post">
                                <input type="hidden" name="status" value="1">
                                <button class="btn btn-primary btn-sm">启用</button>
                                {{csrf_field()}}
                            </form>
                        </div>
                        <div class="col-xs-2">
                        <form action="{{route('shop_pass',[$shop])}}" method="post">
                            <input type="hidden" name="status" value="-1">
                            <button class="btn btn-danger btn-sm">禁用</button>
                            {{csrf_field()}}
                        </form>
                    </div>
                    </div>
                @endif
            @endcan
        </ul>
    </div>
@endsection