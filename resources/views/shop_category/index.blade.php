@extends('default')
@section('content')
    <div class="container-fluid">
        <a href="{{route('shop_categories.create')}}"><button type="button" class="btn btn-primary">添加商店分类</button></a>
    </div>
    <div class="container-fluid">
        <table class="table table-bordered table-hover">
            <tr>
                <th>分类名称</th>
                <th>分类图片</th>
                <th>是否显示</th>
                <th>操作</th>
            </tr>
            @foreach($shop_categories as $shop_category)
                <tr>
                    <td>{{$shop_category->name}}</td>
                    <td><img height="50" src="{{$shop_category->img}}" alt="分类图片"></td>
                    <td>@if($shop_category->status==1) 是 @else 否 @endif</td>
                    <td class="row">
                        <div class="col-xs-1">
                            <a href="{{route('shop_categories.edit',[$shop_category])}}">
                                <button type="submit" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-pencil"></span></button>
                            </a>
                        </div>
                        <div class="col-xs-1">
                            <form action="{{route('shop_categories.destroy',[$shop_category])}}" method="post">
                                <button type="submit" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span></button>
                                {{method_field('DELETE')}}
                                {{csrf_field()}}
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </table>
        @if($shops->count()) <div style="color: orangered" class="container"><a href="/un_pass"><h5>您有未审核的商店</h5></a> </div> @endif
    </div>

{{ $shop_categories->links() }}
@endsection