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
    Route::any('shop_category/edit/{id}',"ShopCategoryController@edit")->name("shop_category.edit");
    Route::any('shop_category/del/{id}',"ShopCategoryController@del")->name("shop_category.del");
    //店铺管理
    Route::any('shop/index',"ShopController@index")->name("shop.index");
    Route::any('shop/index1',"ShopController@index1")->name("shop.index1");
    Route::any('shop/add',"ShopController@add")->name("shop.add");
    Route::any('shop/edit/{id}',"ShopController@edit")->name("shop.edit");
    Route::any('shop/del/{id}',"ShopController@del")->name("shop.del");
    Route::any('shop/check/{id}',"ShopController@check")->name("shop.check");

    //活动管理
    Route::any('activity/index1',"ActivityController@index")->name("activity.index1");
    Route::any('activity/add',"ActivityController@add")->name("activity.add");
    Route::any('activity/edit/{id}',"ActivityController@edit")->name("activity.edit");
    Route::any('activity/del/{id}',"ActivityController@del")->name("activity.del");


    //管理员管理
    Route::any('admin/reg',"AdminController@reg")->name("admin.reg");
    Route::any('admin/login',"AdminController@login")->name("admin.login");
    Route::any('admin/loginout',"AdminController@loginout")->name("admin.loginout");
    Route::any('admin/index',"AdminController@index")->name("admin.index");
    Route::any('admin/edit/{id}',"AdminController@edit")->name("admin.edit");
    Route::any('admin/del/{id}',"AdminController@del")->name("admin.del");
    Route::any('user/index',"UserController@index")->name("user.index");
    //图片上传
    Route::any('uploads/index',"UploadsController@index")->name("uploads.index");


});
//商户
Route::domain('shop.com')->namespace('Shop')->group(function () {
    Route::any('user/reg',"UserController@reg")->name("user.reg");
    Route::any('user/login',"UserController@login")->name("user.login");
    Route::any('user/loginout',"UserController@loginout")->name("user.loginout");
    Route::any('user/index',"UserController@index")->name("user.index");
    Route::any('user/edit',"UserController@edit")->name("user.edit");


    //菜品分类
    Route::any('menu_category/index',"MenuCategoryController@index")->name("menu_category.index");
    Route::any('menu_category/add',"MenuCategoryController@add")->name("menu_category.add");
    Route::any('menu_category/edit/{id}',"MenuCategoryController@edit")->name("menu_category.edit");
    Route::any('menu_category/del/{id}',"MenuCategoryController@del")->name("menu_category.del");
     //菜单
    Route::any('menu/index',"MenuController@index")->name("menu.index");
    Route::any('menu/add',"MenuController@add")->name("menu.add");
    Route::any('menu/edit/{id}',"MenuController@edit")->name("menu.edit");
    Route::any('menu/del/{id}',"MenuController@del")->name("menu.del");

    //活动
    Route::any('activity/index',"ActivityController@index")->name("activity.index");

});

