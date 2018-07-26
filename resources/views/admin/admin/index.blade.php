@extends("admin/layouts.dafault")
@section("content")
    <form action="" class="" method="post" enctype="multipart/form-data">
    <table class="table table-hover" >

        <tr><th>管理员名称</th><th>管理员邮箱</th><th>操作</th></tr>
        @foreach($admins as $admin)
            <tr>
                <td>{{$admin->name}}</td>

                <td>{{$admin->email}}</td>
                <td>

                    <a href="{{route("admin.edit",$admin)}}" class="btn btn-success">编辑</a>
                </td>
                <td>
                    @if($admin->id!==1)
                    <a href="{{route("admin.del",$admin)}}"  class="btn btn-danger">删除</a>
                        @endif
                </td>
            </tr>
        @endforeach

    </table>
    </form>
    @endsection
