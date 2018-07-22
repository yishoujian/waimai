<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //设置可修改字段
    public $fillable=["name","password","email","stutas","shop_id"];

}
