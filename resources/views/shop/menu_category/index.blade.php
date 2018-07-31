@extends("shop/layouts/dafault")
@section("content")
    <form action="" class="" method="post" enctype="multipart/form-data">
    <table class="table table-hover" >
        <a href="{{route('menu_category.add')}}" class="btn btn-success">添加</a>
        <tr><th>分类编号</th><th>菜品分类名称</th><th>菜品编号</th><th>所属商家ID</th><th>描述</th><th>操作</th></tr>
        @foreach($cates as $cate)
            <tr>
                <td>{{$cate->id}}</td>
                <td>{{$cate->name}}</td>
                {{--<td> @if($cate->logo)--}}
                         {{--<img src="/uploads/{{$shop->logo}}" width="80" height="60">--}}
                         {{--@else--}}
                         {{--<img src="/images/1.jpg" width="80" height="60">--}}
                       {{--@endif</td>--}}
                {{--<td>--}}
                <td>{{$cate->type_accumulation}}</td>
                {{--<td>{{$cate->cate1->name}}</td>--}}
                <td>{{$cate->description}}</td>
                {{--{{$shop->is_selected?"是":"否"}}--}}
                    {{--{{$shop->status?"":"checked"}}否--}}
                </td>
                <td>
                    <a href="{{route('menu_category.edit',$cate->id)}}" class="btn btn-success">编辑</a>
                </td>
                <td>
                    <a href="{{route('menu_category.del',$cate->id)}}" class="btn btn-danger">删除</a>
                </td>
            </tr>
        @endforeach

    </table>
    </form>
    @endsection
