<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::domain('www.waimai.com')->namespace('Api')->group(function () {
    //首页接口
    Route::any('shop/list', "ShopController@list");
    Route::any('shop/index', "ShopController@index");
    //登录
    Route::any('member/login', "MemberController@login");
    Route::any('member/reg', "MemberController@reg");
    Route::any('member/sms', "MemberController@sms");
    //忘记密码
    Route::any('member/new', "MemberController@new");
//修改密码
    Route::any('member/edit', "MemberController@edit");
//添加收货地址
    Route::any('address/add', "AddressController@add");
    //收货地址列表
    Route::any('address/list', "AddressController@list");
    //修改收货地址回显
    Route::any('address/edit', "AddressController@edit");
    //修改收货地址
    Route::any('address/update', "AddressController@update");
    //购物车添加
    Route::any('cart/add',"CartController@add");
    //购物车列表
    Route::any('cart/index',"CartController@index");
    //添加订单表
    Route::any('order/add',"OrderController@add");
    //指定订单
    Route::any('order/index',"OrderController@index");
    //订单列表
    Route::any('order/list',"OrderController@list");
    //支付
    Route::any('order/pay',"OrderController@pay");

});


