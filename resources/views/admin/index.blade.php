
@extends("layouts/dafault")
@section("content")

    <table class="table table-hover">
        <tr><th>分类编号</th><th>分类名称</th><th>分类图片</th><th>状态</th><th>操作</th></tr>
        @foreach($users as $user)
        <tr>
            <td>{{$user->id}}</td>
            <td>{{$user->name}}</td>
            <td><img src=""></td>
            <td>{{$user->status}}</td>

        </tr>
            @endforeach

    </table>




    @endsection


