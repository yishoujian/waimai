<?php

namespace App\Http\Controllers\Admin;

use App\Models\Shop;
use App\Models\ShopCategory;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopCategoryController extends BaseController
{
    public function index(Request $request)
    {
        //得到所有数据
        $shops=ShopCategory::all();
//        dd($users);

        return view("admin/shop_category/index",compact('shops'));
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
        return view("admin/shop_category.add",compact("shops"));
        }

    public function edit(Request $request,$id)
    {
        //通过id找到数据
        $shop=ShopCategory::findOrFail($id);
//        var_dump($shop);exit;
        //判断提交方式
        if ($request->isMethod("post")){
            //判断字段是否合法
            $this->validate($request,[
                "name"=>"required",
            ]);
            //修改
            //的到更新后的数据
            $data=$request->all();

//            var_dump($data);exit;
            $data['logo']="";
            if ($request->file("logo")){
                $data['logo']=$request->file("logo")->store("shop","logo");
            }
//            dd($data);
            //数据入库
            $shop->update($data);
            //提示
            $request->session()->flash("success","编辑成功");
            //跳转
            return redirect()->route("shop_category.index");
        }
        //显示视图
        return view("admin.shop_category.edit",compact("shop"));

        }

    public function del(Request $request,$id)
    {
        //通过id找到数据
        $shop=ShopCategory::findOrFail($id);
        //数据入库
        $shop->delete($shop);
        //提示
        $request->session()->flash("success","删除成功");
        return redirect()->route("shop_category.index");


        }



}
