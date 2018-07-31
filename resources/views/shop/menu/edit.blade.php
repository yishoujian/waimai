
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>菜品编辑</title>
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

        <div class="form-group">
            <label for="exampleInputEmail1">名字</label>
            <input type="text" class="form-control"  placeholder="菜名" name="goods_name" value="{{$menu->goods_name}}">
            <div class="form-group">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">描述</label>
                <input type="text" class="form-control"  placeholder="描述" name="description" value="{{$menu->description}}">
                <div class="form-group">
                </div>
            <div>
                <div class="form-group">
                    <label for="exampleInputEmail1">提示信息</label>
                    <input type="text" class="form-control"  placeholder="提示信息" name="tips" value="{{$menu->tips}}">
                    <div class="form-group">
                    </div>
                    <div>
                <div class="form-group">
                    <label for="exampleInputFile">商家图片</label>
                   <img src="/uploads/{{$menu->goods_img}}" width="80" height="60">
                    <p class="help-block"></p>
                {{--</div>--}}
                {{--<label for="exampleInputFile">菜品编号</label>--}}
                {{--<input type="text" id="exampleInputFile" name="" value="{{old('type_accumulation')}}">--}}
                {{--<p class="help-block"></p>--}}
            {{--</div>--}}
            </div>
            <label for="exampleInputFile">菜品价格</label>
            <input type="text" id="exampleInputFile" name="goods_price" value="{{$menu->goods_price}}">
            <p class="help-block"></p>
        </div>
                <div>
                    <label for="exampleInputFile">所属菜品分类ID</label>
                    <select name='shop_id'>
                        @foreach($cates as $cate)
                            <option value='{{$cate->id}}'>{{$cate->name}}</option>
                        @endforeach
                    </select>
                    <p class="help-block"></p>
                </div>

        <button type="submit" class="btn btn-success">添加</button>
    </form>
</div>
<!-- jQuery (Bootstrap 的所有 JavaScript 插件都依赖 jQuery，所以必须放在前边) -->
<script src="/bootstrap/jquery/1.12.4/jquery.min.js"></script>
<!-- 加载 Bootstrap 的所有 JavaScript 插件。你也可以根据需要只加载单个插件。 -->
<script src="/bootstrap/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
