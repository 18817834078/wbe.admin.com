@extends('default')
@section('content')
    <div class="container-fluid">
        <a href="{{route('users.index')}}"><button type="button" class="btn btn-primary">返回用户列表</button></a>
    </div>
    <div class="container-fluid">
        <ul class="list-unstyled">
            <li style="font-size: large">用户名: {{$user->username}} </li>
            <li style="font-size: large">联系方式: {{$user->tel}} </li>
            <li style="font-size: large">创建时间: {{substr($user->created_at,0,16)}} </li>
            <hr>
            <li style="font-size: large">地址:  </li>
            <div class="container-fluid">
                <table class="table table-bordered table-hover">
                    <tr>
                        <th>收货人</th>
                        <th>联系方式</th>
                        <th>省</th>
                        <th>市</th>
                        <th>县</th>
                        <th>详细地址</th>
                        <th>是否默认</th>
                    </tr>
                    @foreach($address as $value)
                        <tr>
                            <td>{{$value->name}}</td>
                            <td>{{$value->tel}}</td>
                            <td>{{$value->province}}</td>
                            <td>{{$value->city}}</td>
                            <td>{{$value->county}}</td>
                            <td>{{$value->address}}</td>
                            <td>@if($value->is_default==1) 是 @else 否 @endif</td>

                        </tr>
                    @endforeach
                </table>
            </div>

        </ul>
    </div>
@endsection