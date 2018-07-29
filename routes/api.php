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

    //首页接口
    Route::any('shop/list', "Api\ShopController@list");
    Route::any('shop/index', "Api\ShopController@index");
    //登录
    Route::any('member/login', "Api\MemberController@login");
    Route::any('member/reg', "Api\MemberController@reg");
    Route::any('member/sms', "Api\MemberController@sms");
    //忘记密码
Route::any('member/new', "Api\MemberController@new");
//修改密码
Route::any('member/edit', "Api\MemberController@edit");




