<?php

namespace App\Http\Controllers\Shop;

use App\Models\Activity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActivityController extends Controller
{
    public function index(Request $request)
    {
        //得到当前时间
        $time=time();
        //转化成时间
        $times=date("Y-m-d",$time);
        //得到所有活动数据
        $activitys= Activity::orderBy('id')->where('end_time','>',$times)->get();
//        dd( $activitys);
        //显示视图
        return view("shop.activity.index",compact("activitys"));

    }

}
