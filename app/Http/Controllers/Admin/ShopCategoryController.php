<?php

namespace App\Http\Controllers\Admin;

use App\Models\Shop;
use App\Models\ShopCategory;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopCategoryController extends Controller
{
    public function index(Request $request)
    {
        //得到所有数据
        $shops=ShopCategory::all();
//        dd($users);

        return view("shop_category.index",compact('shops'));
        //显示视图
    }

    public function add(Request $request)
    {
        //判断提交方式
        if ($request->isMethod("post")){
            //判断字段是否合法
            $this->validate($request,[
                "name"=>"required"
            ]);
            $shops=$request->all();
//            var_dump($shops);exit;
            $shops['logo']="";
            if ($request->file("logo") ){
                $shops['logo']=$request->file("logo")->store("shop","logo");
            }
            //数据入库
            ShopCategory::create($shops);
//            var_dump($shops);exit;
            //提示
            $request->session()->flash("success","添加成功");
            //跳转
        return redirect()->route("shop_category.index");
        }
        //显示视图
        return view("shop_category.add",compact("shops"));
        }

    public function edit(Request $request,$id)
    {

        //显示视图
        return view("shop_category.add");

        }



}
