<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
//店铺分类
Route::domain('admin.com')->namespace('Admin')->group(function () {
    //店铺分类管理
    Route::any('shop_category/index',"ShopCategoryController@index")->name("shop_category.index");
    Route::any('shop_category/add',"ShopCategoryController@add")->name("shop_category.add");
    Route::any('shop_category/edit',"ShopCategoryController@edit")->name("shop_category.edit");
    Route::any('shop_category/del',"ShopCategoryController@del")->name("shop_category.del");



    //店铺管理
    Route::any('shop/index',"ShopController@index")->name("shop.index");
    Route::any('shop/index1',"ShopController@index1")->name("shop.index1");
    Route::any('shop/add',"ShopController@add")->name("shop.add");
    Route::any('shop/edit/{id}',"ShopController@edit")->name("shop.edit");
    Route::any('shop/del/{id}',"ShopController@del")->name("shop.del");

});
//商户
Route::domain('shop.com')->namespace('Shop')->group(function () {
    Route::any('user.reg',"UserController@reg")->name("user.reg");
    Route::any('user.login',"UserController@login")->name("user.login");
    Route::any('user.loginout',"UserController@loginout")->name("user.loginout");
    Route::any('user.index',"UserController@index");
});

