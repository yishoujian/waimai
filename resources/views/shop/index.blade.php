@extends("shop/layouts.dafault")
@section("content")
    <table class="table table-hover">
        <tr><th>店铺编号</th><th>店铺分类名称</th><th>店铺名称</th><th>店铺图片</th><th>店铺评分</th>
            <th>是否品牌</th><th>是否准时送达</th><th>是否蜂鸟配送</th><th>是否保标记</th><th>是否票标记</th>
            <th>是否准标记</th><th>起送金额</th><th>配送费</th><th>店公告</th><th>优惠信息</th><th>状态</th>

        </tr>
        @foreach($shops as $shop)
            <tr>
                <td>{{$shop->id}}</td>
                <td>{{$shop->cate->name}}</td>
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
                <td>
                    <input type="radio" name="radio"   {{$shop->status?"是":"否"}}>通过
                    <input type="radio" name="radio" value="3" checked>未通过
                    </label>
                </td>



            </tr>
        @endforeach

    </table>
    {{$shops->links()}}
@endsection