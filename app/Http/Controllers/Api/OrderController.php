<?php

namespace App\Http\Controllers\Api;

use App\Models\Address;
use App\Models\Cart;
use App\Models\Member;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderGoods;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function add(Request $request)
    {
        //通过ID找到ID
        $user_id=$request->post('user_id');
//        dd($user_id);
        //找到地址
        $address=Address::find($request->post('address_id'));
//        dd($address);
        if ($address === null) {
            return [
                "status" => "false",
                "message" => "地址选择不正确"
            ];
        };
        //店铺id
        $cart=Cart::where("user_id",$user_id)->get();
//        dd($cart);
        //先找购物车第一条数据的商品ID，再通过商品ID在菜品中找出shop_id
        $shopId = Menu::find($cart[0]->goods_id)->shop_id;
//        dd($shopId);
        $data['shop_id'] = $shopId;
        //把用户ID和店铺ID追加进去
        $data['user_id']=$user_id;
        //生成订单号
        $sn=date('ymdHis').rand(1000,999);
//        dd($sn);
        $data['sn']=$sn;
        $data['provence'] = $address->provence;
        $data['city'] = $address->city;
        $data['area'] = $address->area;
        $data['detail_address'] = $address->detail_address;
        $data['tel'] = $address->tel;
        $data['name'] = $address->name;
        //算价格
        $total=0;
        foreach ($cart as $k=>$v){
            $goods = Menu::where('id', $v->goods_id)->first();
            //总计
            $total+=$v->amount * $goods->goods_price;
            }
        $data['total'] = $total;
        //3.6 状态 等待支付
        $data['status'] = 0;
        //入库
       $order=Order::create($data);
//       dd($order);

        //添加商品
        foreach ($cart as $a=>$b){
            //找到当前商品
            $good=Menu::find($b->goods_id);
//            dd($b);
            $dataGoods['order_id']=$order->id;
            $dataGoods['goods_id']=$b->goods_id;
            $dataGoods['amount'] = $b->amount;
            $dataGoods['goods_name'] = $good->goods_name;
            $dataGoods['goods_img'] = $good->goods_img;
            $dataGoods['goods_price'] = $good->goods_price;
            //数据入库
            OrderGoods::create($dataGoods);
            }
        return [
            "status" => "true",
            "message" => "添加成功",
            "order_id" => $order->id
        ];

        }

        //订单首页
    public function index(Request $request)
    {
        //通过ID找到数据
        $id=$request->input('id');
        //通过ID找到订单信息
        $order=Order::find($id);
//        dd($order);
        $data['id']=$order->id;
        $data['order_birth_time']=(string)$order->created_at;
        $data['order_address']=$order->provence.$order->city.$order->area.$order->detail_address;
//        dd( $data['order_address']);
        $data['order_price'] = $order->total;
        $data['order_code']=$order->sn;
        $data['order_price']=$order->total;
        $data['order_status']=$order->order_status;
        $data['shop_id']=$order->shop_id;
        $data['shop_name'] = $order->shop->shop_name;
        $data['shop_img'] = $order->shop->shop_img;
        $data['goods_list']=$order->goods;
          return $data;
          }


          /**
           * 支付
           */
    public function pay(Request $request)
    {
        // 得到订单
        $order=Order::find($request->post('id'));
        //得到用户
        $user=Member::find($order->user_id);
//        dd($user);
        //判断钱够不够支付
        if ($user->money < $order->total){
            return [
                'message'=>'支付失败,余额不足',
                'status'=>'false',
            ];
        }else{
            $user->money= $user->money - $order->total;
            $user->save();
        }

        //更改订单状态
        $order->status = 1;
        $order->save();

        return [
          'status'=>'true',
            'message'=>'支付成功'
        ];

          }

    /**
     * @param Request $request
     * 订单列表
     */

    public function list(Request $request)
    {
        $orders=Order::where('user_id',$request->input('user_id'))->get();
//        dd($order);
//        $data1=[];
        foreach ($orders as $order){
//            $data['id'] = $order->id;
            $order['order_address']=$order->provence.$order->city.$order->area.$order->detail_address;
            $order['order_birth_time']=(string)$order->created_at;
            $order['order_code']=$order->sn;
            $order['order_price']=$order->total;
            $order['order_status']=$order->status;
            $order['shop_id']=(string)$order->shop_id;
            $order['shop_name'] = $order->shop->shop_name;
            $order['shop_img'] = $order->shop->shop_img;
//       return  $order->goods;
//            $order['goods_list'] =$order->goods;
            $order['goods_list'] = $order->goods;
//            dd($order['goods_list']);
        }
        return $orders;
        }


}
