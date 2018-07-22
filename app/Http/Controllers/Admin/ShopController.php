<?php

namespace App\Http\Controllers\Admin;

use App\Models\Shop;
use App\Models\ShopCategory;

use App\Tools\ImageUploadTool;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopController extends Controller
{

    public function index()
    {
        //得到所有数据
//        $data=ShopCategory::all();
         $shops=Shop::paginate(2);

//
        //显示视图
        return view("shop.index",compact("shops"));


    }

    public function index1()
    {
        $shops=Shop::paginate(2);
        //得到所有数据

        //显示视图
        return view("shop.index1",compact("shops"));
        }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     * 添加商家
     */
    public function add(Request $request)
    {
        //得到所有分类信息
        $datas=ShopCategory::all();
//        var_dump($data);exit;
        //判断提交方式
        if ($request->isMethod("post")){
            //验证字段是否合法
            $this->validate($request,[
                "name"=>"required",

                "password"=>"required|min:3",

            ]);
            //的到所有数据
            $shops=$request->all();
//            var_dump($shops);exit;
            $shops['shop_logo']="";
            if ($request->file("shop_logo") ){
                $shops['shop_logo']=$request->file("shop_logo")->store("shop","logo");
            }
//dd($shops);
            //添加入库
           Shop::create($shops);
//            var_dump(Shop::create($shops));exit;
            //提示
            $request->session()->flash("success","添加成功");
            //跳转
            return redirect()->route("shop.index1");

        }
        //显示视图
        return view("shop.add",compact("shops","datas"));

        }
        /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     * 编辑商家
     */
    public function edit(Request $request,$id)
    {
        //得到所有商品分类信息
        $datas=ShopCategory::all();
        //通过id找到数据
      $shops=Shop::find($id);
      //判断提交方式
        if ($request->isMethod("post")){
            $this->validate($request,[
               "name"=>"required",
                "password"=>"required",
            ]);
            //的到更新后的数据
            $data=$request->all();
//            var_dump($shops);exit;
            $shops['shop_logo']="";
            if ( $shops['shop_logo']){
                $shops['shop_logo']=$request->file("shop_logo")->store("shop","logo");
            }
            //数据入库
            $shops->update($data);
            //提示
            $request->session()->flash("success","编辑成功");
            //跳转
            return redirect()->route("shop.index1");

            }
            return view("shop.edit",compact("data","shops","datas"));
        }

    public function del(Request $request,$id)
    {
        //通过id找到数据
        $shop=Shop::find($id);
        //删除
        $shop->delete();
        //提示
        $request->session()->flash("success","删除成功");
        //跳转
        return redirect()->route("shop.index1");

        }
}