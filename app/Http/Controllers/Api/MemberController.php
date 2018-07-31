<?php

namespace App\Http\Controllers\Api;

use App\Models\Member;
use function Couchbase\defaultDecoder;
use Illuminate\Foundation\Http\Middleware\ValidatePostSize;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;
use Mrgoon\AliSms\AliSms;

class MemberController extends BaseController
{
    /**
     * @param Request $request
     * 发送短信 得到验证码
     */
    public function sms(Request $request)
    {
        //接收手机号
        $tel=$request->tel;
//        dd($tel);
        //生成随机的验证码
        $code=rand(1000,9999);
//        dd($code);
        //把验证码存到缓存里
//        Redis::setex("tel_".$tel,300,$code);
        cache(["tel_".$tel => $code], 5);

       return[
            "status"=>"true",
            "message" => "获取短信验证码成功".$code
        ];
        //把随机验证码发送给用户
        $config = [
            'access_key' => 'LTAICkzbQn0fTiHc',
            'access_secret' => 'xRoz5ISd0e8GMo2YnStxneXRbAF5P5',
            'sign_name' => '易守健',
        ];
        $aliSms = new AliSms();
        $response = $aliSms->sendSms($tel, 'SMS_140725313', ['code'=>$code], $config);

        if ($response->Message==='ok'){
//            dd($response->Message);
            return[
           "status"=>"true",
          "message" => "获取短信验证码成功".$code
       ];
        }else{
            return [
                "status" => "false",
                "message" =>$response->Message,
                ];
        };


    }

    /**
     * @param Request $request
     * @return array
     * 注册
     */


    public function reg(Request $request){
        //接收数据
        $data=$request->all();
//        dd($data);
        //设置规则
        //创建一个验证规则

        $validate = Validator::make($data, [
            'username' => 'required|unique:members',
            'sms' => 'required|integer|min:1000|max:9999',
            'tel' => [
                'required',
                'regex:/^0?(13|14|15|17|18|19)[0-9]{9}$/',
                'unique:members'
            ],
            'password' => 'required'
        ]);
        //判断  如果有错
        if ($validate->fails()){
            return [
              'status'=>'false',
              //获取错误信息
                'message'=>$validate->errors()->first(),
            ];
        }
        //验证码
        //取出验证码
//        $code=Redis::get("tel_".$data['tel']);
        $code = Cache::get("tel_".$data['tel']);
//        dd($code);
        //判断验证码是否一致
        if ($code!=$data['sms']){

            return [
                'status'=>'false',
                'message'=>"验证码错误"

            ];
        }
        //密码加密
        $data['password']=bcrypt($data['password']);
        //数据入库
        Member::create($data);
        //返回数据
        return [
          'status'=>'true',
          'message'=>'注册成功'
        ];
        }

        /**
         * 登录
         */
    public function login(Request $request)
    {
        //1.先通过用户名找哪当前用户
        $member = Member::where("username", $request->post('name'))->first();
//        dd($member);
        //验证密码是否正确
        if ($member && Hash::check($request->post('password'),$member->password)){
            return [
              'status'=>'true',
              'message'=>'登录成功',
                'user_id'=>$member->id,
                'user_name'=>$member->username
            ];

        }
        return [
          'status'=>'false',
          'message'=>'账号或者密码错误'
        ];


    }
    /**
     * 忘记密码 重置密码
     *
     */
    public function new(Request $request)
    {
        //接收数据
        $data=$request->all();
        //通过电话号码 找到用户
        $member = Member::where("tel", $request->post('tel'))->first();
        //验证验证码
        $code = Cache::get("tel_".$data['tel']);
//        dd($code);
        //判断验证码是否一致
        //密码不能为空
        if ($code!=$data['sms']){
            return [
                'status'=>'false',
                'message'=>"验证码错误"
            ];
        }
        $member->password=bcrypt($data['password']);
        $member->save();
        return [
            'status'=>'true',
            'message'=>"重置成功"

        ];
        }



        /**
         * 修改密码
         */
    public function edit(Request $request)
    {
        //得到新密码
        $newPassword=$request->newPassword;
        //得到ID
        $id=$request->id;
        //通过ID找到旧密码
        $oldPassword=$request->oldPassword;
        //        dd($oldPassword);
        //得到数据库里面的密码
        $password=Member::findOrfail($id);
        //解密
//        $password1=Hash::check($password);
//        dd($password);
        //修改密码
        if (Hash::check($oldPassword,$password->password)){
//            dd(bcrypt($newPassword));
            $passwords['password']=bcrypt($newPassword);
            $password->update($passwords);
            return [
                'status'=>'true',
                'message'=>"重置成功"
            ];
//            return 222;
        }
//        return   111;
        return [
            'status'=>'false',
            'message'=>"重置失败"
        ];



        }

}
