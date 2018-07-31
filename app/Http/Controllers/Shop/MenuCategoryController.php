<?php

namespace App\Http\Controllers\Shop;

use App\Models\Menu;
use App\Models\MenuCategory;
use App\Models\Shop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MenuCategoryController extends Controller
{
    //
    public function index(Request $request)
    {
        //得到所有数据
        $cates=MenuCategory::all();
        //显示视图
        return view("shop/menu_category/index",compact("cates"));

    }

    public function add(Request $request)
    {
        //得到所有的商家
        $shops=Shop::all();
//        dd($shops);
        //判断提交方式
        if ($request->isMethod("post")){
           //判断字段是否合法
            $this->validate($request,[
                "name"=>"required",
//                "type_accumulation"=>"required",
                "shop_id"=>"required",
            ]);
          if ($request->post('is_selected')==='1'){
              MenuCategory::where('shop_id','=',$request->post('shop_id'))->update(['is_selected'=>0]);

          }

            //的到添加的所有数据
            $menus=$request->all();

            //数据入库
            MenuCategory::create($menus);
            //提示
            $request->session()->flash("success","添加成功");
            //跳转
            return redirect()->route("menu_category.index");
            }
            //显示视图
        return view("shop/menu_category/add",compact("shops"));
            }

    public function edit(Request $request,$id)
    {
        $shops=Shop::all();
        //通过id找到数据
        $shop=MenuCategory::findOrfail($id);
//        dd($shop);
        //判断提交方式
        if ($request->isMethod("post")){
            //判断字段是否合法
            $this->validate($request,[
                "name"=>"required",
//                "type_accumulation"=>"required",
                "shop_id"=>"required",
            ]);
            //得到编辑后的所有数据
            $menu=$request->all();
//            dd($menu);
            //数据入库
//            MenuCategory::updated($menu);
                $shop->update($menu);
            //提示
            $request->session()->flash("success","编辑成功");
            //跳转
            return redirect()->route("menu_category.index");
        }
        //显示视图
        return view("shop/menu_category/edit",compact('shop','shops'));


        }

    public function del(Request $request,$id)
    {
        //通过id找到数据
        $shop=MenuCategory::findOrFail($id);
       $data=Menu::where("category_id",$id)->count();
       if ($data!==0){


        //提示
        $request->session()->flash("danger","不能删除有内容的分类");
        //跳转
        return redirect()->route("menu_category.index");
       }else{
           $shop->delete();
           //提示
           $request->session()->flash("success","删除成功");
           //跳转
           return redirect()->route("menu_category.index");
       }







        }

}
