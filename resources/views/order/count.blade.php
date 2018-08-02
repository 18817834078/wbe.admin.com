@extends('default')
@section('content')
        <div class="col-xs-1 container">
            <div>
                <a href="/"><button type="button" class="btn btn-primary">返回主页</button></a>
            </div>
            <div><br> </div>

        </div>
    <div class="container-fluid col-xs-11">
        <h1>总订单数查询</h1>
        <table class="table table-bordered table-hover">
            <tr>
                <th>今日订单</th>
                <th>本月订单</th>
                <th>总订单数</th>
            </tr>
                <tr>
                    <td>{{$count_today}}</td>
                    <td>{{$count_this_month}}</td>
                    <td>{{$count_all}}</td>
                </tr>
        </table>
        <hr>
        <table class="table table-bordered table-hover">
            <tr>
                <td>查询订单数</td>
                <th>按日查询</th>
                <th>按月查询</th>
            </tr>
            <tr>
                <td>输入日期</td>

                <td>
                    <form  action="{{route('orders.count')}}" method="get">
                        <div class="row">
                            <div class="col-xs-10">
                                <input type="date" class="form-control" name="search_day" value="{{$search_day}}">
                            </div>
                            <div class="col-xs-2">
                                <button type="submit" class="btn btn-default">搜索</button>
                            </div>
                        </div>
                    {{--</form>--}}
                </td>
                <td>
                    {{--<form  action="{{route('orders.count')}}" method="get">--}}
                        <div class="row">
                            <div class="col-xs-10">
                                <input type="month" class="form-control" name="search_month" value="{{$search_month}}">
                            </div>
                            <div class="col-xs-2">
                                <button type="submit" class="btn btn-default">搜索</button>
                            </div>
                        </div>
                    {{--</form>--}}
                </td>
            </tr>
            <tr>
                <td>统计数目</td>
                <td>{{$count_day}}</td>
                <td>{{$count_month}}</td>
            </tr>
        </table>
        <h1>商家订单数查询</h1>
        <div class="row">
            <div class="col-xs-5">
                <input type="date" class="form-control" name="search_shop_day" value="{{$search_shop_day}}">
            </div>
            <div class="col-xs-2">
                <button type="submit" class="btn btn-default">搜索</button>
            </div>
        </div>
        </form>
        <br>
        <div class="row">
            <div class="col-xs-4">
                <table class="table table-bordered table-hover">
                    <tr>
                        <th colspan="2" style="text-align: center">单日统计</th>
                    </tr>
                    <tr>
                        <td>商店</td>
                        <td>订单量</td>
                    </tr>
                    @foreach($count_shop_day as $key=>$val)
                        <tr>
                            <td>{{$key}}</td>
                            <td>{{$val}}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <div class="col-xs-4">
                <table class="table table-bordered table-hover">
                    <tr>
                        <th colspan="2" style="text-align: center">单月统计</th>
                    </tr>
                    <tr>
                        <td>商店</td>
                        <td>订单量</td>
                    </tr>
                    @foreach($count_shop_month as $key=>$val)
                        <tr>
                            <td>{{$key}}</td>
                            <td>{{$val}}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <div class="col-xs-4">
                <table class="table table-bordered table-hover">
                    <tr>
                        <th colspan="2" style="text-align: center">累计订单</th>
                    </tr>
                    <tr>
                        <td>商店</td>
                        <td>订单量</td>
                    </tr>
                    @foreach($count_shop_all as $key=>$val)
                        <tr>
                            <td>{{$key}}</td>
                            <td>{{$val}}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>


    </div>



@endsection