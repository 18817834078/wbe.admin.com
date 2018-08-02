@extends('default')
@section('content')
    <div class="container-fluid">
        @can('商店操作')
        <a href="{{route('shops.create')}}"><button type="button" class="btn btn-primary">添加商店及账户</button></a>
            @endcan
    </div>
    <div class="container-fluid">
        <table class="table table-bordered table-hover">
            <tr>
                <th>账号名称</th>
                <th>邮箱</th>
                <th>是否启用</th>
                <th>拥有店铺</th>
                <th>操作</th>
            </tr>
            @foreach($shop_users as $shop_user)
                <tr>
                    <td>{{$shop_user->name}}</td>
                    <td>{{$shop_user->email}}</td>

                    <td>@if($shop_user->status==1) 已启用  @else 已禁用 @endif </td>
                    <td>{{$shop_user->shop->shop_name}}</td>
                    <td class="row">
                        @can('商店查看')
                        <div class="col-xs-2">
                            <a href="{{route('shop_users.show',[$shop_user])}}">
                                <button type="submit" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-zoom-in"></span></button>
                            </a>
                        </div>
                            @endcan
                            @can('商店操作')
                        <div class="col-xs-2">
                            <a href="{{route('shop_users.edit',[$shop_user])}}">
                                <button type="submit" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-pencil"></span></button>
                            </a>
                        </div>
                        <div class="col-xs-2">
                            <form action="{{route('shop_users.destroy',[$shop_user])}}" method="post">
                                <button type="submit" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span></button>
                                {{method_field('DELETE')}}
                                {{csrf_field()}}
                            </form>
                        </div>
                            @endcan
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

{{ $shop_users->links() }}
@endsection