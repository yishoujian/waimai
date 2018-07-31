<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuCategory extends Model
{
    //设置可修改字段
    public $fillable=['name','type_accumulation','shop_id','description','is_selected'];

    public function cate1()
    {
      return  $this->belongsTo(Shop::class,'shop_category_id');

    }
}
