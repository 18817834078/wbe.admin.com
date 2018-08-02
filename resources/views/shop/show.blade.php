@extends('default')
@section('content')
    <div class="container-fluid">
        @can('商店操作')
        <a href="{{route('shops.create')}}"><button type="button" class="btn btn-primary">添加商店及账户</button></a>
            @endcan
    </div>
    <div class="container-fluid">
        <ul class="list-unstyled">
            <li style="font-size: large">是否品牌: <span class="@if($shop->brand==true) glyphicon glyphicon-ok @else glyphicon glyphicon-remove @endif"></span> </li>
            <li style="font-size: large">准时送达: <span class="@if($shop->on_time==true) glyphicon glyphicon-ok @else glyphicon glyphicon-remove @endif"></span> </li>
            <li style="font-size: large">蜂鸟配送: <span class="@if($shop->fengniao==true) glyphicon glyphicon-ok @else glyphicon glyphicon-remove @endif"></span> </li>
            <li style="font-size: large">保标记: <span class="@if($shop->bao==true) glyphicon glyphicon-ok @else glyphicon glyphicon-remove @endif"></span> </li>
            <li style="font-size: large">票标记: <span class="@if($shop->piao==true) glyphicon glyphicon-ok @else glyphicon glyphicon-remove @endif"></span> </li>
            <li style="font-size: large">准标记: <span class="@if($shop->zhun==true) glyphicon glyphicon-ok @else glyphicon glyphicon-remove @endif"></span> </li>
            <hr>
            <li style="font-size: large">所属商家:{{$shop_user->name}}</li>
            <li style="font-size: large">商家邮箱:{{$shop_user->email}}</li>
            <li style="font-size: large">商家状态:@if($shop_user->status) 已启用 @else 已禁用 @endif</li>
        </ul>
    </div>
@endsection