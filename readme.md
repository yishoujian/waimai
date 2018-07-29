第四天:功能完成啦,在时间转换的时候有点问题,在写判断的时候where语法格式不晓得,现在都已经解决,但是软件没的行!
第六条:API接口 登录 注册 修改密码和重置密码 功能都完成啦,但是`
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
        //把验证码存到Redis里
        Redis::setex("tel_".$tel,300,$code);

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
`

Hash::check(传来的密码,数据库的密码); 返回布尔值

` 
  
          if ($member && Hash::check($request->post('password'),$member->password)){
                     return [
                       'status'=>'true',
                       'message'=>'登录成功',
                         'user_id'=>$member->id,
                         'user_name'=>$member->username
                     ];
         
                 }`
                 
                 