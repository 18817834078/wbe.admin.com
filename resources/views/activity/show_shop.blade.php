@extends('../default_shop')
@section('content')
    <div class="container-fluid">
        <a href="http://wbe.admin.com/activity/activities_shop.html"><button type="button" class="btn btn-primary">返回上一页</button></a>
    </div>
    <br>
    <div class="container-fluid">

        {!!$activity->content!!}
    </div>
@endsection