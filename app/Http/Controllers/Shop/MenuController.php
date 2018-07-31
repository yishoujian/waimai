<?php

namespace App\Http\Controllers\Shop;

use App\Models\MenuCategory;
use App\Models\Menu;
use App\Models\Shop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        //得到所有数据
       //$menus=Menu::all();
//        dd($shops);
        //得到所有商家分类
        $cates=MenuCategory::all();

        //接收
        $search=$request->input("search");
        $min=$request->input("min");
        $max=$request->input("max");
        $cate=$request->input("cate");
        $re=Menu::orderBy('id');
//  dd($re);
        if ($min!==null){
            $re->where('goods_price','>=',$min);
        }

        if ($max!==null){
            $re->where('goods_price','<=',$max);
        }

        if ($search!==null){
            $re->where('goods_name','like',"%{$search}%");
        }
        if ($cate!==null){
            $re->where('category_id',$cate);
        }
        $menus = $re->paginate(2);
//        dd($menus);
        //显示视图
        return view("shop/menu/index",compact("cates","menus"));

    }

    public function add(Request $request)
    {
        //得到所有的商家
        $shops=Shop::all();
        //得到分类id
        $cates=MenuCategory::all();
//        dd($cate=MenuCategory::all());
        //判断提交方式
        if ($request->isMethod("post")){
            //判断字段是否合法
            $this->validate($request,[
//                "goods_name" => "required",
//                "category_id" => "required",
                "shop_id" => "required",
                "tips"=>"required"
            ]);
            //的到添加的所有数据
            $menus=$request->all();
            $menus['month_sales']="";
            $menus['month_sales']="";
            $menus['rating_count']="";
//            $menus['satisfy_count']="";
//            $menus['satisfy_rate']="";
            $menus["goods_img"]= $request->file("goods_img")->store('goods',"logo");
            //数据入库
            Menu::create($menus);
            //提示
            $request->session()->flash("success","添加成功");
            //跳转
            return redirect()->route("menu.index");
        }
        //显示视图
        return view("shop/menu/add",compact("shops","cates"));
    }
    public function edit(Request $request,$id)
    {
        //得到分类id
        $cates=MenuCategory::all();
        //得到店铺信息
        //$shops=Shop::all();
        //通过id找到数据
        $menu=Menu::findOrfail($id);
//        dd($shop);
//        dd($shop);
        //判断提交方式
        if ($request->isMethod("post")){
            //判断字段是否合法
            $this->validate($request,[
               "goods_name"=>"required",
//                "type_accumulation"=>"required",
               // "shop_id"=>"required",
            ]);
            //得到编辑后的所有数据
            $data=$request->all();

     // dd($data);
            //数据入库
//            MenuCategory::updated($menu);
            $menu->update($data);
            //提示
            $request->session()->flash("success","编辑成功");
            //跳转
            return redirect()->route("menu.index");
        }
        //显示视图
        return view("shop/menu/edit",compact('menu','cates'));


    }

    public function del(Request $request,$id)
    {
        //通过ID得到数据
        $menu=Menu::findOrFail($id);
        //入库
        if ($menu->create_id!==""){
            $menu->delete();
            //提示
            $request->session()->flash("success","删除成功");
            //跳转
            return redirect()->route("menu.index");
        }
        //提示
        $request->session()->flash("success","不能删除");
        //跳转
        return redirect()->route("menu.index");



    }





}
