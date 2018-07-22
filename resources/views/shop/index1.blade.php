@extends("layouts.dafault")
@section("content")
    <a href="{{route('shop.add')}}" class="btn btn-success">添加</a>
    <table class="table table-hover">
        <tr><th>店铺编号</th><th>店铺分类名称</th><th>店铺名称</th><th>店铺图片</th><th>店铺评分</th>
            <th>是否品牌</th><th>是否准时送达</th><th>是否蜂鸟配送</th><th>是否保标记</th><th>是否票标记</th>
            <th>是否准标记</th><th>起送金额</th><th>配送费</th><th>店公告</th><th>优惠信息</th><th>状态</th>
            <th>操作</th>
        </tr>
        @foreach($shops as $shop)
            <tr>
                <td>{{$shop->id}}</td>
                <td>{{$shop->shop->name}}</td>
                <td>{{$shop->name}}</td>
                <td>
                    @if($shop->shop_logo)
                        <img src="/uploads/{{$shop->shop_logo}}" width="80" height="60">
                    @else
                        <img src="/images/1.jpg" width="80" height="60">
                    @endif</td>
                </td>
                <td>{{$shop->shop_rating}}</td>
                <td>{{$shop->brand}}</td>
                <td>{{$shop->on_time}}</td>
                <td>{{$shop->fengniao}}</td>
                <td>{{$shop->bao}}</td>
                <td>{{$shop->piao}}</td>
                <td>{{$shop->zhun}}</td>
                <td>{{$shop->start_send}}</td>
                <td>{{$shop->send_cost}}</td>
                <td>{{$shop->send_cost}}</td>
                <td>{{$shop->discount}}</td>
                <td>{{$shop->status}}</td>
                <td>
                    <a href="{{route('shop.edit',$shop)}}" class="btn btn-success">编辑</a>
                </td>
                <td>
                    <a href="{{route('shop.del',$shop)}}" class="btn btn-danger">删除</a>
                </td>
            </tr>
        @endforeach

    </table>
    {{$shops->links()}}
@endsection