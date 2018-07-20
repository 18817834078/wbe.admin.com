@extends('default')
@section('content')
    <div class="container-fluid">
        <a href="{{route('shops.create')}}"><button type="button" class="btn btn-primary">添加商店及账户</button></a>
    </div>
    <div class="container-fluid">
        <table class="table table-bordered table-hover">
            <tr>
                <th>店铺名称</th>
                <th>店铺分类</th>
                <th>店铺图片</th>
                <th>店铺评分</th>
                <th>起送金额</th>
                <th>配送费</th>
                <th>店公告</th>
                <th>优惠信息</th>
                <th>商铺状态</th>
                <th>所属账号</th>
                <th>操作</th>
            </tr>
            @foreach($shops as $shop)
                <tr>
                    <td>{{$shop->shop_name}}</td>
                    <td>{{$shop->category->name}}</td>
                    <td><img height="50" src="{{$shop->shop_img}}" alt="店铺图片"></td>
                    <td>{{$shop->shop_rating}}星</td>
                    <td>{{$shop->start_send}}元</td>
                    <td>{{$shop->send_cost}}元</td>
                    <td>{{$shop->notice}}</td>
                    <td>{{$shop->discount}}</td>
                    <td>@if($shop->status==1) 正常 @elseif($shop->status==0) 审核中 @else 禁用 @endif </td>
                    <td>{{$shop->shop_user->name}}</td>
                    <td class="row">
                        <div class="col-xs-2">
                            <a href="{{route('shops.show',[$shop])}}">
                                <button type="submit" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-zoom-in"></span></button>
                            </a>
                        </div>

                        <div class="col-xs-2">
                            <a href="{{route('shops.edit',[$shop])}}">
                                <button type="submit" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-pencil"></span></button>
                            </a>
                        </div>
                        <div class="col-xs-2">
                            <form action="{{route('shops.destroy',[$shop])}}" method="post">
                                <button type="submit" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span></button>
                                {{method_field('DELETE')}}
                                {{csrf_field()}}
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

{{ $shops->links() }}
@endsection