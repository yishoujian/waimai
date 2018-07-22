@extends("layouts.dafault")
@section("content")
    <form action="" class="" method="post" enctype="multipart/form-data">
    <table class="table table-hover" >
        <a href="{{route('shop_category.add')}}" class="btn btn-success">添加</a>
        <tr><th>分类编号</th><th>分类名称</th><th>分类图片</th><th>状态</th></tr>
        @foreach($shops as $shop)
            <tr>
                <td>{{$shop->id}}</td>
                <td>{{$shop->name}}</td>
                <td> @if($shop->logo)
                         <img src="/uploads/{{$shop->logo}}" width="80" height="60">
                         @else
                         <img src="/images/1.jpg" width="80" height="60">
                       @endif</td>
                <td>

                    {{$shop->status}}</td>
                <td>
                    <a href="{{route('shop_category.edit')}}" class="btn btn-success">编辑</a>
                </td>
                <td>
                    <a href="{{route('shop_category.del')}}" class="btn btn-danger">删除</a>
                </td>
            </tr>
        @endforeach

    </table>
    </form>
    @endsection
