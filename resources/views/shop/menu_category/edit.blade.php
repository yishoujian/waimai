
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>菜品分类管理编辑</title>
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
            <input type="text" class="form-control"  name="name" value="{{$shop->name}}">
            <div class="form-group">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">描述</label>
                <input type="text" class="form-control"  placeholder="name" name="description" value="{{$shop->description}}">
                <div class="form-group">
                </div>
            <div>
                <label for="exampleInputFile">菜品编号</label>
                <input type="text" id="exampleInputFile" name="type_accumulation" value="{{$shop->type_accumulation}}">
                <p class="help-block"></p>
            </div>
                <div>
                    <label for="exampleInputFile">所属商家ID</label>
                    <select name='shop_id'>
                        @foreach($shops as $shop)
                        <option value='{{$shop->shop_id}}'>{{$shop->shop_id}}</option>
                            @endforeach
                    </select>
                    <p class="help-block"></p>
                </div>
                <div>
                    <label for="exampleInputFile">是否默认分类</label>
                    <input type="text" id="exampleInputFile" name="is_selected" value="{{$shop->type_accumulation==0??"是","否"}}">
                    <p class="help-block"></p>
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
