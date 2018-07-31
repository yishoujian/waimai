@extends("shop/layouts/dafault")
@section("content")
    <form class="navbar-form navbar-right" action="" method="">
        <div class="form-group">
            <select name="cate" class="btn btn-success" >
                <option value="">选择你要搜索的分类</option>
                  @foreach($cates as $cate)
                    <option value="{{$cate->id}}">{{$cate->name}}</option>
                @endforeach
            </select>
            <input type="text" class="form-control"  name="search"  placeholder="请输入菜品名">
        </div>
        <input type="text"   placeholder="最小价格" name="min" value="">
        <input type="text"   placeholder="最大价格" name="max" value="">
        <button type="submit" class="btn btn-default">搜索</button>
    </form>
    <a href="{{route('menu.add')}}" class="btn btn-success">添加</a>
    <table class="table table-hover">
        <tr><th>菜品编号</th>
            <th>菜品名称</th>
            <th>菜品评分</th>
            <th>菜品图片</th>
            <th>所属商家ID</th>
            {{--<th>所属分类ID</th>--}}
            <th>价格</th>
            <th>描述</th>
            <th>月销量</th>
            <th>评分数量</th>
            <th>满意度数量</th>
            <th>满意度评分</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
        @foreach($menus as $menu)
            <tr>
                <td>{{$menu->id}}</td>
                <td>{{$menu->goods_name}}</td>
                <td>{{$menu->rating}}</td>
                <td>
                    @if($menu->goods_img)
                        <img src="/uploads/{{$menu->goods_img}}" width="80" height="60">
                    @else
                        <img src="/images/1.jpg" width="80" height="60">
                    @endif</td>
                </td>
                <td>{{$menu->shops->shop_name}}</td>
                {{--<td>{{$menu->category->name}}</td>--}}
                <td>{{$menu->goods_price}}</td>
                <td>{{$menu->description}}</td>
                {{--<td>{{$menu->month_sales}}</td>--}}
                <td>{{$menu->rating_count}}</td>
                <td>{{$menu->tips}}</td>
                <td>{{$menu->satisfy_count}}</td>
                <td>{{$menu->satisfy_rate}}</td>
                <td>{{$menu->status}}</td>
                <td>
                    <a href="{{route('menu.edit',$menu->id)}}" class="btn btn-success">编辑</a>
                </td>
                <td>
                    <a href="{{route('menu.del',$menu->id)}}" class="btn btn-danger">删除</a>
                </td>
            </tr>
        @endforeach

    </table>
 {{$menus->links()}}
@endsection