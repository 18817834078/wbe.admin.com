@extends('default')
@section('content')
    <div class="container-fluid">
        <a href="{{route('activities.create')}}"><button type="button" class="btn btn-primary">添加新活动</button></a>
    </div>
    <div class="container-fluid">

        {!!$activity->content!!}
    </div>
@endsection