<?php

namespace App\Http\Controllers\Api;

use App\Models\Menu;
use App\Models\MenuCategory;
use App\Models\Shop;
use App\Models\ShopCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopController extends BaseController
{
    public function list(Request $request)
    {
        //接收搜索字段
        $keyword=$request->input('keyword');

        //查询到所有状态为1的商家
        //搜索
        $shops = Shop::where('status', 1)->where("shop_name","like","%$keyword%")->get();
        foreach ($shops as $shop) {
            $shop->distance = rand(0, 5000);
            $shop->estimate_time = $shop->distance / 200;
            $shop->shop_img = ''.$shop->shop_img;
        }
        return $shops;
    }

    public function index(Request $request)
    {
        $id = $request->input('id');

        $shop = Shop::findOrfail($id);
        $shop->evaluate = [
            [
                "user_id" => 12344,
                "username" => "w******k",
                "user_img" => "http://www.homework.com/images/slider-pic4.jpeg",
                "time" => "2017-2-22",
                "evaluate_code" => 1,
                "send_time" => 30,
                "evaluate_details" => "不怎么好吃"
            ],
            ["user_id" => 12344,
                "username" => "w******k",
                "user_img" => "http://www.homework.com/images/slider-pic4.jpeg",
                "time" => "2017-2-22",
                "evaluate_code" => 4.5,
                "send_time" => 30,
                "evaluate_details" => "很好吃"
            ],
        ];

        $menus=MenuCategory::where('shop_id',$id)->get();
        foreach ($menus as $menu){
            $menu->goods_list=Menu::where('category_id',$menu->id)->get();
        }
        $shop->commodity=$menus;
        return $shop;

    }

}
