<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use function Sodium\crypto_box_publickey_from_secretkey;

class ShopCategory extends Model
{
    //设置可修改字段
    public $fillable=['name','logo','status'];
}
