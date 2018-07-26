<?php

namespace App\Http\Controllers\Shop;

use App\Exceptions\Handler;
use App\Models\Admin;
//use App\User;
use App\Models\User;
//use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends BaseController
{
    public function index(Request $request)
    {
       ;
        //得到所有数据
       $user=User::find( Auth::user()->id);
//       dd($users);
        //显示视图
        return view("shop/user/index",compact("user"));
        }

        public function edit(Request $request)
    {
        //通过id找到密码
        $admin = Auth::user();
//        dd(Auth::user());
//        $user = Auth::user();
            if (Hash::check($request->password, $admin->password)) {
            $admin->password=bcrypt($request->newPassword);
            $admin->save();
            //退出登录
                Auth::logout();
            //提示
            $request->session()->flash("success","修改成功");
            //跳转
            return redirect()->route("user.login");
        }


        //显示视图
        return view("shop.user.edit");
    }



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
            //给密码加密
            $data['password']=bcrypt($data['password']);
//            dd($data);
            //数据入库
           User::create($data);
            //提示
            $request->session()->flash("success","注册成功等待管理员审核");
            //跳转
            return redirect()->route("user.index");

        }
        //显示视图
        return view("shop/user/reg");


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
                if(Auth::user()->status===0){
                    Auth::logout();
                    return redirect()->route('user.login')->with('danger',"您登陆的商家商户已被禁用");

                }
                $request->session()->flash("success","登录成功");
                //跳转
                return redirect()->route("user.index");

            }else{
                $request->session()->flash("danger","账号或密码错误");
                return back()->withInput();

            }
        }
        //显示视图
        return view("shop/user/login");


    }

    public function loginout(Request $request)
    {
        Auth::logout();
        //提示
        $request->session()->flash("success", "注销成功");
        //跳转
        return redirect()->route("user.login");

    }

}
