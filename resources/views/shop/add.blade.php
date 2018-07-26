<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>商家店铺添加</title>
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
        <select class="form-control"name="shop_category_id" >
            @foreach($datas as $data)
                <option value="{{$data->id}}">{{$data->name}}</option>
            @endforeach
        </select>
        <div class="form-group">
            <label for="exampleInputEmail1">名字</label>
            <input type="text" class="form-control"  placeholder="name" name="name" value="{{old('name')}}">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">密码</label>
            <input type="password" class="form-control" name="password" placeholder="Password" value="{{old('password')}}">
        </div>
        <div class="form-group">
            <label for="exampleInputFile">商家图片</label>
            <input type="file" id="exampleInputFile" name="shop_logo" value="{{old('shop_logo')}}">
            <p class="help-block"></p>
        </div>
        <div class="form-group" >
            <label>图像</label>
           <input type="text" class="form-control" id="img" name="shop_logo">
            <div id="thelist" class="uploader-list"></div>
            <div class="btns">
                <div id="picker">选择文件</div>
                {{--<button id="ctlBtn" class="btn btn-default">开始上传</button>--}}
            </div>
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
@section('js')

    <script>
        var uploader = WebUploader.create({
            auto:true,
            //CSRF
            formData:{
              "_token":"{{csrf_token()}}"
            },

            // swf文件路径
            swf:'Uploader.swf',

            // 文件接收服务端。
            server: '{{route("shop.add")}}',

            // 选择文件的按钮。可选。
            // 内部根据当前运行是创建，可能是input元素，也可能是flash.
            pick: '#picker',

            // 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
            resize: false
        });
        uploader.on( 'fileQueued', function( file ) {
            var $lids=$("#thelist");
            $list.append( '<div id="' + file.id + '" class="item">' +
                '<h4 class="info">' + file.name + '</h4>' +
                '<p class="state">等待上传...</p>' +
                '</div>' );
        });
        uploader.on( 'uploadSuccess', function( file,data ) {
            $( '#'+file.id ).find('p.state').text('已上传');
            $("#img").val(data.url);
        });

        uploader.on( 'uploadError', function( file ) {
            $( '#'+file.id ).find('p.state').text('上传出错');
        });

        uploader.on( 'uploadComplete', function( file ) {
            $( '#'+file.id ).find('.progress').fadeOut();
        });

    </script>
    @endsection()
