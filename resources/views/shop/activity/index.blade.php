@extends("shop/layouts/dafault")
@section("content")
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

                </td>

            </tr>
        @endforeach

    </table>
@endsection

