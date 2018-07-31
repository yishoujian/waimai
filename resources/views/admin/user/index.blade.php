@extends("shop/layouts/dafault")
@section("content")

    <table class="table table-hover">
        <tr><th>用户编号</th><th>用户名称</th><th>用户邮箱</th><th>操作</th></tr>
        @foreach($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>
                <td>
                    <a href="{{route("shop.edit",$user)}}" class="btn btn-success">编辑</a>
                </td>
                <td>
                    <a href="{{route("shop.del",$user)}}" class="btn btn-danger">删除</a>
                </td>
                </td>

            </tr>
        @endforeach

    </table>
@endsection

