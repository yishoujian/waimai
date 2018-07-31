<?php

namespace App\Http\Controllers\Admin;

use App\Models\Activity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActivityController extends BaseController
{

    public function index(Request $request)
    {
        //得到当前时间
        $time=time();
        //转化成时间
        $times=date("Y-m-d",$time);
      $request=$request->post('search');
      if ($request==null){
          $activitys=Activity::all();
      }
       //正在进行
     if($request==='ing'){
         $activitys=Activity::where('start_time','<',$times)->where('end_time','>',$times)->get();
     }
     //已经结束
     if ($request==='end'){
          $activitys=Activity::where('end_time','<',$times)->get();
     }
     //还没开始
        if ($request==='not'){
          $activitys=Activity::where('start_time','>',$times)->get();
        }

     //显示视图
        return view("admin.activity.index",compact("activitys"));

    }

    /**
     * @param Request $request
     * 活动添加
     */

    public function add(Request $request)
    {
        //判断提交方式
        if ($request->isMethod("post")){
            //判断字段是否合法
            $this->validate($request,[
               'title'=>'required',
                'content'=>'required',
                'start_time'=>'required',
                'end_time'=>'required',
            ]);
            //接收所有数据
            $activitys=$request->all();
            //入库
            Activity::create($activitys);
            //提示跳转
            $request->session()->flash("success","添加活动成功");
            return redirect()->route("activity.index");
        }
        //显示视图
        return view("admin/activity/add");

    }

    public function edit(Request $request,$id)
    {
        //得到所有数据
        $activitys=Activity::find($id);
        //判断提交方式
        if ($request->isMethod("post")){
            //判断字段是否合法
            $this->validate($request,[
                'title'=>'required',
                'content'=>'required',
                'start_time'=>'required',
                'end_time'=>'required',
            ]);
            //接收所有数据
            $activity=$request->all();
            //入库
          $activitys->update($activity);
            //提示跳转
            $request->session()->flash("success","编辑活动成功");
            return redirect()->route("activity.index");
        }
        //显示视图
        return view("admin/activity/edit",compact("activitys"));

    }

    public function del(Request $request,$id)
    {
        //找到数据
        $activity=Activity::findOrfail($id);
        //入库
      $activity->delete();
      //提示
        $request->session()->flash("success","删除成功");
        //跳转
        return redirect()->route("activity.index");


    }

}
