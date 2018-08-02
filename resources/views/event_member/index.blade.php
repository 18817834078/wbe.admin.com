@extends('default')
@section('content')

    <div class="container-fluid">
        <table class="table table-bordered table-hover">
            <tr>
                <th>用户名</th>
                <th>用户邮箱</th>

            </tr>
            @foreach($event_members as $event_member)
                <tr>
                    <td>{{$event_member->shop_user->name}}</td>
                    <td>{{$event_member->shop_user->email}}</td>

                </tr>
            @endforeach
        </table>
    </div>

@endsection