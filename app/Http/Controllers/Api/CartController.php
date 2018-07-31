<?php

namespace App\Http\Controllers\Api;

use App\Models\Cart;
use App\Models\Menu;
use function Couchbase\defaultDecoder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CartController extends BaseController
{


    //判断字段是否合法
    public function add(Request $request)
    {
        $id=$request->post("user_id");
        //清空前面的购物车
        Cart::where('user_id',$id)->delete();
        //接收所有数据
        $data = $request->all();
//        dd($data);
        //通过goods_list 获取goods_id
        $goodsList = $data['goodsList'];
        $goodsCount = $data['goodsCount'];
        foreach ($goodsList as $k => $v) {
            $data1 = [
                'goods_id' => $v,
                'amount' => $goodsCount[$k],
                'user_id' => $data['user_id']
            ];
            //入库
            Cart::create($data1);

        }
        return [
            "status" => "true",
            "message" => "添加成功"
        ];
    }

    //购物车数据接口
    public function index(Request $request)
    {
        $id=$request->user_id;
//        dd($id);
        //通过id找到购物车
        $carts=Cart::where('user_id',$id)->get();
        $totalCost="";
//        dd($carts);
        foreach ($carts as $k=>$cart){
            $menus=Menu::where('id',$cart->goods_id)->get()->first();
//            dd($menus);
         $array[$k]=[
           'goods_id'=>"$menus->id",
             'goods_name'=>$menus->goods_name,
             'goods_img'=>$menus->goods_img,
             'goods_price'=>$menus->goods_price,
             'amount'=>$cart->amount,
         ];
            $totalCost=$array[$k]['goods_price']*$array[$k]['amount']+$totalCost;
            }
//         dd($totalCost);
        $data=[];
        $data["goods_list"]=$array;
        $data['totalCost']=$totalCost;
//        dd($array);
        return $data;
        }
}
/*$arr=[];
$arr->goods_name=$menus->goods_name;
$arr->goods_img=$menus->goods_img;*/

