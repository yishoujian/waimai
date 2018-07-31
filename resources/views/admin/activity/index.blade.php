@extends("shop/layouts/dafault")
@section("content")
    <form class="navbar-form navbar-right" action="" method="">
        <div class="form-group">
            <select name="search" class="btn btn-warning" >
                <option value="">请选择</option>
                <option value="ing">正在进行</option>
                <option value="not">未开始</option>
                <option value="end">已经结束</option>
            </select>
            <input type="submit" class="form-control"  >
        </div>

    </form>

    <a href="{{route("activity.add")}}" class="btn btn-warning">添加</a>
    <table class="table table-hover">
        <tr><th>活动编号</th><th>活动名称</th><th>活动内容</th><th>活动开始时间</th><th>结束时间</th><th>操作</th></tr>
        @foreach($activitys as $activity)
            <tr>
                <td>{{$activity->id}}</td>
                <td>{{$activity->title}}</td>
                <td>{{$activity->content}}</td>
                <td>{{$activity->start_time}}</td>
                <td>{{$activity->end_time}}</td>
                <td>
                <td>
                    <a href="{{route("activity.edit",$activity)}}" class="btn btn-success">编辑</a>
                </td>
                <td>
                    <a href="{{route("activity.del", $activity)}}" class="btn btn-danger">删除</a>
                </td>
                </td>

            </tr>
        @endforeach

    </table>
@endsection

