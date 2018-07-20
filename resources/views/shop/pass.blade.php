@extends('default')
@section('content')
    <div class="container-fluid">
        <a href="{{route('shops.create')}}"><button type="button" class="btn btn-primary">添加商店及账户</button></a>
    </div>
    <div class="container-fluid">
        <table class="table table-bordered table-hover">
            <tr>
                <th>商铺名称</th>
                <th>商铺类型</th>
                <th>商铺状态</th>
                <th>商铺所有者</th>
                <th>操作</th>
            </tr>
            @foreach($shops as $shop)
                <tr>
                    <td>{{$shop->shop_name}}</td>
                    <td>{{$shop->category->name}}</td>
                    <td>@if($shop->status==1) 已启用 @elseif($shop->status==0) 审核中 @else 已禁用 @endif </td>
                    <td>{{$shop->shop_user->name}}</td>
                    <td class="row">

                        <div class="col-xs-2 row">

                            <a href="{{route('shops.show',[$shop])}}">
                                <button type="submit" class="btn btn-primary btn-sm">去验证</button>
                            </a>
                        </div>

                    </td>
                </tr>
            @endforeach
        </table>
    </div>

{{ $shops->links() }}
@endsection