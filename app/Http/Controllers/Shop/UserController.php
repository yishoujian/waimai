<?php

namespace App\Http\Controllers\Shop;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function reg(Request $request)
    {
        //判断提交方式
        if ($request->isMethod("post")){
            //验证字符是否合法
            $this->validate($request,[
                "name"=>"required",
                "password"=>"required",
                "email"=>"required|email"
            ]);
            //得到所有数据
            $data=$request->all();
//            dd($data);
            //数据入库
            User::create($data);
            //提示
            $request->session()->flash("success","注册成功等待管理员审核");
            //跳转
            return redirect()->route("user.login");

        }

        //显示视图
        return view("shop.reg");


    }

    public function login(Request $request)
    {
        //判断提交方式
        if ($request->isMethod("post")){
            //判断账号密码是否正确
            if (Auth::attempt(['name'=>$request->post('name'),
                'password'=>$request->post('password')],
                $request->has('remember'))){
                //提示
                $request->session()->flash("success","登录成功");
                //跳转
                return redirect()->route("shop.index");

            }else{
                $request->session()->flash("danger","账号或密码错误");
                return redirect()->route("user.reg");

            }
        }
        //显示视图
        return view("shop.login");


    }

}
