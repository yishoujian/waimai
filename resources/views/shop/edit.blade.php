<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>商家店铺编辑</title>
@include("shop/layouts/_msg")
@include("shop/layouts/_error")

<!-- Bootstrap -->
    <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim 和 Respond.js 是为了让 IE8 支持 HTML5 元素和媒体查询（media queries）功能 -->
    <!-- 警告：通过 file:// 协议（就是直接将 html 页面拖拽到浏览器中）访问页面时 Respond.js 不起作用 -->
    <!--[if lt IE 9]>
    <script src="/bootstrap/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="/bootstrap/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="callout-danger container-fluid" >

    <form method="post" action="" enctype="multipart/form-data" >
        {{csrf_field()}}
        <select class="form-control"name="class_id" >
            @foreach($datas as $data)
                <option value="{{$data->id}}">{{$data->name}}</option>
            @endforeach
        </select>
        <div class="form-group">
            <label for="exampleInputEmail1">名字</label>
            <input type="text" class="form-control"  placeholder="name" name="name" value="{{old('name',$shops->name)}}">
        </div>
        {{--<div class="form-group">--}}
            {{--<label for="exampleInputPassword1">密码</label>--}}
            {{--<input type="password" class="form-control" name="password" placeholder="Password" value="{{old('password',$shops->password)}}">--}}
        {{--</div>--}}
        <div class="form-group">
            <label for="exampleInputFile">商家图片</label>
            <img src="/uploads/{{$shops->shop_logo}}/" width="80" height="60">
            <input type="file" id="exampleInputFile" name="shop_logo" >
            <p class="help-block"></p>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">评分</label>
            <input type="text" class="form-control"  placeholder="name" name="shop_rating" value="{{$shops->shop_rating}}">
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">是否是品牌</label>
            <input type="radio" name="brand" value="1" {{$shops->brand?"checked":""}}>是
            <input type="radio" name="brand" value="0" {{$shops->brand?"":"checked"}} >否
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">是否准时</label>
            <input type="radio" name="on_time" value="1" {{$shops->on_time?"checked":""}}>	是
            <input type="radio" name="on_time"  value="0" {{$shops->on_time?"":"checked"}}>否
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">是否蜂鸟</label>
            <input type="radio" name="fengniao" value="1" {{$shops->fengniao?"checked":""}}>	是
            <input type="radio" name="fengniao"  value="0" {{$shops->fengniao?"":"checked"}}>否
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">是否有票</label>
            <input type="radio" name="piao" value="1" {{$shops->piao?"checked":""}}>	是
            <input type="radio" name="piao"  value="0"{{$shops->piao?"":"checked"}}>否
        </div>
</div>
<div class="form-group">
    <label for="exampleInputEmail1">是否包</label>
    <input type="radio" name="bao"  value="1" {{$shops->bao?"checked":""}}>	是
    <input type="radio" name="bao" value="0"{{$shops->bao?"":"checked"}}>否
</div>
<div class="form-group">
    <label for="exampleInputEmail1">是否准</label>
    <input type="radio" name="zhun"  value="1"{{$shops->zhun?"checked":""}}>	是
    <input type="radio" name="zhun" value="0"{{$shops->zhun?"":"checked"}}>否
</div>
<div class="form-group">
    <label for="exampleInputEmail1">起送金额</label>
    <input type="text" class="form-control"  placeholder="name" name="start_send"  value="{{$shops->start_send}}">
</div>
<div class="form-group">
    <label for="exampleInputEmail1">配送费</label>
    <input type="text" class="form-control"  placeholder="name" name="send_cost" value="{{old('send_cost',$shops->send_cost)}}">
</div>
<div class="form-group">
    <label for="exampleInputEmail1">公告</label>
    <input type="text" class="form-control"  placeholder="name" name="notice" value="{{old('notice',$shops->notice)}}">
</div>
<div class="form-group">
    <label for="exampleInputEmail1">优惠信息</label>
    <input type="text" class="form-control"  placeholder="name" name="discount" value="{{old('discount',$shops->discount)}}">
</div>




        <button type="submit" class="btn btn-success">编辑</button>
    </form>
</div>
<!-- jQuery (Bootstrap 的所有 JavaScript 插件都依赖 jQuery，所以必须放在前边) -->
<script src="/bootstrap/jquery/1.12.4/jquery.min.js"></script>
<!-- 加载 Bootstrap 的所有 JavaScript 插件。你也可以根据需要只加载单个插件。 -->
<script src="/bootstrap/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
