<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index(Request $request)
    {
        //得到所有数据
        $users=User::all();
        //显示视图
        return view("admin/user/index",compact("users"));




    }
}
