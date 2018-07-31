<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    //菜单
    //设置可修改字段
    public $fillable=["goods_name","shop_id","category_id",
        "goods_price","description","month_sales","rating_count","tips","satisfy_count"
        ,"satisfy_rate","goods_img","status"];

    public function shops()
{
    return $this->belongsTo(Shop::class,"shop_id");

}

    public function category()
    {
        return $this->belongsTo(MenuCategory::class,'category_id');

}
}
