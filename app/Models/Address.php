<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    public $fillable=['user_id','name','tel','provence','area','city','detail_address','is_default'];
}
