<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Shop extends Model
{
    public $fillable=["shop_category_id","name","shop_logo",
        "shop_rating","brand","fengniao","bao","piao","zhun","start_send",
        "send_cost","notice","discount"];

    public function cate()
    {
        return $this->belongsTo(ShopCategory::class,'shop_category_id');
        }
}

