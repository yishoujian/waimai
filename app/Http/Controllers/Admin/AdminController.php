<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends BaseController
{
    public function reg(Request $request)
    {
        //判断提交方式
        if ($request->isMethod("post")) {
            //判断字段是否合法
            $this->validate($request, [
                "name" => "required",
                "password" => "required",
                "email" => "required|email"
            ]);

            $data = $request->all();
            //给密码加密
            $data['password'] = bcrypt($data['password']);
//            dd($data);
            //数据入库
            Admin::create($data);
            //提示
            $request->session()->flash("success", "注册成功");
            //跳转
            return redirect()->route("admin.login");
        }
        //显示视图
        return view("admin.reg");

    }

    public function login(Request $request)
    {
        //判断提交方式
        if ($request->isMethod("post")) {
            //判断账号密码是否正确

            if (Auth::guard("admin")->attempt(['name' => $request->post('name'),
                'password' => $request->post('password')],
                $request->post('remember'))) {
                //提示
                $request->session()->flash("success", "登录成功");
                //跳转
                return redirect()->route("shop.index");

            } else {
                $request->session()->flash("danger", "账号或密码错误");
                return redirect()->route("admin.reg");

            }
        }
        //显示视图
        return view("admin.login");


    }

    public function loginout(Request $request)

    {
        //退出登录
        Auth::logout();
        //提示
        $request->session()->flash("success", "注销成功");
        //跳转
        return redirect()->route("shop.index1");


    }

    /**
     * 管理员管理
     *
     */
    public function index(Request $request)
    {
        //得到所有数据
        $admins = Admin::all();
//       dd($admins);
        //显示视图
        return view("admin.admin.index", compact("admins"));

    }

    public function edit(Request $request, $id)
    {
        //通过id找到密码
        $admin = Admin::findOrfail($id);
//        dd($password);
//        $user = Auth::user();
        if (Hash::check($request->password, $admin->password)) {
           $admin->password=bcrypt($request->newPassword);
           $admin->save();
            //退出登录
            //提示
            $request->session()->flash("success","修改成功");
            //跳转
            return redirect()->route("admin.index");
        }
        //显示视图
        return view("admin.admin.edit");
    }



}
